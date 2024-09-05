<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Misscall_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $sql ="call usp_A_GetMisscallAPI('".$per_page_record."' , '".$page_number."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
}




