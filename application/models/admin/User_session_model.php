<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_session_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('common_helper');
    }

    public function checkLogin($login_data_array)
    {
        $sql = "call usp_A_CheckLogin('" .
            $login_data_array['email'] . "','" .
            fnEncrypt($this->input->post('password'), $this->config->item('sSecretKey')) .
            "')";

        $query = $this->db->query($sql);
        $query->next_result($sql);
        $user_data = $query->result_array();

        if (sizeof($user_data) > 0 && !empty($user_data)) {
            $this->session->set_userdata($user_data[0]);
            $this->session->set_userdata('language', 'english');
            return $user_data;
        }
        return array();
    }

    public function editProfile($data)
    {
        $data['FirstName'] = getStringClean((isset($data['FirstName'])) ? $data['FirstName'] : NULL);
        $data['LastName'] = getStringClean((isset($data['LastName'])) ? $data['LastName'] : NULL);
        $data['MobileNo'] = getStringClean((isset($data['MobileNo'])) ? $data['MobileNo'] : NULL);
        $data['signature'] = getStringClean((isset($data['signature'])) ? $data['signature'] : NULL);
        $data['ModifiedBy'] = $this->session->userdata['UserID'];
        $data['UserID'] = $this->session->userdata['UserID'];
        $UserType = $this->session->userdata['UserType'] . " Web";
        $sql = "call usp_A_EditAdminDetail('" .
            $data['FirstName'] . "','" .
            $data['LastName'] . "','" .
            $data['MobileNo'] . "','" .
            $data['ModifiedBy'] . "','" .
            $data['UserID'] . "','$UserType','" .
            GetIP() . "','" .
            $data['signature']
            . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
    public function checkIfCurrentPasswordMatches()
    {
        $data = array();
        $data['Password'] = fnEncrypt($this->input->post('current_password'));
        $sql = "call usp_A_CheckCurrentPassword('" .
            $this->session->userdata['UserID'] . "','" .
            $data['Password'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function checkIfEmailIDIsRegistered($email_id = null)
    {
        $user_type = array();
        $query = $this->db->query("call usp_A_CheckUserExist('" . $email_id . "')");
        $query->next_result();
        $user_array = $query->row_array();
        if (@$user_array['ID'] == 1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function changePassword($new_password = null, $old_pass = null)
    {
        $data['ID'] = $this->session->userdata['UserID'];
        $data['UserID'] = $this->session->userdata['UserID'];
        $data['Password'] = fnEncrypt($new_password, $this->config->item('sSecretKey'));
        $data['CPassword'] = fnEncrypt($old_pass, $this->config->item('sSecretKey'));
        $sql = "call usp_M_ChangePassword('" .
            $data['ID'] . "','" .
            $data['CPassword'] . "','" .
            $data['Password'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
    public function currentUserProfileData()
    {
        $query = $this->db->query("call usp_A_GetAdminByID('" . $this->session->userdata['UserID'] . "')");
        return $query->row();
    }
    function getUserComboBox()
    {
        $query = $this->db->query("call usp_A_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    public function ForgotPassword($data)
    {
        $sql = "call usp_M_ForgotPassword('" .
            $data .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        $res = $query->row();
        return $res;
    }

    public function findUserByForgotPasswordLink($random_string = null)
    {
        $user_type = array();
        $user_type = getUserType();

        $query = $this->db->query("call usp_A_GetUserByForgotPasswordLink('" . $random_string . "','" . $user_type['types']['Admin'] . "')");

        $query->next_result();
        $user_array = $query->row_array();
        return $user_array;
    }

    public function resetPassword($reset_password_data)
    {
        $user_type = array();
        $user_type = getUserType();

        $this->db->query("call usp_A_ResetUserPassword('" . $reset_password_data['user_id'] . "','" . fnEncrypt($reset_password_data['new_password'], $this->config->item('sSecretKey')) . "','" . $user_type['types']['Admin'] . "')");
        return 1;
    }
    function get_emailtemplate($id)
    {
        $sql = "call usp_W_GetEmailTemplateDetailByID('" . $id . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
    }
}
