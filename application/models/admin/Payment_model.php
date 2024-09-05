<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $sql ="call usp_A_GetCustomerPayment('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $CustomerPropertyID.
                    "',-1,'". $this->UserRoleID."')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['MileStone']     = getStringClean((isset($data['MileStone']))    ? $data['MileStone']  : '');
        $data['PaymentAmount']     = getStringClean((isset($data['PaymentAmount']) && $data['PaymentAmount'] !="")    ? str_replace(',','',$data['PaymentAmount'])  : 0);
        $data['GSTAmount']     = getStringClean((isset($data['GSTAmount']) && $data['GSTAmount'] !="")    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['PaymentDate']     = (isset($data['PaymentDate']))    ? GetDateTimeInFormat($data['PaymentDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
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
        $sql = "call usp_A_AddCustomerPayment('" . 
            $data['CustomerPropertyID'] . "','" .
            $data['AmountType'] . "','" .
            $data['PaymentAmount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['PaymentDate'] . "','" .
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
            $data['MileStone'] . "','','" .
            $data['UTR'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data){
        $data['CustomerPropertyID']     = (isset($data['CustomerPropertyID']))    ? $data['CustomerPropertyID']  : 0;
        $data['MileStone']     = getStringClean((isset($data['MileStone']))    ? $data['MileStone']  : 0);
        $data['PaymentAmount']     = getStringClean((isset($data['PaymentAmount']) && $data['PaymentAmount'] !="")    ? str_replace(',','',$data['PaymentAmount'])  : 0);
        $data['GSTAmount']     = getStringClean((isset($data['GSTAmount']) && $data['GSTAmount'] !="")    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['PaymentDate']     = (isset($data['PaymentDate']))    ? GetDateTimeInFormat($data['PaymentDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
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
        $sql = "call usp_A_EditCustomerPayment('" . 
            $data['CustomerPaymentID'] . "','" .
            $data['MileStone'] . "','" .
            $data['CustomerPropertyID'] . "','" .
            $data['AmountType'] . "','" .
            $data['PaymentAmount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['PaymentDate'] . "','" .
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
        $query = $this->db->query("call usp_A_GetCustomerPaymentByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    public function getRemainingAmount($ID ,$CPID = 0) {
            $query = $this->db->query("SELECT Fn_A_TotremPayByCustomer('" .$ID."','" . $CPID . "') AS TotalRemainingAmount;");
            return $query->row();
    }
    public function getGSTRemainingAmount($ID ,$CPID = 0) {
            $query = $this->db->query("SELECT Fn_GetRemainingGSTAmount('" .$ID."','" . $CPID . "') AS TotalGSTRemainingAmount;");
            return $query->row();
    }
    
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_customerpayment";
        $data['field_name']  = "CustomerPaymentID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
}