<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listProject($per_page_record = 10, $page_number = 1) {
        $FirstName = getStringClean(($this->input->post('FirstName')!='')?$this->input->post('FirstName'):'');
        $Email            = getStringClean(($this->input->post('Email') != '')?$this->input->post('Email'):'');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '')?$this->input->post('MobileNo'):'');
        $status_search_value           = ($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        $GroupID  = -1;
        $sql ="call usp_A_GetProject('".$per_page_record."' , '".$page_number."','".$FirstName."' , '".$Email."','".$GroupID."','" . $status_search_value ."')";
        $query =  $this->db->query($sql);
           $query->next_result();
           //pr($query->result());exit;
        return $query->result();  
    }
    function insert($array){
        $array['Type']     = getStringClean((isset($array['Type']))    ? $array['Type']  : 'New');
        $array['ProjectType']     = getStringClean((isset($array['ProjectType']))    ? $array['ProjectType']  : NULL);
        $array['Title']     = getStringClean((isset($array['Title']))    ? $array['Title']  : NULL);
        $array['Location']     = getStringClean((isset($array['Location']))    ? $array['Location']  : NULL);
        $array['Description']         = getStringClean((isset($array['Description']))        ? $array['Description']      : NULL);
        $array['GroupID']      = (isset($array['GroupID']))       ? $array['GroupID']   : 0;
        $array['ATSPercentage']      = getStringClean((isset($array['ATSPercentage']))       ? $array['ATSPercentage']   : 0);
        $array['TotalUnits']      = getStringClean((isset($array['TotalUnits']))       ? $array['TotalUnits']   : 0);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1){
            $array['UserType'] = 'Admin Web';
        }else{
            $array['UserType'] = 'Employee Web';
        }
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddProject('" . 
            $array['Title'] . "','" .
            $array['Location'] . "','" .  
            $array['Description'] . "','" . 
            $array['GroupID']  . "','" . 
            $array['TotalUnits'] . "','" . 
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','".
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['ATSPercentage'] . "','" .
            $array['Prefix'] ."','".
            $array['ProjectType']."','".
            $array['Type']."')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function getRecordCount(){
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_project','ProjectID')");
        $query->next_result();
        return $query->result();
    }

    function update($array){
        $array['Type']     = getStringClean((isset($array['Type']))    ? $array['Type']  : 'New');
        $array['ProjectType']     = getStringClean((isset($array['ProjectType']))    ? $array['ProjectType']  : NULL);
        $array['Title']     = getStringClean((isset($array['Title']))    ? $array['Title']  : NULL);
        $array['Location']     = getStringClean((isset($array['Location']))    ? $array['Location']  : NULL);
        $array['Description']         = getStringClean((isset($array['Description']))        ? $array['Description']      : NULL);
        $array['GroupID']      = (isset($array['GroupID']))       ? $array['GroupID']   : 0;
        $array['ATSPercentage']      = getStringClean((isset($array['ATSPercentage']))       ? $array['ATSPercentage']   : 0);
        
        $array['TotalUnits']      = getStringClean((isset($array['TotalUnits']))       ? $array['TotalUnits']   : 0);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1){
            $array['UserType'] = 'Admin Web';
        }else{
            $array['UserType'] = 'Employee Web';
        }
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditProject('" . 
            $array['ProjectID'] . "','" .
            $array['Title'] . "','" .
            $array['Location'] . "','" .  
            $array['Description'] . "','" .
            $array['GroupID']  . "','" .
            $array['TotalUnits'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','".
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['ATSPercentage'] . "','" .
            $array['Prefix'] ."','".
            $array['ProjectType']."','".
            $array['Type']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($project_id = NULL) {
        $query = $this->db->query("call usp_A_GetProjectByID ('" . $project_id . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = (isset($data['table_name']))?$data['table_name']:"sssm_project";
        $data['field_name']  = (isset($data['field_name']))?$data['field_name']:"ProjectID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
      
    function getGroupComboBox()
    {
        $query = $this->db->query("call usp_A_GetGroup_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    public function GetProjectRule($ProjectID) {
        $sql ="call usp_A_GetProjectRule('".
                    $ProjectID.
                    "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->row();  
    }
    public function AddEditProjectRule($array) {
        if($this->session->userdata['IsAdmin'] = 1){
            $array['UserType'] = 'Admin Web';
        }else{
            $array['UserType'] = 'Employee Web';
        }
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_AddEditProjectWiseRule('".
                    $array['ProjectID']. "','" .
                    getStringClean($array['Rule']). "','" .
                    $array['CreatedBy']. "','" .
                    $array['UserType']. "','" .
                    $array['IPAddress']. 
                    "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->row();  
    }
}




