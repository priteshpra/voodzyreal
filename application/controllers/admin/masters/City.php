<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/city_model');
        $this->load->model('admin/state_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",3,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }
    }

    public function index($per_page_record = 10, $page_number = 1) {
        $result = $data = array();
		$this->load->view('admin/includes/header');
		$result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$result['countries'] = getCountryCombobox();
		$result['states'] = getStateCombobox();
		
		$this->load->view('admin/masters/city/list', $result);
		$data['page_level_js'] = $this->load->view('admin/masters/city/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/masters/city/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($state_result, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['cities'] = $this->city_model->listData($per_page_record, $page_number);

        if (empty($result['cities']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['cities'][0]->rowcount;

        //$result['total_records'] = $this->city_model->getRecordCount();
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/city/ajax_listing', $result, TRUE);
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
				$this->form_validation->set_rules('CityName', 'City Name', 'trim|required');
				$this->form_validation->set_rules('StateID', 'StateID', 'required');
				
				if ($this->form_validation->run() == TRUE) {
                    $res = $this->city_model->insert($this->input->post());
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/City');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/city/add');
                    }
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/City/add');
                    
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/City/add');
                }
            } else {
                $this->load->view('admin/includes/header');
                $data = array();
                $data['page_name'] = 'add';
                $data['countries'] = getCountryCombobox();
				$data['states'] = getStateCombobox();
                $data['loading_button'] = getLoadingButton();
                $this->load->view('admin/masters/city/add_edit', $data);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/masters/city/add_edit_js', NULL, TRUE);
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
				$this->form_validation->set_rules('CityName', 'City Name', 'trim|required');
				$this->form_validation->set_rules('StateID', 'StateID', 'required');
				
				if ($this->form_validation->run() == TRUE) {
                    if ($this->form_validation->run() == TRUE) {
                        $array = $this->input->post();
                        $array['ID'] = $ID;
                        $res = $this->city_model->update($array);
                        if (@$res->ID) {
                            redirect($this->config->item('base_url') . 'admin/masters/City');
                        } else {
							$error_array = array(
								"error_message" => $res->Message,
								"method_name" => $res->Method,
								"Type" => "Admin",
								"User_Agent" => getUserAgent()
							);
							$this->common_model->insertAdminError($error_array);
							$this->session->set_flashdata('posterror', label('please_try_again'));
							redirect($this->config->item('base_url') . 'admin/masters/city/edit/' . $ID);
						}
                    } else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/masters/City/edit/' . $ID);
                    }
                }
                $city_array = $this->input->post();
                $city_array['ID'] = $ID;
                if ($this->city_model->editCity($city_array)) {
                    redirect($this->config->item('base_url') . 'admin/masters/city');
                } else {
                    redirect($this->config->item('base_url') . 'admin/masters/city/edit' . $ID);
                }
            } else {
                $this->load->view('admin/includes/header');
                $show = array();
                $show['page_name'] = 'edit/' . $ID;
                $show['cities'] = $this->city_model->getCityById($ID);
				$country_id = $this->state_model->getStateByID($show['cities']->StateID);
				
				
                $show['countries'] = getCountryCombobox($country_id->CountryID);
                $show['states'] = getStateCombobox($show['cities']->StateID,$country_id->CountryID);
                $show['loading_button'] = getLoadingButton();
                $this->load->view('admin/masters/city/add_edit', $show);
                $show['page_level_js'] = $this->load->view('admin/masters/city/add_edit_js', NULL, TRUE);
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

    public function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->city_model->changeStatus($this->input->post());
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

    public function checkDuplicate() {
        try {
            if ($this->input->post()) {
                $dup = $this->city_model->checkDuplicate($this->input->post());
                echo  $dup->Count;
                
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
        $this->load->library('excel');
        $cities_result['cities'] = $this->city_model->listData(-1, 1);

        /*  pr($cities_result['cities']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($cities_result['cities'])) {
            $dataResult['result'] = $cities_result['cities'];
        }
        //pr($dataResult['result']);exit;
        $fields = array("SrNo", "CityName", "StateName"); //Header Define
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
        if (!empty($cities_result['cities'])) {
            foreach ($dataResult['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    if ($field == 'MajorCity') {
                        if ($data->$field == 1)
                            $data->$field = "Yes";
                        else
                            $data->$field = "No";
                    }
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Cities.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
