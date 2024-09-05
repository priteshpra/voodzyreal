<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_Model {
	function __construct() 
    {
        parent::__construct();
    }
	
    public function listData($PageSize = 10, $CurrentPage = 1) 
    {        
		$AreaName = getStringClean(($this->input->post('AreaName')!='')?$this->input->post('AreaName'):'');
        $CityID = ($this->input->post('CityID') != '')?$this->input->post('CityID'):-1;
		$Status = ($this->input->post('Status') != '')?$this->input->post('Status'):-1;
        
        $sql = "call usp_A_GetArea( '$PageSize' , '$CurrentPage','$AreaName','$CityID','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
	
	public function Insert($array)
    {    
        $array['AreaName'] = getStringClean((isset($array['AreaName']))?$array['AreaName']:NULL);
		$array['CityID'] = (isset($array['CityID']))?$array['CityID']:783;             
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['CreatedBy'] = $this->session->userdata['UserID']; 
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
        $sql = "call usp_A_AddArea('".
            $array['AreaName']."','".
            $array['CityID']."','".
            $array['CreatedBy']."','".
            $array['Status']."','".
            $array['UserType']."','".
            $array['IPAddress'].
            "')";       
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function Update($array)
    {
        $array['AreaName'] = getStringClean((isset($array['AreaName']))?$array['AreaName']:NULL);             
		$array['CityID'] = (isset($array['CityID']))?$array['CityID']:783;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['ID'] = (isset($array['ID']))?$array['ID']:NULL;
		$array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['Usertype'] = $this->session->userdata['UserType'] . ' Web';
		$array['IPAddress'] = GetIP();
		
		$sql = "call usp_A_EditArea('" .
                $array['AreaName']."','".
                $array['CityID']."','".
                $array['ModifiedBy']."','".
                $array['Status']."','".
                $array['ID']."','".
                $array['Usertype']."','".
                $array['IPAddress'].
                "')";
        $query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetAreaByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($banner_array)
    {
        $banner_array['id']            =   (isset($banner_array['id']))?$banner_array['id']:0;                
        $banner_array['status']        =   (isset($banner_array['status']))?$banner_array['status']:0;
        
        $banner_array['table_name'] = "ss_area";
        $banner_array['field_name'] = "AreaID";
        $banner_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$banner_array['table_name']."','".$banner_array['field_name']."','".$banner_array['id']."','".$banner_array['status']."','".$banner_array['modified_by']."');");        
               
    }
}