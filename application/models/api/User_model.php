<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // Start : to list all contries 
    function getUser($data) {
        $sql = "call usp_M_GetUser()";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }  


    public function changePassword($data){
        //$OldPassword = (isset($data->OldPassword)) ? fnEncrypt($data->OldPassword, $this->config->item('sSecretKey')) : '-1';
        $data->OldPassword = (isset($data->OldPassword)) ? fnEncrypt( $data->OldPassword) : '-1';
        $data->Password = (isset($data->Password)) ? fnEncrypt( $data->Password) : '-1';

        $query = $this->db->query("call usp_M_ChangePassword('".$data->UserID."','".$data->OldPassword."','".$data->Password."')");

        $query->next_result();
        return $query->result();
    } 

    public function forgotPassword($data){

        $data->random_string = (isset($data->random_string)) ? fnEncrypt( $data->random_string) : '-1';        
        $query = $this->db->query("call usp_M_ForgotPassword('".$data->Email."','".$data->random_string."')");
        $query->next_result();
        return $query->row_array();
    } 

}
