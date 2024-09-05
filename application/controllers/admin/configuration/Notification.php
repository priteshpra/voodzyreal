<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/notification_model');
    }

    public function index($per_page_record = 10, $page_number = 1) {
        $result = $data = array();
		$this->load->view('admin/includes/header');
		$result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/configuration/notification/list', $result);
		$data['page_level_js'] = $this->load->view('admin/configuration/notification/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/configuration/notification/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($state_result, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data'] = $this->notification_model->listData($per_page_record, $page_number);

        if (empty($result['data']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/configuration/notification/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }
}
