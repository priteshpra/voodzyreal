<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feature_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function listData($PageSize = 10, $CurrentPage = 1)
    {
        $FeatureName = getStringClean(($this->input->post('FeatureName') != '') ? $this->input->post('FeatureName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;

        $sql = "call usp_A_GetFeatures( '$PageSize' , '$CurrentPage','$FeatureName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function Insert($array)
    {
        $array['FeatureName'] = getStringClean((isset($array['FeatureName'])) ? $array['FeatureName'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddFeatures('" .
            $array['FeatureName'] . "','" .
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
        $array['FeatureName'] = getStringClean((isset($array['FeatureName'])) ? $array['FeatureName'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['Usertype'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_EditFeature('" .
            $array['FeatureName'] . "','" .
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
        $query = $this->db->query("call usp_A_GetFeatureByID('$ID')");
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($banner_array)
    {
        $banner_array['id']            =   (isset($banner_array['id'])) ? $banner_array['id'] : 0;
        $banner_array['status']        =   (isset($banner_array['status'])) ? $banner_array['status'] : 0;

        $banner_array['table_name'] = "ss_features";
        $banner_array['field_name'] = "FeaturesID";
        $banner_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $banner_array['table_name'] . "','" . $banner_array['field_name'] . "','" . $banner_array['id'] . "','" . $banner_array['status'] . "','" . $banner_array['modified_by'] . "');");
    }
}
