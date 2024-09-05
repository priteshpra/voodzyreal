<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reminder extends Admin_Controller {

  public function __construct(){
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",22," . $this->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        // if(empty($this->cur_module) && $this->ProjectID != -1){
        //     show_404();
        // }
        $this->load->model('admin/reminder_model');
        $this->load->model('admin/customerproperty_model','property_model');
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['CustomerPropertyID'] = $this->input->post('CustomerPropertyID');
        $tmp = $this->property_model->getByID($result['CustomerPropertyID']);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $tmp->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        $result['IsCancelled'] = $this->input->post('IsCancelled');
        $result['data_array'] = $this->reminder_model->listData($per_page_record  , $page_number);
        if(isset($result['data_array'][0]->CustomerReminderID)){
            $result['total_records'] = $result['data_array'][0]->rowcount;
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
            $ajax_listing = $this->load->view('admin/user/reminder/ajax_listing', $result,TRUE);
        }else{
            $result['total_records'] = 0;
        }
        
        
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
   
    function changeStatus(){
        try{
            if ($this->input->post()){
                    $res = $this->reminder_model->changeStatus($this->input->post());
                    if($res){
                        $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                        echo json_encode(array('result' => 'success','message'=>$message));
                    }else{
                        echo json_encode(array('result' => 'error',label('please_try_again')));
                    }
                }
        }catch (Exception $e){
            echo json_encode(array('result' => 'error','message'=>$e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function add($CustomerPropertyID = 0) {
        if($CustomerPropertyID == 0){
            show_404();
        }
        try {
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Amount', 'Amount', 'trim|required');
                $this->form_validation->set_rules('Message', 'Message', 'trim|required');
                $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
                $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['CustomerPropertyID'] = $CustomerPropertyID;
                    $res = $this->reminder_model->insert($data);

                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID.'#reminder');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                       
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/reminder/add/'.$CustomerPropertyID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/reminder/add/'.$CustomerPropertyID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['Page'] = 'add/'.$CustomerPropertyID;
            $data['CustomerPropertyID'] = $CustomerPropertyID;
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/user/reminder/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/user/reminder/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent()
                );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public  function edit($CustomerPropertyID = 0,$ID = 0){
        if($CustomerPropertyID == 0 || $ID == 0){
            show_404();
            die;
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
                $this->form_validation->set_rules('Amount', 'Amount', 'trim|required');
                $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
                $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['CustomerReminderID'] = $ID;
                $data['CustomerPropertyID'] = $CustomerPropertyID;
                $res = $this->reminder_model->update($data);
                if(@$res->ID){
                    redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID.'#reminder');
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/reminder/edit/'.$CustomerPropertyID."/".$ID);
                }
            }else{
                echo validation_errors();exit;
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/reminder/edit/'.$CustomerPropertyID."/".$ID);
            }
        }else{
            $result = array();
            $result['CustomerPropertyID'] = $CustomerPropertyID;
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/'.$CustomerPropertyID ."/" . $ID;
            $result['data'] = $this->reminder_model->getByID($ID);
            if(!isset($result['data']->CustomerReminderID)){
                show_404();
                die;
            }
            $this->load->view('admin/includes/header');     
            $this->load->view('admin/user/reminder/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/reminder/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }
    public function addresponse(){
        if($this->input->post()){
            $data = $this->reminder_model->addResponse();
            if(@$data->ID){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

}
