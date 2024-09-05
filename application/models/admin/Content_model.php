<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //Start : for listing page contents 
    public function listContent($per_page_record = Null, $page_number = Null) {
        if($per_page_record == Null)
        {
            $per_page_record = 10;
        }
        if($page_number == Null)
        {
            $page_number = 1;
        }
        
        $Status_search_value=($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
 
        $sql = "call usp_A_GetContent( '$per_page_record' , '$page_number' ,'$Status_search_value')";
        $query = $this->db->query($sql);
        return $query->result();
    
    }
    function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('sssf_cms','CMSID')");
        $query->next_result();
        return $query->result();
    }

    //End : for listing Page contents 

    public function insertPageContent($page_content_array = array()) {
        $page_content_array['PageID']  = (isset($page_content_array['PageID'])) ? $page_content_array['PageID'] : NULL;
        $page_content_array['Content'] = $this->db->escape_str((isset($page_content_array['Content'])) ? $page_content_array['Content'] : NULL);
        $page_content_array['Status']  = (isset($page_content_array['Status']) && $page_content_array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $page_content_array['created_by'] = $this->session->userdata['UserID'];
        $query = $this->db->query("call usp_A_AddCMS('" . $page_content_array['PageID'] . "','" . $page_content_array['Content'] . "','" . $page_content_array['Status'] . "','" . $page_content_array['created_by'] . "')");
        $query->next_result();
        return $query->row();
    }

    public function updatePageContent($page_content_array) {
        //print_r($page_content_array);die();
        $page_content_array['PageID']  = (isset($page_content_array['PageID'])) ? $page_content_array['PageID'] : NULL;
        $page_content_array['Content'] = $this->db->escape_str((isset($page_content_array['Content'])) ? $page_content_array['Content'] : NULL);
        $page_content_array['Status']  = (isset($page_content_array['Status']) && $page_content_array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $page_content_array['cms_id']  = (isset($page_content_array['cms_id'])) ? $page_content_array['cms_id'] : NULL;
        $page_content_array['modified_by'] = $this->session->userdata['UserID'];
        //echo "call usp_A_EditCMS('" . $page_content_array['PageID'] . "','" . $page_content_array['Content'] . "','" . $page_content_array['Status'] . "','" . $page_content_array['modified_by'] . "','" . $page_content_array['cms_id'] . "')";die();
        $query = "call usp_A_EditCMS('" . 
            $page_content_array['PageID'] . "','" . 
            $page_content_array['Content'] . "','" . 
            $page_content_array['Status'] . "','" . 
            $page_content_array['modified_by'] . "','" . 
            $page_content_array['cms_id'] . "')";
        $query = $this->db->query($query);
        $query->next_result();
        return $query->row();

    }

    public function getContentByID($cms_id = NULL) {
        $query = $this->db->query("call usp_A_GetContentByID('" . $cms_id . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($page_content_array) {
        $page_content_array['id']           = (isset($page_content_array['id'])) ? $page_content_array['id'] : NULL;
        $page_content_array['modified_by']  = (isset($page_content_array['modified_by'])) ? $page_content_array['modified_by'] : NULL;
        $page_content_array['Status']       = (isset($page_content_array['Status'])) ? $page_content_array['Status'] : NULL;


        $page_content_array['table_name'] = "sssf_cms";
        $page_content_array['field_name'] = "CMSID";
        $page_content_array['modified_by']= $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $page_content_array['table_name'] . "','" . $page_content_array['field_name'] . "','" . $page_content_array['id'] . "','" . $page_content_array['Status'] . "','" . $page_content_array['modified_by'] . "');");
    }

    function listPages() {
        return $this->db->query("call usp_A_GetPageName_ComboBox()")->result_array();
    }

}
