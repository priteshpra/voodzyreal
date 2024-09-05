<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $sql ="call usp_M_GetCustomerDocumentByCProperty('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $CustomerPropertyID. "','".
                    site_url().
                    "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['Title']     = getStringClean((isset($data['Title']))    ? $data['Title']  : '');
        $data['ImagePath']     = (isset($data['ImagePath']))    ? $data['ImagePath']  : '';
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomerPropertyDocument('" . 
            $data['CustomerPropertyID'] . "','" .
            $data['ImagePath'] . "','" .
            $data['Title'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."','',0);" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Delete($ID = NULL) {
        $sql = "call usp_M_DeleteField('sssm_customerpropertydocument','CustomerPropertyDocumentID','" . $ID . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_customerpropertydocument";
        $data['field_name']  = "CustomerPropertyDocumentID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
}