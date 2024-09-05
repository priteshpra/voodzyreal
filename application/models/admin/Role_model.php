<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function insertRoleMap($array) {

        // Start for insert Role in sssm_role table
        if($array['RoleID'] != 0){
            $RoleID = $array['RoleID'];
            $RoleID = $this->UpdateRole($array);
            $RoleProject = $this->role_model->GetRoleProjectByRoleID($RoleID);
            foreach ($RoleProject as $key => $rolevalue) {
                $sql = "call usp_M_DeleteField('sssm_rolemap','RoleProjectID','" . $rolevalue->RoleProjectID . "')";
                $query = $this->db->query($sql);
                $query->next_result();
            }
            $sql = "call usp_M_DeleteField('sssm_roleproject','RoleID','" . $RoleID . "')";
            $query = $this->db->query($sql);
            $query->next_result();
        }else{
        $RoleID = $this->InsertRole($array);
        }
        // END for insert Role in sssm_role table

        $allmodules = $this->GetAllModules(); // Get All Modules
        $Bothvalue = array();
        foreach ($allmodules as $value) {
            if($value->Type == "Both"){
                $Bothvalue[] = $value;
            }else{
                $other[] = $value;
            }
        }
        $Actions = unserialize(ROLEACTIONS);    // Get All Module's Action
        $CreatedBy = $this->session->userdata['UserID'];

        foreach ($array['Project'] as $key => $value) {// Loop By Project
            $data = array(
                    'RoleID' => $RoleID,
                    'ProjectID' => $value['ProjectID'],
                    'CreatedBy' => $CreatedBy
            );
            $this->db->insert('sssm_roleproject', $data);
            $RoleProjectID = $this->db->insert_id();
            // Insert in Role Project 
            
            $insertMod = @$value['mod']; 
            $insert_batch_array = array();
            $allmodules = $this->GetAllModules();
            if($value['ProjectID'] == 0){
                $cusmodule = $Bothvalue;       
            }else{
                $cusmodule = $other;
            }
            foreach ($cusmodule as $key => $modvalue) {

                $Module = $modvalue->ModuleID;
                $tmp_array = array();
                $tmp_array['RoleProjectID'] = $RoleProjectID;
                $tmp_array['ModuleID'] = $modvalue->ModuleID;
                foreach ($Actions as $value) {
                    $tmp_array[$value] = (isset($insertMod[$modvalue->ModuleID][$value]) && $insertMod[$modvalue->ModuleID][$value]=="on")?1:0;
                }
                $insert_batch_array[] = $tmp_array;
            }
            $this->db->insert_batch('sssm_rolemap', $insert_batch_array);
        }
        return 1;
    }

    function InsertRole($array){
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $CreatedBy = $array['created_by'] = $this->session->userdata['UserID'];
        $sql = "CALL usp_A_AddRoles('" . 
            $array['Name'] . "','" . 
            $array['Description'] . "','" . 
            $array['created_by'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        return $result->ID;
    }

    function UpdateRole($array){
        $array['Name'] = getStringClean(isset($array['Name']) ? $array['Name'] : NULL);
        $array['Description'] = getStringClean(isset($array['Description']) ? $array['Description'] : NULL);
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $CreatedBy = $array['created_by'] = $this->session->userdata['UserID'];
        $sql = "CALL usp_A_EditRoles('" . 
            $array['Name'] . "','" . 
            $array['Description'] . "','" . 
            $array['created_by'] . "','1','".
            $array['RoleID']."','".
            $array['usertype']."','".
            $array['IPAddress']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        return $result->ID;
    }

    function listRole($per_page_record = Null, $page_number = Null) {
        if ($per_page_record == Null) {
            $per_page_record = 10;
        }
        if ($page_number == Null) {
            $page_number = 1;
        }
        $RoleName = getStringClean(($this->input->post('RoleName') != '') ? $this->input->post('RoleName') : '');
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetRoles( '$per_page_record' , '$page_number','$RoleName','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function listRoleMapping($per_page_record = 10, $page_number = 1,$rolename = -1) {
        $RoleID = ($rolename != '') ? $rolename : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetRoleListing( '$per_page_record' , '$page_number','$RoleID','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getParentModules($id = -1) {
        $sql = "call usp_A_GetParentModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getSubModules($parent_id = Null) {
        $sql = "call usp_A_GetSubModules('" . $parent_id . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function getChildModules($id = -1) {
        $sql = "call usp_A_GetChildModules('$id')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function changeStatus($array) {
        $array['id'] = getStringClean((isset($array['id'])) ? $array['id'] : NULL);
        $array['status'] = getStringClean((isset($array['status'])) ? $array['status'] : NULL);

        $array['table_name'] = "sssm_roles";
        $array['field_name'] = "RoleID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function getRoleByID($id = null) {
        $query = $this->db->query("CALL usp_A_GetRolesByID($id)");
        $query->next_result();
        $result['role'] = $query->row();
        return $result;
    }

    public function getCustomerByRoleID($id = null) {
        $query = $this->db->query("CALL usp_A_GetCustomerByRoleID($id)");
        $query->next_result();
        $result['roledata'] = $query->row();
        return $result;
    }

    public function getRoleComboBox() {
        $query = $this->db->query("call usp_A_GetRole_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    public function GetAllModules() {
        $query = $this->db->query("call usp_A_GelAllModule()");
        $query->next_result();
        return $query->result();
    }
    public function GetRoleProjectByRoleID($RoleID) {
        $query = $this->db->query("call usp_A_GetRoleProjectByRoleID($RoleID)");
        $query->next_result();
        return $query->result();
    }
    public function GetModuleByRoleProjectID($RoleProjectID){
        $query = $this->db->query("call usp_A_GetModuleByRoleProjectID($RoleProjectID)");
        $query->next_result();
        $data = $query->result_array();
        $formated_array = array();
        foreach ($data as $key => $value) {
            $formated_array[$value['ModuleID']] = $value;
        }
        return $formated_array;

    }

}
