<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reminder_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $sql ="call usp_A_GetCustomerReminder('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $CustomerPropertyID.
                    "','CustomerProperty','". 
                    $this->ProjectID . "','".
                    $this->UserRoleID . "','Web')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['Message']     = getStringClean((isset($data['Message']))    ? getStringClean($data['Message'])  : '');
        $data['Amount']     = (isset($data['Amount']))    ? str_replace(',','',$data['Amount'])  : 0;
        $data['ReminderTime']     = (isset($data['ReminderTime']))    ? $data['ReminderTime'].":00"  : '00:00:00';
        $str = $data['ReminderDate'] ." ". $data['ReminderTime'];
        $data['ReminderDate']     = (isset($data['ReminderDate']))? GetDateTimeInFormat($str,DATE_TIME_FORMAT,DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomerReminder('" . 
            $data['CustomerPropertyID'] . "','" .
            $data['Message'] . "','" .
            $data['Amount'] . "','" .
            $data['ReminderDate'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['Message']     = getStringClean((isset($data['Message']))    ? getStringClean($data['Message'])  : '');
        $data['Amount']     = (isset($data['Amount']))    ? str_replace(',','',$data['Amount'])  : 0;
        $data['ReminderTime']     = (isset($data['ReminderTime']))    ? $data['ReminderTime'].":00"  : '00:00:00';
        $str = $data['ReminderDate'] ." ". $data['ReminderTime'];
        $data['ReminderDate']     = (isset($data['ReminderDate']))? GetDateTimeInFormat($str,DATE_TIME_FORMAT,DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditCustomerReminder('" . 
            $data['CustomerReminderID'] . "','" .
            $data['Amount'] . "','" .
            $data['ReminderDate'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetCustomerReminderByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    public function addResponse(){
        $ID = $this->input->post('ReminderID');
        $Response = getStringClean($this->input->post('Response'));
        $query = $this->db->query("call usp_A_AddRespose('" .
                             $ID . 
                             "','Customer','".
                             $Response ."','".
                             $this->session->userdata['UserID'] ."','Admin Web','". GetIP() ."')");
        $query->next_result();
        return $query->row();
    }
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_customerreminder";
        $data['field_name']  = "CustomerReminderID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
}