<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_activity_log_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listCustomerActivityLog($per_page_record = Null, $page_number = Null) {
        if ($per_page_record == Null) {
            $per_page_record = 10;
        }
        if ($page_number == Null) {
            $page_number = 1;
        }
        $ActivitylogName = getStringClean(($this->input->post('ActivitylogName') != '') ? $this->input->post('ActivitylogName') : '');
        $ActivityDate = ($this->input->post('ActivityDate') != '') ? date('Y-m-d h:i:s', strtotime($this->input->post('ActivityDate'))) : NULL;
        $sql = "call usp_A_GetActivityLog( '$per_page_record' , '$page_number','$ActivitylogName' ,'$ActivityDate')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call usp_A_GetRecordCount('sssf_activitylog
','ActivityLogID')");
        $query->next_result();
        return $query->result();
    }

    function changeStatus($customer_activity_log_array) {
        $customer_activity_log_array['id'] = (getStringClean(isset($customer_activity_log_array['id'])) ? $customer_activity_log_array['id'] : NULL);
        $customer_activity_log_array['status'] = (getStringClean(isset($customer_activity_log_array['status'])) ? $customer_activity_log_array['status'] : NULL);

        $customer_activity_log_array['table_name'] = "sssf_activitylog";
        $customer_activity_log_array['field_name'] = "ActivityLogID";
        $customer_activity_log_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call cf_A_ChangeStatus('" . $customer_activity_log_array['table_name'] . "','" . $customer_activity_log_array['field_name'] . "','" . $customer_activity_log_array['id'] . "','" . $customer_activity_log_array['status'] . "','" . $customer_activity_log_array['modified_by'] . "');");
    }

}
