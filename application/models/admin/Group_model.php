<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
	    $group=getStringClean(($this->input->post('GroupName')!='')?$this->input->post('GroupName'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
     $sql = "call usp_A_GetGroup( '$per_page_record' , '$page_number','$group','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_group','GroupID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['GroupName']   =   (isset($array['GroupName']))?$array['GroupName']:NULL;             
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = 'Admin Web';
		$array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddGroup('".$array['GroupName']."','".$array['created_by']."','".$array['Status']."','".$array['usertype']."','".$array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['GroupName']   =   (isset($array['GroupName']))?$array['GroupName']:NULL;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID']   =   (isset($array['ID']))?$array['ID']:NULL;
		$array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
		$array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditGroup('".$array['GroupName']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "sssm_group";
        $array['field_name'] = "GroupID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
               
    }

    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['GroupName']       =  $array['GroupName'];      
        $array['table_name'] = "sssm_group";
        $array['field_name'] = "GroupID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','GroupName','".$array['GroupName']."','GroupID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function getGroupByID($ID = null) {
        $query = $this->db->query("call usp_A_GetGroupByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}