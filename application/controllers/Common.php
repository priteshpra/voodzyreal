     <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
    }
    function GetCountry($Selected = 0){
     echo getCountryCombobox($Selected);
    }
    function GetState($Selected = 0,$CountryID = 0){
    echo  GetStateCombobox($Selected,$CountryID);
    }
    function GetCity($Selected = 0,$StateID){
        getCityCombobox($Selected,$StateID);
    }
    function GetMileStoneByProperty($Selected = 0,$CustomerPropertyID){
       echo getCustomerMileStoneCombobox($Selected,$CustomerPropertyID);
    }
    function CheckPassCode(){
        $data = $this->common_model->CheckPassCode();
        if(isset($data->UserID)){
            echo json_encode(array('Result'=>'Success', 'Logout'=>'0','Message'=>''));
        }else{
            $msg = explode('~',$data->Message);
            if($msg[0] == 107){
                $logout = 1;
            }else{
                $logout = 0;
            }
            echo json_encode(array('Result'=>'Fail', 'Logout'=>$logout,'Message'=>@$msg[1]));
        }
    }
    function SetProjectSession(){
        $PID = $this->input->post('ProjectIDByRoleID');
        @$this->session->userdata['ProjectID'] = $PID;
    }
    function GetProperty($Selected = 0,$ProjectID,$Select2 = 0,$Type = ""){
     echo getPropertyCombobox($Selected = 0,$ProjectID,$Select2,$Type);
    }
    function GetProject($Selected = 0,$GroupID = -1,$RoleID = -1,$disabled = 0,$OnlyOne = 0){
     echo getProject($Selected,$GroupID,$RoleID,$disabled,$OnlyOne);
    }
     public function getCronJobAction(){ 			

   		$array['Name'] = 'abc';
        $array['Description'] = 'this is Description';
        $array['UserType'] = 'Web';
        $array['IPAddress'] = '212.1.32.1';
        $array['CreatedBy'] = 1;
        $sql = "CALL usp_A_AddRoles('" . 
            $array['Name'] . "','" . 
            $array['Description'] . "','" . 
            $array['CreatedBy'] . "','".
            $array['UserType']."','".
            $array['IPAddress']."')"; 
        $query = $this->db->query($sql);
        $query->next_result();
        $result = $query->row();
        //$roleid = $result->ID;

 }
}
