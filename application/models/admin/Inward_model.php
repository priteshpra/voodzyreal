<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inward_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ListData($PageSize = 10, $CurrentPage = 1) {
        
        $ChallanDate=getStringClean(($this->input->post('ChallanDate')!='')?$this->input->post('ChallanDate'):'0000-00-00');

        if ($this->input->post('ChallanDate')=='0000-00-00' || $this->input->post('ChallanDate')=='1970-01-01' ||$ChallanDate=='0000-00-00') {
            $ChallanDate='0000-00-00';
        }
        else
        {

            $ChallanDate1=getStringClean(($this->input->post('ChallanDate')!='')?$this->input->post('ChallanDate'):'0000-00-00');
            $ChallanDate =date("Y-m-d", strtotime($ChallanDate1) );
        }

        $ChallanNo=getStringClean(($this->input->post('ChallanNo')!='')?$this->input->post('ChallanNo'):-1);
        $VendorName=getStringClean(($this->input->post('VendorName') != '')?$this->input->post('VendorName'):'');
        
        $sql = "call usp_A_GetInwardMaster_List('$PageSize','$CurrentPage','$VendorName','$ChallanDate','$ChallanNo')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    function Insert($array) {

        $array['ChallanNo'] = getStringClean((isset($array['ChallanNo'])) ? $array['ChallanNo'] : '');
        $str1 = $array['ChallanDate'];
        $array['ChallanDate'] =date("Y-m-d", strtotime($str1) );
        $array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : '');
        $array['CategoryID'] = getStringClean((isset($array['CategoryID'])) ? $array['CategoryID'] : '');
        $array['ProjectID'] = getStringClean((isset($array['ProjectID'])) ? $array['ProjectID'] : '');
        $array['VendorID'] = getStringClean((isset($array['VendorID'])) ? $array['VendorID'] : '');
        $array['Total'] = getStringClean((isset($array['TotalPrice'])) ? $array['TotalPrice'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['EmployeeID'] = $this->session->userdata['UserID']; 

        $sql = "call usp_A_AddInward
            (
                '".$array['UserType']."',
                '".$array['IPAddress']."',
                '".$array['EmployeeID']."',
                '".$array['Status']."',
                '".$array['VendorID']."',
                '".$array['ChallanNo']."',
                '".$array['image']."',
                '".$array['ChallanDate']."',
                '".$array['Total']."',
                '".$array['CategoryID']."',
                '".$array['ProjectID']."'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function ItemInsert($array) {

        $array['GoodsReceivedNoteID'] = getStringClean((isset($array['GoodsReceivedNoteID'])) ? $array['GoodsReceivedNoteID'] : '');
        $array['GoodsID'] = getStringClean((isset($array['GoodsID'])) ? $array['GoodsID'] : 0);
        $array['UOMID'] = getStringClean((isset($array['UOMID'])) ? $array['UOMID'] : 0);
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : 0);
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['Total'] = getStringClean((isset($array['FinalPrice'])) ? $array['FinalPrice'] : 0);
        $array['Status'] = getStringClean((isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $array['CreatedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $array['EmployeeID'] = $this->session->userdata['UserID']; 

        $sql = "call usp_A_AddInwardItem
            (
                '".$array['UserType']."',
                '".$array['IPAddress']."',
                '".$array['EmployeeID']."',
                '".$array['Status']."',
                '".$array['GoodsReceivedNoteID']."',
                '".$array['GoodsID']."',
                '".$array['Qty']."',
                '".$array['UOMID']."',
                '".$array['Rate']."',
                '".$array['Total']."'
            )";
          
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function Update($array) {
        $array['ChallanNo'] = getStringClean((isset($array['ChallanNo'])) ? $array['ChallanNo'] : '');
        $str1 = $array['ChallanDate'];
        $array['ChallanDate'] =date("Y-m-d", strtotime($str1) );
        $array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : '');
        $array['CategoryID'] = getStringClean((isset($array['CategoryID'])) ? $array['CategoryID'] : '');
        $array['ProjectID'] = getStringClean((isset($array['ProjectID'])) ? $array['ProjectID'] : '');
        $array['VendorID'] = getStringClean((isset($array['VendorID'])) ? $array['VendorID'] : '');
        $array['Total'] = getStringClean((isset($array['TotalPrice'])) ? $array['TotalPrice'] : 0);

        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditInwardMaster('" .
                $array['ProjectID'] . "','" .
                $array['ModifiedBy'] . "','" .
                $array['Status'] . "','" .
                $array['ID'] . "','".
                $array['UserType']."','".
                $array['IPAddress']."',
                '".$array['CategoryID']."',
                '".$array['VendorID']."',
                '".$array['ChallanNo']."',
                '".$array['image']."',
                '".$array['ChallanDate']."',
                '".$array['Total']."'
                )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    
    public function ItemUpdate($array) {

        $array['GoodsID'] = getStringClean((isset($array['GoodsID'])) ? $array['GoodsID'] : 0);
        $array['UOMID'] = getStringClean((isset($array['UOMID'])) ? $array['UOMID'] : 0);
        $array['Qty'] = getStringClean((isset($array['Qty'])) ? $array['Qty'] : 0);
        $array['Rate'] = getStringClean((isset($array['Rate'])) ? $array['Rate'] : 0);
        $array['Total'] = getStringClean((isset($array['FinalPrice'])) ? $array['FinalPrice'] : 0);

        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ModifiedBy'] = $this->session->userdata['UserID'];
        $array['UserType'] = $this->session->userdata['UserType'] . ' Web';
        $array['IPAddress'] = GetIP();
        $sql ="call usp_A_EditInwardItem('" .
                $array['ModifiedBy'] . "','" .
                $array['UserType']."','".
                $array['IPAddress']."','".
                $array['ID'] . "',
                '".$array['GoodsID']."',
                '".$array['UOMID']."',
                '".$array['Qty']."',
                '".$array['Rate']."',
                '".$array['Total']."','" .
                $array['Status'] . "'
                )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function GetByID($ID = 0) {
        $sql = "call usp_A_GetInwardMasterByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   

    public function GetByIDItem($ID = 0) {
        $sql = "call usp_A_GetInwardItemByID('$ID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }   
    
    public function changeStatus($array)
    {
        $array['id']            =   (isset($array['id']))?$array['id']:0;                
        $array['status']        =   (isset($array['status']))?$array['status']:0;
        $array['table_name'] = "ss_goodsreceivednote";
        $array['field_name'] = "GoodsReceivedNoteID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');"); 
    }

    public function UpdateInvoiceImg($array)
    {
        $array['image'] = getStringClean((isset($array['image'])) ? $array['image'] : '');
        $array['GoodsReceivedNoteID'] = getStringClean((isset($array['GoodsReceivedNoteID'])) ? $array['GoodsReceivedNoteID'] : 0);
        $sql = "call usp_A_UpdateInvoiceImage
            (
                '".$array['GoodsReceivedNoteID']."',
                '".$array['image']."'
            )";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function InwardItemListData($PageSize = 10, $CurrentPage = 1) {
        $GoodsReceivedNoteID = ($this->input->post('GoodsReceivedNoteID') != '') ? $this->input->post('GoodsReceivedNoteID') : 0;
        $sql = "call usp_A_GetInwardItem_List('$PageSize','$CurrentPage','$GoodsReceivedNoteID')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

}
