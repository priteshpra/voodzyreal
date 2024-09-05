<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $ProjectID = $this->input->post('ProjectID');
        $sql ="call usp_A_GetProperty('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $ProjectID.
                    "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['ProjectID']     = (isset($data['ProjectID']))    ? $data['ProjectID']  : '';
        $data['SaleableArea']     = (isset($data['SaleableArea']))    ? $data['SaleableArea']  : '';
        $data['TarreceSaleableArea']     = (isset($data['TarreceSaleableArea']))    ? $data['TarreceSaleableArea']  : '';

        $data['PropertyNo']     = getStringClean((isset($data['PropertyNo']))    ? $data['PropertyNo']  : '');
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddProperty('" . 
            $data['ProjectID'] . "','" .
            $data['PropertyNo'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."','".
            $data['SaleableArea'] ."','".
            $data['TarreceSaleableArea'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data){
        $data['ProjectID']     = (isset($data['ProjectID']))    ? $data['ProjectID']  : '';
        $data['SaleableArea']     = (isset($data['SaleableArea']))    ? $data['SaleableArea']  : '';
        $data['TarreceSaleableArea']     = (isset($data['TarreceSaleableArea']))    ? $data['TarreceSaleableArea']  : '';
        $data['PropertyNo']     = getStringClean((isset($data['PropertyNo']))    ? $data['PropertyNo']  : '');
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditProperty('" . 
            $data['PropertyID'] . "','" .
            $data['ProjectID'] . "','" .
            $data['PropertyNo'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."','".
            $data['SaleableArea'] ."','".
            $data['TarreceSaleableArea'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetPropertyByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_property";
        $data['field_name']  = "PropertyID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
    
    function email_exists($email,$contact){
        $query = $this->db->query("call usp_A_CheckEmployeeEmailExist('".getStringClean($email)."','".getStringClean($contact)."')");
        //$query->next_result();
        return $query->row();
    }
    
    function getEmployee()
    {
        $query = $this->db->query("call usp_A_GetEmployee_ComboBox()");
        $query->next_result();
        return $query->result();
    }
   
    function checkDuplicate($data){
        $query = $this->db->query("call usp_A_CheckProperty('".
            $data['ProjectID'] . "','".
            getStringClean($data['PropertyNo']) . "','".
            $data['PropertyID'] . "')");
        $query->next_result();
        return $query->row();   
    }

}