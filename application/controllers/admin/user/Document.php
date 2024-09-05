<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Document extends Admin_Controller {

  public function __construct(){
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",21," . $this->ProjectID .")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        $this->load->model('admin/document_model');
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['CustomerID'] = $this->input->post('CustomerID');
        $result['IsCancelled'] = $this->input->post('IsCancelled');
        $result['data_array'] = $this->document_model->listData($per_page_record  , $page_number);
        if(isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        if($result['total_records'] != 0){
            $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
            $ajax_listing = $this->load->view('admin/user/document/ajax_listing', $result,TRUE);
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        }else{
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
        }
    }
   
    function changeStatus(){
        try{
            if ($this->input->post()){
                    $res = $this->document_model->changeStatus($this->input->post());
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
                $this->form_validation->set_rules('Title', 'Title', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['CustomerPropertyID'] = $CustomerPropertyID;
                    $url = site_url("admin/user/document/add/".$CustomerPropertyID);
                    $config = array("max_width" => PROJECT_DOCUMENT_MAX_WIDTH,
                        "max_height" => PROJECT_DOCUMENT_MAX_HEIGHT,
                        'max_size' => PROJECT_DOCUMENT_MAX_SIZE,
                        'path' => PROJECT_DOCUMENT_UPLOAD_PATH,
                        'allowed_types' => PROJECT_DOCUMENT_ALLOWED_TYPES,
                        'tpath' => PROJECT_DOCUMENT_THUMB_UPLOAD_PATH,
                        'twidth' => PROJECT_DOCUMENT_THUMB_MAX_WIDTH,
                        'theight' => PROJECT_DOCUMENT_THUMB_MAX_HEIGHT
                    );
                    $data['ImagePath'] = FileUploadURL("ImagePath", "EditImagePath", $config, '', $url);
                    $res = $this->document_model->insert($data);
                    if (@$res->ID) {

                        $user_ID = @$this->session->userdata['UserID'];

                        $_DeviceResult = $this->common_model->getDeviceByEmployee($user_ID,'Document',@$res->ProjectID);
                        if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){  
                            $Message = $res->Emp_name.' has added property document of '.$res->FirstName.' '.$res->LastName.'(customer).';
                                    $NoOfUser = array();
                                    foreach ($_DeviceResult as $key => $value) {
                                        $NoOfUser[$value->UserID] = $value;
                                    }

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->common_model->getInlineQuery("SELECT Fn_A_AddNotification('".$val->UserID."', '".$Message."' , '".$user_ID."', '".$res->ID."','AddCustomerDocument') as IsNotificationAdded, 'Success' as Status");
                                    }
                            foreach ($_DeviceResult as $d_val) { 
                                if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                                    $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                                                'message'=>$Message,
                                                'title'=>DEFAULT_WEBSITE_TITLE,
                                                'event'=>'Add Customer Document',
                                                'ActionType'=>'AddCustomerDocument',
                                                'detail'=> (array) $res
                                            );
                                    $notification_res = sendPushNotification($pushNotificationArr);
                                }
                            }
                        }
                        redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID.'#document');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                       
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/document/add/'.$CustomerPropertyID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/document/add/'.$CustomerPropertyID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['Page'] = 'add/'.$CustomerPropertyID;
            $data['CustomerPropertyID'] = $CustomerPropertyID;
            $data['Property'] = getCustomerPropertyCombobox(0,$CustomerPropertyID);
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/user/document/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/user/document/add_js', NULL, TRUE);
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
    public function delete(){
        $this->document_model->Delete($this->input->post('id'));
    }

}
