<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_template_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listEmail($per_page_record = Null, $page_number = Null) {
        if ($per_page_record == Null) {
            $per_page_record = 10;
        }
        if ($page_number == Null) {
            $page_number = 1;
        }
        $EmailTemplateTitle = getStringClean(($this->input->post('EmailTemplateTitle') != '') ? $this->input->post('EmailTemplateTitle') : '');
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetEmailTemplate('$per_page_record' , '$page_number','$EmailTemplateTitle','$status_search_value')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount() {
        $query = $this->db->query("call cf_A_GetRecordCount('cf_emailtemplate','EmailTemplateID')");
        $query->next_result();
        return $query->result();
    }

    public function insertEmailTemplate($email_template_array) {
        $email_template_array['EmailTemplateTitle'] = getStringClean((isset($email_template_array['EmailTemplateTitle'])) ? $email_template_array['EmailTemplateTitle'] : NULL);
        $email_template_array['EmailSubject'] = getStringClean((isset($email_template_array['EmailSubject'])) ? $email_template_array['EmailSubject'] : NULL);
        $email_template_array['Content'] = (isset($email_template_array['Content'])) ? $email_template_array['Content'] : NULL;
        $email_template_array['Status'] = (isset($email_template_array['Status'])) ? ACTIVE : INACTIVE;
        $email_template_array['created_by'] = $this->session->userdata['UserID'];


        $sql = "call usp_A_AddEmailTemplate('" .
        $email_template_array['EmailTemplateTitle'] . "','" .
        $email_template_array['EmailSubject'] . "','" .
        $email_template_array['Content'] . "','" .
        $email_template_array['created_by'] . "','" .
        $email_template_array['Status'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function updateEmailTemplate($email_template_array) {
        $email_template_array['EmailTemplateID'] = (isset($email_template_array['EmailTemplateID'])) ? $email_template_array['EmailTemplateID'] : NULL;
        $email_template_array['EmailTemplateTitle'] = getStringClean((isset($email_template_array['EmailTemplateTitle'])) ? $email_template_array['EmailTemplateTitle'] : NULL);
        $email_template_array['EmailSubject'] = getStringClean((isset($email_template_array['EmailSubject'])) ? $email_template_array['EmailSubject'] : NULL);
        $email_template_array['Content'] = (isset($email_template_array['Content'])) ? $email_template_array['Content'] : NULL;
        $email_template_array['created_by'] = (isset($email_template_array['created_by'])) ? $email_template_array['created_by'] : NULL;
        $email_template_array['Status'] = (isset($email_template_array['Status']) && $email_template_array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $email_template_array['modified_by'] = $this->session->userdata['UserID'];
        $sql = "call usp_A_EditEmailTemplate('" .
                $email_template_array['EmailTemplateID'] . "','" .
                $email_template_array['EmailTemplateTitle'] . "','" .
                $email_template_array['EmailSubject'] . "','" .
                $email_template_array['Content'] . "','" .
                $email_template_array['modified_by'] . "','" .
                $email_template_array['Status'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getEmailTemplateDetailsByID($EmailTemplateID = NULL) {
        $query = $this->db->query("call usp_A_GetEmailTemplateDetailByID('$EmailTemplateID')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($email_template_array) {
        $email_template_array['id'] = (isset($email_template_array['id'])) ? $email_template_array['id'] : NULL;
        $email_template_array['modified_by'] = (isset($email_template_array['modified_by'])) ? $email_template_array['modified_by'] : NULL;
        $email_template_array['status'] = (isset($email_template_array['status'])) ? $email_template_array['status'] : NULL;
        $email_template_array['table_name'] = "sssf_emailtemplate";
        $email_template_array['field_name'] = "EmailTemplateID";
        $email_template_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $email_template_array['table_name'] . "','" . $email_template_array['field_name'] . "','" . $email_template_array['id'] . "','" . $email_template_array['status'] . "','" . $email_template_array['modified_by'] . "');");
    }

    function getEmailTemplateDetailsByEmailTemplateTitle($email_template_title = null) {
        return $this->db->query("call cf_A_GetEmailTemplateDetailsByEmailTemplateTitle('$email_template_title')")->row_array();
    }

}
