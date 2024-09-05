<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function getConfig(){
        $query = $this->db->query("call usp_M_GetConfig()");
        $query->next_result();
        return $query->row();
       
    }

    
    public function insertUpdateConfig($config_array) {
       
        $config_array['CrashEmail'] = getStringClean((isset($config_array['CrashEmail'])) ? $config_array['CrashEmail'] : NULL);

        $config_array['SupportEmail'] = getStringClean((isset($config_array['SupportEmail'])) ? $config_array['SupportEmail'] : NULL);
		$config_array['TimeZone'] = (isset($config_array['TimeZone'])) ? '+'.$config_array['TimeZone'] : NULL;
		$config_array['AppVersionAndroid'] = (isset($config_array['AppVersionAndroid'])) ? $config_array['AppVersionAndroid'] : 0;
		$config_array['AppVersionIOS'] = (isset($config_array['AppVersionIOS'])) ? $config_array['AppVersionIOS'] : 0;
		$config_array['usertype'] = 'Admin Web';
		$config_array['IPAddress'] = GetIP();
        if($config_array['ID'] == 0)
        {
            $config_array['created_by'] = (isset($config_array['created_by'])) ? $config_array['created_by'] : 0;
            $config_array['created_by'] = $this->session->userdata['UserID'];
            $config_array['modified_by'] = '0' ;
        }
        //For updating records
        else 
        {
            $config_array['modified_by'] = (isset($config_array['modified_by'])) ? $config_array['modified_by'] : 0;
            $config_array['modified_by'] = $this->session->userdata['UserID'];
            $config_array['created_by'] = '0';
        }
		$query = "call usp_A_AddEditConfig('" .
         $config_array['CrashEmail'] . "','" . 
         $config_array['SupportEmail'] . "','" .
		 $config_array['TimeZone'] . "','" .
		 $config_array['AppVersionAndroid'] . "','" .
		 $config_array['AppVersionIOS'] . "','" .
		 $config_array['usertype'] . "','" .
		 $config_array['IPAddress'] . "','".
         $config_array['created_by'] . "','" . 
         $config_array['ID'] . "','" . 
         $config_array['modified_by'] . "')";
        return $this->db->query($query);
    }

    

}
