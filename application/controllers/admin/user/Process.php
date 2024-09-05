<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Process extends Admin_Controller {

  public function __construct(){
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",19," . $this->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        // if(empty($this->cur_module) && $this->ProjectID != -1){
        //     show_404();
        // }
        $this->load->model('admin/process_model');
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['CustomerPropertyID'] = $this->input->post('CustomerPropertyID');
        $result['data_array'] = $this->process_model->listData($per_page_record  , $page_number);
        if(isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        if($result['total_records'] != 0){
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
            $ajax_listing = $this->load->view('admin/user/process/ajax_listing', $result,TRUE);
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        }else{
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
        }
    }
}
