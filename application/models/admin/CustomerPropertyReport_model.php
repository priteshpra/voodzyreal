<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomerPropertyReport_model extends CI_Model {
    public function ReportRole(){
        $array = $this->input->post();
        $FilterType = (!isset($array['FilterType']) || @$array['FilterType'] == "")?"Daily":@$array['FilterType'];
        $sql = "call usp_A_ReportRole('".
                    $this->UserRoleID. "','".
                    $this->ProjectID. "','".
                    'Web'. "','".
                    $FilterType. "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function listData($PageSize = 10, $CurrentPage = 1){
        $array = $this->input->post();
        $array['FilterType'] = (!isset($array['FilterType']) || @$array['FilterType'] == "")?"Daily":@$array['FilterType'];
        $array['CustomStartDate'] = getStringClean(($this->input->post('CustomStartDate') != '')?GetDateInFormat($this->input->post('CustomStartDate'),DATE_FORMAT,DATABASE_DATE_FORMAT):'');
        $array['CustomEndDate'] = getStringClean(($this->input->post('CustomEndDate') != '')?GetDateInFormat($this->input->post('CustomEndDate'),DATE_FORMAT,DATABASE_DATE_FORMAT):'');
        $ProjectID = ($this->ProjectID != "") ?$this->ProjectID: -1;
        $sql = "call usp_A_CustomerPropertyReport('".
                    $PageSize . "','".
                    $CurrentPage . "','".
                    $this->UserRoleID. "','".
                    $ProjectID . "','".
                    'Web'. "','".
                    $array['ReportType']. "','".
                    $array['FilterType']. "','".
                    $array['CustomStartDate']. "','".
                    $array['CustomEndDate']. "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }
}