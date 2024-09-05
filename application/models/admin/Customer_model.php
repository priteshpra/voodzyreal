<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listProcess($PageSize = 10, $CurrentPage = 1) 
    {        
		$CustomerID = getStringClean(($this->input->post('CustomerID')!='')?$this->input->post('CustomerID'):'');
        
        $sql = "call usp_A_GetCustomerProcess( '$PageSize' , '$CurrentPage','$CustomerID','CustomerProperty')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function listdata($per_page_record = 10, $page_number = 1) {
        $data = $this->input->post();
        $Name = getStringClean((isset($data['Name']))? $data['Name'] : '');
        $MobileNo = getStringClean(isset($data['MobileNo']) ?$data['MobileNo']: '');
        $Status=(isset($data['Status']) && $data['Status'] != '')?$data['Status']:-1;
        $EmailID = getStringClean(isset($data['EmailID']) ?$data['EmailID']: '');

        /*if($data['ProjectID'] == "-1") 
        {
            $ProjectID =$this->ProjectID;
        }
        else
        {
            $ProjectID=$data['ProjectID'];
        }*/

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $ProjectID = ($this->ProjectID != "") ?$this->ProjectID: -1;
        $PropertyID = (@$data['PropertyID'] != "") ?$data['PropertyID']: -1;
        $sql ="call usp_A_GetCustomer('".
                    $per_page_record."' , '".
                    $page_number."','".
                    $Name."','". 
                    $MobileNo."','". 
                    $Status."','". 
                    $EmailID."','". 
                    $this->UserRoleID."','". 
                    $ProjectID."','".
                    "Web" . "','".
                    $PropertyID . "','" .
                    $EmployeeID . "')";
                    
        //echo json_encode($sql);
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->result();  
    }
    
    public function insert($data){
        $data['FirstName']     = getStringClean((isset($data['FirstName']))    ? $data['FirstName']  : '');
        $data['LastName']     = getStringClean((isset($data['LastName']))    ? $data['LastName']  : '');
        $data['EmailID']     = getStringClean((isset($data['EmailID']))    ? $data['EmailID']  : '');
        $data['MobileNo']     = getStringClean((isset($data['MobileNo']))    ? $data['MobileNo']  : '');
        $data['MobileNo1']     = getStringClean((isset($data['MobileNo1']))    ? $data['MobileNo1']  : '');
        $data['Address']     = getStringClean((isset($data['Address']))    ? $data['Address']  : '');
        $data['CreatedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_AddCustomer('" . 
            $data['FirstName'] . "','" .
            $data['LastName'] . "','" .
            $data['EmailID'] . "','" .
            $data['MobileNo'] . "','" .
            $data['MobileNo1'] . "','" .
            $data['Address'] . "','" .
            $data['CreatedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function update($data){
        $data['FirstName']     = getStringClean((isset($data['FirstName']))    ? $data['FirstName']  : '');
        $data['LastName']     = getStringClean((isset($data['LastName']))    ? $data['LastName']  : '');
        $data['EmailID']     = getStringClean((isset($data['EmailID']))    ? $data['EmailID']  : '');
        // $data['MobileNo']     = (isset($data['MobileNo']))    ? $data['MobileNo']  : '';
        $data['MobileNo1']     = getStringClean((isset($data['MobileNo1']))    ? $data['MobileNo1']  : '');
        $data['Address']     = getStringClean((isset($data['Address']))    ? $data['Address']  : '');
        $data['ModifiedBy'] = $this->session->userdata['UserID'];
        $data['Status'] = (isset($data['Status']) && $data['Status'] == 'on') ? ACTIVE : INACTIVE;
        if($this->session->userdata['IsAdmin'] = 1)
            $data['UserType'] = 'Admin Web';
        else
            $data['UserType'] = 'Employee Web';
        $data['IPAddress'] = GetIP();
        $sql = "call usp_A_EditCustomer('" . 
            $data['CustomerID'] . "','" .
            $data['FirstName'] . "','" .
            $data['LastName'] . "','" .
            // $data['EmailID'] . "','" .
            // $data['MobileNo'] . "','" .
            $data['MobileNo1'] . "','" .
            $data['Address'] . "','" .
            $data['ModifiedBy'] . "','".
            $data['Status'] . "','".
            $data['UserType'] . "','".
            $data['IPAddress'] . "','" .
            $data['EmailID'] . "','" .
            $data['MobileNo'] ."');" ;
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($ID = NULL) {
        $query = $this->db->query("call usp_A_GetCustomerByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }
    
    public function changeStatus($data) {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['modified_by'] = (isset($data['modified_by']))  ? $data['modified_by']   : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = "sssm_customer";
        $data['field_name']  = "CustomerID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }
    
    public function EmailMobExist($EmailID,$MobileNo,$CustomerID){
        $query = $this->db->query("call usp_A_CheckCustomerEmailExist('".getStringClean($EmailID)."','".getStringClean($MobileNo). "','".$CustomerID."')");
        $query->next_result();
        return $query->row();
    }
}




