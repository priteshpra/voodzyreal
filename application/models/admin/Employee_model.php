<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listemployee($per_page_record = Null, $page_number = Null) {
        if ($per_page_record == Null) {
            $per_page_record = 10;
        }
        if ($page_number == Null) {
            $page_number = 1;
        }

        $VendorName_search = ($this->input->post('UsersettingName') != '') ? $this->input->post('UsersettingName') : '';
        // print_r($VendorName_search);die();
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        // echo " call usp_A_GetVendorDetail('$per_page_record' , '$page_number', '$VendorName_search', '$status_search_value')";//die();
        $sql = "call    usp_A_GetEmployee('$per_page_record' , '$page_number', '$VendorName_search', '$status_search_value')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function getPackageDetailByID($package_id = null) {
        $query = $this->db->query("call usp_A_GetPackageByID ('" . $package_id . "')");
        $query->next_result();
        return $query->result();
    }

    public function insertemployee($employee_array = null) {
        $employee_array['FirstName'] = getStringClean((isset($employee_array['FirstName'])) ? $employee_array['FirstName'] : NULL);
        $employee_array['DepartmentID'] = getStringClean((isset($employee_array['DepartmentID'])) ? $employee_array['DepartmentID'] : NULL);
        $employee_array['LastName'] = getStringClean((isset($employee_array['LastName'])) ? $employee_array['LastName'] : NULL);
        $employee_array['password'] = fnEncrypt($employee_array['password'], $this->config->item('sSecretKey'));
        $employee_array['Email'] = getStringClean((isset($employee_array['Email'])) ? $employee_array['Email'] : NULL);
        $employee_array['DOB'] = getStringClean((isset($employee_array['DOB'])) ? date('Y-m-d', strtotime($employee_array['DOB'])) : NULL);
        $employee_array['MobileNo'] = getStringClean((isset($employee_array['MobileNo'])) ? $employee_array['MobileNo'] : NULL);
        $employee_array['Address'] = getStringClean((isset($employee_array['Address'])) ? $employee_array['Address'] : NULL);
        $employee_array['ImageURL'] = getStringClean((isset($employee_array['ImageURL'])) ? $employee_array['ImageURL'] : NULL);
        $employee_array['Status'] = getStringClean((isset($employee_array['Status']) && $employee_array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $employee_array['created_by'] = $this->session->userdata['UserID'];
        $query = $this->db->query("call usp_A_AddEmployee('" .
                $employee_array['DepartmentID'] . "','" .
                $employee_array['FirstName'] . "','" .
                $employee_array['LastName'] . "','" .
                $employee_array['ImageURL'] . "','" .
                $employee_array['DOB'] . "','" .
                $employee_array['Email'] . "','" .
                $employee_array['password'] . "','" .
                $employee_array['Address'] . "','" .
                $employee_array['MobileNo'] . "','" .
                $employee_array['created_by'] . "','" .
                $employee_array['Status'] . "')");
        $query->next_result();
        return $query->row();
    }

    public function changeStatus($vendor_array) {
        $vendor_array['id'] = (isset($vendor_array['id'])) ? $vendor_array['id'] : NULL;
        $vendor_array['modified_by'] = (isset($vendor_array['modified_by'])) ? $vendor_array['modified_by'] : NULL;
        $vendor_array['status'] = (isset($vendor_array['status'])) ? $vendor_array['status'] : NULL;
        $vendor_array['table_name'] = "sssf_admindetails";
        $vendor_array['field_name'] = "UserID";
        $vendor_array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $vendor_array['table_name'] . "','" . $vendor_array['field_name'] . "','" . $vendor_array['id'] . "','" . $vendor_array['status'] . "','" . $vendor_array['modified_by'] . "');");
    }

    public function getemployeeBYID($employee_id = NULL) {
        $query = $this->db->query("call usp_A_GetEmployeeByID('$employee_id')");
        $query->next_result();
        return $query->row();
    }

    public function getemployeeBYIDList($employee_id = NULL) {
        $query = $this->db->query("call usp_A_GetEmployeeByID('$employee_id')");
        $query->next_result();
        return $query->result();
    }

    public function updateemployee($employee_array) {

        $employee_array['FirstName'] = getStringClean((isset($employee_array['FirstName'])) ? $employee_array['FirstName'] : NULL);
        $employee_array['DepartmentID'] = getStringClean((isset($employee_array['DepartmentID'])) ? $employee_array['DepartmentID'] : NULL);
        $employee_array['LastName'] = getStringClean((isset($employee_array['LastName'])) ? $employee_array['LastName'] : NULL);
        $employee_array['password'] = fnEncrypt($employee_array['password'], $this->config->item('sSecretKey'));
        $employee_array['Email'] = getStringClean((isset($employee_array['Email'])) ? $employee_array['Email'] : NULL);
        $employee_array['DOB'] = getStringClean((isset($employee_array['DOB'])) ? date('Y-m-d', strtotime($employee_array['DOB'])) : NULL);
        $employee_array['MobileNo'] = getStringClean((isset($employee_array['MobileNo'])) ? $employee_array['MobileNo'] : NULL);
        $employee_array['Address'] = getStringClean((isset($employee_array['Address'])) ? $employee_array['Address'] : NULL);
        $employee_array['ImageURL'] = getStringClean((isset($employee_array['ImageURL'])) ? $employee_array['ImageURL'] : NULL);
        $employee_array['Status'] = getStringClean((isset($employee_array['Status']) && $employee_array['Status'] == 'on') ? ACTIVE : INACTIVE);
        $employee_array['modified_by'] = $this->session->userdata['UserID'];
        $employee_array['ID'] = getStringClean((isset($employee_array['ID'])) ? $employee_array['ID'] : NULL);

        $sql = "call usp_A_EditEmployee('" .
                $employee_array['DepartmentID'] . "','" .
                $employee_array['FirstName'] . "','" .
                $employee_array['LastName'] . "','" .
                $employee_array['ImageURL'] . "','" .
                $employee_array['DOB'] . "','" .
                $employee_array['Email'] . "','" .
                $employee_array['password'] . "','" .
                $employee_array['Address'] . "','" .
                $employee_array['MobileNo'] . "','" .
                $employee_array['modified_by'] . "','" .
                $employee_array['Status'] . "','" .
                $employee_array['ID'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function getVendor() {
        $query = $this->db->query("call usp_A_GetVendor_ComboBox()");
        $query->next_result();
        return $query->result();
    }

}
