<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChanelPartner_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
        $Name = ($this->input->post('Name') != '') ? $this->input->post('Name') : '';
        $FirmName = ($this->input->post('FirmName') != '') ? $this->input->post('FirmName') : '';
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetChanelPartnerList('$per_page_record','$page_number ','$FirmName','$Status','$Name')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['FirmName']   =   getStringClean((isset($array['FirmName']))?$array['FirmName']:'');
		$array['FirstName']   =   getStringClean((isset($array['FirstName']))?$array['FirstName']:'');        
        $array['LastName']   =   getStringClean((isset($array['LastName']))?$array['LastName']:'');            
        $array['EmailID']   =   getStringClean((isset($array['EmailID']))?$array['EmailID']:'');
        $array['MobileNo']   =   getStringClean((isset($array['MobileNo']))?$array['MobileNo']:0);
        $array['PanNo']   =   getStringClean((isset($array['PanNo']))?$array['PanNo']:0);
        $array['AadharNo']   =   getStringClean((isset($array['AadharNo']))?$array['AadharNo']:0);
        $array['GstNo']   =   getStringClean((isset($array['GstNo']))?$array['GstNo']:0);
        $array['AccountNo']   =   getStringClean((isset($array['AccountNo']))?$array['AccountNo']:0);
        $array['BankName']   =   getStringClean((isset($array['BankName']))?$array['BankName']:'');
        $array['IFCCode']   =   getStringClean((isset($array['IFCCode']))?$array['IFCCode']:0);
        $array['ReraCode']   =   getStringClean((isset($array['ReraCode']))?$array['ReraCode']:'');
        $array['Status']     = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['password'] = $array['Password'] = (isset($array['Password'])) ? fnEncrypt(getStringClean($array['Password'])) : '';
        $array['usertype'] = 'Admin Web';
		$array['IPAddress'] = GetIP();
		$sql = "call usp_A_AddChanelPartners('".$array['usertype']."','".$array['IPAddress']."','".$array['created_by']."',
            '".$array['EmailID']."',
            '".$array['password']."',
            '".$array['MobileNo']."',
            '".$array['FirmName']."',
            '".$array['FirstName']."',
            '".$array['LastName']."',
            '".$array['PanNo']."',
            '".$array['AadharNo']."',
            '".$array['GstNo']."',
            '".$array['AccountNo']."',
            '".$array['Status']."','".
            $array['BankName']."','".
            $array['IFCCode']."','".    
            $array['ReraCode']."'
            )";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['ID']   =   getStringClean((isset($array['ID']))?$array['ID']:0);
        $array['FirmName']   =   getStringClean((isset($array['FirmName']))?$array['FirmName']:'');
        $array['FirstName']   =   getStringClean((isset($array['FirstName']))?$array['FirstName']:'');        
        $array['LastName']   =   getStringClean((isset($array['LastName']))?$array['LastName']:'');            
        $array['EmailID']   =   getStringClean((isset($array['EmailID']))?$array['EmailID']:'');
        $array['MobileNo']   =   getStringClean((isset($array['MobileNo']))?$array['MobileNo']:0);
        $array['PanNo']   =   getStringClean((isset($array['PanNo']))?$array['PanNo']:0);
        $array['AadharNo']   =   getStringClean((isset($array['AadharNo']))?$array['AadharNo']:0);
        $array['GstNo']   =   getStringClean((isset($array['GstNo']))?$array['GstNo']:0);
        $array['AccountNo']   =   getStringClean((isset($array['AccountNo']))?$array['AccountNo']:0);
        $array['BankName']   =   getStringClean((isset($array['BankName']))?$array['BankName']:'');
        $array['IFCCode']   =   getStringClean((isset($array['IFCCode']))?$array['IFCCode']:0);
        $array['ReraCode']   =   getStringClean((isset($array['ReraCode']))?$array['ReraCode']:'');
        $array['Status']     = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['modified_by'] = $this->session->userdata['UserID']; 
        $array['password'] = "123";
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditChanelPartners('".$array['usertype']."','".$array['IPAddress']."','".$array['modified_by']."','".$array['FirmName']."','".$array['FirstName']."','".$array['LastName']."','".$array['PanNo']."','".$array['AadharNo']."','".$array['GstNo']."','".$array['AccountNo']."','".$array['Status']."','".$array['ID']."','".
            $array['BankName']."','".
            $array['IFCCode']."','".
            $array['ReraCode']."')";  
        $query = $this->db->query($sql);
        $query->next_result();    
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "sssm_chanelpartner";
        $array['field_name'] = "ChanelPartnerID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');"); 
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
	
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetChanelPArtnerByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    
}