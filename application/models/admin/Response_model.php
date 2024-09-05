<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Response_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    public function listData($per_page_record = 10, $page_number = 1,$Type = "Customer") {
        $ID = $this->input->post('ReminderID');
        $sql ="call usp_A_GetResponse('".$per_page_record."' , '".$page_number."','" .$ID ."','" . $Type ."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
}




