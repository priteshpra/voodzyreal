<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",1,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();

        if(@$this->cur_module->is_view != 1){
            show_404();
        }

        $this->load->library('session');
        $this->load->model('admin/feedback_model');
    }

    public function index() {

        // $pushNotificationArr = array(
        //     'device_id' => 'fj6KjlWoTsSptz8FeYvtFQ:APA91bFe9cS_oWeDE2pPIp7Xgl8Ge0iH-3Usy1lzyS_YA6UY6I7aBAwnx4rwNXc87rTEmZax7wps55168ARaVjqcP-T2niXuWzp-MbfA0r1jrEP4lSD4zTX7BpmNC0hfhMY910fgZRMd',
        //     'message' => "Test Notification",
        //     'title' => DEFAULT_WEBSITE_TITLE,
        //     'event' => 'Add Customer',
        //     'ActionType' => 'AddCustomer',
        //     'detail' => 'Test'
        // );
        // //pr($pushNotificationArr);
        // $res = sendPushNotification($pushNotificationArr);
        // pr($res);

        //pr(fnDecrypt('EG1O7CQ1MTHjsZjgNugy5g==')); 

        $data = array();
        $this->load->view('admin/includes/header');
        $data['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $data['reason_array'] = $this->feedback_model->ListData(-1, 1);
        $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
        $this->load->view('admin/admindasboard/index', $data);
        $data['page_level_js'] = $this->load->view('admin/admindasboard/index_js',$data, TRUE);
        $this->load->view('admin/includes/add_feedback_model', $data);
        $this->load->view('admin/includes/footer', $data);
    }
    
    public function ajax_dashboard(){
        if($this->input->post()){
            $data = array();
            $data['FilterType'] = $this->input->post('FilterType');
            $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
            $data['OverDue'] = $this->common_model->GetDashboardOverDue($this->input->post());
            $this->load->view('admin/admindasboard/ajax_listing',$data);
        }
    }

}
