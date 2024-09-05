<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usersession extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_session_model');
        $this->load->model('admin/employeedetails_model');
        $this->load->helper("phpmailerautoload");
    }

    public  function adminlogin(){  
        $this->load->view('admin/usersession/login_form');       
    }
    
    public function postLogin(){
        $data = array();
        $data = $this->user_session_model->checkLogin($this->input->post());
        
        if(count($data) > 0 && !empty($data) && !isset($data['0']['Message'])){ 
            redirect($this->config->item('base_url').'admin-dashboard/');
        }else{
            $message = explode('~',$data['0']['Message']);
            $this->session->set_flashdata('posterror',$message[1]);
            redirect($this->config->item('base_url').'admin-login');
        }
    }
    public function myProfile(){
        $data = $res =  array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
            $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->user_session_model->editProfile($this->input->post()); 
                $this->session->set_userdata($res);
                $this->session->set_userdata('language', 'english');
                if (@$res['UserID']) {
                    //$this->session->set_flashdata('postsuccess',label('profile_update_successful'));
                    redirect($this->config->item('base_url') . 'admin-dashboard/');
                } else {
                    $msg = isset($res['Message'])?$res['Message']:label('please_try_again');
                    
                    $this->session->set_flashdata('posterror',$msg);
                    redirect($this->config->item('base_url') . 'my-profile');
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'my-profile');
            }
        }

        $this->load->view('admin/includes/header');
        $data['profile'] = $this->user_session_model->currentUserProfileData();
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/usersession/my_profile',$data);
        $res['page_level_js'] = $this->load->view('admin/usersession/my_profile_js', NULL, TRUE);
        $res['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }
    public function changePassword(){
        $data = array(); 
        $this->load->view('admin/includes/header');
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/usersession/change_password',$data);
        $data['page_level_js'] = $this->load->view('admin/usersession/change_password_js', NULL, TRUE);
        $data['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }
    public function postChangePassword(){
        $resu = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        if(@$resu->cnt == 0 && !isset($resu->cnt)){
            $this->session->set_flashdata('posterror', label('old_password_does_not_match'));
            redirect($this->config->item('base_url').'change-password');
        }
        $res = $this->user_session_model->changePassword($this->input->post('new_password'),$this->input->post('current_password'));
        $msg = explode('~',$res['Message']);
        if($msg[0] == 200){
            $this->session->set_flashdata('postsuccess', $msg[1]);
        }else{
            $this->session->set_flashdata('posterror', $msg[1]);
        }
        redirect($this->config->item('base_url').'change-password');
    }
    public function forgotPassword(){
        $data = array(); 
        $this->load->view('admin/usersession/forgot_password_form');
        unset($data);
        
    }
    public function resetpassword(){
        $data = array(); 
        $this->load->view('admin/usersession/forgot_password_form');
        unset($data);
    }
    
    public function postResetPassword(){
            $data = $array = array();
            $Content = $this->user_session_model->get_emailtemplate($id = 6);
            $data = $this->user_session_model->ForgotPassword($this->input->post('email_id'));
            $array['ToEmailID'] = $data->EmailID;
            $array['Subject']  = DEFAULT_WEBSITE_TITLE.'- '.$Content['EmailSubject'];
            $array['Body'] = $Content['Content']; 
            $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
            $array['FromName'] = DEFAULT_FROM_NAME;
            $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
            $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
            $array['AltBody'] = '';  
            $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
            $back_image_path = '';//
            $data1 = array('{site_name}','{logo}','{first_name}','{last_name}','{back_image}','{password}','{base_url}');
            $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path, $forgot_password_result['0']->FirstName, $forgot_password_result['0']->LastName, $back_image_path, fnDecrypt($forgot_password_result['0']->Password),base_url());
            $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
            $res = CustomMail($array);
            $this->session->set_flashdata('postsuccess', label('api_msg_new_password_send_by_mail'));
            redirect($this->config->item('base_url').'admin-reset-password');
    }
    
    public function adminLogout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) 
        {
            $this->session->unset_userdata($key);
        }
        $this->session->sess_destroy();
        redirect($this->config->item('base_url').'admin-login');
    }
    
    public function checkIfEmailIDIsRegistered(){
		$res = $this->user_session_model->checkIfEmailIDIsRegistered($this->input->post('email_id'));
        echo $res;exit;
	}
    
    public function checkIfCurrentPasswordMatches(){
        $res = $this->user_session_model->checkIfCurrentPasswordMatches($this->input->post('current_password'));
        echo @$res->cnt;exit;
    }
    public function notification(){
        if($this->input->post()){
            $res = $this->employeedetails_model->SetNotification();
            if(@$res->ID){
                $this->session->set_flashdata('postsuccess', label('api_msg_update_notification_setting_successfully'));
                redirect($this->config->item('base_url') . 'notificationsetting');
            }else{
                $this->session->set_flashdata('posterror', label('please_try_again'));
                redirect($this->config->item('base_url') . 'notificationsetting');
            }
        }
        $this->load->view('admin/includes/header');
        $data['loading_button'] = getLoadingButton();
        $data['data'] = $this->employeedetails_model->GetNotification();
        $this->load->view('admin/usersession/notification',$data);

        $res['page_level_js'] = $this->load->view('admin/usersession/notification_js', NULL, TRUE);
        $res['footer']['listing_page'] = 'no';
        $this->load->view('admin/includes/footer', $res);

    }

    public function privacy_policy()
    {
        $this->load->view('admin/privacy_policy');
    }

    public function contact_us()
    {
        $this->load->view('admin/contact_us');
    }
}
