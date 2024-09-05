<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Errorlog_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }

    function listData($per_page_record = 10, $page_number = 1) 
    {
        
        $method_name_search_value=getStringClean(($this->input->post('MethodName')!='')?$this->input->post('MethodName'):'');
        $error_date_search_value=($this->input->post('ActivityDate')!='')?date('Y-m-d', strtotime($this->input->post('ActivityDate'))):'0000-00-00';
        $status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        
        $sql = "call usp_A_GetErrorLog( '$per_page_record' , '$page_number','$method_name_search_value','$error_date_search_value','$status_search_value' )";
        $query = $this->db->query($sql);
        return $query->result();          
    }

    function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_errorlog','ErrorLogID')");
        $query->next_result();
        return $query->result();
    }
    function changeStatus($error_log_array = null){
        $error_log_array['id']            =   (getStringClean(isset($error_log_array['id'])) ? $error_log_array['id'] : NULL);                
        $error_log_array['status']        =   (getStringClean(isset($error_log_array['status'])) ? $error_log_array['status'] : NULL);        
        $error_log_array['table_name']    =   "sssm_errorlog";
        $error_log_array['field_name']    =   "ErrorLogID";
        $error_log_array['modified_by']   =   $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$error_log_array['table_name']."','".$error_log_array['field_name']."','".$error_log_array['id']."','".$error_log_array['status']."','".$error_log_array['modified_by']."');");                       
    }
}