<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/banner_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",17)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index() {
		$banner_result = $data = array();
		$this->load->view('admin/includes/header');
		$banner_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/masters/banner/list', $banner_result);
		$data['page_level_js'] = $this->load->view('admin/masters/banner/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/banner/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($banner_result, $data);
		
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['banner'] = $this->banner_model->listData($per_page_record, $page_number);
        if (empty($result['banner']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['banner'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/banner/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function add() {
        try {
            if(@$this->cur_module->is_insert == 0)
                        show_404();
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('BannerTitle', 'BannerTitle',    'trim|required');
				//$this->form_validation->set_rules('SubTitle', 'SubTitle',    'trim|required');
				//$this->form_validation->set_rules('Sequence', 'Sequence',    'trim|required');
				
				if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/masters/banner/add");
                    $config = array("max_width" => BANNER_MAX_WIDTH,
                        "max_height" => BANNER_MAX_HEIGHT,
                        'max_size' => BANNER_MAX_SIZE,
                        'path' => BANNER_UPLOAD_PATH,
                        'allowed_types' => BANNER_ALLOWED_TYPES,
                        'tpath' => BANNER_THUMB_UPLOAD_PATH,
                        'twidth' => BANNER_THUMB_MAX_WIDTH,
                        'theight' => BANNER_THUMB_MAX_HEIGHT
                    );
					
                    $config = array("max_width" => BANNER_MAX_WIDTH,
                        "max_height" => BANNER_MAX_HEIGHT,
                        'max_size' => BANNER_MAX_SIZE,
                        'path' => BANNER_UPLOAD_PATH,
                        'allowed_types' => BANNER_ALLOWED_TYPES,
                        'tpath' => BANNER_THUMB_UPLOAD_PATH,
                        'twidth' => BANNER_THUMB_MAX_WIDTH,
                        'theight' => BANNER_THUMB_MAX_HEIGHT
                    );
					
                    $data = $this->input->post();
					$data['image'] = FileUploadURL("userfile", "editImageURL", $config, '', $url);
					$config1 = array("max_width" => BANNER_MOBILE_MAX_WIDTH,
                        "max_height" => BANNER_MOBILE_MAX_HEIGHT,
                        'max_size' => BANNER_MOBILE_MAX_SIZE,
                        'path' => BANNER_MOBILE_UPLOAD_PATH,
                        'allowed_types' => BANNER_MOBILE_ALLOWED_TYPES,
                        'tpath' => BANNER_MOBILE_THUMB_UPLOAD_PATH,
                        'twidth' => BANNER_MOBILE_THUMB_MAX_WIDTH,
                        'theight' => BANNER_MOBILE_THUMB_MAX_HEIGHT
                    );
					$data['mobileimage'] = FileUploadURL("userfile1", "editMobileURL", $config, '', $url);
					
					
					$res = $this->banner_model->insert($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/banner');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
							
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/banner/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/banner/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
			
            $this->load->view('admin/masters/banner/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/masters/banner/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($ID = NULL) {
        try {
            if(@$this->cur_module->is_edit == 0)
                        show_404();
            $data = $res = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('BannerTitle', 'BannerTitle',    'trim|required');
				
                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/masters/banner/edit".$ID);
                    $config = array("max_width" => BANNER_MAX_WIDTH,
                        "max_height" => BANNER_MAX_HEIGHT,
                        'max_size' => BANNER_MAX_SIZE,
                        'path' => BANNER_UPLOAD_PATH,
                        'allowed_types' => BANNER_ALLOWED_TYPES,
                        'tpath' => BANNER_THUMB_UPLOAD_PATH,
                        'twidth' => BANNER_THUMB_MAX_WIDTH,
                        'theight' => BANNER_THUMB_MAX_HEIGHT
                    );
					
                    $data = $this->input->post();
					$data['image'] = FileUploadURL("userfile", "editImageURL", $config, '', $url);
					$config1 = array("max_width" => BANNER_MOBILE_MAX_WIDTH,
                        "max_height" => BANNER_MOBILE_MAX_HEIGHT,
                        'max_size' => BANNER_MOBILE_MAX_SIZE,
                        'path' => BANNER_MOBILE_UPLOAD_PATH,
                        'allowed_types' => BANNER_MOBILE_ALLOWED_TYPES,
                        'tpath' => BANNER_MOBILE_THUMB_UPLOAD_PATH,
                        'twidth' => BANNER_MOBILE_THUMB_MAX_WIDTH,
                        'theight' => BANNER_MOBILE_THUMB_MAX_HEIGHT
                    );
					$data['mobileimage'] = FileUploadURL("userfile1", "editMobileURL", $config1, '', $url);
					
					$data['ID'] = $ID;
					
                    $res = $this->banner_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/banner');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
							
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/banner/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/banner/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['banner'] = $this->banner_model->getBannerByID($ID);
            $data['loading_button'] = getLoadingButton();
			$this->load->view('admin/masters/banner/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/banner/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data,$res);
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

    function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->banner_model->changeStatus($this->input->post());
                if($res){
                    $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                    echo json_encode(array('result' => 'success','message'=>$message));
                }else{
                    echo json_encode(array('result' => 'error',label('please_try_again')));
                }
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

    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $array = array();
        $fields = array("SrNo", "BannerTitle","Type"); //Header Define

        $this->load->library('excel');
        $array['data'] = $this->banner_model->listData(-1, 1);
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
        $filename = 'banner.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
