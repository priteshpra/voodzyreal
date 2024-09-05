<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notificationmessages extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/notificationmessages_model');
        $this->load->helper('common_helper');
        $tmp =  $this->db->query("CALL usp_A_GetRoleMappingByID(" . $this->UserRoleID . ",12)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(empty($this->cur_module) ){
            show_404();
        }
    }

    public function index($per_page_record = 10, $page_number = 1) {
        try {
            $this->load->view('admin/includes/header');
            $notificationmessages_result = array();
            $notificationmessages_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $this->load->view('admin/masters/notificationmessages/list', $notificationmessages_result);
            $data = array();
            $data['page_level_js'] = $this->load->view('admin/masters/notificationmessages/list_js', NULL, TRUE);
            
            $this->load->view('admin/includes/footer', $data);
            unset($notificationmessages_result);
            unset($data);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['notificationmessages'] = $this->notificationmessages_model->listData($per_page_record, $page_number);
        if (empty($result['notificationmessages']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['notificationmessages'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/masters/notificationmessages/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function add()
    {
        
		try {
               if(@$this->cur_module->is_insert == 0)
                        show_404();

				$data = $res = array();
			   
               if ($this->input->post()) {
					$this->load->library('form_validation');
					$this->form_validation->set_rules('Action', 'Action', 'trim|required');
					
					if ($this->form_validation->run() == TRUE) {
						$res = $this->notificationmessages_model->insert($this->input->post());
						if (@$res->ID) {
							redirect($this->config->item('base_url') . 'admin/masters/notificationmessages');
						} else {
							$error_array = array(
								"error_message" => $res->Message,
								"method_name" => $res->Method,
								"Type" => "Admin",
								"User_Agent" => getUserAgent()
							);
							$this->common_model->insertAdminError($error_array);
							$this->session->set_flashdata('posterror', label('please_try_again'));
							redirect($this->config->item('base_url') . 'admin/masters/notificationmessages/add');
						}
					} else {
						$this->session->set_flashdata('posterror', label('required_field'));
						redirect($this->config->item('base_url') . 'admin/masters/notificationmessages/add');
					}
				}
                $this->load->view('admin/includes/header');
				$data['page_name'] = 'add';
				$data['loading_button'] = getLoadingButton();
				
				$this->load->view('admin/masters/notificationmessages/add_edit', $data);
				$array['page_level_js'] = $this->load->view('admin/masters/notificationmessages/add_edit_js', NULL, TRUE);
				$this->load->view('admin/includes/footer', $array);
				unset($data,$array);
            
        }catch (Exception $e) {
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
                $this->form_validation->set_rules('Action', 'Action', 'trim|required');
				
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['ID'] = $ID;
                    $res = $this->notificationmessages_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/masters/notificationmessages');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/masters/notificationmessages/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/masters/notificationmessages/edit/' . $ID);
                }
            }
			$this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['notificationmessages'] = $this->notificationmessages_model->getNotificationMessagesByID($ID);
			$data['loading_button'] = getLoadingButton();
			$this->load->view('admin/masters/notificationmessages/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/masters/notificationmessages/add_edit_js', NULL, TRUE);
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

    
    public function changeStatus() {
        try {
            if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
               
				$res = $this->notificationmessages_model->changeStatus($this->input->post());
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
        $fields = array("SrNo", "Action","Role","message"); //Header Define

        $this->load->library('excel');
        $array['data'] = $this->notificationmessages_model->listData(-1, 1);
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
        $filename = 'notificationmessages.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    
    }

}
