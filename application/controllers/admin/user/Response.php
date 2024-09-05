<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Response extends Admin_Controller {

    public function __construct() {
        parent::__construct();       
        $this->load->model('admin/response_model');
    }

    public  function index($CID = 0,$ID = 0){
        if($CID == 0 && $ID == 0){
            show_404();
        }
        $this->load->view('admin/includes/header');
        $result = $data = array();
        $result['ReminderID'] = $ID;
        $result['ParentID'] = $CID;
        $result['Url'] = "admin/user/property/details/". $CID."#reminder";
        $result['Type'] = 'Customer';
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/user/response/list',$result);
        $data['page_level_js'] = $this->load->view('admin/user/response/list_js', $result, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($result,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1,$Type = "Customer"){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->response_model->listData($per_page_record  , $page_number,$Type);
        if(@$result['data_array'][0]->Message)
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/user/response/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
     public  function visitor($VID = 0,$ID = 0){
        if($VID == 0 && $ID == 0){
            show_404();
        }
        $this->load->view('admin/includes/header');
        $result = $data = array();
        $result['ReminderID'] = $ID;
        $result['ParentID'] = $VID;
        $result['Url'] = "admin/user/visitor/details/". $VID."#reminder";
        $result['Type'] = 'Visitor';
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/user/response/list',$result);
        $data['page_level_js'] = $this->load->view('admin/user/response/list_js', $result, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($result,$data);
    }

   
}
