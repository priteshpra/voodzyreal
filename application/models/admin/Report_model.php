<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function ReportRole()
    {
        $array = $this->input->post();
        $FilterType = (!isset($array['FilterType']) || @$array['FilterType'] == "") ? "Daily" : @$array['FilterType'];
        $sql = "call usp_A_ReportRole('" .
            $this->UserRoleID . "','" .
            $this->ProjectID . "','" .
            'Web' . "','" .
            $FilterType . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function listData($PageSize = 10, $CurrentPage = 1)
    {
        $array = $this->input->post();
        $array['FilterType'] = (!isset($array['FilterType']) || @$array['FilterType'] == "") ? "Daily" : @$array['FilterType'];
        $array['CustomStartDate'] = getStringClean(($this->input->post('CustomStartDate') != '') ? GetDateInFormat($this->input->post('CustomStartDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $array['CustomEndDate'] = getStringClean(($this->input->post('CustomEndDate') != '') ? GetDateInFormat($this->input->post('CustomEndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_MA_DashboardReport('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $this->UserRoleID . "','" .
            $this->ProjectID . "','" .
            'Web' . "','" .
            $array['ReportType'] . "','" .
            $array['FilterType'] . "','" .
            $array['CustomStartDate'] . "','" .
            $array['CustomEndDate'] . "','" .
            $EmployeeID . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function DuePayment($PageSize = 10, $CurrentPage = 1)
    {
        $Percentage = ($this->input->post('Percentage') != '') ? $this->input->post('Percentage') : 100;
        $ProjectID = ($this->ProjectID != "") ? $this->ProjectID : -1;
        //$ProjectID = ($this->input->post('ProjectID')!='')?$this->input->post('ProjectID'):-1;
        $sql = "call usp_A_DuePayment('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $ProjectID . "','" .
            $this->UserRoleID . "','" .
            'Web' . "','" .
            $Percentage . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function GetCancelledProject($PageSize = 10, $CurrentPage = 1)
    {
        $ProjectState = $this->input->post('ProjectState');
        //$ProjectID = ($this->input->post('ProjectID')!='')?$this->input->post('ProjectID'):-1;
        $ProjectID = ($this->ProjectID != "") ? $this->ProjectID : -1;
        $IsCancelled = 0;
        $IsHold = 0;
        if ($ProjectState == 1) {
            $IsCancelled = 1;
            $IsHold = -1;
        } elseif ($ProjectState == 2) {
            $IsHold = 1;
            $IsCancelled = -1;
        } elseif ($ProjectState == -1) {
            $IsCancelled = 1;
            $IsHold = 1;
        }

        $sql = "call usp_A_GetCancelledProject('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $ProjectID . "','" .
            $IsCancelled . "','" .
            $IsHold . "','" .
            $this->UserRoleID . "','" .
            'Web' . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function GetPayment($PageSize = 10, $CurrentPage = 1)
    {
        $PropertyID = ($this->input->post('PropertyID') != '') ? $this->input->post('PropertyID') : -1;
        //$ProjectID = ($this->input->post('ProjectID')!='')?$this->input->post('ProjectID'):-1;
        $ProjectID = ($this->ProjectID != "") ? $this->ProjectID : -1;
        $sql = "call usp_A_GetReportPayment('" .
            $PageSize . "','" .
            $CurrentPage . "','" .
            $this->UserRoleID . "','" .
            $ProjectID . "','" .
            $PropertyID . "','" .
            'Web' . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
    public function ExportByProject()
    {
        $ProjectID = ($this->input->post('ProjectID') != '') ? $this->input->post('ProjectID') : -1;

        $sql = "call usp_A_GetProjectByID('" . $ProjectID . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        $project_array = $query->row();
        $leng = strlen($project_array->Prefix);
        $sql = "call  usp_A_GetWingsByPrefix('" . $leng . "','" . $ProjectID . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        $wings_array = $query->result();
        return $wings_array;
    }
    public function GetPropertyByWings($Prefix, $PrefixLen, $ProjectID)
    {
        $sql = "call  usp_A_GetPropertyByWings('" .
            $Prefix . "','" .
            $PrefixLen . "','" .
            $ProjectID . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GetDocument($PageSize = 10, $CurrentPage = 1)
    {
        /*$ProjectID = ($this->input->post('ProjectID')!='')?$this->input->post('ProjectID'):-1;*/
        $ProjectID = ($this->ProjectID != "") ? $this->ProjectID : -1;
        $sql = "call usp_A_GetReportDocument('$PageSize','$CurrentPage','$ProjectID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function TotalPayment($PageSize = 10, $CurrentPage = 1)
    {
        $ProjectID = ($this->ProjectID != "") ? $this->ProjectID : -1;
        $sql = "call usp_A_GetTotalPaymentReport('" . $ProjectID . "','" . $PageSize . "','" . $CurrentPage . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GetFollowupReport($per_page_record = 10, $page_number = 1)
    {
        $EmployeeID = ($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : -1;
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetVisitorReminderReport('$per_page_record' , '$page_number','$EmployeeID','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GetDSRReport($per_page_record = 10, $page_number = 1)
    {
        $EmployeeID = ($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : -1;
        $ReportDate = getStringClean(($this->input->post('ReportDate') != '') ? GetDateInFormat($this->input->post('ReportDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetDSRReport('$per_page_record' , '$page_number','$EmployeeID','$ReportDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GetBirthdayReport($per_page_record = 10, $page_number = 1)
    {
        $BirthDate = ($this->input->post('BirthDate') != '') ? $this->input->post('BirthDate') : date("d");
        $BirthMonth = ($this->input->post('BirthMonth') != '') ? $this->input->post('BirthMonth') : date("m");

        $sql = "call usp_GetBirthdayUpcoming('$per_page_record' , '$page_number','$BirthDate','$BirthMonth')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GettAnniversaryReport($per_page_record = 10, $page_number = 1)
    {
        $AnniversaryDate = ($this->input->post('AnniversaryDate') != '') ? $this->input->post('AnniversaryDate') : date("d");
        $AnniversaryMonth = ($this->input->post('AnniversaryMonth') != '') ? $this->input->post('AnniversaryMonth') : date("m");

        $sql = "call usp_GetAnniversaryUpcoming('$per_page_record' , '$page_number','$AnniversaryDate','$AnniversaryMonth')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function NotificationData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Project = getStringClean(($this->input->post('Project') != '') ? $this->input->post('Project') : '');
        $Source = getStringClean(($this->input->post('Source') != '') ? $this->input->post('Source') : 'All');

        $sql = "call usp_A_GetOpprtunityNotification('$PageSize','$CurrentPage','$Name','$MobileNo','$Project','$Source')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function GetOpportunityFollowupReport($per_page_record = 10, $page_number = 1)
    {

        $EmployeeID = ($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : -1;
        $FollowUpDate = ($this->input->post('FollowUpDate') != '') ? $this->input->post('FollowUpDate') : '0000-00-0';
        $FollowUpDate = getStringClean(($this->input->post('FollowUpDate') != '') ? GetDateInFormat($this->input->post('FollowUpDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetOpportunityReminderReport('$per_page_record','$page_number','$EmployeeID','$FollowUpDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function OpportunityListData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $Project = getStringClean(($this->input->post('Project') != '') ? $this->input->post('Project') : '');
        $Source = getStringClean(($this->input->post('Source') != '') ? $this->input->post('Source') : 'All');
        $FeedbackID = getStringClean(($this->input->post('FeedbackID') != '') ? $this->input->post('FeedbackID') : '');
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $AssignType = getStringClean(($this->input->post('AssignType') != '') ? $this->input->post('AssignType') : 'All');
        if ($this->input->post('EmployeeID') == "-1" || $this->input->post('EmployeeID') == "-1") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : $this->session->userdata['UserID']);
        }
        $EmployeeID = -1;
        $sql = "call usp_A_GetOpprtunityFromToDate('$PageSize','$CurrentPage','$Name','$MobileNo','$Project','$Source','$FeedbackID','$FromDate','$EndDate','$EmployeeID','$AssignType')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function VisitorFromEndDatelistData($per_page_record = 10, $page_number = 1)
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

        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetVisitorByFromToDate( '$per_page_record', '$page_number','$EmployeeID','$Name','$EmailID','$MobileNo','$Profession','$DesignationID','$Requirement','$status_search_value','$LeadType','$ProjectID','$FromDate','$EndDate')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function LeadTypeFromEndDatelistData($per_page_record = 10, $page_number = 1)
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

        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetVisitorLeadTypeByFromToDate( '$per_page_record', '$page_number','$EmployeeID','$Name','$EmailID','$MobileNo','$Profession','$DesignationID','$Requirement','$status_search_value','$LeadType','$ProjectID','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function FeedbackListData($per_page_record = 10, $page_number = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');

        $sql = "call usp_A_GetFeedbackFromToDate( '$per_page_record', '$page_number','$FromDate','$EndDate')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function VisitListData($per_page_record = 10, $page_number = 1)
    {
        $FromDate = getStringClean(($this->input->post('FromDate') != '') ? GetDateInFormat($this->input->post('FromDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $EndDate = getStringClean(($this->input->post('EndDate') != '') ? GetDateInFormat($this->input->post('EndDate'), DATE_FORMAT, DATABASE_DATE_FORMAT) : '');
        $ProjectID = $this->ProjectID;

        $sql = "call usp_A_GetVisitFromToDate( '$per_page_record', '$page_number','$FromDate','$EndDate','$ProjectID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function OpportunityAssignStatus($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
        $AssignStatus = getStringClean(($this->input->post('AssignStatus') != '') ? $this->input->post('AssignStatus') : 'New');
        $FilterType = getStringClean(($this->input->post('FilterType') != '') ? $this->input->post('FilterType') : 'Daily');

        if ($this->session->userdata['RoleID'] == "-1" || $this->session->userdata['RoleID'] == "-2") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }
        if ($AssignStatus == 'OverDue') {
            if($this->input->post('ReportUserID') != 0){
                $EmployeeID = $this->input->post('ReportUserID');
            }
            $sql = "call usp_A_GetOpprtunityOverDue('$PageSize','$CurrentPage','$Name','$MobileNo','$EmployeeID','$FilterType')";
        } else {
            $sql = "call usp_A_GetOpprtunityAssignStatus('$PageSize','$CurrentPage','$Name','$MobileNo','$EmployeeID','$AssignStatus','$FilterType')";
        }

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listVisitorLost($per_page_record = 10, $page_number = 1)
    {
        $FilterType = getStringClean(($this->input->post('FilterType') != '') ? $this->input->post('FilterType') : 'Daily');

        if ($this->session->userdata['RoleID'] == "-1" || $this->session->userdata['RoleID'] == "-2") {
            $EmployeeID = getStringClean(($this->input->post('EmployeeID') != '') ? $this->input->post('EmployeeID') : '-1');
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }
        
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $MobileNo = getStringClean(($this->input->post('MobileNo') != '') ? $this->input->post('MobileNo') : '');
       
        $status_search_value = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetVisitorByLost( '$per_page_record', '$page_number','$EmployeeID','$Name','$MobileNo','$status_search_value','$FilterType')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
