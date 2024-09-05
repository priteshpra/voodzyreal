<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Furnish_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function listData($PageSize = 10, $CurrentPage = 1)
    {
        $FurnishName = getStringClean(($this->input->post('FurnishName') != '') ? $this->input->post('FurnishName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetFurnish( '$PageSize' , '$CurrentPage','$FurnishName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function Insert($array)
    {
        $array['FurnishName'] = getStringClean((isset($array['FurnishName'])) ? $array['FurnishName'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddFurnish('" .
            $array['FurnishName'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array)
    {
        $array['FurnishName'] = getStringClean((isset($array['FurnishName'])) ? $array['FurnishName'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['Usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditFurnish('" .
            $array['FurnishName'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['Usertype'] . "','" .
            $array['IPAddress'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = null)
    {
        $query = $this->db->query("call usp_A_GetFurnishByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($banner_array)
    {
        $banner_array['id']            =   (isset($banner_array['id'])) ? $banner_array['id'] : 0;
        $banner_array['status']        =   (isset($banner_array['status'])) ? $banner_array['status'] : 0;

        $banner_array['table_name'] = "ss_furnish";
        $banner_array['field_name'] = "FurnishID";
        $banner_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $banner_array['table_name'] . "','" . $banner_array['field_name'] . "','" . $banner_array['id'] . "','" . $banner_array['status'] . "','" . $banner_array['modified_by'] . "');");
    }
}
