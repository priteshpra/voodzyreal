<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class employee extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/employee_model');
        $this->load->helper('common_helper');
        //$this->load->helper('global_config_helper');
    }

    public function index() {
        try {
            $array = $data = array();
            $this->load->view('admin/includes/header');
            $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/user/employee/list', $array);
            $data['page_level_js'] = $this->load->view('admin/user/employee/list_js', NULL, TRUE);
            $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/user/employee/add';
            $data['footer']['listing_page'] = 'yes';
            $this->load->view('admin/includes/footer', $data);
            unset($array, $data);
        } catch (Exception $e) {
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

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $array = array();
        $array['per_page_record'] = $per_page_record;
        $array['page_number'] = $page_number;
        $array['admin_array'] = $this->employee_model->listemployee($per_page_record, $page_number);
        if (empty($array['admin_array']))
            $array['total_records'] = 0;
        else
            $array['total_records'] = $array['admin_array'][0]->rowcount;

        //$array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($array['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $array, TRUE);
            $ajax_listing = $this->load->view('admin/user/employee/ajax_listing_employee', $array, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else {
            echo json_encode(array('a' => '<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
        }
    }

    public function add() {
        try {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                $this->form_validation->set_rules('Email', 'Email', 'trim|required');
                $this->form_validation->set_rules('Address', 'Address', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $array = array();
                    $array = $this->input->post();
                    $url = site_url("admin/user/employee/add/");
                    $config = array("max_width" => EMPLOYEE_MAX_WIDTH,
                        "max_height" => EMPLOYEE_MAX_HEIGHT,
                        'max_size' => EMPLOYEE_MAX_SIZE,
                        'path' => EMPLOYEE_UPLOAD_PATH,
                        'allowed_types' => EMPLOYEE_ALLOWED_TYPES,
                        'tpath' => EMPLOYEE_THUMB_UPLOAD_PATH,
                        'twidth' => EMPLOYEE_THUMB_MAX_WIDTH,
                        'theight' => EMPLOYEE_THUMB_MAX_HEIGHT
                    );
                    $array['ImageURL'] = FileUploadURL("ImageURL", "editImageURL", $config, '', $url);
                    $res = $this->employee_model->insertemployee($array);
                    if ($res->ID) {
                        redirect($this->config->item('base_url') . 'admin/user/employee');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', 'Please Try Again');
                        redirect($this->config->item('base_url') . 'admin/user/employee/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', 'Please Fill All Fields');
                    redirect($this->config->item('base_url') . 'admin/user/employee/add');
                }
            }
            $data = array();
            $this->load->view('admin/includes/header');
            $data['loading_button'] = getLoadingButton();
            $data['department'] = getDepartment();
            $data['page_name'] = 'add';
            $this->load->view('admin/user/employee/add_edit', $data);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/user/employee/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
        } catch (Exception $e) {
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

    public function edit($ID = null) {
        try {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');
                $this->form_validation->set_rules('Address', 'Address', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $array = array();
                    $array = $this->input->post();
                    $array['ID'] = $ID;
                    $url = site_url("admin/user/employee/edit/$ID");
                    $config = array("max_width" => EMPLOYEE_MAX_WIDTH,
                        "max_height" => EMPLOYEE_MAX_HEIGHT,
                        'max_size' => EMPLOYEE_MAX_SIZE,
                        'path' => EMPLOYEE_UPLOAD_PATH,
                        'allowed_types' => EMPLOYEE_ALLOWED_TYPES,
                        'tpath' => EMPLOYEE_THUMB_UPLOAD_PATH,
                        'twidth' => EMPLOYEE_THUMB_MAX_WIDTH,
                        'theight' => EMPLOYEE_THUMB_MAX_HEIGHT
                    );
                    $array['ImageURL'] = FileUploadURL("ImageURL", "editImageURL", $config, '', $url);
                    $res = $this->employee_model->updateemployee($array);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/user/employee');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', 'Please Try Again');
                        redirect($this->config->item('base_url') . 'admin/user/employee/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', 'Please Fill All Fields');
                    redirect($this->config->item('base_url') . 'admin/user/employee/edit/' . $ID);
                }
            }
            $data = array();
            $this->load->view('admin/includes/header');
            $data['admin'] = $this->employee_model->getemployeeBYID($ID); // Get edit record information
            $data['loading_button'] = getLoadingButton();
            $data['department'] = getDepartment($data['admin']->DepartmentID);
            $data['page_name'] = 'edit/' . $ID;
            $this->load->view('admin/user/employee/add_edit', $data);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/user/employee/add_edit_js', NULL, TRUE, $data);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
        } catch (Exception $e) {
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
        try {
            if ($this->input->post()) {
                $this->employee_model->changeStatus($this->input->post());
            }
        } catch (Exception $e) {
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


    public function export_to_excel() {
        //load our new PHPExcel library
        $this->load->library('excel');
        $banner_result['banner'] = $this->employee_model->listemployee(-1, 1);
        // print_r($banner_result['banner']);exit;
        $dataResult['result'] = array();
        If (!empty($banner_result['banner'])) {
            $dataResult['result'] = $banner_result['banner'];
        }
        $fields = array("SrNo", "FirstName", "LastName", "DepartmentName", "Email", "MobileNo"); //Header Define
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
        if (!empty($banner_result['banner'])) {
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

        $filename = 'employee.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function getEmployeeCombobox(){
        if($this->input->get()){
            $json = array();
            $this->load->model('Common_model');
            $data = $this->Common_model->getEmployee();
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->UserID, 'text'=>$value->FirstName." ".$value->LastName];
            }
            echo json_encode($json);
        }
    }
}
