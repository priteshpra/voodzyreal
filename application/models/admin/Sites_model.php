<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sites_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1)
    {
        $VisitorID = ($this->input->post('VisitorID') != '') ? $this->input->post('VisitorID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetVisitorSites('" .
            $per_page_record . "' , '" .
            $page_number . "','" .
            $VisitorID . "','" .
            $status_search_value . "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function insert($data)
    {

        $data['VisitorID']   =  getStringClean((isset($data['VisitorID'])) ? $data['VisitorID'] : 0);
        $data['UserID']   =  getStringClean((isset($data['UserID'])) ? $data['UserID'] : 0);
        $data['ProjectID']   =  getStringClean((isset($data['ProjectID'])) ? $data['ProjectID'] : 0);
        $data['LeadType'] = getStringClean((isset($data['LeadType'])) ? $data['LeadType'] : 'Cold');

        $data['Finance']   =  getStringClean((isset($data['Finance'])) ? $data['Finance'] : '');
        $data['buyingPurpose']   =  getStringClean((isset($data['buyingPurpose'])) ? $data['buyingPurpose'] : '');
        $data['TimeToCall']   =  getStringClean((isset($data['TimeToCall'])) ? $data['TimeToCall'] : '');

        $data['Remarks']   =  getStringClean((isset($data['Remarks'])) ? $data['Remarks'] : '');

        $data['EntryTime']     = (isset($data['EntryTime']))    ? $data['EntryTime'] . ":00"  : '00:00:00';
        $str = $data['EntryDate'] . " " . $data['EntryTime'];
        $data['EntryDate']     = (isset($data['EntryDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $str1 = $data['InquiryDate'];
        $data['InquiryDate'] = date("Y-m-d", strtotime($str1));

        $data['SiteName']   =  getStringClean((isset($data['SiteName'])) ? $data['SiteName'] : '');

        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;

        if ($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();

        $sql = "call usp_A_AddVisitorSites('" .
            $data['VisitorID'] . "','" .
            $data['CreatedBy'] . "','" .
            $data['Status'] . "','" .
            $data['UserType'] . "','" .
            $data['IPAddress'] . "','" .
            $data['ProjectID'] . "','" .
            $data['UserID'] . "','" .
            $data['Remarks'] . "','" .
            $data['EntryDate'] . "','" .
            $data['Finance'] . "','" .
            $data['buyingPurpose'] . "','" .
            $data['TimeToCall'] . "','" .
            $data['InquiryDate'] . "','" .
            $data['LeadType'] . "','" .
            $data['SiteName'] . "'
        );";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data)
    {
        $data['VisitorID']   =  getStringClean((isset($data['VisitorID'])) ? $data['VisitorID'] : 0);
        $data['UserID']   =  getStringClean((isset($data['UserID'])) ? $data['UserID'] : 0);
        $data['ProjectID']   =  getStringClean((isset($data['ProjectID'])) ? $data['ProjectID'] : 0);
        $data['LeadType'] = getStringClean((isset($data['LeadType'])) ? $data['LeadType'] : 'Cold');

        $data['Finance']   =  getStringClean((isset($data['Finance'])) ? $data['Finance'] : '');
        $data['buyingPurpose']   =  getStringClean((isset($data['buyingPurpose'])) ? $data['buyingPurpose'] : '');
        $data['TimeToCall']   =  getStringClean((isset($data['TimeToCall'])) ? $data['TimeToCall'] : '');

        $data['Remarks']   =  getStringClean((isset($data['Remarks'])) ? $data['Remarks'] : '');

        $data['EntryTime']     = (isset($data['EntryTime']))    ? $data['EntryTime'] . ":00"  : '00:00:00';
        $str = $data['EntryDate'] . " " . $data['EntryTime'];
        $data['EntryDate']     = (isset($data['EntryDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;

        $str1 = $data['InquiryDate'];
        $data['InquiryDate'] = date("Y-m-d", strtotime($str1));

        $data['SiteName']   =  getStringClean((isset($data['SiteName'])) ? $data['SiteName'] : '');

        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;

        if ($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();

        $sql = "call usp_A_EditVisitorSites('" .
            $data['ProjectID'] . "','" .
            $data['CreatedBy'] . "','" .
            $data['Status'] . "','" .
            $data['ID'] . "','" .
            $data['UserType'] . "','" .
            $data['IPAddress'] . "','" .
            $data['UserID'] . "','" .
            $data['SiteName'] . "','" .
            $data['Remarks'] . "','" .
            $data['EntryDate'] . "','" .
            $data['Finance'] . "','" .
            $data['buyingPurpose'] . "','" .
            $data['TimeToCall'] . "','" .
            $data['InquiryDate'] . "','" .
            $data['LeadType'] . "'
        );";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL)
    {
        $query = $this->db->query("call usp_A_GetVisitorSitesByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($data)
    {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "ss_visitorsites";
        $data['field_name']  = "VisitorSitesID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
}
