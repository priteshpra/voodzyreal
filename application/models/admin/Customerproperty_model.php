<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customerproperty_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) {
        $CustomerID = $this->input->post('CustomerID');
        $sql ="call usp_A_GetCustomerProperty('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $CustomerID.
                    "','-1','','-1','".
                    $this->UserRoleID . "','Web')";
                    
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['CustomerID']         = (isset($data['CustomerID']))    ? $data['CustomerID']  : 0;
        $data['ProjectID']         = (isset($data['ProjectID']))    ? $data['ProjectID']  : 0;
        $data['PurchaseDate']       = (isset($data['PurchaseDate']))    ? GetDateTimeInFormat($data['PurchaseDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['Amount']             = getStringClean((isset($data['Amount']))    ? str_replace(',','',$data['Amount'])  : 0);
        $data['GSTAmount']          = getStringClean((isset($data['GSTAmount']))    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['CustomerFirstName']  = getStringClean((isset($data['CustomerFirstName']))    ? $data['CustomerFirstName']  : '');
        $data['CustomerLastName']   = getStringClean((isset($data['CustomerLastName']))    ? $data['CustomerLastName']  : '');
        $data['CustomerAddress']    = getStringClean((isset($data['CustomerAddress']))    ? $data['CustomerAddress']  : '');
        $data['CustomerEmailID']    = getStringClean((isset($data['CustomerEmailID']))    ? $data['CustomerEmailID']  : '');
        $data['CustomerPanNo']      = getStringClean((isset($data['CustomerPanNo']))    ? $data['CustomerPanNo']  : '');
        $data['CustomerAdhaarNo']   = getStringClean((isset($data['CustomerAdhaarNo']))    ? $data['CustomerAdhaarNo']  : '');
        $data['CustomerMobileNo']   = getStringClean((isset($data['CustomerMobileNo']))    ? $data['CustomerMobileNo']  : '');
        $data['CustomerMobileNo1']  = getStringClean((isset($data['CustomerMobileNo1']))    ? $data['CustomerMobileNo1']  : '');
        $data['CustomerSFirstName'] = getStringClean((isset($data['CustomerSFirstName']))    ? $data['CustomerSFirstName']  : '');
        $data['CustomerSLastName']  = getStringClean((isset($data['CustomerSLastName']))    ? $data['CustomerSLastName']  : '');
        $data['CustomerSAddress']   = getStringClean((isset($data['CustomerSAddress']))    ? $data['CustomerSAddress']  : '');
        $data['CustomerSEmailID']   = getStringClean((isset($data['CustomerSEmailID']))    ? $data['CustomerSEmailID']  : '');
        $data['CustomerSPanNo']     = getStringClean((isset($data['CustomerSPanNo']))    ? $data['CustomerSPanNo']  : '');
        $data['CustomerSAdhaarNo']  = getStringClean((isset($data['CustomerSAdhaarNo']))    ? $data['CustomerSAdhaarNo']  : '');
        $data['CustomerSMobileNo']  = getStringClean((isset($data['CustomerSMobileNo']))    ? $data['CustomerSMobileNo']  : '');
        $data['CustomerSMobileNo1'] = getStringClean((isset($data['CustomerSMobileNo1']))    ? $data['CustomerSMobileNo1']  : '');  

        if (@$data['ChanelPartnerID']=='') {
            $data['ChanelPartnerID'] = 0;
        }
        else
        {
            $data['ChanelPartnerID']     = getStringClean((isset($data['ChanelPartnerID']))    ? $data['ChanelPartnerID']  : '0');
        }  

        $data['CreatedBy']          = $this->session->userdata['UserID'];
        $data['Status']             = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        $data['IsHold']             = (isset($data['IsHold']) && $data['IsHold'] == 'on') ? ACTIVE : INACTIVE;

        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';

        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomerProperty('" . 
            $data['CustomerID'] . "','" .
            $data['ProjectID'] . "','" .
            $data['PurchaseDate'] . "','" .
            $data['Amount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['CustomerFirstName'] . "','" .
            $data['CustomerLastName'] . "','" .
            $data['CustomerAddress'] . "','" .
            $data['CustomerEmailID'] . "','" .
            $data['CustomerPanNo'] . "','" .
            $data['CustomerAdhaarNo'] . "','" .
            $data['CustomerMobileNo'] . "','" .
            $data['CustomerMobileNo1'] . "','" .
            $data['CustomerSFirstName'] . "','" .
            $data['CustomerSLastName'] . "','" .
            $data['CustomerSAddress'] . "','" .
            $data['CustomerSEmailID'] . "','" .
            $data['CustomerSPanNo'] . "','" .
            $data['CustomerSAdhaarNo'] . "','" .
            $data['CustomerSMobileNo'] . "','" .
            $data['CustomerSMobileNo1'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."','','".
            $data['ChanelPartnerID'] ."','".
            $data['IsHold'] ."');" ;  

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data){
        $data['CustomerID']     = (isset($data['CustomerID']))    ? $data['CustomerID']  : 0;
        $data['PurchaseDate']     = (isset($data['PurchaseDate']))    ? GetDateTimeInFormat($data['PurchaseDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['Amount']             = getStringClean((isset($data['Amount']))    ? str_replace(',','',$data['Amount'])  : 0);
        $data['GSTAmount']             = getStringClean((isset($data['GSTAmount']))    ? str_replace(',','',$data['GSTAmount'])  : 0);
        $data['CustomerFirstName']     = getStringClean((isset($data['CustomerFirstName']))    ? $data['CustomerFirstName']  : '');
        $data['CustomerLastName']     = getStringClean((isset($data['CustomerLastName']))    ? $data['CustomerLastName']  : '');
        $data['CustomerAddress']     = getStringClean((isset($data['CustomerAddress']))    ? $data['CustomerAddress']  : '');
        $data['CustomerEmailID']     = getStringClean((isset($data['CustomerEmailID']))    ? $data['CustomerEmailID']  : '');
        $data['CustomerPanNo']     = getStringClean((isset($data['CustomerPanNo']))    ? $data['CustomerPanNo']  : '');
        $data['CustomerAdhaarNo']     = getStringClean((isset($data['CustomerAdhaarNo']))    ? $data['CustomerAdhaarNo']  : '');
        $data['CustomerMobileNo']     = getStringClean((isset($data['CustomerMobileNo']))    ? $data['CustomerMobileNo']  : '');
        $data['CustomerMobileNo1']     = getStringClean((isset($data['CustomerMobileNo1']))    ? $data['CustomerMobileNo1']  : '');
        $data['CustomerSFirstName']     = getStringClean((isset($data['CustomerSFirstName']))    ? $data['CustomerSFirstName']  : '');
        $data['CustomerSLastName']     = getStringClean((isset($data['CustomerSLastName']))    ? $data['CustomerSLastName']  : '');
        $data['CustomerSAddress']     = getStringClean((isset($data['CustomerSAddress']))    ? $data['CustomerSAddress']  : '');
        $data['CustomerSEmailID']     = getStringClean((isset($data['CustomerSEmailID']))    ? $data['CustomerSEmailID']  : '');
        $data['CustomerSPanNo']     = getStringClean((isset($data['CustomerSPanNo']))    ? $data['CustomerSPanNo']  : '');
        $data['CustomerSAdhaarNo']     = getStringClean((isset($data['CustomerSAdhaarNo']))    ? $data['CustomerSAdhaarNo']  : '');
        $data['CustomerSMobileNo']     = getStringClean((isset($data['CustomerSMobileNo']))    ? $data['CustomerSMobileNo']  : '');
        $data['CustomerSMobileNo1']     = getStringClean((isset($data['CustomerSMobileNo1']))    ? $data['CustomerSMobileNo1']  : '');
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        if ($data['ChanelPartnerID']=='') {
            $data['ChanelPartnerID'] = 0;
        }
        else
        {
            $data['ChanelPartnerID']     = getStringClean((isset($data['ChanelPartnerID']))    ? $data['ChanelPartnerID']  : '0');
        }   
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        $data['IsHold'] = (isset($data['IsHold']) && $data['IsHold'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditCustomerProperty('" . 
            $data['CustomerPropertyID'] . "','" .
            $data['CustomerID'] . "','" .
            $data['PurchaseDate'] . "','" .
            $data['Amount'] . "','" .
            $data['GSTAmount'] . "','" .
            $data['CustomerFirstName'] . "','" .
            $data['CustomerLastName'] . "','" .
            $data['CustomerAddress'] . "','" .
            $data['CustomerEmailID'] . "','" .
            $data['CustomerPanNo'] . "','" .
            $data['CustomerAdhaarNo'] . "','" .
            $data['CustomerMobileNo'] . "','" .
            $data['CustomerMobileNo1'] . "','" .
            $data['CustomerSFirstName'] . "','" .
            $data['CustomerSLastName'] . "','" .
            $data['CustomerSAddress'] . "','" .
            $data['CustomerSEmailID'] . "','" .
            $data['CustomerSPanNo'] . "','" .
            $data['CustomerSAdhaarNo'] . "','" .
            $data['CustomerSMobileNo'] . "','" .
            $data['CustomerSMobileNo1'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] . "','".
            $data['ChanelPartnerID'] . "','".
            $data['IsHold'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetCustomerPropertyByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    function AddMileStone($PropertyID){        
        $query = $this->db->query("call usp_A_GetMileStone('" . $PropertyID. "')");
        $query->next_result();
        $data =  $query->result();
        foreach ($data as $value) {
            $sql = "call usp_A_AddCustomerMileStone('" .
             $value->ProjectMileStoneID. "','".
             $PropertyID. "','".
             $this->session->userdata['UserID']. 
              "')";
            $query = $this->db->query($sql);
            $query->next_result();
        }
    }
    
    function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_customerproperty";
        $data['field_name']  = "CustomerPropertyID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
    function CancelProperty(){
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $IsCancelFee = $this->input->post('IsCancelFee');
        $Reason = $this->input->post('Reason');
        $CancelFeeAmount = ($this->input->post('CancelFeeAmount')!="")?$this->input->post('CancelFeeAmount'):0;
        $RefundAmount = ($this->input->post('RefundAmount')!="")?$this->input->post('RefundAmount'):0;
        $RefundGSTAmount = ($this->input->post('RefundGSTAmount')!="")?$this->input->post('RefundGSTAmount'):0;
        $UserID = $this->session->userdata['UserID'];
        if($this->session->userdata['IsAdmin'] = 1)
            $UserType = 'Admin Web';
        else
            $UserType = 'Employee Web';
        $IPAddress = GetIP();
        $sql = "call usp_A_CancelledProperty('" . 
                $CustomerPropertyID ."','".
                $UserID ."','". 
                $IsCancelFee ."','". 
                $Reason ."','". 
                $CancelFeeAmount ."','". 
                $RefundAmount ."','". 
                $RefundGSTAmount ."','". 
                $UserType ."','".
                $IPAddress. "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    function CheckMultipleProperty(){
        $CustomerID = $this->input->post('CustomerID');
        $PropertyID = $this->input->post('PropertyID');
        $query = $this->db->query("call usp_A_CheckMultipleProperty('" . $CustomerID . "','". $PropertyID . "')");
        $query->next_result();
        return $query->row();
    }
    function GetMileStone($ProjectID){
        $sql = "CALL usp_A_GetMileStoneByProperty('$ProjectID');";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
     function ChangeVST(){
        $Type = $this->input->post('Type');
        $ID = $this->input->post('ID');
        $uid = $this->session->userdata['UserID'];
        // $PassCode = $this->input->post('PassCode');
        $query = $this->db->query("call usp_M_ChangePropertyStatus('$Type','$ID','$uid')");
        $query->next_result();
        return $query->row();
    }
    public function converttocustomer($VisitorID){
        $UserID = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . ' Web';
        $IPAddress = GetIP();
        $query = $this->db->query("call usp_M_ConvertVisitorToCustomer('$VisitorID','$UserID','$UserType','$IPAddress')");
        $query->next_result();
        return $query->row();
    }

    public function availableProperty($id)
    {
        $query = $this->db->query("call usp_A_AvailableProperty('".$id."')");
        $query->next_result();
        return $query->row();
    }

    public function deleteProperty($id)
    {
        $query = $this->db->query("call usp_A_DeleteProperty('".$id."')");
        $query->next_result();
        return $query->row();
    }   

}