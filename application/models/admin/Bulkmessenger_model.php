<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulkmessenger_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function list($per_page_record = 10, $page_number = 1) {
        $CustomerID = $this->input->post('CustomerID');
        $sql ="call usp_A_GetCustomerProperty('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $CustomerID.
                    "','-1','')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    function insert($data){
        $data['CustomerID']     = (isset($data['CustomerID']))    ? $data['CustomerID']  : 0;
        $data['PropertyID']     = (isset($data['PropertyID']))    ? $data['PropertyID']  : 0;
        $data['PurchaseDate']     = (isset($data['PurchaseDate']))    ? GetDateTimeInFormat($data['PurchaseDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['Amount']     = (isset($data['Amount']))    ? $data['Amount']  : 0;
        $data['CustomerFirstName']     = (isset($data['CustomerFirstName']))    ? $data['CustomerFirstName']  : '';
        $data['CustomerLastName']     = (isset($data['CustomerLastName']))    ? $data['CustomerLastName']  : '';
        $data['CustomerAddress']     = getStringClean((isset($data['CustomerAddress']))    ? $data['CustomerAddress']  : '');
        $data['CustomerEmailID']     = (isset($data['CustomerEmailID']))    ? $data['CustomerEmailID']  : '';
        $data['CustomerPanNo']     = (isset($data['CustomerPanNo']))    ? $data['CustomerPanNo']  : '';
        $data['CustomerAdhaarNo']     = (isset($data['CustomerAdhaarNo']))    ? $data['CustomerAdhaarNo']  : '';
        $data['CustomerMobileNo']     = (isset($data['CustomerMobileNo']))    ? $data['CustomerMobileNo']  : '';
        $data['CustomerMobileNo1']     = (isset($data['CustomerMobileNo1']))    ? $data['CustomerMobileNo1']  : '';
        $data['CustomerSFirstName']     = (isset($data['CustomerSFirstName']))    ? $data['CustomerSFirstName']  : '';
        $data['CustomerSLastName']     = (isset($data['CustomerSLastName']))    ? $data['CustomerSLastName']  : '';
        $data['CustomerSAddress']     = getStringClean((isset($data['CustomerSAddress']))    ? $data['CustomerSAddress']  : '');
        $data['CustomerSEmailID']     = (isset($data['CustomerSEmailID']))    ? $data['CustomerSEmailID']  : '';
        $data['CustomerSPanNo']     = (isset($data['CustomerSPanNo']))    ? $data['CustomerSPanNo']  : '';
        $data['CustomerSAdhaarNo']     = (isset($data['CustomerSAdhaarNo']))    ? $data['CustomerSAdhaarNo']  : '';
        $data['CustomerSMobileNo']     = (isset($data['CustomerSMobileNo']))    ? $data['CustomerSMobileNo']  : '';
        $data['CustomerSMobileNo1']     = (isset($data['CustomerSMobileNo1']))    ? $data['CustomerSMobileNo1']  : '';        
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomerProperty('" . 
            $data['CustomerID'] . "','" .
            $data['PropertyID'] . "','" .
            $data['PurchaseDate'] . "','" .
            $data['Amount'] . "','" .
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
            $data['IPAddress'] ."','');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function update($data){
        $data['CustomerID']     = (isset($data['CustomerID']))    ? $data['CustomerID']  : 0;
        $data['PurchaseDate']     = (isset($data['PurchaseDate']))    ? GetDateTimeInFormat($data['PurchaseDate'],DATE_FORMAT,DATABASE_DATE_FORMAT)  : DEFAULT_DATE;
        $data['Amount']     = (isset($data['Amount']))    ? $data['Amount']  : 0;
        $data['CustomerFirstName']     = (isset($data['CustomerFirstName']))    ? $data['CustomerFirstName']  : '';
        $data['CustomerLastName']     = (isset($data['CustomerLastName']))    ? $data['CustomerLastName']  : '';
        $data['CustomerAddress']     = getStringClean((isset($data['CustomerAddress']))    ? $data['CustomerAddress']  : '');
        $data['CustomerEmailID']     = (isset($data['CustomerEmailID']))    ? $data['CustomerEmailID']  : '';
        $data['CustomerPanNo']     = (isset($data['CustomerPanNo']))    ? $data['CustomerPanNo']  : '';
        $data['CustomerAdhaarNo']     = (isset($data['CustomerAdhaarNo']))    ? $data['CustomerAdhaarNo']  : '';
        $data['CustomerMobileNo']     = (isset($data['CustomerMobileNo']))    ? $data['CustomerMobileNo']  : '';
        $data['CustomerMobileNo1']     = (isset($data['CustomerMobileNo1']))    ? $data['CustomerMobileNo1']  : '';
        $data['CustomerSFirstName']     = (isset($data['CustomerSFirstName']))    ? $data['CustomerSFirstName']  : '';
        $data['CustomerSLastName']     = (isset($data['CustomerSLastName']))    ? $data['CustomerSLastName']  : '';
        $data['CustomerSAddress']     = getStringClean((isset($data['CustomerSAddress']))    ? $data['CustomerSAddress']  : '');
        $data['CustomerSEmailID']     = (isset($data['CustomerSEmailID']))    ? $data['CustomerSEmailID']  : '';
        $data['CustomerSPanNo']     = (isset($data['CustomerSPanNo']))    ? $data['CustomerSPanNo']  : '';
        $data['CustomerSAdhaarNo']     = (isset($data['CustomerSAdhaarNo']))    ? $data['CustomerSAdhaarNo']  : '';
        $data['CustomerSMobileNo']     = (isset($data['CustomerSMobileNo']))    ? $data['CustomerSMobileNo']  : '';
        $data['CustomerSMobileNo1']     = (isset($data['CustomerSMobileNo1']))    ? $data['CustomerSMobileNo1']  : '';
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
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
            $data['IPAddress'] ."');" ;
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
        $id = $this->input->post('CustomerPropertyID');
        $uid = $this->session->userdata['UserID'];
        if($this->session->userdata['IsAdmin'] = 1)
            $UserType = 'Admin Web';
        else
            $UserType = 'Employee Web';
        $IPAddress = GetIP();
         $query = $this->db->query("call usp_A_CancelledProperty('" . $id ."','".$uid. "','".$UserType . "','".$IPAddress. "')");
        $query->next_result();
        return $query->row();
    }
}