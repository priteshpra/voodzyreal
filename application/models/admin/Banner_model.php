<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {
	function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Start : to list all contries 
    public function listData($per_page_record = 10, $page_number = 1) 
    {        
		$BannerTitle=getStringClean(($this->input->post('BannerTitle')!='')?$this->input->post('BannerTitle'):'');
		$SubTitle=getStringClean(($this->input->post('SubTitle')!='')?$this->input->post('SubTitle'):'');
        $Type=getStringClean(($this->input->post('Type') != '')?$this->input->post('Type'):'');
		$status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetBanner( '$per_page_record' , '$page_number','$BannerTitle','$SubTitle','$Type','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
             
    }
	
	public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_banner','BannerID')");
        $query->next_result();
        return $query->result();
    }
	
	public function insert($banner_array)
    {    
        $banner_array['BannerTitle']   =   getStringClean((isset($banner_array['BannerTitle']))?$banner_array['BannerTitle']:NULL);             
		$banner_array['SubTitle']    = getStringClean((isset($banner_array['SubTitle'])) ? $banner_array['SubTitle'] : NULL);
		$banner_array['Sequence'] = (isset($banner_array['Sequence'])) ? $banner_array['Sequence'] : 0;
        $banner_array['IsCreative'] = (isset($banner_array['IsCreative']) && $banner_array['IsCreative'] == 'on') ? ACTIVE : INACTIVE;
		$banner_array['image'] = getStringClean((isset($banner_array['image'])) ? $banner_array['image'] : NULL);
		$banner_array['mobileimage'] = getStringClean((isset($banner_array['mobileimage'])) ? $banner_array['mobileimage'] : NULL);
		$banner_array['Type']        =   getStringClean((isset($banner_array['Type']))? $banner_array['Type']:NULL);
		$banner_array['RedirectURL'] = getStringClean((isset($banner_array['RedirectURL'])) ? $banner_array['RedirectURL'] : NULL);
		$banner_array['Status']        =   (isset($banner_array['Status']) && $banner_array['Status'] == 'on')?ACTIVE:INACTIVE;
		$banner_array['created_by'] = $this->session->userdata['UserID']; 
        $banner_array['usertype'] = 'Admin Web';
		$banner_array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_AddBanner('".
		$banner_array['BannerTitle']."','".
		$banner_array['SubTitle']."','".
		$banner_array['Sequence']."','".
		$banner_array['IsCreative']."','".
		$banner_array['image']."','".
		$banner_array['mobileimage']."','".
		$banner_array['Type']."','".
		$banner_array['RedirectURL']."','".
		$banner_array['created_by']."','".
		$banner_array['Status']."','".
		$banner_array['usertype']."','".
		$banner_array['IPAddress']."')";        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
	
	public function update($banner_array)
    {
        //pr($banner_array);exit;
		$banner_array['BannerTitle']   =   getStringClean((isset($banner_array['BannerTitle']))?$banner_array['BannerTitle']:NULL);             
		$banner_array['SubTitle']    = getStringClean((isset($banner_array['SubTitle'])) ? $banner_array['SubTitle'] : NULL);
		$banner_array['Sequence'] = (isset($banner_array['Sequence'])) ? $banner_array['Sequence'] : 0;
        $banner_array['IsCreative'] = (isset($banner_array['IsCreative']) && $banner_array['IsCreative'] == 'on') ? ACTIVE : INACTIVE;
		$banner_array['image'] = getStringClean((isset($banner_array['image'])) ? $banner_array['image'] : NULL);
		$banner_array['mobileimage'] = getStringClean((isset($banner_array['mobileimage'])) ? $banner_array['mobileimage'] : NULL);
		$banner_array['Type']        =   getStringClean((isset($banner_array['Type']))? $banner_array['Type']:NULL);
		$banner_array['RedirectURL'] = getStringClean((isset($banner_array['RedirectURL'])) ? $banner_array['RedirectURL'] : NULL);
		$banner_array['Status']        =   (isset($banner_array['Status']) && $banner_array['Status'] == 'on')?ACTIVE:INACTIVE;
        $banner_array['ID']   =   (isset($banner_array['ID']))?$banner_array['ID']:NULL;
		$banner_array['modified_by'] = $this->session->userdata['UserID'];
        $banner_array['usertype'] = 'Admin Web';
		$banner_array['IPAddress'] = GetIP();
		
		
        $sql = "call usp_A_EditBanner('".
		$banner_array['BannerTitle']."','".$banner_array['SubTitle']."','".$banner_array['Sequence']."','".$banner_array['IsCreative']."','".$banner_array['image']."','".$banner_array['mobileimage']."','".$banner_array['Type']."','".$banner_array['RedirectURL']."','".$banner_array['modified_by']."','".$banner_array['Status']."','".$banner_array['ID']."','".$banner_array['usertype']."','".$banner_array['IPAddress']."')";
		$query = $this->db->query($sql);
		$query->next_result();
        return $query->row();
    }
	public function changeStatus($banner_array)
    {
        $banner_array['id']            =   (isset($banner_array['id']))?$banner_array['id']:0;                
        $banner_array['status']        =   (isset($banner_array['status']))?$banner_array['status']:0;
        
        $banner_array['table_name'] = "ssc_banner";
        $banner_array['field_name'] = "BannerID";
        $banner_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$banner_array['table_name']."','".$banner_array['field_name']."','".$banner_array['id']."','".$banner_array['status']."','".$banner_array['modified_by']."');");        
               
    }
	
	public function getBannerByID($ID = null) {
        $query = $this->db->query("call usp_A_GetBannerByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}