<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Propertygallery_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1)
    {
        $ProjectID = $this->input->post('ProjectID');
        $sql = "call usp_A_GetPropertyGallery('" .
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
        $data['SaleInventoryID']     = (isset($data['SaleInventoryID']))    ? $data['SaleInventoryID']  : 0;
        $data['ImagePath']     = (isset($data['ImagePath']))    ? $data['ImagePath']  : '';
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        if ($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddPropertyGallery('" .
            $data['ImagePath'] . "','" .
            $data['SaleInventoryID'] . "','" .
            $data['Title'] . "','" .
            $data['FileType'] . "','" .
            $data['CreatedBy'] . "','" .
            $data['UserType'] . "','" .
            $data['IPAddress'] . "');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
