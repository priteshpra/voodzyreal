<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usersetting extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/Usersetting_model');
        $this->load->helper('global_config_helper');
        $this->load->helper('common_helper');
    }

    public function index($per_page_record = 10  , $page_number = 1) {
        try
        {
            $this->load->view('admin/includes/header');
            $societymember_result = array();
            
            $societymember_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);        
            $this->load->view('admin/user/Usersetting/list', $societymember_result);

            $data = array();
            $data['page_level_js'] = $this->load->view('admin/user/Usersetting/list_js', NULL, TRUE);
            $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/user/Usersetting/add';
            $data['footer']['listing_page'] = 'yes';
            $this->load->view('admin/includes/footer', $data);

            unset($societymember_result);
            unset($data);
        } 
        catch (Exception $e) 
        {
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
    
    public function ajax_listing($per_page_record = 10  , $page_number = 1)
    {
        $result = array();
        
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['Usersetting_array'] = $this->Usersetting_model->listusersetting($per_page_record  , $page_number  );
 
        //pr($result);die();
        if(empty($result['Usersetting_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['Usersetting_array'][0]->rowcount;
        
      
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/user/Usersetting/ajax_listing_usersetting', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="11" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
    public function add()
    {

        try
        {
            
            
           if ($this->input->post()) 
            {                 
                        $array = $this->input->post();
                      
                        $res = $this->Usersetting_model->insertusersetting($array);
                    // pr($res);die();
                        if (@$res->ID) 
                        {
                            redirect($this->config->item('base_url') . 'admin/user/Usersetting');
                        } 
                        else
                        {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => "Admin",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);
                            $this->session->set_flashdata('posterror', 'Please Try Again');
                            redirect($this->config->item('base_url') . 'admin/user/Usersetting/add');
                        }
                    } 
                                  
            $data = array();
            // For Service Provider Combo Box
            $data['loading_button'] = getLoadingButton();
                $data['member'] = getSocietyMember();
                $data['vendor'] = getVendor();
                $data['Admin'] = getAdmin();
            $data['page_name'] = 'add';  
            $this->load->view('admin/includes/header');
            $this->load->view('admin/user/Usersetting/add_edit', $data);
            $data = array();

            $data['page_level_js'] = $this->load->view('admin/user/Usersetting/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
            
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($UserSettingID = null)
    {
       // echo $SocietyMemberID;die();
        try
        {
            //$this->form_validation->set_rules('ServentName', 'ServentName', 'trim|required');
          

            if ($this->input->post())
            { 
                     $array = $this->input->post();
                     
                    $array['UserSettingID'] = $UserSettingID;
                   
                     $res = $this->Usersetting_model->updateusersetting($array);
                   // pr($res);die();
                    if (@$res->ID) 
                    {
                        redirect($this->config->item('base_url') . 'admin/user/Usersetting');
                    } else 
                    {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', 'Please Try Again');
                        redirect($this->config->item('base_url') . 'admin/society/Usersetting/edit/' . $UserSettingID);
                    }
               
            }

                
                

                  
                $this->load->view('admin/includes/header');    
            $data = array();
            $data['usersetting'] = $this->Usersetting_model->getusersettingByID($UserSettingID); // Get edit record information
         //   pr($data);die();
            if($data['usersetting']->UserType == "Admin"){
                    $data['member'] = getSocietyMember();
                    $data['vendor'] = getVendor();
                    $data['Admin'] = getAdmin($data['usersetting']->UserId);
                }else if($data['usersetting']->UserType == "Member"){
                    $data['member'] = getSocietyMember($data['usersetting']->UserId);
                    $data['Admin'] = getAdmin();
                    $data['vendor'] = getVendor();
                }else if($data['usersetting']->UserType == "Vendor"){
                    $data['member'] = getSocietyMember();
                    $data['Admin'] = getAdmin();
                    $data['vendor'] = getVendor($data['usersetting']->UserId);
                }
                else{
                    $data['member'] = getSocietyMember();
                    $data['Admin'] = getAdmin();
                    $data['vendor'] = getVendor();
                }
            $data['loading_button'] = getLoadingButton();
            $data['page_name']='edit/'.$UserSettingID;

            $this->load->view('admin/user/Usersetting/add_edit', $data);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/user/Usersetting/add_edit_js', NULL, TRUE, $data);
            $this->load->view('admin/includes/footer', $data);

            
            unset($data);
             
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
               "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }


    function changeStatus() {
        try
        {
            if ($this->input->post()) {
                $this->Usersetting_model->changeStatus($this->input->post());
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();

            $error_array = array(
               "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
     public function export_to_excel()
    {
        //load our new PHPExcel library
       $this->load->library('excel');   
        
       $servent_result['servent'] = $this->Usersetting_model->listusersetting(-1,1);
       // print_r($servent_result['servent']);exit;
       $dataResult['result'] = array();   
       If (!empty($servent_result['servent'])) {
            $dataResult['result'] =$servent_result['servent'];
        }
        $fields = array("SrNo","UserType","VisitorDirectAllowed","PushNotification","ComplaintNotification","TicketNotification","MaintananceDueNotication"); //Header Define
        

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field)
        {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }
        
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
    if (!empty($servent_result['servent'])) {
        foreach($dataResult['result'] as $rr=>$data)
        {
            
            $col = 0;
            foreach ($fields as $field)
            {
                
                if($field=='SrNo')
                    $data->$field = $SerialNo;
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
                
            }
            $row++;
            $SerialNo++;
        }    
    }       
  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
 
$filename='societymember.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter->save('php://output');

 }

}
