<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends Admin_Controller 
{

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",52,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }
        $this->load->model('admin/vendor_model');
        $this->load->model('admin/inward_model');
    }

    public function index() 
    {
        $result = $data = array();
		$this->load->view('admin/includes/header');
		$result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/user/vendor/list', $result);
		$data['page_level_js'] = $this->load->view('admin/user/vendor/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/user/vendor/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($state_result, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) 
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['vendor'] = $this->vendor_model->listData($per_page_record, $page_number);
        if (isset($result['vendor'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['vendor'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/user/vendor/ajax_listing',$result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="10" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));

    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $array = array();
            
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required');
                $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->vendor_model->insert($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/user/vendor');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/vendor/add');
                    }
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/vendor/add');
                    
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/vendor/add');
                }
            } else {
                $this->load->view('admin/includes/header');
                $data = array();
                $data['page_name'] = 'add';
                $data['category'] = getCategoryComboBox();
                $data['loading_button'] = getLoadingButton();
                $this->load->view('admin/user/vendor/add_edit', $data);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/user/vendor/add_edit_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data);
            }
        } catch (Exception $e) {
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

    public function edit($ID = null) {
        try {
            if(@$this->cur_module->is_edit == 0)
                        show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required');
                $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    if ($this->form_validation->run() == TRUE) {
                        $array = $this->input->post();
                        $array['ID'] = $ID;
                        $res = $this->vendor_model->update($array);
                        if (@$res->ID) {
                            redirect($this->config->item('base_url') . 'admin/user/vendor');
                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => "Admin",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);
                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/vendor/edit/' . $ID);
                        }
                    } 
                    else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/user/vendor/edit/' . $ID);
                    }
                }
                $city_array = $this->input->post();
                $city_array['ID'] = $ID;
                if ($this->city_model->editCity($city_array)) {
                    redirect($this->config->item('base_url') . 'admin/user/vendor');
                } else {
                    redirect($this->config->item('base_url') . 'admin/user/vendor/edit' . $ID);
                }
            } else {
                $this->load->view('admin/includes/header');
                $show = array();
                $show['page_name'] = 'edit/' . $ID;
                $show['vendor'] = $this->vendor_model->getByID($ID);
                $show['category'] = getCategoryComboBox(@$show['vendor']->CategoryID);
                $show['loading_button'] = getLoadingButton();
                $this->load->view('admin/user/vendor/add_edit', $show);
                $show['page_level_js'] = $this->load->view('admin/user/vendor/add_edit_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $show);
                unset($show, $data);
            }
        } catch (Exception $e) {
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

    public function combobox(){
        if($this->input->get()){
            $json = array();
            $_POST['CategoryID'] = ($this->input->get('CategoryID')=="")?'-1':$this->input->get('CategoryID');
            $data = $this->vendor_model->VendorNameCombobox();
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->VendorID, 'text'=>$value->VendorName];
            }
            echo json_encode($json);
        }
    }

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $array = array();
        $fields = array("SrNo","VendorName","EmailID","MobileNo","BusinessName","CategoryName","PANNo","GSTNo"); //Header Define

        $this->load->library('excel');
        $array['data'] = $this->vendor_model->listData(-1, 1);
        $array['result'] = array();
        if (!empty($array['data'])) {
            $array['result'] = $array['data'];
        }
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
        if (!empty($array['data'])) {
            foreach ($array['result'] as $rr => $data) {

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
        ob_end_clean();
        $filename = 'vendor.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function changeStatus() {

        if($this->cur_module->is_status == 0){
            echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
            die;
        }
         try {
            if ($this->input->post()) {
                $res = $this->vendor_model->changeStatus($this->input->post());
                if($res){
                    $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                    echo json_encode(array('result' => 'success','message'=>$message));
                }else{
                    echo json_encode(array('result' => 'error',label('please_try_again')));
                }
            }
        } catch (Exception $e) {
            echo json_encode(array('result' => 'error','message'=>$e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function details($ID = 0,$UserID=0){
        $data = array();
        $data['data'] = $this->vendor_model->getByID($UserID);
        $data['loading_button'] = getLoadingButton();        
        $data['page_level_js'] = $this->load->view('admin/user/vendor/details_js', $data, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/user/vendor/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function ajax_inwardlisting($PageSize = 10, $CurrentPage = 1) {
        $res = array();
        $res['per_page_record'] = $PageSize;
        $res['page_number'] = $CurrentPage;
        $res['data_array'] = $this->vendor_model->InwardListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_inwardlisting = $this->load->view('admin/user/vendor/ajax_listing_inward', $res, TRUE);
            echo json_encode(array('listing' => $ajax_inwardlisting, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'pagination' => ''));
        unset($res);
    }
}   
