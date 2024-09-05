<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Imagetitle_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1)
    {
        $ProjectID = $this->input->post('ProjectID');
        $sql = "call usp_A_GetPropertyImageTitle('" .
            $per_page_record . "' , '" .
            $page_number . "','" .
            $ProjectID .
            "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function insert($data)
    {
        $data['ProjectID']     = (isset($data['ProjectID']))    ? $data['ProjectID']  : '';
        $data['Title']     = getStringClean((isset($data['Title']))    ? $data['Title']  : '');

        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;

        if ($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();

        $sql = "call usp_A_AddPropertyTitleImage('" .
            $data['ProjectID'] . "','" .
            $data['Title'] . "','" .
            $data['CreatedBy'] . "','" .
            $data['Status'] . "','" .
            $data['UserType'] . "','" .
            $data['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data)
    {
        $data['ProjectID']     = (isset($data['ProjectID']))    ? $data['ProjectID']  : '';
        $data['Title']     = getStringClean((isset($data['Title']))    ? $data['Title']  : '');
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if ($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditPropertyImageTitle('" .
            $data['PropertyImageTitleID'] . "','" .
            $data['ProjectID'] . "','" .
            $data['Title'] . "','" .
            $data['CreatedBy'] . "','" .
            $data['Status'] . "','" .
            $data['UserType'] . "','" .
            $data['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL)
    {
        $query = $this->db->query("call usp_A_GetPropertyImageTitleByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($data)
    {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_propertyimagetitle";
        $data['field_name']  = "PropertyImageTitleID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }

    function checkDuplicate($data)
    {
        $query = $this->db->query("call usp_A_CheckProperty('" .
            $data['ProjectID'] . "','" .
            getStringClean($data['Title']) . "','" .
            $data['PropertyImageTitleID'] . "')");
        $query->next_result();
        return $query->row();
    }
}
