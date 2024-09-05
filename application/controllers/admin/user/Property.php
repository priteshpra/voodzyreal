<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Property extends Admin_Controller {

  public function __construct() 
    {
        parent::__construct();

        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",18,'-1')");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) && $this->ProjectID != -1){
            show_404();
        }
        $process_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",19," . $this->ProjectID .")");
        $process_tmp->next_result();
        $this->process_module = $process_tmp->row();
        $payment_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $this->ProjectID .")");
        $payment_tmp->next_result();
        $this->payment_module = $payment_tmp->row();
        $this->payment_tmp = $this->payment_module;
        $document_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",21," . $this->ProjectID .")");
        $document_tmp->next_result();
        $this->document_module = $document_tmp->row();
        $reminder_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",22," . $this->ProjectID .")");
        $reminder_tmp->next_result();
        $this->reminder_module = $reminder_tmp->row();
        $refund_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45," . $this->ProjectID .")");
        $refund_tmp->next_result();
        $this->refund_module = $refund_tmp->row();
        $this->load->model('admin/customerproperty_model','property_model');
        $this->load->model('admin/customer_model','customer_model');
        $this->load->model('admin/visitor_model','visitor_model');
        $this->load->model('admin/refund_model');
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['CustomerID'] = $this->input->post('CustomerID');
        $result['data_array'] = $this->property_model->listData($per_page_record  , $page_number);
        if(isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        if($result['total_records'] != 0){
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
            $ajax_listing = $this->load->view('admin/user/property/ajax_listing', $result,TRUE);
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        }else{
             echo json_encode(array('a'=>'<tr><td colspan="10" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
        }
    }
   
    function changeStatus(){
        try{
            if ($this->input->post()){
                    $res = $this->property_model->changeStatus($this->input->post());
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
    public function add($CustomerID,$VisitorID='') {
        try {
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                //$this->form_validation->set_rules('PropertyID', 'PropertyID', 'trim|required');
                // $this->form_validation->set_rules('Amount', 'Amount', 'trim|required');
                /*$this->form_validation->set_rules('GSTAmount', 'GSTAmount', 'trim|required');*/
                $this->form_validation->set_rules('PurchaseDate', 'PurchaseDate', 'trim|required');
                $this->form_validation->set_rules('CustomerFirstName', 'CustomerFirstName', 'trim|required');
                $this->form_validation->set_rules('CustomerLastName', 'CustomerLastName', 'trim|required');
                $this->form_validation->set_rules('CustomerAddress', 'CustomerAddress', 'trim|required');
                $this->form_validation->set_rules('CustomerMobileNo', 'CustomerMobileNo', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $status_submit = 0;
                    if($CustomerID=='-1' && $VisitorID > 0){
                            $converttocustomer = $this->property_model->converttocustomer($VisitorID);
                            $msg = explode('~',@$converttocustomer->Message);
                            if(@$converttocustomer->ID){
                                 delete_cookie('RemoveCount'); 
                                $status_submit = 1;
                                $CustomerID = $data['CustomerID'] = @$converttocustomer->ID;
                                // echo json_encode(array('result' => 'Success', 'Message' => $msg[1]));
                            }else{
                                $status_submit = 0;
                                $this->session->set_flashdata('posterror', $msg[1]);
                                redirect($this->config->item('base_url') . 'admin/user/property/add/'.$CustomerID.'/'.$VisitorID);
                            }
                    }else{
                        $status_submit = 1;
                        $data['CustomerID'] = $CustomerID;    
                    }
                    
                    if($status_submit==1){
                        $res = $this->property_model->insert($data);
                        if (@$res->ID) {

                            redirect($this->config->item('base_url') . 'admin/user/customer/details/'.$CustomerID.'#property');

                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => $this->session->user_data['UserType'] . " Web",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);
                           
                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/property/add/'.$CustomerID.'/'.$VisitorID);
                        }
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/property/add/'.$CustomerID.'/'.$VisitorID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['Page']               = 'add/'.$CustomerID.'/'.$VisitorID;

            $data['CustomerID']         = $CustomerID;
            $data['CustomerDetail']     = $this->customer_model->getByID($CustomerID);

            $data['VisitorID']          = $VisitorID;
            $data['VisitorDetail']      = $this->visitor_model->getByID($VisitorID);
            $data['Leads']              = getLeads($VisitorID);
            $data['Project']            = getProject(0,-1,$this->UserRoleID);
            $data['Property']           = getPropertyCombobox(0,-1);
            $data['ChannelPartner']     = getChanelPartner(@$data['VisitorDetail']->ChanelPartnerID);
            $data['loading_button']     = getLoadingButton();
            $this->load->view('admin/user/property/add_edit', $data);
            $array['page_level_js']     = $this->load->view('admin/user/property/add_js', $data, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message"     => $e->getMessage(),
                "method_name"       => __CLASS__ . '->' . __FUNCTION__,
                "Type"              => $this->session->user_data['UserType'] . " Web",
                "User_Agent"        => getUserAgent()
                );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public  function edit($CustomerID = 0,$ID = 0){
        if($CustomerID == 0 || $ID == 0){
            show_404();
            die;
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
                $this->form_validation->set_rules('Amount', 'Amount', 'trim|required');
                $this->form_validation->set_rules('PurchaseDate', 'PurchaseDate', 'trim|required');
                $this->form_validation->set_rules('CustomerFirstName', 'CustomerFirstName', 'trim|required');
                $this->form_validation->set_rules('CustomerLastName', 'CustomerLastName', 'trim|required');
                $this->form_validation->set_rules('CustomerAddress', 'CustomerAddress', 'trim|required');
                $this->form_validation->set_rules('CustomerMobileNo', 'CustomerMobileNo', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['CustomerPropertyID'] = $ID;
                $data['CustomerID'] = $CustomerID;
                $res = $this->property_model->update($data);
                if(@$res->ID){
                    $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $this->input->post('ProjectID') .")");
                            $tmp->next_result();
                            $tmp_mod = $tmp->row();
                    if($data['paymentflag'] == 1 && $tmp_mod->is_insert == 1){
                        $this->session->set_flashdata('PropertyID',$data['PropertyID']);
                        redirect($this->config->item('base_url') . 'admin/user/payment/add/'.$CustomerID);
                    }
                    if($tmp_mod->is_insert == 0 && $data['paymentflag'] == 1){
                                $this->session->set_flashdata('posterror',label('you_do_not_have_access_to_insert_payment_for_this_project'));
                            }
                    redirect($this->config->item('base_url') . 'admin/user/customer/details/'.$CustomerID.'#property');
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/property/edit/'.$CustomerID."/".$ID);
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/property/edit/'.$CustomerID."/".$ID);
            }
        }else{
            $result = array();
            $result['CustomerID'] = $CustomerID;
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/'.$CustomerID ."/" . $ID;
            $result['data'] = $this->property_model->getByID($ID);
            if(@$result['data']->Message || @$result['data']->IsCancelled == 1){
                show_404();
                die;
            }
            $result['Project'] = getProject($result['data']->ProjectID,-1,$this->UserRoleID,1);
            $result['Property'] = getPropertyCombobox($result['data']->PropertyID,$result['data']->ProjectID,0,"All");
            $result['ChannelPartner']     =getChanelPartner(@$result['data']->ChannelPartnerID);
            $this->load->view('admin/includes/header');     
            $this->load->view('admin/user/property/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/property/add_js', $result, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }
    public function details($ID){
        $result['Property'] = $this->property_model->getByID($ID);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",18," . $result['Property']->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        $process_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",19," . $result['Property']->ProjectID .")");
        $process_tmp->next_result();
        $this->process_module = $process_tmp->row();
        $payment_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",20," . $result['Property']->ProjectID .")");
        $payment_tmp->next_result();
        $this->payment_module = $payment_tmp->row();
        $this->payment_tmp = $this->payment_module;
        $document_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",21," . $result['Property']->ProjectID .")");
        $document_tmp->next_result();
        $this->document_module = $document_tmp->row();
        $reminder_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",22," . $result['Property']->ProjectID .")");
        $reminder_tmp->next_result();
        $this->reminder_module = $reminder_tmp->row();
        $refund_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45," . $result['Property']->ProjectID .")");
        $refund_tmp->next_result();
        $this->refund_module = $refund_tmp->row();
        $result = array();
        $result['CustomerPropertyID'] = $ID;
        $result['loading_button'] = getLoadingButton();
        $result['Property'] = $this->property_model->getByID($ID);
        $result['MileStone'] = $this->property_model->GetMileStone($ID);
        $result['CancelProperty'] = $this->refund_model->getCancelByCPID($ID);
        // usp_A_GetMileStoneByCProperty
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        if(@$result['Property']->Message){
            show_404();
            die;
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/property/details',$result);
        $data['page_level_js'] = $this->load->view('admin/user/property/details_js', $result, TRUE);
        $this->load->view('admin/includes/footer',$data);

    }

    public function CancelProperty(){
        if($this->input->post()){
            $data = $this->property_model->CancelProperty();
            if(@$data->ID){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    public function ChangeVST(){
        if($this->input->post()){
            $PassCode = $this->input->post('PassCode');
            $uid = $this->session->userdata['UserID'];
            $this->load->model('api/master_model','master_model');
            
            $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('".$uid."','".$PassCode."')");
            if(@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)){
                $res = $this->property_model->ChangeVST();
                if(@$res->ID){
                    echo 1;
                }else{
                    $msg = explode('~',@$res->Message);
                    echo @$msg[1];
                }
            } else{
                    $msg = explode('~',@$_PassCodeResult[0]->Message);
                    echo @$msg[1];
            }
        }
    }

    public function CheckMultipleProperty(){
        if($this->input->post()){
            $data = $this->property_model->CheckMultipleProperty();
            if(@$data->ID){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    public function GetPropertyByID($ID){
        $data = $this->property_model->getByID($ID);
        if(@$data->CustomerPropertyID){
            $data->TotalRemTotalPayment  = $data->TotalPayment;
            $data->TotalRemGSTAmount  = $data->TotalGSTPayment;
            $data->Amount  = SalaryComma($data->Amount);
            $data->TotalPayment  = SalaryComma($data->TotalPayment);
            $data->GSTAmount  = SalaryComma($data->GSTAmount);
            $data->RemainingPayment  = SalaryComma($data->RemainingPayment);
            $data->TotalGSTPayment  = SalaryComma($data->TotalGSTPayment);
        }else{
            $msg = explode('~',$data->Message);
            $data->Message = @$msg[1];
        }
        echo json_encode(array('data'=>$data));
    }

    public function available($ID){
        $data = $this->property_model->availableProperty($ID);
        if(@$data->ID){
            redirect($this->config->item('base_url') . 'admin/user/customer/');
        }else{
            $msg = explode('~',$data->Message);
            $data->Message = @$msg[1];
        }
        echo json_encode(array('data'=>$data));
    }

    public function delete($ID){
        $data = $this->property_model->deleteProperty($ID);
        if(@$data->ID){
            redirect($this->config->item('base_url') . 'admin/user/customer/');
        }else{
            $msg = explode('~',$data->Message);
            $data->Message = @$msg[1];
        }
        echo json_encode(array('data'=>$data));
    }

}
