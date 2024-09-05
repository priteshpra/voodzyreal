<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Goods_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        $GoodsName = getStringClean(($this->input->post('GoodsName') != '') ? $this->input->post('GoodsName') : '');
        $Status = ($this->input->post('Status') != '') ? $this->input->post('Status') : -1;
        $sql = "call usp_GetGoods('$PageSize','$CurrentPage','$GoodsName','$Status' )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {
        $array['GoodsName'] = getStringClean((isset($array['GoodsName'])) ? $array['GoodsName'] : '');
        $array['CategoryID']= getStringClean(($this->input->post('CategoryID') != '') ? $this->input->post('CategoryID') : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        
        $array['IPAddress'] = GetIP();
        $sql = "call usp_AddGoods
            (
                '".$array['GoodsName']."',
                '".$array['CreatedBy']."',
                '".$array['Status']."',
                '".$array['UserType']."',
                '".$array['IPAddress']."',
                '".$array['CategoryID']."'
            )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['GoodsName'] = getStringClean((isset($array['GoodsName'])) ? $array['GoodsName'] : '');
        $array['CategoryID']= getStringClean(($this->input->post('CategoryID') != '') ? $this->input->post('CategoryID') : 0);;
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_EditGoods('" .
                $array['GoodsName'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."',
                '".$array['CategoryID']."'
                )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_GetGoodsByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   

    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        
        $array['table_name'] = "ss_goods";
        $array['field_name'] = "GoodsID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');"); 
    }

    public function GoodsNameCombobox() 
    {
        $CategoryID = ($this->input->post('CategoryID')=="")?'-1':$this->input->post('CategoryID');
        $sql = "call usp_M_GetGoodbyCategoryID('$CategoryID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

}
