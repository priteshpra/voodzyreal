<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anniversary extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/report_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",59,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }
    }

    public function index() {
        $data = $res = array();
        $this->load->view('admin/includes/header');
        $data['AnniversaryMonth'] = getMonth('AnniversaryMonth',date("m"));
        $this->load->view('admin/report/anniversary/list', $data);
        $data['page_level_js'] = $this->load->view('admin/report/anniversary/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $result = array();
        $result['per_page_record'] = $PageSize;
        $result['page_number'] = $CurrentPage;
        $result['data_array'] = $this->report_model->GettAnniversaryReport($PageSize, $CurrentPage);
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/anniversary/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }
    

}
