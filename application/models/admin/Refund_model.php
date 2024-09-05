<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refund_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $sql ="call usp_A_GetRefund('".$per_page_record."' , '".$page_number."','".$CustomerPropertyID ."','-1','".$this->UserRoleID."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    function insert($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['RefundAmount']     = getStringClean((isset($data['RefundAmount']) && $data['RefundAmount'] !="")    ? str_replace(',','',$data['RefundAmount'])  : 0);
        $data['GSTAmount']     = getStringClean((isset($data['GSTAmount']) && $data['GSTAmount'] !="")    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['RefundDate']     = (isset($data['RefundDate']))    ? GetDateTimeInFormat($data['RefundDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['PaymentMode']     = (isset($data['PaymentMode']))    ? $data['PaymentMode']  : 'Cheque';
        $data['IFCCode']     = getStringClean((isset($data['IFCCode']))    ? $data['IFCCode']  : '');
        $data['UTR']     = getStringClean((isset($data['UTR']))    ? $data['UTR']  : '');
        $data['ChequeNo']     = getStringClean((isset($data['ChequeNo']))    ? $data['ChequeNo']  : '');
        $data['AccountNo']     = getStringClean((isset($data['AccountNo']))    ? $data['AccountNo']  : '');
        $data['BankName']     = getStringClean((isset($data['BankName']))    ? $data['BankName']  : '');
        $data['BranchName']     = getStringClean((isset($data['BranchName']))    ? $data['BranchName']  : '');
        $data['AmountType']     = getStringClean((isset($data['AmountType']))    ? $data['AmountType']  : 0);
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddRefund('" . 
            $data['CustomerPropertyID'] . "','" .
            $data['AmountType'] . "','" .
            $data['RefundAmount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['RefundDate'] . "','" .
            $data['PaymentMode'] . "','" .
            $data['ChequeNo'] . "','" .
            $data['IFCCode'] . "','" .
            $data['AccountNo'] . "','" .
            $data['BankName'] . "','" .
            $data['BranchName'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] . "','" .
            $data['UTR'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function getRecordCount(){
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_project','ProjectID')");
        $query->next_result();
        return $query->result();
    }

    function update($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['RefundAmount']     = getStringClean((isset($data['RefundAmount']) && $data['RefundAmount'] !="")    ? str_replace(',','',$data['RefundAmount'])  : 0);
        $data['GSTAmount']     = getStringClean((isset($data['GSTAmount']) && $data['GSTAmount'] !="")    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['RefundDate']     = (isset($data['RefundDate']))    ? GetDateTimeInFormat($data['RefundDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['PaymentMode']     = (isset($data['PaymentMode']))    ? $data['PaymentMode']  : 'Cheque';
        $data['IFCCode']     = getStringClean((isset($data['IFCCode']))    ? $data['IFCCode']  : '');
        $data['UTR']     = getStringClean((isset($data['UTR']))    ? $data['UTR']  : '');
        $data['ChequeNo']     = getStringClean((isset($data['ChequeNo']))    ? $data['ChequeNo']  : '');
        $data['AccountNo']     = getStringClean((isset($data['AccountNo']))    ? $data['AccountNo']  : '');
        $data['BankName']     = getStringClean((isset($data['BankName']))    ? $data['BankName']  : '');
        $data['BranchName']     = getStringClean((isset($data['BranchName']))    ? $data['BranchName']  : '');
        $data['AmountType']     = getStringClean((isset($data['AmountType']))    ? $data['AmountType']  : 0);
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditRefund('" . 
            $data['RefundID'] . "','" .
            $data['CustomerPropertyID'] . "','" .
            $data['AmountType'] . "','" .
            $data['RefundAmount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['RefundDate'] . "','" .
            $data['PaymentMode'] . "','" .
            $data['ChequeNo'] . "','" .
            $data['IFCCode'] . "','" .
            $data['AccountNo'] . "','" .
            $data['BankName'] . "','" .
            $data['BranchName'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] . "','".
            $data['UTR'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();

    }

    public function getByID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetRefundByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }

    public function ChangeRefund($ID = NULL) {
        $query = $this->db->query("call usp_A_ChangeRefundCloseStatus('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    
    public function getCancelByCPID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetCancelPropertyByCPID ('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    public function getRemainingAmount($ID ,$RID = 0) {
            $query = $this->db->query("SELECT Fn_GetRemainingRefund('" .$ID."','" . $RID . "',1) AS TotalRemainingAmount;");
            return $query->row();
    }
    public function getGSTRemainingAmount($ID ,$RID = 0) {
            $query = $this->db->query("SELECT Fn_GetRemainingRefund('" .$ID."','" . $RID . "',0) AS TotalGSTRemainingAmount;");
            return $query->row();
    }

}




