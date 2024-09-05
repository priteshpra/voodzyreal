<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1)
    {
        if ($this->input->post('EmployeeID') == "-1" || $this->input->post('EmployeeID') == "-") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : $this->session->userdata['UserID']);
        }

        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $EmailID = getStringClean(($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Profession = ($this->input->post('Profession') != '') ? $this->input->post('Profession') : 'All';
        $DesignationID = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : -1;
        $Requirement = getStringClean(($this->input->post('Requirement') != '') ? $this->input->post('Requirement') : 'All');
        $LeadType = getStringClean(($this->input->post('LeadType') != '') ? $this->input->post('LeadType') : 'All');
        $status_search_value = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $ProjectID = $this->ProjectID;
        $Source = getStringClean(($this->input->post('Source') != '') ? $this->input->post('Source') : 'All');

        $sql = "call usp_A_GetVisitorFilter( '$per_page_record', '$page_number','$EmployeeID','$Name','$EmailID','$MobileNo','$Profession','$DesignationID','$Requirement','$status_search_value','$LeadType','$ProjectID','$Source')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function withoutFilterlistData($per_page_record = 10, $page_number = 1)
    {
        if ($this->input->post('EmployeeID') == "-1" || $this->input->post('EmployeeID') == "-") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : $this->session->userdata['UserID']);
        }

        $status_search_value = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetVisitorWithoutFilter( '$per_page_record', '$page_number','$EmployeeID','$status_search_value')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listReminderNotificationData()
    {
        $Current = date("Y-m-d H:i");
        if (@$this->session->userdata['RoleID'] == "-1" || @$this->session->userdata['RoleID'] == "-2") {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = @$this->session->userdata['UserID'];
        }

        if ($EmployeeID=='') {
            $EmployeeID = '-1';
        }

        $sql = "call usp_A_GetReminderByTime( '$EmployeeID', '$Current')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listReminder($per_page_record = 10, $page_number = 1, $ID = -1)
    {
        $VisitorID = ($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetVisitorReminder( '$per_page_record' , '$page_number','$VisitorID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getTemplate($ID)
    {
        $sql = "call usp_A_GetTemplate('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_visitor','VisitorID')");
        $query->next_result();
        return $query->result();
    }

    public function InsertReminder($array)
    {
        $array['VisitorID']   =   (isset($array['VisitorID'])) ? $array['VisitorID'] : 0;
        $array['SitesID']   =   (isset($array['SitesID'])) ? $array['SitesID'] : 0;
        $array['Message']   =   getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ReminderTime']     = (isset($array['ReminderTime']))    ? $array['ReminderTime'] . ":00"  : '00:00:00';
        $str = $array['ReminderDate'] . " " . $array['ReminderTime'];
        $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str = $array['PastDate'] . " " . $array['PastTime'];
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';
        $sql = "call usp_A_AddVisitorReminder('" .
            $array['VisitorID'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['SitesID'] . "');";
        
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function EditReminder($array)
    {

        $array['VisitorID']   =   (isset($array['VisitorID'])) ? $array['VisitorID'] : 0;
        $array['SitesID']   =   (isset($array['SitesID'])) ? $array['SitesID'] : 0;
        $array['Message']   =   getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ReminderTime']     = (isset($array['ReminderTime']))    ? $array['ReminderTime'] . ":00"  : '00:00:00';
        $str = $array['ReminderDate'] . " " . $array['ReminderTime'];
        $array['ReminderDate']     = (isset($array['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['PastTime']     = (isset($array['PastTime']))    ? $array['PastTime'] . ":00"  : '00:00:00';
        $str = $array['PastDate'] . " " . $array['PastTime'];
        $array['PastDate']     = (isset($array['PastDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';
        $sql = "call usp_A_EditVisitorReminder('" .
            $array['ID'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['SitesID'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function insert($array)
    {

        $array['UserID']   =  getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);
        $array['FirstName']   =  getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : '');
        $array['LastName']   =  getStringClean((isset($array['LastName'])) ? $array['LastName'] : '');
        $array['EmailID']   =  getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address']   =  getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName'])) ? $array['CompanyName'] : '');
        $array['DesignationID']   =  (isset($array['DesignationID'])) ? $array['DesignationID'] : -1;

        $array['VisitorStatus']   =  getStringClean((isset($array['VisitorStatus'])) ? $array['VisitorStatus'] : '');

        $array['BirthDate']   =  getStringClean((isset($array['BirthDate'])) ? $array['BirthDate'] : 0);
        $array['BirthMonth']   =  getStringClean((isset($array['BirthMonth'])) ? $array['BirthMonth'] : 0);
        $array['AnniversaryDate']   =  getStringClean((isset($array['AnniversaryDate'])) ? $array['AnniversaryDate'] : 0);
        $array['AnniversaryMonth']   =  getStringClean((isset($array['AnniversaryMonth'])) ? $array['AnniversaryMonth'] : 0);
        $array['OpportunityID']   =  getStringClean((isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0);

        $array['SecondName']   =  getStringClean((isset($array['SecondName'])) ? $array['SecondName'] : '');
        $array['SecondMobileNo']   =  getStringClean((isset($array['SecondMobileNo'])) ? $array['SecondMobileNo'] : '');

        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddVisitor('" .
            $array['UserID'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Address'] . "','" .
            $array['EmailID'] . "','" .
            $array['CompanyName'] . "','" .
            $array['DesignationID'] . "','" .
            $array['BirthDate'] . "','" .
            $array['BirthMonth'] . "','" .
            $array['AnniversaryDate'] . "','" .
            $array['AnniversaryMonth'] . "','" .
            $array['OpportunityID'] . "','" .
            $array['SecondMobileNo'] . "','" .
            $array['SecondName'] . "','" .
            $array['VisitorStatus'] . "'
            )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function update($array)
    {
        $array['UserID']   =  getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);
        $array['FirstName']   =  getStringClean((isset($array['FirstName'])) ? $array['FirstName'] : '');
        $array['LastName']   =  getStringClean((isset($array['LastName'])) ? $array['LastName'] : '');
        $array['EmailID']   =  getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo']   =  getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Address']   =  getStringClean((isset($array['Address'])) ? $array['Address'] : '');
        $array['CompanyName']   =  getStringClean((isset($array['CompanyName'])) ? $array['CompanyName'] : '');
        $array['DesignationID']   =  (isset($array['DesignationID'])) ? $array['DesignationID'] : -1;

        $array['VisitorStatus']   =  getStringClean((isset($array['VisitorStatus'])) ? $array['VisitorStatus'] : '');

        $array['BirthDate']   =  getStringClean((isset($array['BirthDate'])) ? $array['BirthDate'] : 0);
        $array['BirthMonth']   =  getStringClean((isset($array['BirthMonth'])) ? $array['BirthMonth'] : 0);
        $array['AnniversaryDate']   =  getStringClean((isset($array['AnniversaryDate'])) ? $array['AnniversaryDate'] : 0);
        $array['AnniversaryMonth']   =  getStringClean((isset($array['AnniversaryMonth'])) ? $array['AnniversaryMonth'] : 0);

        $array['SecondName']   =  getStringClean((isset($array['SecondName'])) ? $array['SecondName'] : '');
        $array['SecondMobileNo']   =  getStringClean((isset($array['SecondMobileNo'])) ? $array['SecondMobileNo'] : '');

        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID']   =   (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditVisitor('" .
            $array['UserID'] . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['FirstName'] . "','" .
            $array['LastName'] . "','" .
            $array['Address'] . "','" .
            $array['CompanyName'] . "','" .
            $array['DesignationID'] . "','" .
            $array['BirthDate'] . "','" .
            $array['BirthMonth'] . "','" .
            $array['AnniversaryDate'] . "','" .
            $array['AnniversaryMonth'] . "','" .
            $array['SecondMobileNo'] . "','" .
            $array['SecondName'] . "','" .
            $array['MobileNo'] . "','" .
            $array['VisitorStatus'] . "','" .
            $array['EmailID'] . "'
            )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "sssm_visitor";
        $array['field_name'] = "VisitorID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
    public function changeReminderStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "sssm_visitorreminder";
        $array['field_name'] = "VisitorReminderID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
    public function emailexist()
    {
        $EmailID = getStringClean($this->input->post('EmailID'));
        $MobileNo = getStringClean($this->input->post('MobileNo'));
        $ID = $this->input->post('ID');

        $sql = "call usp_A_CheckVisitorEmailExist('" .
            $EmailID . "','" .
            $MobileNo . "','" .
            $ID . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function checkDuplicate($array)
    {
        $array['id']    =   $array['id'];
        $array['Designation']       =  getStringClean($array['Designation']);
        $array['table_name'] = "sssm_visitor";
        $array['field_name'] = "VisitorID";
        $sql = "call usp_A_CheckDuplicate('" . $array['table_name'] . "','Designation','" . $array['Designation'] . "','DesignationID','" . $array['id'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetVisitorByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function getReminderByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetReminderByID('$ID')");
        $query->next_result();
        return $query->row();
    }
    public function converttocustomer()
    {
        $VisitorID = $this->input->post('VisitorID');
        $UserID = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $query = $this->db->query("call usp_M_ConvertVisitorToCustomer('$VisitorID','$UserID','$UserType','$IPAddress')");
        $query->next_result();
        return $query->row();
    }
    public function visitoridle()
    {
        $VisitorID = $this->input->post('VisitorID');
        $Status = $this->input->post('Idle');
        $UserID = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $query = $this->db->query("call usp_A_AddVisitorIdle('$VisitorID','$UserID','$UserType','$IPAddress','$Status')");
        $query->next_result();
        return $query->row();
    }
    public function addResponse()
    {
        $ID = $this->input->post('ReminderID');
        $Response = getStringClean($this->input->post('Response'));
        $sql = "call usp_A_AddRespose('" .
            $ID .
            "','Visitor','" .
            $Response . "','" .
            $this->session->userdata['UserID'] . "','Admin Web','" . GetIP() . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }


    public function updateVisitorReminder($data)
    {

        if (!isset($data['IPAddress'])) $data['IPAddress'] = '';
        $data['ReminderDate'] = (!isset($data['ReminderDate']) || $data['ReminderDate'] == '') ? '1000-01-01' : $data['ReminderDate'];
        $UserID = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . ' Web';

        $data['EntryTime']     = (isset($data['EntryTime']))    ? $data['EntryTime'] . ":00"  : '00:00:00';
        $str = $data['EntryDate'] . " " . $data['EntryTime'];
        $data['EntryDate']     = (isset($data['EntryDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $sql = "call usp_A_UpdateVisitorReminder('" . $data['VisitorID'] . "','" .
            $data['ReminderDate'] . "','" .
            $data['Message'] . "','" .
            $UserID . "','" .
            $UserType . "', '" .
            $data['IPAddress'] . "', '" .
            $data['EntryDate'] . "')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function getQueryResult($sql)
    {
        try {
            $query = $this->db->query($sql);
            $query->next_result();
            return $query->result();
        } catch (Exception $e) {
            return '';
        }
    }

    public function DSRVisitorlistData($per_page_record = 10, $page_number = 1)
    {

        $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $EmailID = getStringClean(($this->input->post('EmailID') != '') ? $this->input->post('EmailID') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Profession = ($this->input->post('Profession') != '') ? $this->input->post('Profession') : 'All';
        $DesignationID = ($this->input->post('DesignationID') != '') ? $this->input->post('DesignationID') : -1;
        $Requirement = getStringClean(($this->input->post('Requirement') != '') ? $this->input->post('Requirement') : 'All');
        $LeadType = getStringClean(($this->input->post('LeadType') != '') ? $this->input->post('LeadType') : 'All');
        $ProjectID = $this->ProjectID;
        $status_search_value = 1;

        $sql = "call usp_A_GetVisitor( '$per_page_record', '$page_number','$EmployeeID','$Name','$EmailID','$MobileNo','$Profession','$DesignationID','$Requirement','$status_search_value','$LeadType','$ProjectID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
