<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/report_model');
    }

    public function index() {
        $data = $res = array();
        
        if($this->ProjectID == -1)
        {
            $data['Project'] = getProject(0,-1,$this->UserRoleID);
        }
        else
        {
            $data['Project'] = getProject($this->ProjectID,-1,$this->UserRoleID,0,1);
        }
        
        //$data['Project'] = getProject(0,-1,$this->UserRoleID);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/document/list', $data);
        $data['page_level_js'] = $this->load->view('admin/report/document/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $result = array();
        $result['per_page_record'] = $PageSize;
        $result['page_number'] = $CurrentPage;
        $result['data_array'] = $this->report_model->GetDocument($PageSize, $CurrentPage);
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/document/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }
    
}
