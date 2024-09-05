<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campaign_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1)
    {
        $Title = getStringClean(($this->input->post('Title') != '') ? $this->input->post('Title') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_A_GetCampaign('$PageSize' , '$CurrentPage','$Title','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array)
    {
        $array['Title'] = getStringClean((isset($array['Title'])) ? $array['Title'] : '');
        $array['Source'] = getStringClean((isset($array['Source'])) ? $array['Source'] : '');
        $array['UserID'] = getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);

        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddCampaign('" .
            $array['Title'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Source'] . "','" .
            $array['UserID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['Title'] = getStringClean((isset($array['Title'])) ? $array['Title'] : '');
        $array['Source'] = getStringClean((isset($array['Source'])) ? $array['Source'] : '');
        $array['UserID'] = getStringClean((isset($array['UserID'])) ? $array['UserID'] : 0);

        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditCampaign('" .
            $array['Title'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "','" .
            $array['Source'] . "','" .
            $array['UserID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0)
    {
        $sql = "call usp_A_GetCampaignByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id'])) ? $array['id'] : 0;
        $array['status']        =   (isset($array['status'])) ? $array['status'] : 0;

        $array['table_name'] = "ss_campaign";
        $array['field_name'] = "CampaignID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
}
