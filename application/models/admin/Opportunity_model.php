<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Opportunity_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        if ($this->input->post('EmployeeID') == "-1" || $this->input->post('EmployeeID') == "-1") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : $this->session->userdata['UserID']);
        }

        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Project = getStringClean(($this->input->post('Project') != '') ? $this->input->post('Project') : '');
        $Source = getStringClean(($this->input->post('Source') != '') ? $this->input->post('Source') : 'All');
        $FeedbackID = getStringClean(($this->input->post('FeedbackID') != '') ? $this->input->post('FeedbackID') : '');
        $LeadType = getStringClean(($this->input->post('LeadType') != '') ? $this->input->post('LeadType') : '');
        $Requirement = getStringClean(($this->input->post('Requirement') != '') ? $this->input->post('Requirement') : '');
        
        $sql = "call usp_A_GetOpprtunityAPI('$PageSize','$CurrentPage','$Name','$MobileNo','$Project','$Source','$FeedbackID','$LeadType','$Requirement','$EmployeeID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function DashboardFollowUplistData($PageSize = 10, $CurrentPage = 1)
    {
        $array = $this->input->post();
        $array['FilterType'] = (!isset($array['FilterType']) || @$array['FilterType'] == "") ? "Daily" : @$array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_MA_DashboardLeadFollowUpReport('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $array['FilterType'] . "','" .
            $EmployeeID . "')";

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
        if ($EmployeeID == '') {
            $EmployeeID = '-1';
        }

        $sql = "call usp_A_GetOpportunityReminderByTime( '$EmployeeID', '$Current')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listAssignNotificationData()
    {
        $Current = date("Y-m-d H:i");
        //$EmployeeID = $this->session->userdata['UserID'];

        if (@$this->session->userdata['RoleID'] == "-1" || @$this->session->userdata['RoleID'] == "-2") {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = @$this->session->userdata['UserID'];
        }
        if ($EmployeeID == '') {
            $EmployeeID = '-1';
        }

        $sql = "call usp_A_GetOpportunityByAssignTime('$Current', '$EmployeeID')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function listLeadProcess($PageSize = 10, $CurrentPage = 1)
    {
        $OpportunityID = getStringClean(($this->input->post('OpportunityID') != '') ? $this->input->post('OpportunityID') : -1);
        $VisitorID = getStringClean(($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1);
        $Status = getStringClean(($this->input->post('Status') != '') ? $this->input->post('Status') : -1);

        $sql = "call usp_A_GetLeadProcess('$PageSize','$CurrentPage','$OpportunityID','$VisitorID','$Status')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function DSROpportunitylistData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Project = getStringClean(($this->input->post('Project') != '') ? $this->input->post('Project') : '');

        $sql = "call usp_A_GetOpprtunityDSRReport('$PageSize','$CurrentPage','$Name','$MobileNo','$Project')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function Insert($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Source'] = getStringClean((isset($array['Source'])) ? $array['Source'] : '');
        $array['Message'] = getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ProjectID'] = getStringClean((isset($array['ProjectID'])) ? $array['ProjectID'] : 0);

        $str1 = $array['EntryDate'];
        $array['EntryDate'] = date("Y-m-d", strtotime($str1));

        if (isset($array['Area'])) {
            $array['Area'] =  implode(',', $array['Area']);
        } else {
            $array['Area'] = '';
        }

        $array['Budget'] = getStringClean((isset($array['Budget'])) ? $array['Budget'] : '');
        $array['Purpose'] = getStringClean((isset($array['Purpose'])) ? $array['Purpose'] : '');
        $array['TypesofRequirement'] = getStringClean((isset($array['TypesofRequirement'])) ? $array['TypesofRequirement'] : '');
        $array['LeadType'] = getStringClean((isset($array['LeadType'])) ? $array['LeadType'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');

        if (isset($array['Requirement'])) {
            $array['Requirement'] =  implode(',', $array['Requirement']);
        } else {
            $array['Requirement'] = '';
        }

        if (isset($array['RequirementValue'])) {
            $array['RequirementValue'] =  implode(',', $array['RequirementValue']);
        } else {
            $array['RequirementValue'] = '';
        }

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = @$array['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddOpportunity('" .
            $array['Source'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['EntryDate'] . "','" .
            $array['EmailID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Message'] . "','" .
            $array['Name'] . "','" .
            $array['ProjectID'] . "','" .
            $array['Area'] . "','" .
            $array['Budget'] . "','" .
            $array['Purpose'] . "','" .
            $array['TypesofRequirement'] . "','" .
            $array['LeadType'] . "','" .
            $array['Address'] . "','" .
            $array['Requirement'] . "','" .
            $array['RequirementValue'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Source'] = getStringClean((isset($array['Source'])) ? $array['Source'] : '');
        $array['Message'] = getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['ProjectID'] = getStringClean((isset($array['ProjectID'])) ? $array['ProjectID'] : 0);

        $str1 = $array['EntryDate'];
        $array['EntryDate'] = date("Y-m-d", strtotime($str1));

        if (isset($array['Area'])) {
            $array['Area'] =  implode(',', $array['Area']);
        } else {
            $array['Area'] = '';
        }

        $array['Budget'] = getStringClean((isset($array['Budget'])) ? $array['Budget'] : '');
        $array['Purpose'] = getStringClean((isset($array['Purpose'])) ? $array['Purpose'] : '');
        $array['TypesofRequirement'] = getStringClean((isset($array['TypesofRequirement'])) ? $array['TypesofRequirement'] : '');
        $array['LeadType'] = getStringClean((isset($array['LeadType'])) ? $array['LeadType'] : '');
        $array['Address'] = getStringClean((isset($array['Address'])) ? $array['Address'] : '');

        if (isset($array['Requirement'])) {
            $array['Requirement'] =  implode(',', $array['Requirement']);
        } else {
            $array['Requirement'] = '';
        }

        if (isset($array['RequirementValue'])) {
            $array['RequirementValue'] =  implode(',', $array['RequirementValue']);
        } else {
            $array['RequirementValue'] = '';
        }

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = @$array['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditOpportunity('" .
            $array['Source'] . "','" .
            $array['EntryDate'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['EmailID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Message'] . "','" .
            $array['Name'] . "','" .
            $array['ProjectID'] . "','" .
            $array['Area'] . "','" .
            $array['Budget'] . "','" .
            $array['Purpose'] . "','" .
            $array['TypesofRequirement'] . "','" .
            $array['LeadType'] . "','" .
            $array['Address'] . "','" .
            $array['Requirement'] . "','" .
            $array['RequirementValue'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function InsertMagicBricks($array)
    {
        $array['0']->city   =   getStringClean((isset($array['0']->city)) ? $array['0']->city : '');
        $array['0']->dt    = getStringClean((isset($array['0']->dt)) ? $array['0']->dt : '');
        $array['0']->email   =   getStringClean((isset($array['0']->email)) ? $array['0']->email : '');
        $array['0']->isd    = getStringClean((isset($array['0']->isd)) ? $array['0']->isd : '');
        $array['0']->locality   =   getStringClean((isset($array['0']->locality)) ? $array['0']->locality : '');
        $array['0']->loginid    = getStringClean((isset($array['0']->loginid)) ? $array['0']->loginid : '');
        $array['0']->mobile   =   getStringClean((isset($array['0']->mobile)) ? $array['0']->mobile : '');
        $array['0']->msg    = getStringClean((isset($array['0']->msg)) ? $array['0']->msg : '');
        $array['0']->name   =   getStringClean((isset($array['0']->name)) ? $array['0']->name : '');
        $array['0']->pid    = getStringClean((isset($array['0']->pid)) ? $array['0']->pid : '');
        $array['0']->project   =   getStringClean((isset($array['0']->project)) ? $array['0']->project : '');
        $array['0']->subject    = getStringClean((isset($array['0']->subject)) ? $array['0']->subject : '');
        $array['0']->time   =   getStringClean((isset($array['0']->time)) ? $array['0']->time : '');
        $array['0']->tranType    = getStringClean((isset($array['0']->tranType)) ? $array['0']->tranType : '');
        $array['0']->VTime    = getStringClean((isset($array['0']->VTime)) ? $array['0']->VTime : '');
        $array['0']->vdate    = getStringClean((isset($array['0']->vdate)) ? $array['0']->vdate : '');

        $array['0']->Status = 1;
        $array['0']->created_by = 1;
        $array['0']->usertype = 'Admin Web';
        $array['0']->IPAddress = GetIP();

        $sql = "call usp_A_AddOpportunityAPI('MagicBricks','" .
            $array['0']->created_by . "','" .
            $array['0']->Status . "','" .
            $array['0']->usertype . "','" .
            $array['0']->IPAddress . "','" .
            $array['0']->city . "','" .
            $array['0']->dt . "','" .
            $array['0']->email . "','" .
            $array['0']->isd . "','" .
            $array['0']->locality . "','" .
            $array['0']->loginid . "','" .
            $array['0']->mobile . "','" .
            $array['0']->msg . "','" .
            $array['0']->name . "','" .
            $array['0']->pid . "','" .
            $array['0']->project . "','" .
            $array['0']->subject . "','" .
            $array['0']->time . "','" .
            $array['0']->tranType . "','" .
            $array['0']->VTime . "','" .
            $array['0']->vdate . "'
		)";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetOpportunityByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function listReminder($per_page_record = 10, $page_number = 1, $ID = -1)
    {
        $OpportunityID = ($this->input->post('OpportunityID') != '') ? $this->input->post('OpportunityID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetOpportunityReminder( '$per_page_record' , '$page_number','$OpportunityID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function changeReminderStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "ss_opportunityreminder";
        $array['field_name'] = "OpportunityReminderID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function InsertReminder($array)
    {
        $array['OpportunityID']   =   (isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0;
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

        $sql = "call usp_A_AddOpportunityReminder('" .
            $array['OpportunityID'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function InsertRingingReminder($array)
    {
        $array['created_by'] = $this->session->userdata['UserID'];
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';

        $sql = "call usp_A_AddOpportunityReminder('" .
            $array['OpportunityID'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function EditReminder($array)
    {
        $array['OpportunityID']   =   (isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0;
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

        $sql = "call usp_A_EditOpportunityReminder('" .
            $array['ID'] . "','" .
            $array['Message'] . "','" .
            $array['ReminderDate'] . "','" .
            $array['PastDate'] . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function updateAssignLead($array)
    {
        $array['OpportunityID']   =   (isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0;
        $array['Status']        =  1;
        $array['created_by'] = (isset($array['UserID'])) ? $array['UserID'] : 0;
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';

        $sql = "call usp_A_UpdateAssignBy('" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['OpportunityID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "'
        );";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function updateReAssignLead($array)
    {
        $array['OpportunityID']   =   (isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0;
        $array['Reason']   =   (isset($array['Reason'])) ? $array['Reason'] : 0;
        $array['Remarks']   =   (isset($array['Remarks'])) ? $array['Remarks'] : '';
        $array['Status']        =  1;
        $array['created_by'] = (isset($array['UserID'])) ? $array['UserID'] : 0;
        $array['IPAddress'] = GetIP();
        $array['usertype'] = 'Admin Web';

        $sql = "call usp_A_UpdateReAssignBy('" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['OpportunityID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Remarks'] . "','" .
            $array['Reason'] . "'
        );";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getReminderByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetOpportunityReminderByID('$ID')");
        $query->next_result();
        return $query->row();
    }
}
