<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
        $Name = ($this->input->post('Name') != '') ? $this->input->post('Name') : '';
        $EmailID = ($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '';
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetVendor('$per_page_record','$page_number ','$Name','$EmailID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
	
	public function insert($array)
    {    
        $array['BusinessName']   =   getStringClean((isset($array['BusinessName']))?$array['BusinessName']:'');
		$array['FirstName']   =   getStringClean((isset($array['FirstName']))?$array['FirstName']:'');        
        $array['LastName']   =   getStringClean((isset($array['LastName']))?$array['LastName']:'');            
        $array['EmailID']   =   getStringClean((isset($array['EmailID']))?$array['EmailID']:'');
        $array['MobileNo']   =   getStringClean((isset($array['MobileNo']))?$array['MobileNo']:0);
        $array['AadharNo']   =   getStringClean((isset($array['AadharNo']))?$array['AadharNo']:0);
        $array['GstNo']   =   getStringClean((isset($array['GstNo']))?$array['GstNo']:0);
        $array['CategoryID']   =   getStringClean((isset($array['CategoryID']))?$array['CategoryID']:0);  
        $array['Status']     = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
		$array['created_by'] = $this->session->userdata['UserID']; 
        $array['usertype'] = 'Admin Web';
		$array['IPAddress'] = GetIP();
		$sql = "call usp_A_AddVendor(
            '".$array['EmailID']."',
            '".$array['created_by']."',
            '".$array['Status']."',
            '".$array['usertype']."',
            '".$array['IPAddress']."',
            '".$array['MobileNo']."',
            '".$array['FirstName']."',
            '".$array['LastName']."',
            '".$array['BusinessName']."',
            '".$array['CategoryID']."',
            '".$array['GstNo']."',
            '".$array['PanNo']."'
            )";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($array)
    {
        $array['ID']   =   getStringClean((isset($array['ID']))?$array['ID']:0);
        $array['BusinessName']   =   getStringClean((isset($array['BusinessName']))?$array['BusinessName']:'');
        $array['FirstName']   =   getStringClean((isset($array['FirstName']))?$array['FirstName']:'');        
        $array['LastName']   =   getStringClean((isset($array['LastName']))?$array['LastName']:'');            
        $array['EmailID']   =   getStringClean((isset($array['EmailID']))?$array['EmailID']:'');
        $array['MobileNo']   =   getStringClean((isset($array['MobileNo']))?$array['MobileNo']:0);
        $array['PanNo']   =   getStringClean((isset($array['PanNo']))?$array['PanNo']:0);
        $array['GstNo']   =   getStringClean((isset($array['GstNo']))?$array['GstNo']:0);
        $array['CategoryID']   =   getStringClean((isset($array['CategoryID']))?$array['CategoryID']:0);  

        $array['Status']     = (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['modified_by'] = $this->session->userdata['UserID']; 

        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditVendor('".$array['FirstName']."','".$array['modified_by']."','".$array['Status']."','".$array['ID']."','".$array['usertype']."','".$array['IPAddress']."','".$array['LastName']."','".$array['BusinessName']."','".$array['CategoryID']."','".$array['GstNo']."','".$array['PanNo']."','".$array['EmailID']."','".
            $array['MobileNo']."')";  
        $query = $this->db->query($sql);
        $query->next_result();    
        return $query->row();
    }
	public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ss_vendor";
        $array['field_name'] = "VendorID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');"); 
    }

    
	public function getByID($ID = null) {
        $query = $this->db->query("call usp_A_GetVendorByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function VendorNameCombobox() 
    {
        $CategoryID = ($this->input->post('CategoryID')=="")?'-1':$this->input->post('CategoryID');
        $sql = "call usp_A_GetVendor_Combo_Box('$CategoryID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function InwardListData($per_page_record = 10, $page_number = 1) 
    {        
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $sql = "call usp_A_GetInwardMaster_ListByVendorID('$per_page_record','$page_number','$UserID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

}