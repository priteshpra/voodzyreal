<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $CategoryName = getStringClean(($this->input->post('CategoryName') != '') ? $this->input->post('CategoryName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetCategory('$PageSize' , '$CurrentPage','$CategoryName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function ListDataActive($PageSize = 10, $CurrentPage = 1) {
        $CategoryName = getStringClean(($this->input->post('CategoryName') != '') ? $this->input->post('CategoryName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : 1;
        $sql = "call usp_GetCategory('$PageSize' , '$CurrentPage','$CategoryName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['CategoryName'] = getStringClean((isset($array['CategoryName'])) ? $array['CategoryName'] : '');
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'].' Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddCategory('" .
                $array['CategoryName'] . "','" .
                $array['CreatedBy'] . "','" .
                $array['Status'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['CategoryName'] = getStringClean((isset($array['CategoryName'])) ? $array['CategoryName'] : '');
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] .' Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditCategory('" .
                $array['CategoryName'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetCategoryByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
    
    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ss_category";
        $array['field_name'] = "CategoryID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');"); 
    }
}
