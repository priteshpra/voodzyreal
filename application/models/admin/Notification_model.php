<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    public function listData($per_page_record = 10, $page_number = 1){        
        
        if ($this->session->userdata['RoleID'] =="-1" || $this->session->userdata['RoleID'] =="-2") {
            $ID='-1';
        }
        else{
            $ID = $this->session->userdata['UserID'];
        }
        $sql = "call usp_M_GetNotification( '$per_page_record' , '$page_number','$ID','".base_url()."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getNotificationCount(){
        
        $sql = "call usp_M_GetNotificationCount()";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function updateReadNotification(){

     $sql = "call usp_U_updateReadNotification()";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();   
    }

    public function Insert($array)
    {
    
        $sql = "call usp_M_AddNotification('" .
            $array['UserID'] . "','" .
            $array['message'] . "','" .                    
            $array['actionType'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }


    public function listNotification($per_page_record = 10, $page_number = 1, $ID = -1)
    {
        $OpportunityID = ($this->input->post('OpportunityID') != '') ? $this->input->post('OpportunityID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetNotifications( '$per_page_record' , '$page_number','$OpportunityID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

   
	
}