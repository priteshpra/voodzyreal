<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employeedetails_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $FirstName    = getStringClean(($this->input->post('FirstName')!='')?$this->input->post('FirstName'):'');
        $Email            = getStringClean(($this->input->post('Email') != '')?$this->input->post('Email'):'');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '')?$this->input->post('MobileNo'):'');
        $status_search_value           = ($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        $query =  $this->db->query("call usp_A_GetEmployees('".$per_page_record."' , '".$page_number."','".$FirstName."' , '".$Email."','".$MobileNo."','".$status_search_value ."')");
        $query->next_result();
        return $query->result();  
    }

    public function listDeviceInfo($per_page_record = 10, $page_number = 1,$ID = -1) {
        $DeviceName    = getStringClean(($this->input->post('DeviceName')!='')?$this->input->post('DeviceName'):'');
        $DeviceOS            = getStringClean(($this->input->post('DeviceOS') != '')?$this->input->post('DeviceOS'):'');
        $OSVersion = getStringClean(($this->input->post('OSVersion') != '')?$this->input->post('OSVersion'):'');
        $status_search_value           = ($this->input->post('Status_search') != '')?$this->input->post('Status_search'):-1;
        $query =  $this->db->query("call usp_A_GetDeviceInfo('$per_page_record' , '$page_number','$DeviceName' , '$DeviceOS','$OSVersion','$ID','$status_search_value')");
        $query->next_result();
        return $query->result();  
    }
    
    public function editBasicDetails($array){
        $userid = isset($array['cUserID']) ? $array['cUserID'] : 0;
        $FirstName   =   getStringClean((isset($array['FirstName']))?$array['FirstName']:NULL);
        $LastName   =   getStringClean((isset($array['LastName']))?$array['LastName']:NULL); 
        $Address   =   getStringClean((isset($array['Address']))?$array['Address']:NULL);
        $MobileNo   =   getStringClean((isset($array['MobileNo']))?$array['MobileNo']:NULL);
        
        /*echo "call usp_A_EditBasicEmployee('$userid','$FirstName','$LastName','$Address','$MobileNo')";exit;*/
        $query = $this->db->query("call usp_A_EditBasicEmployee('$userid','$FirstName','$LastName','$Address','$MobileNo')");
        $query->next_result();
        return $query->result();
    }

    public function changePassword(){
        $ID = $this->input->post("UserID");
        $password = fnEncrypt($this->input->post('new_password'), $this->config->item('sSecretKey'));
        $sql = "CALL usp_A_EmployeeChangePassword('".$password."','".$ID."');";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function changePasscode(){
        $ID = $this->input->post("UserID");
        $password    = getStringClean(($this->input->post('new_passcode')!='')?$this->input->post('new_passcode'):'');
       /* $password=getStringClean((isset($this->input->post('new_passcode')))? $this->input->post('new_passcode'):NULL);*/
        $sql = "CALL usp_A_EmployeeChangePasscode('".$password."','".$ID."');";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function update($array){
        $array['FirstName']     = getStringClean((isset($array['FirstName']))    ? $array['FirstName']  : NULL);
        $array['LastName']     = getStringClean((isset($array['LastName']))    ? $array['LastName']  : NULL);
        $array['Email']         = getStringClean((isset($array['Email']))            ? $array['Email']      : NULL);
        $array['MobileNo']     = getStringClean((isset($array['MobileNo']))          ? $array['MobileNo']  : NULL);
        $array['Address']      = getStringClean((isset($array['Address']))         ? $array['Address']   : NULL);
        $array['modified_by']      = $this->session->userdata['UserID'];
        $array['Status']           = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['IsAdmin'] = (isset($array['IsAdmin']) && $array['IsAdmin'] == 'on') ? ACTIVE : INACTIVE;
        $array['RoleID']      = (isset($array['RoleID']))         ? $array['RoleID']   : '0';
        
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditEmployee('" . 
            $array['FirstName'] . "','" . 
            $array['LastName']  . "','".
            $array['Email'] . "','" .
            $array['Address']  . "','" . 
            $array['MobileNo'] . "','" .
            $array['modified_by'] . "','" .
            $array['PassCode']. "','".
            $array['ID']. "','".
            $array['Status'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."','".
            $array['IsAdmin']."','".
            $array['RoleID']."')" ; 
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getEmployeeByID($employee_id = NULL) {
        $query = $this->db->query("call usp_A_GetEmployeeByID ('" . $employee_id . "')");
        $query->next_result();
        return $query->row();
    }
    
    public function changeStatus($employees_array) {
        $employees_array['id']          = (isset($employees_array['id']))           ? $employees_array['id']            : NULL;
        $employees_array['modified_by'] = (isset($employees_array['modified_by']))  ? $employees_array['modified_by']   : NULL;
        $employees_array['status']      = (isset($employees_array['status']))       ? $employees_array['status']        : NULL;
        $employees_array['table_name']  = "sssm_admindetails";
        $employees_array['field_name']  = "UserID
        ";
        $employees_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $employees_array['table_name'] . "','" . $employees_array['field_name'] . "','" . $employees_array['id'] . "','" . $employees_array['status'] . "','" . $employees_array['modified_by'] . "');");
    }

    public function changeDeviceInfoStatus($array) {
        $array['id']          = (isset($array['id']))           ? $array['id']            : NULL;
        $array['modified_by'] = (isset($array['modified_by']))  ? $array['modified_by']   : NULL;
        $array['status']      = (isset($array['status']))       ? $array['status']        : NULL;
        $array['table_name']  = "sssm_deviceinfo";
        $array['field_name']  = "DeviceID
        ";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
    
    public function insert($array){
        $array['FirstName']     = getStringClean((isset($array['FirstName']))    ? $array['FirstName']  : NULL);
        $array['LastName']     = getStringClean((isset($array['LastName']))    ? $array['LastName']  : NULL);
        $array['Email']         = getStringClean((isset($array['Email']))            ? $array['Email']      : NULL);
        $array['Password']         = (isset($array['Password']))            ? fnEncrypt($array['Password'], $this->config->item('sSecretKey'))      : NULL;
        $array['MobileNo']     = getStringClean((isset($array['MobileNo']))          ? $array['MobileNo']  : NULL);

        $array['Address']      = getStringClean((isset($array['Address']))         ? $array['Address']   : NULL);
        $array['RoleID']      = (isset($array['RoleID']))         ? $array['RoleID']   : '0';

        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['IsAdmin'] = (isset($array['IsAdmin']) && $array['IsAdmin'] == 'on') ? ACTIVE : INACTIVE;
        $sql = "call usp_A_AddEmployee('" . 
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .  
            $array['Email'] . "','" . 
            $array['Password']  . "','" . 
            $array['Address']  . "','" . 
            $array['MobileNo'] . "','" .
            $array['PassCode'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."','".
            $array['IsAdmin']."','".
            $array['RoleID']."')" ;

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function email_exists($email,$contact,$id){
        $query = $this->db->query("call usp_A_CheckEmployeeEmailExist('".getStringClean($email)."','".getStringClean($contact)."','$id')");
        return $query->row();
    }
    
    public function getEmployee(){
        $query = $this->db->query("call usp_A_GetEmployee_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    public function GetNotification($ID = 0){ 
        $ID = ($ID == 0)?$this->session->userdata['UserID']:$ID;
        $sql = "call usp_A_GetNotificationSetting('".$ID."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function SetNotification($ID = 0){ 
        $ID = ($ID == 0)?$this->session->userdata['UserID']:$ID;
        $array = $this->input->post();
        $IPAddress = GetIP();
        $usertype = 'Admin Web';

        $IsPush = (isset($array['IsPush']) && $array['IsPush'] == 'on')?ACTIVE:INACTIVE;
        $VisitorReminder = (isset($array['VisitorReminder']) && $array['VisitorReminder'] == 'on')?ACTIVE:INACTIVE;
        $Customer = (isset($array['Customer']) && $array['Customer'] == 'on')?ACTIVE:INACTIVE;
        $CustomerReminder = (isset($array['CustomerReminder']) && $array['CustomerReminder'] == 'on')?ACTIVE:INACTIVE;
        $CustomerProperty = (isset($array['CustomerProperty']) && $array['CustomerProperty'] == 'on')?ACTIVE:INACTIVE;
        $Payment = (isset($array['Payment']) && $array['Payment'] == 'on')?ACTIVE:INACTIVE;
        $Document = (isset($array['Document']) && $array['Document'] == 'on')?ACTIVE:INACTIVE;
        $sql = "call usp_A_SetUserNotificationSetting('".
                        $ID. "','" . 
                        $IsPush. "','" . 
                        $ID. "','" . 
                        $usertype. "','" . 
                        $IPAddress. "','" . 
                        $VisitorReminder. "','" . 
                        $Customer. "','" .    
                        $CustomerReminder. "','" .    
                        $CustomerProperty. "','" .    
                        $Payment. "','" .    
                        $Document."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

}




