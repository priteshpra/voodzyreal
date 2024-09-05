<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $ProjectID = $this->input->post('ProjectID');
        $sql ="call usp_A_GetProjectGallery('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $ProjectID.
                    "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['ProjectID']     = (isset($data['ProjectID']))    ? $data['ProjectID']  : 0;
        $data['ImagePath']     = (isset($data['ImagePath']))    ? $data['ImagePath']  : '';
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddProjectGallery('" . 
            $data['ImagePath'] . "','" .
            $data['ProjectID'] . "','" .
            $data['CreatedBy'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}




