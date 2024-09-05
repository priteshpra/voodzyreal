<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smstemplate_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Start : to list all contries 
    function listData($per_page_record = 10, $page_number = 1) 
    {        
        
        $Title=getStringClean(($this->input->post('Title')!='')?$this->input->post('Title'):'');
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetSMSTemplate( '$per_page_record' , '$page_number','$Title','$status_search_value' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_smstemplate','SMSID')");
        $query->next_result();
        return $query->result();
    }
    
    
    function insert($array)
    {   
        $array['Title']   =   (isset($array['Title']))?$array['Title']:NULL;    
        $array['Message']   =   (isset($array['message']))? addslashes($array['message']):NULL;              
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
       
        $array['created_by'] = $this->session->userdata['UserID']; 
        
        $sql = "call usp_A_AddSMSTemplate('".
            $array['Title']."','".
            $array['Message']."','".
            $array['created_by']."','".
            $array['Status']."','".
            $array['usertype']."','".
            $array['IPAddress']."')";        

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
     public function update($array)
    {    
    //pr($array);exit;
        $array['Title']   =   (isset($array['Title']))?$array['Title']:NULL;   
        $array['Message']   =   (isset($array['message']))? addslashes($array['message']):NULL;         
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['id']   =   (isset($array['ID']))?$array['ID']:NULL;
        
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        
        
        $sql = "call usp_A_EditSMSTemplate(
            '".$array['Title']."',
            '".$array['Message']."',
            '".$array['modified_by']."',
            '".$array['Status']."',
            '".$array['id']."',
            '".$array['usertype']."',
            '".$array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "sssm_smstemplate";
        $array['field_name'] = "SMSID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
        //return $this->db->query("select @a AS xyz")->result();        
    }
    public function getSMSTemplateByID($ID = null) {
        $query = $this->db->query("call usp_A_GetSMSTemplateByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}