<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function listData($per_page_record = 10, $page_number = 1) 
    {
        $MessageKey=getStringClean(($this->input->post('MessageKey')!='')?$this->input->post('MessageKey'):''); 
        $Message=getStringClean(($this->input->post('Message')!='')?$this->input->post('Message'):''); 
        $Language=getStringClean(($this->input->post('Language') != '')?$this->input->post('Language'):'');
       
        
      $sql = "call usp_A_GetMessage('$per_page_record' , '$page_number','$Language','$MessageKey','$Message')";
        $query = $this->db->query($sql);
        return $query->result();

    }

    public function getmessageByID($messageID = NULL)
    {
        $query = $this->db->query("call usp_A_GetMessageDetailsByID('$messageID')");
         $query->next_result();
        return $query->row();
    }
    
    public function update($array) 
    {//print_r($array);die();
        $array['Language'] = getStringClean((isset($array['Language'])) ? $array['Language'] : 0);
        $array['MessageKey'] = getStringClean((isset($array['MessageKey'])) ? $array['MessageKey'] : NULL);
        $array['Message'] = getStringClean((isset($array['Message'])) ? $array['Message'] : NULL);
        $array['Status']        =   (isset($array['Status']) && $array['Status'] == 'on')?ACTIVE:INACTIVE;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();

         $query = $this->db->query("call usp_A_EditMessage('" .
            $array['Message'] . "','" .
            $array['modified_by']."','".
            $array['ID'] . "','".
            $array['usertype']."','".
            $array['IPAddress']."')");
            $query->next_result();
            return $query->row();

    }

    public function changeStatus($array)
    {
        $array['id']            =   getStringClean((isset($array['id']))?$array['id']:0);                
        $array['status']        =   getStringClean((isset($array['status']))?$array['status']:0);
        
        $array['table_name'] = "ssc_message";
        $array['field_name'] = "MessageID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('".$array['table_name']."','".$array['field_name']."','".$array['id']."','".$array['status']."','".$array['modified_by']."');");        
        //return $this->db->query("select @a AS xyz")->result();        
    }   
}

