<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Propertys_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function listProject($per_page_record = 10, $page_number = 1)
    {
        $DisplayName = getStringClean(($this->input->post('DisplayName') != '') ? $this->input->post('DisplayName') : '');
        $status_search_value           = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $GroupID  = -1;
        $sql = "call usp_A_GetPropertys('" . $per_page_record . "' , '" . $page_number . "','" . $DisplayName . "' ,'" . $status_search_value . "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        //pr($query->result());exit;
        return $query->result();
    }
    function insert($array)
    {
        $array['Type']     = getStringClean((isset($array['Type']))    ? $array['Type']  : 'New');
        $array['ProjectType']     = getStringClean((isset($array['ProjectType']))    ? $array['ProjectType']  : NULL);
        $array['DisplayName']     = getStringClean((isset($array['DisplayName']))    ? $array['DisplayName']  : NULL);
        $array['UserID']     = getStringClean((isset($array['UserID']))    ? $array['UserID']  : $this->session->userdata['UserID']);
        $array['ProjectDetailsID']         = getStringClean((isset($array['ProjectDetailsID']))        ? $array['ProjectDetailsID']      : NULL);
        $array['PropertyConfigurationID']      = (isset($array['PropertyConfigurationID']))       ? $array['PropertyConfigurationID']   : $this->configdata->ConfigID;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        if ($this->session->userdata['IsAdmin'] = 1) {
            $array['UserType'] = 'Admin Web';
        } else {
            $array['UserType'] = 'Employee Web';
        }
        $array['CreatedBy'] = $this->session->userdata['UserID'];

        $array['IPAddress'] = GetIP();

        $sql = "call usp_A_AddPropertys('" .
            $array['DisplayName'] . "','" .
            $array['UserID'] . "','" .
            $array['ProjectDetailsID'] . "','" .
            $array['PropertyConfigurationID']  . "','" .
            $array['PropertyPurpose'] . "','" .
            $array['Amount'] . "','" .
            $array['SuperBuiltupArea'] . "','" .
            $array['CarpetArea'] . "','" .
            $array['AmountType'] . "','" .
            $array['PropertyType'] . "','" .
            $array['Specification'] . "','" .
            $array['OwenerFirstName'] . "','" .
            $array['OwenerLastName'] . "','" .
            $array['AboutProperty'] . "','" .
            $array['CompanyName'] . "','" .
            $array['PhoneNumber'] . "','" .
            $array['Apartment'] . "','" .
            $array['StreetAddress'] . "','" .
            $array['Landmark'] . "','" .
            $array['CityName'] . "','" .
            $array['Pincode'] . "','" .
            $array['PropertyPDFURL'] . "','" .
            $array['AvailableDate'] . "','" .
            $array['PostedDate'] . "','" .
            $array['CreatedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "'
            )";

        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('sssm_project','ProjectID')");
        $query->next_result();
        return $query->result();
    }

    function update($array)
    {
        $array['Type']     = getStringClean((isset($array['Type']))    ? $array['Type']  : 'New');
        $array['ProjectType']     = getStringClean((isset($array['ProjectType']))    ? $array['ProjectType']  : NULL);
        $array['DisplayName']     = getStringClean((isset($array['DisplayName']))    ? $array['DisplayName']  : NULL);
        $array['UserID']     = getStringClean((isset($array['UserID']))    ? $array['UserID']  : $this->session->userdata['UserID']);
        $array['ProjectDetailsID']         = getStringClean((isset($array['ProjectDetailsID']))        ? $array['ProjectDetailsID']      : NULL);
        $array['PropertyConfigurationID']      = (isset($array['PropertyConfigurationID']))       ? $array['PropertyConfigurationID']   : $this->configdata->ConfigID;
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        if ($this->session->userdata['IsAdmin'] = 1) {
            $array['UserType'] = 'Admin Web';
        } else {
            $array['UserType'] = 'Employee Web';
        }
        $array['ModifiedBy'] = $this->session->userdata['UserID'];

        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditPropertys('" .
            $array['SaleInventoryID'] . "','" .
            $array['DisplayName'] . "','" .
            $array['UserID'] . "','" .
            $array['ProjectDetailsID'] . "','" .
            $array['PropertyConfigurationID']  . "','" .
            $array['PropertyPurpose'] . "','" .
            $array['Amount'] . "','" .
            $array['SuperBuiltupArea'] . "','" .
            $array['CarpetArea'] . "','" .
            $array['AmountType'] . "','" .
            $array['PropertyType'] . "','" .
            $array['Specification'] . "','" .
            $array['OwenerFirstName'] . "','" .
            $array['OwenerLastName'] . "','" .
            $array['AboutProperty'] . "','" .
            $array['CompanyName'] . "','" .
            $array['PhoneNumber'] . "','" .
            $array['Apartment'] . "','" .
            $array['StreetAddress'] . "','" .
            $array['Landmark'] . "','" .
            $array['CityName'] . "','" .
            $array['Pincode'] . "','" .
            $array['PropertyPDFURL'] . "','" .
            $array['AvailableDate'] . "','" .
            $array['PostedDate'] . "','" .
            $array['ModifiedBy'] . "','" .
            $array['Status'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] . "'
            ')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getByID($project_id = NULL)
    {
        $query = $this->db->query("call usp_A_GetPropertysByID ('" . $project_id . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($data)
    {
        $data['id']          = (isset($data['id']))           ? $data['id']            : NULL;
        $data['status']      = (isset($data['status']))       ? $data['status']        : NULL;
        $data['table_name']  = (isset($data['table_name'])) ? $data['table_name'] : "ss_saleinventory";
        $data['field_name']  = (isset($data['field_name'])) ? $data['field_name'] : "SaleInventoryID";
        $data['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $data['table_name'] . "','" . $data['field_name'] . "','" . $data['id'] . "','" . $data['status'] . "','" . $data['modified_by'] . "');");
    }

    function getGroupComboBox()
    {
        $query = $this->db->query("call usp_A_GetGroup_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    public function GetProjectRule($ProjectID)
    {
        $sql = "call usp_A_GetProjectRule('" .
            $ProjectID .
            "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function AddEditProjectRule($array)
    {
        if ($this->session->userdata['IsAdmin'] = 1) {
            $array['UserType'] = 'Admin Web';
        } else {
            $array['UserType'] = 'Employee Web';
        }
        $array['CreatedBy'] = $this->session->userdata['UserID'];

        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_AddEditProjectWiseRule('" .
            $array['ProjectID'] . "','" .
            getStringClean($array['Rule']) . "','" .
            $array['CreatedBy'] . "','" .
            $array['UserType'] . "','" .
            $array['IPAddress'] .
            "')";
        $query =  $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
}
