<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/config_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",27,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1 && @$this->cur_module->is_edit != 1){
            show_404();
        }
    }
    public  function index()
    {
       try
        {
            if($this->cur_module->is_edit == 0)
                        show_404();
			$this->load->view('admin/includes/header');
            $data = array();
            $array = $this->config_model->getConfig();
            if(empty($array)){
                $data['page_name'] = "addConfig";
            }else{
                $data['config'] = $array;
                $data['page_name'] = "editConfig/".$data['config']->ConfigID;
            }
            $data['loading_button'] = getLoadingButton(); 
            $this->load->view('admin/configuration/config/add_edit',$data);
            $data['page_level_js'] = $this->load->view('admin/configuration/config/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);    
            unset($data);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
				"Type" => "Admin",
                "User_Agent" => getUserAgent(),
				"IPAddress" => GetIP()
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    public function editConfig($ID = NULL)
    {
        try
        {
            if($this->cur_module->is_edit == 0)
                        show_404();
			$data = $res = array();
			if ($this->input->post())	
            {
				$this->load->library('form_validation');
            
				$this->form_validation->set_rules('CrashEmail', 'CrashEmail', 'trim|required');
				$this->form_validation->set_rules('SupportEmail', 'SupportEmail', 'trim|required');
				if ($this->form_validation->run() == TRUE) 
				{
					$res = $this->input->post();
                    $res['ID'] = $ID;

                    if ($this->config_model->insertUpdateConfig($res)) 
                    {
						$this->session->set_flashdata('postsuccess', 'Record has been saved successfully.');
                        
						redirect($this->config->item('base_url') . 'admin/configuration/config');
                    }
					else{
						$error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/configuration/config');
					}
                }
				else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/configuration/config');
                }
            } 
            $this->load->view('admin/includes/header');
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/configuration/config', $data);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
				"Type" => "Admin",
                "User_Agent" => getUserAgent(),
				
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    public function addConfig()
    {
        try
        {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
			$data = $array = array();
			if ($this->input->post()) 
            {
				$this->load->library('form_validation');

				$this->form_validation->set_rules('CrashEmail', 'CrashEmail', 'trim|required');
				$this->form_validation->set_rules('SupportEmail', 'SupportEmail', 'trim|required');

				if ($this->form_validation->run() == TRUE) 
				{
					
					$res = $this->input->post();
					$res['ID'] = 0;

					if ($this->config_model->insertUpdateConfig($res))
					{
						$this->session->set_flashdata('postsuccess', 'Record has been added successfully.');
                        
						redirect($this->config->item('base_url') . 'admin/configuration/config');
					}
					else{
						$error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/configuration/config');
					}
				   
				}
				else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/configuration/config');
                }
			}			
            $this->load->view('admin/includes/header');
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/masters/configuration/config', $data);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
				"Type" => "Admin",
                "User_Agent" => getUserAgent(),
            );
            $this->common_model->insertAdminError($error_array);
        }    
    }
    
    
    
}
