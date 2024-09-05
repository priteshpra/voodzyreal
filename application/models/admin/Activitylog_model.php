<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activitylog_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
		$ActivitylogName = ($this->input->post('ActivitylogName') != '') ? $this->input->post('ActivitylogName') : '';
        $StartDate = ($this->input->post('StartDate') != '') ? date('Y-m-d h:i:s', strtotime($this->input->post('StartDate'))) : DEFAULT_DATE;
        $EndDate = ($this->input->post('EndDate') != '') ? date('Y-m-d h:i:s', strtotime($this->input->post('EndDate'))) : DEFAULT_DATE;
        $UserID = ($this->input->post('UserID') != '') ? $this->input->post('UserID') : -1;
        $sql = "call usp_A_GetActivityLog( '$per_page_record' , '$page_number','$ActivitylogName' ,'$StartDate','$EndDate','$UserID')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_activitylog
','ActivityLogID')");
        $query->next_result();
        return $query->result();
    }

    function changeStatus($array) {
        $array['id'] = (getStringClean(isset($array['id'])) ? $array['id'] : NULL);
        $array['status'] = (getStringClean(isset($array['status'])) ? $array['status'] : NULL);

        $array['table_name'] = "sssm_activitylog";
        $array['field_name'] = "ActivityLogID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call cf_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

}
