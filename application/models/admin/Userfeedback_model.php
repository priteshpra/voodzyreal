<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userfeedback_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData() {
        $VisitorID=getStringClean(($this->input->post('VisitorID') != '')?$this->input->post('VisitorID'):-1);
        $OpportunityID=getStringClean(($this->input->post('OpportunityID') != '')?$this->input->post('OpportunityID'):-1);
        $UserID=getStringClean(($this->input->post('UserID') != '')?$this->input->post('UserID'):-1);
        $sql ="call usp_GetUserFeedbackByID('".$VisitorID."','".$OpportunityID."','".$UserID."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }

    function Insert() {

        $array = array();
        $array['FeedbackDate'] = getStringClean(($this->input->post('FeedbackDate') != '')?GetDateInFormat($this->input->post('FeedbackDate'),DATE_FORMAT,DATABASE_DATE_FORMAT):'');
        $array['ProjectID']=getStringClean(($this->input->post('ProjectID') != '')?$this->input->post('ProjectID'):'');
        $array['Type']=getStringClean(($this->input->post('Type') != '')?$this->input->post('Type'):'New');
        $array['VisitorID']=getStringClean(($this->input->post('VisitorID') != '')?$this->input->post('VisitorID'):0);
        $array['SitesID']=getStringClean(($this->input->post('SitesID') != '')?$this->input->post('SitesID'):0);
        $array['OpportunityID']=getStringClean(($this->input->post('OpportunityID') != '')?$this->input->post('OpportunityID'):0);
        $array['FeedbackID']=getStringClean(($this->input->post('FeedbackID') != '')?$this->input->post('FeedbackID'):0);
        $array['CallStartDateTime']=getStringClean(($this->input->post('CallStartDateTime') != '')?$this->input->post('CallStartDateTime'):'');
        $array['CallEndDateTime']=getStringClean(($this->input->post('CallEndDateTime') != '')?$this->input->post('CallEndDateTime'):'');
        $array['Remarks']=getStringClean(($this->input->post('Remarks') != '')?$this->input->post('Remarks'):'');

        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] .' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_AddUserFeedback('" .
                $array['CreatedBy'] . "','" .
                $array['CreatedBy'] . "' ,'1','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['VisitorID']."','".
                $array['OpportunityID']."','".
                $array['FeedbackID']."','".
                $array['CallStartDateTime']."','".
                $array['CallEndDateTime']."','".
                $array['Remarks']."','".
                $array['SitesID']."','".
                $array['ProjectID']."','".
                $array['Type']."','".
                $array['FeedbackDate']."'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    

    function DSRReportInsert($array) {
        
        $array['FeedbackDate'] = getStringClean(($this->input->post('FeedbackDate') != '')?GetDateInFormat($this->input->post('FeedbackDate'),DATE_FORMAT,DATABASE_DATE_FORMAT):'');
        $array['ProjectID']=getStringClean(($this->input->post('ProjectID') != '')?$this->input->post('ProjectID'):0);
        $array['AddType']=getStringClean(($this->input->post('AddType') != '')?$this->input->post('AddType'):'Website');
        $array['SitesID']=getStringClean(($this->input->post('SitesID') != '')?$this->input->post('SitesID'):0);
        $array['VisitorID'] = getStringClean((isset($array['VisitorID'])) ? $array['VisitorID'] : 0);
        $array['OpportunityID'] = getStringClean((isset($array['OpportunityID'])) ? $array['OpportunityID'] : 0);
        $array['EndCallTime'] = getStringClean((isset($array['EndCallTime'])) ? $array['EndCallTime'] : '');
        $array['StartCallTime'] = getStringClean((isset($array['StartCallTime'])) ? $array['StartCallTime'] : '');
        $array['FeedbackID'] = getStringClean((isset($array['FeedbackID'])) ? $array['FeedbackID'] : 0);
        $array['Remarks'] = getStringClean((isset($array['Remarks'])) ? $array['Remarks'] : '');

        $array['Status'] = 1;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'].' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_AddUserFeedback('" .
                $array['CreatedBy'] . "','" .
                $array['CreatedBy'] . "' ,'1','".
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['VisitorID']."','".
                $array['OpportunityID']."','".
                $array['FeedbackID']."','".
                $array['StartCallTime']."','".
                $array['EndCallTime']."','".
                $array['Remarks']."','".
                $array['SitesID']."','".
                $array['ProjectID']."','".
                $array['AddType']."','".
                $array['FeedbackDate']."'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function getProjectByRoleID($array){
        $array->UserID=getStringClean(($array->UserID != '')?$array->UserID:0);
        $array->RoleID=getStringClean(($array->RoleID != '')?$array->RoleID:0);
        $Type='All';

        $query = $this->db->query("call usp_A_GetProjectByRole('".$array->UserID. "','".
            $array->RoleID. "','All')");
        $query->next_result();
        return $query->result();
    }

    function getDSRProjectCount($ID){
        $query = $this->db->query("call usp_A_GetDSRProjectCount('".$ID. "')");
        $query->next_result();
        return $query->result();
    }

    function getDSRTotalCallingCount($ID){
        $query = $this->db->query("call usp_A_GetDSRTotalCallingCount()");
        $query->next_result();
        return $query->result();
    }

    function getDSRLeadsCount(){
        $query = $this->db->query("call usp_A_GetDSRTotalLeadCount()");
        $query->next_result();
        return $query->result();
    }

    function getDSRTotalVisitCount(){
        $query = $this->db->query("call usp_A_GetDSRTotalVisitCount()");
        $query->next_result();
        return $query->result();
    }

    function getDSRTotalBrokerCount(){
        $query = $this->db->query("call usp_A_GetDSRTotalBrokerCount()");
        $query->next_result();
        return $query->row();
    }
}




