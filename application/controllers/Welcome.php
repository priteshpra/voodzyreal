<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
public function getCronJobAction(){ 			
$this->load->helper("phpmailerautoload");
   		
   		/*$array['Name'] = 'abc';
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
        $result = $query->row();*/
        //$roleid = $result->ID;
 //email otp functionality
                            // $Content = $this->bulkmessage_model->get_emailtemplate($id = 3);
                            // $array['Attached'] = $PhotoURL;
                            $array['ToEmailID'] = 'narendra.saggisoftsolutions@gmail.com';
                            $array['Subject']  = DEFAULT_WEBSITE_TITLE;
                            $array['Body'] = 'this is test email';
                            $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                            $array['FromName'] = DEFAULT_FROM_NAME;
                            $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                            $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                            $array['AltBody'] = '';
                            $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                            $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                            //$data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{message}', '{base_url}');

                            //$datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $_result->FirstName, $_result->LastName, $back_image_path,   $msg_body, base_url());
                            //$array['Body'] = str_replace($data1, $datavalue, $array['Body']);                            
                            //pr($array['Body']);exit();
                            $res = CustomMail($array);
                            var_dump($res);exit();
                            if ($res == 1) {
                                $sendStatus = 1; //Success
                            } else {
                            }

 }


}
