<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$city=getStringClean(($this->input->post('CityName')!='')?$this->input->post('CityName'):'');
        $CountryID=($this->input->post('CountryID') != '')?$this->input->post('CountryID'):-1;
        $state=($this->input->post('StateID') != '')?$this->input->post('StateID'):-1;
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetCity( '$per_page_record' , '$page_number','$city','$state','$status_search_value','$CountryID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_cities','CityID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($city_array)
    {    
        $city_array['CityName']   =   getStringClean((isset($city_array['CityName']))?$city_array['CityName']:NULL);
		$city_array['StateID']   =   (isset($city_array['StateID']))?$city_array['StateID']:0;             
        $city_array['Status']        =   (isset($city_array['Status']) && $city_array['Status'] == 'on')?ACTIVE:INACTIVE;
		$city_array['created_by'] = $this->session->userdata['UserID']; 
        $city_array['usertype'] = 'Admin Web';
		$city_array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddCity('".$city_array['CityName']."','".$city_array['StateID']."','".$city_array['created_by']."','".$city_array['Status']."','".$city_array['usertype']."','".$city_array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($city_array)
    {
        $city_array['CityName']   =   getStringClean((isset($city_array['CityName']))?$city_array['CityName']:NULL);
		$city_array['StateID']   =   (isset($city_array['StateID']))?$city_array['StateID']:0;      
        $city_array['Status']        =   (isset($city_array['Status']) && $city_array['Status'] == 'on')?ACTIVE:INACTIVE;
        $city_array['ID']   =   (isset($city_array['ID']))?$city_array['ID']:NULL;
		$city_array['modified_by'] = $this->session->userdata['UserID'];
        $city_array['usertype'] = 'Admin Web';
		$city_array['IPAddress'] = GetIP();
		
		
        $query = $this->db->query("call usp_A_EditCity('".$city_array['CityName']."','".$city_array['StateID']."','".$city_array['modified_by']."','".$city_array['Status']."','".$city_array['ID']."','".$city_array['usertype']."','".$city_array['IPAddress']."')");
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($city_array)
    {
        $city_array['id']            =   (isset($city_array['id']))?$city_array['id']:0;                
        $city_array['status']        =   (isset($city_array['status']))?$city_array['status']:0;
        
        $city_array['table_name'] = "sssm_cities";
        $city_array['field_name'] = "CityID";
        $city_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$city_array['table_name']."','".$city_array['field_name']."','".$city_array['id']."','".$city_array['status']."','".$city_array['modified_by']."');");        
               
    }

    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];                
        $array['CityName']       =  $array['CityName'];
        $array['table_name'] = "sssm_cities";
        $array['field_name'] = "CityID";
        $sql = "call usp_A_CheckDuplicate('".$array['table_name']."','CityName','".$array['CityName']."','CityID','".$array['id']."')"; 
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function getCityByID($ID = null) {
        $query = $this->db->query("call usp_A_GetCityByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}