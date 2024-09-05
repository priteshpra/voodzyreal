<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Process_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $ID = $this->input->post('CustomerPropertyID');
        $sql ="call usp_A_GetCustomerProcess('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $ID.
                    "','CustomerProperty')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
}




