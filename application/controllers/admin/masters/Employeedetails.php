<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employeedetails extends Admin_Controller {

  public function __construct() 
    {
        parent::__construct();       
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",3)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module)){
           
           }
        $this->load->model('admin/employeedetails_model');
    }
    public  function index($per_page_record = 10  , $page_number = 1)
    {
        $this->load->view('admin/includes/header');
        $employee_result = $data = array();
        $employee_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/employeedetail/list',$employee_result);
        $data['page_level_js'] = $this->load->view('admin/employeedetail/list_js', NULL, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($employee_result,$data);
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['employee_array'] = $this->employeedetails_model->listEmployees($per_page_record  , $page_number);

        if(empty($result['employee_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['employee_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/employeedetail/ajax_listing_employeedetail', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
   
    public function add() {
        if($this->cur_module->is_insert == 0)
                        show_404();
        if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required');
                $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required');
                $this->form_validation->set_rules('Address1', 'Address1', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                if($this->form_validation->run() == TRUE){
                    
                    $employee_id = $this->employeedetails_model->insertEmployee($this->input->post());
                    if($employee_id[0]->employee_id > 0){
                        if($_FILES['userfile']){
                            $file_name = date("YmdHis") . "_" . $employee_id[0]->employee_id;
                            $max_height = -1; //EMPLOYEE_MAX_HEIGHT;
                            $max_width = -1; //EMPLOYEE_MAX_WIDTH;
                            $max_size = -1 ;//EMPLOYEE_MAX_SIZE;
                            $allowed_types = EMPLOYEE_ALLOWED_TYPES;
                            $path = EMPLOYEE_UPLOAD_PATH;
                            $uploadFile='userfile';
                            $file_upload_return = array();
                            $file_upload_return = do_upload($uploadFile,$allowed_types, $path, $file_name, $max_size, $max_width, $max_height);
                            if ($file_upload_return['status'] == 0) {
                                
                                $this->session->set_flashdata('posterror', $file_upload_return['error']);
                                redirect($this->config->item('base_url') . 'admin/employee/employeedetail/add');
                            } else {
                                $data = $file_upload_return['upload_data'];
                                $employee_image = $data['raw_name'] . $data['file_ext'];

                                //for thumb image
                                $source_path = EMPLOYEE_UPLOAD_PATH . $employee_image;
                                $thumb_path = EMPLOYEE_THUMB_UPLOAD_PATH . $employee_image;
                                $thumb_width = EMPLOYEE_THUMB_MAX_WIDTH;
                                $thumb_height = EMPLOYEE_THUMB_MAX_HEIGHT;
                                resize_image($source_path, $thumb_path, $thumb_width, $thumb_height);

                                $employee_array = $this->input->post();
                                $employee_array['employee_id'] = $employee_id[0]->employee_id;
                                $employee_array['ImageURL'] = $employee_image;

                                $this->employeedetails_model->updateEmployee($employee_array);
                                redirect($this->config->item('base_url') . 'admin/employee/employeedetail');
                            }    
                        }else{
                            redirect($this->config->item('base_url') . 'admin/employee/employeedetail');
                        }
                    }else{
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/employee/employeedetail/add');
                    }
                }else{
                    
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/employee/employeedetail/add');
                }
            } 
            else {
                $result = array();
                $result['countries'] = getAllCountryForCombobox();
                $result['states'] = getStateComboBox();
                $result['cities'] = getCityComboBox();
                $result['loading_button'] = getLoadingButton(); 
                $result['page_name'] = 'add';
                $this->load->view('admin/includes/header');
                $this->load->view('admin/employeedetail/add_edit', $result);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/employeedetail/add_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data);
            }

    }
    public  function edit($employee_id = null)
    {
        if($this->cur_module->is_edit == 0)
                        show_404();        
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required');
            $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('Address1', 'Address1', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $employee_array = $this->input->post();
                $employee_array['employee_id'] = $employee_id;
                if($_FILES['userfile'] && $_FILES['userfile']['name']!=''){
                    $file_name = date("YmdHis") . "_" . $employee_id;
                    $max_height = -1; //EMPLOYEE_MAX_HEIGHT;
                    $max_width = -1 ;//EMPLOYEE_MAX_WIDTH;
                    $max_size = -1 ;//EMPLOYEE_MAX_SIZE;
                    $allowed_types = EMPLOYEE_ALLOWED_TYPES;
                    $path = EMPLOYEE_UPLOAD_PATH;
                    $uploadFile='userfile';
                    $file_upload_return = array();
                    $file_upload_return = do_upload($uploadFile,$allowed_types, $path, $file_name, $max_size, $max_width, $max_height);
                    if ($file_upload_return['status'] == 0) {
                        $this->session->set_flashdata('posterror', $file_upload_return['error']);
                        redirect($this->config->item('base_url') . 'admin/employee/employeedetail/edit/'.$employee_id);
                    } else {
                        $data = $file_upload_return['upload_data'];
                        $employee_image = $data['raw_name'] . $data['file_ext'];
                        $employee_array['ImageURL'] = $employee_image;

                        $source_path = EMPLOYEE_UPLOAD_PATH . $employee_image;
                        $thumb_path = EMPLOYEE_THUMB_UPLOAD_PATH . $employee_image;
                        $thumb_width = EMPLOYEE_THUMB_MAX_WIDTH;
                        $thumb_height = EMPLOYEE_THUMB_MAX_HEIGHT;
                        resize_image($source_path, $thumb_path, $thumb_width, $thumb_height);
                    }
                }else{
                        $employee_array['ImageURL'] = $this->input->post('editImageURL');
                }
              
                $this->employeedetails_model->updateEmployee($employee_array);
                redirect($this->config->item('base_url') . 'admin/employee/employeedetail');
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/employee/employeedetail/edit/'.$employee_id);
            }
        }else{
            $this->load->view('admin/includes/header');     
            $result = array();
            $result['loading_button'] = getLoadingButton();
            $result['page_name'] = 'edit/'.$employee_id;
     
            $result['employee'] = $this->employeedetails_model->getEmployeeByID($employee_id); // Get edit record information
           //PR($result['employee']);exit();
            $result['countries'] = getAllCountryForCombobox($result['employee']->CountryID);

            $result['states'] = getStateComboBox($result['employee']->StateID,$result['employee']->CountryID);
           
            $result['cities'] = getCityComboBox($result['employee']->CityID,$result['employee']->StateID);
          

            $this->load->view('admin/employeedetail/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/employeedetail/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }



    function changeStatus() 
    {
        if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
        }
        try{
            if ($this->input->post()){
                    $res = $this->employeedetails_model->changeStatus($this->input->post());
                    if($res){
                        $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                        echo json_encode(array('result' => 'success','message'=>$message));
                    }else{
                        echo json_encode(array('result' => 'error',label('please_try_again')));
                    }
                }
        }catch (Exception $e){
            echo json_encode(array('result' => 'error','message'=>$e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }

        
    }
    
    
    public function export_to_excel() {
        // if($this->cur_module->is_export == 0)
        //                 show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $employee_result['employee'] = $this->employeedetails_model->listEmployees(-1, 1);
        //pr($employee_result);exit;
        $dataResult['result'] = array();
        if (!empty($employee_result['employee'])) {
            $dataResult['result'] = $employee_result['employee'];
        }
        $fields = array("SrNo", "FirstName", "Email", "Gender", "CellPhone", "Country", "State", "City"); //Header Define
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }

        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($employee_result['employee'])) {
            foreach ($dataResult['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        $filename = 'Employeedetail.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
