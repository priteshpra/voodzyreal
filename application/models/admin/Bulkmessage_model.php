<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulkmessage_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    // Start : to list all contries 
    public function GetDetails($Type, $ProjectID = 0)
    {
        if ($ProjectID == "")
            $ProjectID = 0;
        $sql = "call usp_A_GetBulkDetails( '$Type','$ProjectID' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function insert($array)
    {
        $array['Type']   =   getStringClean((isset($array['Type'])) ? $array['Type'] : '');
        $array['Subject']   =   getStringClean((isset($array['Subject'])) ? $array['Subject'] : '');
        $array['Message']   =   getStringClean((isset($array['Message'])) ? $array['Message'] : '');
        $array['Receiver']   =   getStringClean((isset($array['Receiver'])) ? $array['Receiver'] : '');
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . " Web";
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_AddBulkMessages('" .
            $array['Type'] . "','" .
            $array['Subject'] . "','" .
            $array['Message'] . "','" .
            $array['Receiver'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function update($array)
    {
        //print_r($array);die();
        $array['StateName']   =   getStringClean((isset($array['StateName'])) ? $array['StateName'] : NULL);
        $array['CountryID']   =   getStringClean((isset($array['CountryID'])) ? $array['CountryID'] : 0);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID']   =   (isset($array['ID'])) ? $array['ID'] : 0;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();


        $sql = "call usp_A_EditState('" .
            $array['StateName'] . "','" .
            $array['CountryID'] . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;
        $array['table_name'] = "sssm_state";
        $array['field_name'] = "StateID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }

    public function getStateByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetStateByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    function get_emailtemplate($id)
    {
        $sql = "call usp_W_GetEmailTemplateDetailByID('" . $id . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
}
