<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitorleads_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $VisitorID=($this->input->post('VisitorID')!='')?$this->input->post('VisitorID'):-1;
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        $sql ="call usp_A_GetVisitLeads('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $VisitorID."','".
                    $status_search_value."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "ss_visitlead";
        $data['field_name']  = "VisitLeadID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }

}