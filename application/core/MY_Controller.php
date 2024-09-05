<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 *
 * @package Project Name
 * @subpackage  Controllers
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    
    
}

class LoggedIn extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->updatelangfile('english');
    }
    public function updatelangfile($my_lang){
        $this->session->set_userdata('language', 'english');
        $this->db->where('Language',$my_lang);
        $query = $this->db->get('sssm_messages');

        $lang=array();
        $langstr="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                /**
                *
                *
                * Description:  ".$my_lang." language file for general views
                *
                */"."\n\n\n";


                //pr($query->result());exit();
        foreach ($query->result() as $row){
            $lang['error_csrf'] = 'This form post did not pass our security checks.';
            $langstr.= "\$lang['".$row->MessageKey."'] = \"$row->Message\";"."\n";
        }
        $filepath = './application/language/'.$my_lang.'/message_lang.php';
        write_file($filepath, $langstr);

    }
}

class Front_Controller extends LoggedIn {
    function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->library('googleplus');

        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();

        $without_login_methods = array('login', 'signup', 'googlelogin', 'fblogin', 'callback', 'forgotpassword');
        $with_login_methods = array('editprofile', 'profile', /* 'ajax_listing', */ 'addstory', 'bookmark', '');


        $with_login_controllers = array(/* 'Story','Publication', */'Author');
        $user_session = $this->session->userdata("user_data");

        if (isset($user_session['AuthorID'])) {//if(isset($this->session->userdata['UserID']))
            // Session is registered
            if (in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'home');
            }
        } else {
            // Session is not registered
            if (in_array($current_method, $with_login_methods) || in_array($current_controller, $with_login_controllers)) {
                redirect($this->config->item('base_url') . 'author-login');
            }
        }
    }
}

class Admin_Controller extends LoggedIn {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $this->module_data = array();
        $this->UserRoleID = 0;
        $without_login_methods = array('adminlogin', 'forgotPassword', 'resetpassword', 'postLogin','postResetPassword','checkIfEmailIDIsRegistered','label','privacy_policy','contact_us');

        $with_login_methods = array('adminLogout', 'changePassword', 'myProfile', 'editMyProfile', 'editProfile','checkIfEmailIDIsRegistered');
        
        if (isset($this->session->userdata['UserID'])) {
            $UserID = $this->session->userdata['UserID'];
            $this->UserRoleID = $this->session->userdata['RoleID'];
            $this->ProjectID = (@$this->session->userdata['ProjectID']!='')?$this->session->userdata['ProjectID']:-1;
            $this->ProjectCombobox = getProjectByRoleID($this->UserRoleID,$this->ProjectID);
            $query = "CALL usp_A_GetRolesMappingByID('".$this->UserRoleID ."','Web');";
            $res = $this->db->query($query);
            $res->next_result();
            $data = $res->result();
            if(@$data[0]->ModuleID){
                foreach ($data as $value) {
                        $this->module_data[] = $value->ModuleID;
                }
            }
            if (($current_method =='privacy_policy') || ($current_method =='contact_us')) {
               
            }
            else
            {
                if ((in_array($current_method, $without_login_methods))) {
                    redirect($this->config->item('base_url') . 'admin-dashboard');
                }
            }
            
        }else{
            if (!in_array($current_method, $without_login_methods)) {
                redirect($this->config->item('base_url') . 'admin-login');
            }
        }
    }
    function CheckDuplicate() {
        try {
            if ($this->input->post()) {
               $res = $this->common_model->CheckDuplicate($this->input->post());
                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
	function CheckDuplicateDouble() {
        try {
            if ($this->input->post()) {
                $res = $this->common_model->CheckDuplicateDouble($this->input->post());
                if(@$res->Count == 0)
                    echo json_encode(array('result' => 'Success','count'=>$res->Count));
                else
                    echo json_encode(array('result' => 'Fail'));
            }
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    /**
     * Purpose : For multiple change status 
     */
    public function multipleChangeStatus() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
                $multiple_id = $this->input->post("ids");
                $table_name = $this->input->post("table_name");
                $field_name = $this->input->post("field_name");
                $new_status = 0;
                $checkbox_ids = explode(",", $multiple_id);

                foreach ($checkbox_ids as $checkbox_id) {

                    $this->common_model->changeStatus();
                    $this->db->query("call cf_A_ChangeStatus('" . $table_name . "','" . $field_name ."','" . $checkbox_id . "','" . $new_status . "','" . $this->session->userdata['AdminID'] . "')");
                }
        }else{
            show_404();
        }

    }
    public function getRecordInfo() {
        $record_id = $this->input->post("id");
        $table_name = $this->input->post("table_name");
        $field_name = $this->input->post("field_name");
        $record_result = array();
        $record_result = getRecordTrack($record_id, $table_name, $field_name);

        $data = "";
        foreach ($record_result as $records) {
            $crd = ($records->CreatedDate!="")?GetDateTimeInFormat($records->CreatedDate):'';
            $mrd = ($records->ModifiedDate!="")?GetDateTimeInFormat($records->ModifiedDate):'';

            $data .= '<tr><td style="width:20px;color:#000000;"><i class="mdi-action-perm-identity"></i></td><td><b>Created By</b></td><td>'.$records->CreatedBy.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#000000;"><i class="mdi-notification-event-note"></i></td><td><b>Created Date</b></td><td>'.$crd.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#dbab83;"><i class="mdi-action-perm-identity"></i></td><td><b>Modified By</b></td><td>'.$records->ModifiedBy.'</td></tr>';
            $data .= '<tr><td style="width:20px;color:#dbab83;"><i class="mdi-notification-event-note"></i></td><td><b>Modified Date</b></td><td>'.$mrd.'</td></tr>'; 
        }
        echo $data;
    }
    public function emailexist(){
        $email_id = $this->input->post('email');
       $exists = $this->common_model->emailexists($email_id);
        echo $exists->emailcount;exit;
        if ($exists->emailcount > 0) {
            echo label('email_exist');exit();
        } 
        else {
            echo '0';exit();
        }
    }

}
