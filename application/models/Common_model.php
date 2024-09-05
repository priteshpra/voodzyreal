<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertAdminError($error_array)
    {
        $error_array['error_message'] = getStringClean((isset($error_array['error_message'])) ? $error_array['error_message'] : NULL);
        $error_array['method_name'] = getStringClean((isset($error_array['method_name'])) ? $error_array['method_name'] : NULL);
        $error_array['Type'] = getStringClean((isset($error_array['Type'])) ? $error_array['Type'] : NULL);
        $error_array['User_Agent'] = getStringClean((isset($error_array['User_Agent'])) ? $error_array['User_Agent'] : NULL);
        $sql = "SELECT Fn_A_AddErrorlog('" .
            $error_array['method_name'] . "','" .
            $error_array['error_message'] . "','" .
            $error_array['Type'] . "','" .
            $error_array['User_Agent'] . "','" .
            $this->session->userdata['UserID'] . "','" .
            GetIP() . "','" .
            $this->session->userdata['UserID'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        $query->result();
    }
    function delete($TableName, $FieldName, $ID)
    {
        $query = $this->db->query("call usp_M_DeleteField('" . $TableName . "','" . $FieldName . "','" . $ID . "')");
        return $query->row();
    }
    function emailexists($email)
    {
        $query = $this->db->query("call usp_A_CheckEmailExist('" . $email . "')");
        return $query->row();
    }
    function getDeviceInfo($ID)
    {
        $query = $this->db->query("call usp_A_GetDeviceInfo('$ID')");
        $query->next_result();
        return $query->result();
    }
    function getCountryCombobox()
    {
        $query = $this->db->query("call usp_A_GetCountry_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getEmployeeCombobox()
    {
        $query = $this->db->query("call usp_A_GetEmployeeCombobox()");
        $query->next_result();
        return $query->result();
    }

    function getEmployee()
    {
        $query = $this->db->query("call usp_A_GetEmployee_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    function getVisitor()
    {
        $query = $this->db->query("call usp_A_GetVisitor_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getDesignation()
    {
        $query = $this->db->query("call usp_A_GetDesignation_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    function getLanguageCombobox()
    {
        $query = $this->db->query("call usp_A_Language_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getRolesCombobox()
    {
        $query = $this->db->query("call usp_A_Roles_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getUserCombobox($usertype = "")
    {
        $query = $this->db->query("call usp_A_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getStateCombobox($StateID = 0, $CountryID = 0)
    {
        $query = $this->db->query("call usp_A_GetStateOnly_ComboBox($CountryID)");
        $query->next_result();
        return $query->result();
    }
    function getPageCombobox($StateID = 0)
    {
        $query = $this->db->query("call usp_A_pagename_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyCity()
    {
        $query = $this->db->query("call usp_A_GetCity_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyGroup()
    {
        $query = $this->db->query("call usp_A_GetGroup_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyState()
    {
        $query = $this->db->query("call usp_A_GetStateOnly_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetPropertyCombobox($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetPropertyByProjectID($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function GetAllPropertyCombobox($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetAllPropertyByProjectID($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function GetPurchaseProperty($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetPurchaseProperty($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function getCustomerPropertyCombobox($CustomerID)
    {
        $query = $this->db->query("call usp_A_GetCustomerProperty_ComboBox($CustomerID)");
        $query->next_result();
        return $query->result();
    }
    function getProjectMileStoneCombobox($CustomerPropertyID)
    {
        $query = $this->db->query("call usp_A_GetProjectMileStone_Combobox($CustomerPropertyID)");
        $query->next_result();
        return $query->result();
    }
    function getProject($GroupID)
    {
        $query = $this->db->query("call usp_A_GetProject_ComboBox('" . $GroupID . "')");
        $query->next_result();
        return $query->result();
    }
    function CheckPassCode()
    {
        $ID = $this->session->userdata['UserID'];
        $PassCode = $this->input->post('PassCode');
        $query = $this->db->query("call usp_M_CheckPassCode('$ID','$PassCode')");
        $query->next_result();
        return $query->row();
    }


    function getProjectByRoleID($RoleID)
    {
        $query = $this->db->query("call usp_A_GetProjectByRole('" . $this->session->userdata['UserID'] . "','" .
            $this->UserRoleID . "','All')");
        $query->next_result();
        return $query->result();
    }
    function GetDashboard($array)
    {
        $array['FilterType'] = (!isset($array['FilterType']) || $array['FilterType'] == "") ? "Daily" : $array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_MA_Dashboard('" .
            $this->UserRoleID . "','" .
            $this->ProjectID . "','" .
            'Web' . "','" .
            $array['FilterType'] . "','" .
            $EmployeeID . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function GetDashboardOverDue($array)
    {
        $array['FilterType'] = (!isset($array['FilterType']) || $array['FilterType'] == "") ? "Daily" : $array['FilterType'];

        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        $sql = "call usp_A_GetDashboardOverDue('" .
            $this->UserRoleID . "','" .
            $this->ProjectID . "','" .
            $EmployeeID . "','" .
            $array['FilterType'] . "')";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }

    public function CheckDuplicate($data)
    {
        $data['data_value'] = getStringClean($data['data_value']);
        $sql = "call usp_A_CheckDuplicate ('" .
            $data['table_name'] . "','" .
            $data['field_name'] . "','" .
            $data['data_value'] . "','" .
            $data['ufield'] . "','" .
            $data['ID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function CheckDuplicateDouble($data)
    {
        $sql = "call usp_A_CheckDuplicateDouble ('" .
            $data['table_name'] . "','" .
            $data['field_name'] . "','" .
            $data['data_value'] . "','" .
            $data['field_name1'] . "','" .
            $data['data_value1'] . "','" .
            $data['ufield'] . "','" .
            $data['ID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function changeStatus($data)
    {
        $array['ID'] = (isset($data['ID'])) ? $data['ID'] : NULL;
        $array['Status'] = (isset($data['Status'])) ? $data['Status'] : NULL;

        $array['table_name'] = $data['table_name'];
        $array['field_name'] = $data['field_name'];
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['ID'] . "','" . $array['Status'] . "','" . $array['modified_by'] . "');");
    }

    public function getDeviceByEmployee($UserID, $UserType, $ProjectID)
    {
        $query = $this->db->query("call usp_M_getDeviceByEmployee($UserID, '$UserType', $ProjectID)");
        $query->next_result();
        return $query->result();
    }

    // Start : Result as per Sp query 
    public function getInlineQuery($sql)
    {
        try {
            $query = $this->db->query($sql);
            return $query->result();
        } catch (Exection $e) {
            return '';
        }
    }

    function getChanelPartnersCombobox($ID)
    {
        $sql = "call usp_A_GetChanelPartnerList('-1','1','','1','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}
