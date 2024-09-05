<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employeedetails extends Admin_Controller {

  public function __construct() 
    {
        parent::__construct();       
        // $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",17," . $this->ProjectID .")");
        // $tmp->next_result();
        // $this->cur_module = $tmp->row();
        // if(@$this->cur_module->is_view != 1){
        //     show_404();
        // }
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            
        }else{
            show_404();
        }
        $this->load->model('admin/employeedetails_model');
    }
    public  function index($per_page_record = 10  , $page_number = 1){
        $this->load->view('admin/includes/header');
        $employee_result = $data = array();
        $employee_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/user/employeedetails/list',$employee_result);
        $data['page_level_js'] = $this->load->view('admin/user/employeedetails/list_js', NULL, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($employee_result,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employee'] = $this->employeedetails_model->listData($per_page_record  , $page_number);

        if(empty($result['employee']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['employee'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/user/employeedetails/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function details($ID = 0){
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            
        }else{
            show_404();
        }
        $this->UserID = $ID;
        $data = array();
        $_POST['UserID'] = $data['ID'] = $ID;
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $data['details'] = $this->employeedetails_model->getEmployeeByID($ID);
        $c = 1;
        if($c == 0){
            show_404();
        }
        $data['data'] = $this->employeedetails_model->GetNotification($ID);
        $data['page_level_js'] = $this->load->view('admin/user/employeedetails/details_js', $data, TRUE);

        $data['loading_button'] = getLoadingButton(); 
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/employeedetails/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function SetNotification($ID){
        if($this->input->post()){
            $res = $this->employeedetails_model->SetNotification();
            if(@$res->ID){
                echo json_encode(array('result'=>'Success', 'Message'=>label('api_msg_update_notification_setting_successfully')));
            }else{
                echo json_encode(array('result'=>'Success', 'Message'=>label('please_try_again')));
            }
        }
    }

    public function ajax_deviceinfo($per_page_record=10,$page_number = 1,$ID = -1){
        
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['deviceinfo'] = $this->employeedetails_model->listDeviceInfo($per_page_record,$page_number,$ID);
        if(isset($result['deviceinfo'][0]->Message))
            $result['total_records'] = 0;
        else{
           $result['total_records'] = $result['deviceinfo'][0]->rowcount;
        }
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/user/employeedetails/ajax_listing_deviceinfo', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">No Device Info Found.</td></tr>', 'b'=>''));
    }

    public function editBasicDetails(){
        $data = $this->input->post();
        $res = $this->employeedetails_model->editBasicDetails($data);
    }

    public function changepassword(){
        if($this->input->post() && $this->input->is_ajax_request()){
            $password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
           // print_r($confirm_password);die();
            if($password == $confirm_password){
                $res = $this->employeedetails_model->changePassword();
                if($res){
                    echo json_encode(array('Status'=>'Success', 'Message'=>label('msg_lbl_change_password')));
                }else{
                    echo json_encode(array('Status'=>'Error', 'Message'=>label('please_try_again')));
                }
            }else{
                echo json_encode(array('Status'=>'Error', 'Message'=>label('password_not_updated')));
            }
        }else{
            show_404();
        }
    }

    public function changepasscode(){
        if($this->input->post() && $this->input->is_ajax_request()){
            $passcode = $this->input->post('new_passcode');
            $confirm_passcode = $this->input->post('confirm_passcode');
           // print_r($confirm_password);die();
            if($passcode == $confirm_passcode){
                $res = $this->employeedetails_model->changePasscode();
                if($res){
                    echo json_encode(array('Status'=>'Success', 'Message'=>label('msg_lbl_change_passcode')));
                }else{
                    echo json_encode(array('Status'=>'Error', 'Message'=>label('please_try_again')));
                }
            }else{
                echo json_encode(array('Status'=>'Error', 'Message'=>label('passcode_not_updated')));
            }
        }else{
            show_404();
        }
    }
   
    public function add() {
        try {
        // if($this->cur_module->is_insert == 0)
                        // show_404();
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            
        }else{
            show_404();
        }
            $data = $res = array();
        if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('Address', 'Address', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                $this->form_validation->set_rules('PassCode', 'PassCode', 'trim|required');
                
                if($this->form_validation->run() == TRUE){
                    $data = $this->input->post();
                    $res = $this->employeedetails_model->insert($data);
                    //pr($res);exit;
                    if(@$res[0]->ID){
                        redirect($this->config->item('base_url') . 'admin/user/employeedetails');
                        
                    }else{
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent(),
                            "CreatedBy" => $this->session->user_data['UserID']
                        );
                        $this->common_model->insertAdminError($error_array);

                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/employeedetails/add');
                    }
                }else{
                    
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/employeedetails/add');
                }
            } 
            $result = array();
            $result['loading_button'] = getLoadingButton(); 
            $result['page_name'] = 'add';
            $result['PassCode'] = generateOTP(5);
            $result['roles'] = getAllRolesForCombobox();
            $this->load->view('admin/includes/header');
            $this->load->view('admin/user/employeedetails/add_edit', $result);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/user/employeedetails/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
        }
        catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent(),
                "CreatedBy" => $this->session->user_data['UserID']
                );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public  function edit($ID = null){
        try {
        // if($this->cur_module->is_edit == 0)
        //                 show_404(); 
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            
        }else{
            show_404();
        }
            
            $data = $res = array();       
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required');
            $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('Address', 'Address', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['ID'] = $ID;
                
                $res = $this->employeedetails_model->update($data);
                if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/user/employeedetails');
                    } else {
                        //echo form_validations();exit;
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/employeedetails/edit/' . $ID);
                    }

                redirect($this->config->item('base_url') . 'admin/user/employeedetail');
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/employeedetails/edit/'.$employee_id);
            }
        }else{
            $this->load->view('admin/includes/header');     
            $result = array();
            $result['loading_button'] = getLoadingButton();
            $result['page_name'] = 'edit/'.$ID;
     
            $result['employee'] = $this->employeedetails_model->getEmployeeByID($ID); // Get edit record information
            // pr($result['employee']);exit();
            $result['roles'] = getAllRolesForCombobox($result['employee']->RoleID);
            
            $this->load->view('admin/user/employeedetails/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/employeedetails/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
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

    public function email_exists(){
        $email_id = $this->input->post('email');
        $contact_no = $this->input->post('contact_no');
        $id = $this->input->post('id');
        $data = $this->employeedetails_model->email_exists($email_id,$contact_no,$id); 
        if(@$data->ID){
            echo 1;
        }else{
            $msg = explode('~',$data->Message);
            echo @$msg[1];
        }
    }

    public function changeStatus(){
        /*if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            show_404();
        }*/
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            
        }else{
            show_404();
        }
        // if($this->cur_module->is_status == 0){
        //         echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
        //         die;
        // }
        try{
            if ($this->input->post()){
                    $res = $this->employeedetails_model->changeStatus($this->input->post());
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

    public function changeDeviceInfoStatus(){
        if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
        }
        try{
            if ($this->input->post()){
                    $res = $this->employeedetails_model->changeDeviceInfoStatus($this->input->post());
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
    
    public function export_to_excel() {
        $this->load->library('excel');
        $data['data'] = $this->employeedetails_model->listData(-1, 1);
        $dataResult['result'] = array();
        if (!empty($data['data'])) {
            $dataResult['result'] = $data['data'];
        }
        $fields = array("SrNo", "FirstName", "EmailID","MobileNo","Address"); //Header Define
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }

        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($data['data'])) {
            foreach ($dataResult['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Employeedetails.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }



}
