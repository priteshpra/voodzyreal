<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Name = getStringClean(($this->input->post('Name') != '') ? $this->input->post('Name') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetContact('$PageSize' , '$CurrentPage','$Name','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Type'] = getStringClean((isset($array['Type'])) ? $array['Type'] : '');

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddContact('" .
            $array['Name'] . "','" .
            $array['EmailID'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Type'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Name'] = getStringClean((isset($array['Name'])) ? $array['Name'] : '');
        $array['EmailID'] = getStringClean((isset($array['EmailID'])) ? $array['EmailID'] : '');
        $array['MobileNo'] = getStringClean((isset($array['MobileNo'])) ? $array['MobileNo'] : '');
        $array['Type'] = getStringClean((isset($array['Type'])) ? $array['Type'] : '');

        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditContact('" .
            $array['Name'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['EmailID'] . "','" .
            $array['MobileNo'] . "','" .
            $array['Type'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetContactByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "ss_contact";
        $array['field_name'] = "ContactID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
}
