<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Admin_Controller {

  public function __construct(){
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $this->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        // if(empty($this->cur_module) && $this->ProjectID != -1){
        //     show_404();
        // }
        $this->load->model('admin/payment_model');
        $this->load->model('admin/customerproperty_model','property_model');

        // $payment_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $this->ProjectID .")");
        // $payment_tmp->next_result();
        // $this->payment_tmp = $payment_tmp->row();
        
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
    
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->payment_model->listData($per_page_record  , $page_number);
        $result['CustomerPropertyID'] = $this->input->post('CustomerPropertyID');
        $result['IsCancelled'] = $this->input->post('IsCancelled');
        $tmp = $this->property_model->getByID($result['CustomerPropertyID']);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $tmp->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        if($result['total_records'] != 0){
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
            $ajax_listing = $this->load->view('admin/user/payment/ajax_listing', $result,TRUE);
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        }else{
            echo json_encode(array('a'=>'<tr><td colspan="12" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
        }
    }
   
    function changeStatus(){
        try{
            if ($this->input->post()){
                    $res = $this->payment_model->changeStatus($this->input->post());
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
                $this->form_validation->set_rules('MileStone', 'MileStone', 'trim|required');
                /*$this->form_validation->set_rules('PaymentDate', 'PaymentAmountDate', 'trim|required');
                $this->form_validation->set_rules('BankName', 'BankName', 'trim|required');
                $this->form_validation->set_rules('BranchName', 'BranchName', 'trim|required');*/
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['CustomerPropertyID'] = $CustomerPropertyID;
                    $res = $this->payment_model->insert($data);
                    if (@$res->ID) {

                        $user_ID = @$this->session->userdata['UserID'];

                        $_DeviceResult = $this->common_model->getDeviceByEmployee($user_ID,'Payment',@$res->ProjectID);
                            if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){  
                                $Message = $res->EmployeeFirstName.' '.$res->EmployeeLastName.' has added payment of '.$res->FirstName.' '.$res->LastName.'(customer).';
                                    $NoOfUser = array();
                                    foreach ($_DeviceResult as $key => $value) {
                                        $NoOfUser[$value->UserID] = $value;
                                    }

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','AddCustomerPayment') as IsNotificationAdded, 'Success' as Status");
                                    }
                                foreach ($_DeviceResult as $d_val) { 
                                    if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                        $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                    'message'=>$Message,
                                                    'title'=>DEFAULT_WEBSITE_TITLE,
                                                    'event'=>'Add Customer Payment',
                                                    'ActionType'=>'AddCustomerPayment',
                                                    'detail'=> (array) $res
                                                );
                                        
                                        $notification_res = sendPushNotification($pushNotificationArr);
                                    }
                                }
                            }

                            if($res->PaymentPush=='ATS'){

                                if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){   
                                    $Message = @$res->Title.'('. $res->PropertyNo .') has ready for ATS.';
                                    $NoOfUser = array();
                                    
                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','ATSPayment') as IsNotificationAdded, 'Success' as Status");
                                    }
                                    foreach ($_DeviceResult as $d_val) { 
                                        
                                        if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                            $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                        'message'=>$Message,
                                                        'title'=>DEFAULT_WEBSITE_TITLE,
                                                        'event'=>'ATS Payment Reminder',
                                                        'ActionType'=>'AddCustomer',
                                                        'detail'=> (array) $res
                                                    );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                }
                            }elseif($res->PaymentPush=='SD'){

                                if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){   
                                    $Message = @$res->Title.'('. $res->PropertyNo .') has ready for Sale Deed.';
                                    $NoOfUser = array();
                                    
                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','SDPayment') as IsNotificationAdded, 'Success' as Status");
                                    }
                                    foreach ($_DeviceResult as $d_val) { 
                                        if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                            $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                        'message'=>$Message,
                                                        'title'=>DEFAULT_WEBSITE_TITLE,
                                                        'event'=>'Sale Deed Payment Reminder',
                                                        'ActionType'=>'AddCustomer',
                                                        'detail'=> (array) $res
                                                    );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                }
                            }
                            
                        $CPDetails = $this->property_model->getByID($this->input->post('CustomerPropertyID'));
                        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",22," . $CPDetails->ProjectID .")");
                            $tmp->next_result();
                            $tmp_mod = $tmp->row();
                        if($data['reminderflag'] == 1 && $tmp_mod->is_insert == 1){
                            $this->session->set_flashdata('PropertyID',$data['PropertyID']);
                            redirect($this->config->item('base_url') . 'admin/user/reminder/add/'.$CustomerPropertyID);
                        }
                        if($data['reminderflag'] == 1 && $tmp_mod->is_insert == 0){
                            $this->session->set_flashdata('posterror',label('you_do_not_have_access_to_insert_reminder_for_this_project'));
                        }
                        redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID.'#payment');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                       
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/payment/add/'.$CustomerPropertyID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/payment/add/'.$CustomerPropertyID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['Page'] = 'add/'.$CustomerPropertyID;
            $data['CustomerPropertyID'] = $CustomerPropertyID;
            $data['CustomerProperty'] = $this->property_model->getByID($CustomerPropertyID);
            $data['Property'] = getCustomerPropertyCombobox(0,$CustomerPropertyID);

            if (isset($this->session->userdata['PropertyID'])) {
                $data['Property'] = getCustomerPropertyCombobox($this->session->userdata['PropertyID'],$CustomerPropertyID);
            }
                
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/user/payment/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/user/payment/add_js', NULL, TRUE);
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
            $this->form_validation->set_rules('MileStone', 'MileStone', 'trim|required');
            /*$this->form_validation->set_rules('PaymentDate', 'PaymentAmountDate', 'trim|required');
            $this->form_validation->set_rules('BankName', 'BankName', 'trim|required');
            $this->form_validation->set_rules('BranchName', 'BranchName', 'trim|required');*/
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['CustomerPaymentID'] = $ID;
                $data['CustomerPropertyID'] = $CustomerPropertyID;
                $res = $this->payment_model->update($data);
                if(@$res->ID){
                    $user_ID = @$this->session->userdata['UserID'];

                        $_DeviceResult = $this->common_model->getDeviceByEmployee($user_ID,'Payment',@$res->ProjectID);
                        if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){  
                            $Message = $res->EmployeeFirstName.' '.$res->EmployeeLastName.' has added payment of '.$res->FirstName.' '.$res->LastName.'(customer).';
                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','AddCustomerPayment') as IsNotificationAdded, 'Success' as Status");
                                }
                            foreach ($_DeviceResult as $d_val) { 
                                //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                                if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                    // $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','AddCustomerPayment') as IsNotificationAdded, 'Success' as Status");
                                    $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                'message'=>$Message,
                                                'title'=>DEFAULT_WEBSITE_TITLE,
                                                'event'=>'Add Customer Payment',
                                                'ActionType'=>'AddCustomerPayment',
                                                'detail'=> (array) $res
                                            );
                                    //pr($pushNotificationArr);
                                    $notification_res = sendPushNotification($pushNotificationArr);
                                    //pr($res);
                                }
                            }
                        }

                        if($res->PaymentPush=='ATS'){

                            if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){   
                                $Message = @$res->Title.'('. $res->PropertyNo .') has ready for ATS.';
                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','ATSPayment') as IsNotificationAdded, 'Success' as Status");
                                }
                                foreach ($_DeviceResult as $d_val) { 
                                    //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                                    if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                        // $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','ATSPayment') as IsNotificationAdded, 'Success' as Status");
                                        $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                    'message'=>$Message,
                                                    'title'=>DEFAULT_WEBSITE_TITLE,
                                                    'event'=>'ATS Payment Reminder',
                                                    'ActionType'=>'AddCustomer',
                                                    'detail'=> (array) $res
                                                );
                                        //pr($pushNotificationArr);
                                        $res = sendPushNotification($pushNotificationArr);
                                        //pr($res);
                                    }
                                }
                            }
                        }elseif($res->PaymentPush=='SD'){

                            if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){   
                                $Message = @$res->Title.'('. $res->PropertyNo .') has ready for Sale Deed.';
                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','SDPayment') as IsNotificationAdded, 'Success' as Status");
                                }
                                foreach ($_DeviceResult as $d_val) { 
                                    //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                                    if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                        // $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','SDPayment') as IsNotificationAdded, 'Success' as Status");
                                        $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                    'message'=>$Message,
                                                    'title'=>DEFAULT_WEBSITE_TITLE,
                                                    'event'=>'Sale Deed Payment Reminder',
                                                    'ActionType'=>'AddCustomer',
                                                    'detail'=> (array) $res
                                                );
                                        //pr($pushNotificationArr);
                                        $res = sendPushNotification($pushNotificationArr);
                                        //pr($res);
                                    }
                                }
                            }
                        }
                    $CPDetails = $this->property_model->getByID($this->input->post('CustomerPropertyID'));
                        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",22," . $CPDetails->ProjectID .")");
                    $tmp->next_result();
                    $tmp_mod = $tmp->row();
                    if($data['reminderflag'] == 1 && $tmp_mod->is_insert == 1){
                        $this->session->set_flashdata('PropertyReminderID',$data['PropertyReminderID']);
                        redirect($this->config->item('base_url') . 'admin/user/reminder/add/'.$CustomerPropertyID);
                    }
                    if($tmp_mod->is_insert == 0){
                        $this->session->set_flashdata('posterror',label('you_do_not_have_access_to_insert_reminder_for_this_project'));
                    }
                    redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID.'#payment');
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/payment/edit/'.$CustomerPropertyID."/".$ID);
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/payment/edit/'.$CustomerPropertyID."/".$ID);
            }
        }else{
            $result = array();
            $result['CustomerPropertyID'] = $CustomerPropertyID;
            $result['CustomerPaymentID'] = $ID;
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/'.$CustomerPropertyID ."/" . $ID;
            $result['data'] = $this->payment_model->getByID($ID);
            if(@$result['data']->Message){
                show_404();
                die;
            }
            $result['CustomerProperty'] = $this->property_model->getByID($CustomerPropertyID);
            $this->load->view('admin/includes/header');     
            $this->load->view('admin/user/payment/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/payment/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }
    public function getReamainingPayment($ID = 0,$CPID = 0){
        $res = $this->payment_model->getRemainingAmount($ID,$CPID);
        $res1 = $this->payment_model->getGSTRemainingAmount($ID,$CPID);
        $data = $this->property_model->getByID($ID);
        echo json_encode(array('RemainingAmount'=>@$res->TotalRemainingAmount, 'RemainingGSTAmount'=>@$res1->TotalGSTRemainingAmount,'data'=>$data));
    }

}

?>