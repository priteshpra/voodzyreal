  <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Visitor extends Admin_Controller
    {

        function __construct()
        {
            parent::__construct();
            $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",23,0)");
            $tmp->next_result();
            $this->cur_module = $tmp->row();
            if (@$this->cur_module->is_view != 1) {
                show_404();
            }
            $this->load->model('admin/visitor_model');
            $this->load->model('admin/config_model');
            $this->load->model('admin/feedback_model');
            $this->load->model('admin/visitorleads_model');
            $this->configdata = $this->config_model->getConfig();
            $reminder_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",24,0)");
            $reminder_tmp->next_result();
            $this->reminder_module = $reminder_tmp->row();
        }

        public function index()
        {
            $res = $data = array();
            $this->load->view('admin/includes/header');
            $res['projects'] = getProject(0, -1, $this->UserRoleID);
            $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $res['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
            $res['employee'] = getEmployee();
            $res['designation'] = getDesignation();
            $res['reason_array'] = $this->feedback_model->ListData(-1, 1);
            $this->load->view('admin/user/visitor/list', $res);
            $data['page_level_js'] = $this->load->view('admin/user/visitor/list_js', NULL, TRUE);
            $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/user/visitor/add';
            $data['footer']['listing_page'] = 'yes';
            $this->load->view('admin/includes/add_feedback_model', $res);
            $this->load->view('admin/includes/footer', $data);
            unset($res, $data);
        }

        public function reminderalert()
        {
            $data = $this->visitor_model->listReminderNotificationData();
            if (isset($data['0']->VisitorReminderID)) {
                $datastr = '';
                foreach ($data as $key => $value) {
                    $datastr .= 'Visitor of ' . $value->VisitorName  . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';
                }
                echo json_encode($datastr);
            } else {
                echo json_encode('');
            }
        }

        public function withoutfiltervisitor()
        {
            $res = $data = array();
            $this->load->view('admin/includes/header');
            $res['projects'] = getProject(0, -1, $this->UserRoleID);
            $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $res['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
            $res['employee'] = getEmployee();
            $res['designation'] = getDesignation();
            $res['reason_array'] = $this->feedback_model->ListData(-1, 1);
            $this->load->view('admin/user/visitorwithoutfilter/list', $res);
            $data['page_level_js'] = $this->load->view('admin/user/visitorwithoutfilter/list_js', NULL, TRUE);
            $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/user/visitor/add';
            $data['footer']['listing_page'] = 'yes';
            $this->load->view('admin/includes/add_feedback_model', $res);
            $this->load->view('admin/includes/footer', $data);
            unset($res, $data);
        }

        public function ajax_listing($per_page_record = 10, $page_number = 1)
        {
            $result = array();
            $result['per_page_record'] = $per_page_record;
            $result['page_number'] = $page_number;
            $result['visitor'] = $this->visitor_model->listData($per_page_record, $page_number);
            if (isset($result['visitor'][0]->Message))
                $result['total_records'] = 0;
            else
                $result['total_records'] = $result['visitor'][0]->rowcount;

            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            if ($result['total_records'] != 0) {
                $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
                $ajax_listing = $this->load->view('admin/user/visitor/ajax_listing', $result, TRUE);
                echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
            } else
                echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
        }

        public function withoutfilterajax_listing($per_page_record = 10, $page_number = 1)
        {
            $result = array();
            $result['per_page_record'] = $per_page_record;
            $result['page_number'] = $page_number;
            $result['visitor'] = $this->visitor_model->withoutFilterlistData($per_page_record, $page_number);
            if (isset($result['visitor'][0]->Message))
                $result['total_records'] = 0;
            else
                $result['total_records'] = $result['visitor'][0]->rowcount;

            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            if ($result['total_records'] != 0) {
                $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
                $ajax_listing = $this->load->view('admin/user/visitorwithoutfilter/ajax_listing', $result, TRUE);
                echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
            } else
                echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
        }

        public function details($ID = 0)
        {
            $this->UserID = $ID;
            $data = array();
            $_POST['UserID'] = $data['VisitorID'] = $ID;
            $_POST['VisitorID'] = $ID;
            $data['visitlead'] = $this->visitorleads_model->listData(1, 1);
            $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $data['data'] = $this->visitor_model->getByID($ID);
            $data['loading_button'] = getLoadingButton();
            $data['page_level_js'] = $this->load->view('admin/user/visitor/details_js', $data, TRUE);
            $this->load->view('admin/includes/header');
            $this->load->view('admin/user/visitor/details', $data);
            $this->load->view('admin/includes/footer', $data);
            unset($data);
        }

        public function add()
        {
            try {
                if (@$this->cur_module->is_insert == 0)
                    show_404();
                $data = $array = array();

                if ($this->input->post()) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                    $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                    $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                    if ($this->form_validation->run() == TRUE) {
                        $res = $this->visitor_model->insert($this->input->post());
                        if (@$res->ID) {
                            //redirect($this->config->item('base_url') . 'admin/user/visitor');
                            redirect($this->config->item('base_url') . 'admin/user/sites/add/' . @$res->ID);
                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => $this->session->user_data['UserType'] . " Web",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);

                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/visitor/add');
                        }
                    } else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/user/visitor/add');
                    }
                }
                $this->load->view('admin/includes/header');
                $data['page_name'] = 'add';
                $data['loading_button'] = getLoadingButton();
                $data['ChannelPartner'] = getChanelPartner();
                $data['designation'] = getDesignation();
                $data['employee'] = getEmployee($this->session->userdata['UserID']);
                $data['projects'] = getProject(0, -1, $this->UserRoleID);
                $data['BirthMonth'] = getMonth('BirthMonth');
                $data['AnniversaryMonth'] = getMonth('AnniversaryMonth');
                $this->load->view('admin/user/visitor/add_edit', $data);
                $array['page_level_js'] = $this->load->view('admin/user/visitor/add_edit_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $array);
                unset($data, $array);
            } catch (Exception $e) {
                echo $e->getMessage();

                $error_array = array(
                    "error_message" => $e->getMessage(),
                    "method_name" => __CLASS__ . '->' . __FUNCTION__,
                    "Type" => $this->session->user_data['UserType'] . " Web",
                    "User_Agent" => getUserAgent()
                );
                $this->common_model->insertAdminError($error_array);
            }
        }

        public function edit($ID = NULL)
        {

            try {
                if (@$this->cur_module->is_edit == 0)
                    show_404();
                $data = $res = array();

                if ($this->input->post()) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                    $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                    $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');

                    if ($this->form_validation->run() == TRUE) {
                        $data = $this->input->post();
                        $data['ID'] = $ID;
                        $res = $this->visitor_model->update($data);
                        if (@$res->ID) {
                            redirect($this->config->item('base_url') . 'admin/user/visitor');
                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => $this->session->user_data['UserType'] . " Web",
                                "User_Agent" => getUserAgent()

                            );
                            $this->common_model->insertAdminError($error_array);
                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/visitor/edit/' . $ID);
                        }
                    } else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/user/visitor/edit/' . $ID);
                    }
                }

                $this->load->view('admin/includes/header');
                $data['page_name'] = 'edit/' . $ID;
                $data['visitor'] = $this->visitor_model->getByID($ID);

                if (empty($data['visitor'])) {
                    $this->session->set_flashdata('posterror', label('record_not_found'));
                    redirect($this->config->item('base_url') . 'admin/user/visitor/');
                }

                $data['ChannelPartner'] = getChanelPartner(@$data['visitor']->ChanelPartnerID);
                $data['loading_button'] = getLoadingButton();
                $data['designation'] = getDesignation(@$data['visitor']->DesignationID);
                $data['employee'] = getEmployee(@$data['visitor']->EmployeeID);
                $data['BirthMonth'] = getMonth('BirthMonth', @$data['visitor']->BirthMonth);
                $data['AnniversaryMonth'] = getMonth('AnniversaryMonth', @$data['visitor']->AnniversaryMonth);

                $this->load->view('admin/user/visitor/add_edit', $data);
                $res['page_level_js'] = $this->load->view('admin/user/visitor/add_edit_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $res);
                unset($data, $res);
            } catch (Exception $e) {
                echo $e->getMessage();

                $error_array = array(
                    "error_message" => $e->getMessage(),
                    "method_name" => __CLASS__ . '->' . __FUNCTION__,
                    "Type" => $this->session->user_data['UserType'] . " Web",
                    "User_Agent" => getUserAgent()
                );
                $this->common_model->insertAdminError($error_array);
            }
        }

        public function changeStatus()
        {
            try {
                if ($this->cur_module->is_status == 0) {
                    echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                    die;
                }
                if ($this->input->post()) {
                    $res = $this->visitor_model->changeStatus($this->input->post());
                    if ($res) {
                        $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                        echo json_encode(array('result' => 'success', 'message' => $message));
                    } else {
                        echo json_encode(array('result' => 'error', label('please_try_again')));
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();

                $error_array = array(
                    "error_message" => $e->getMessage(),
                    "method_name" => __CLASS__ . '->' . __FUNCTION__,
                    "Type" => $this->session->user_data['UserType'] . " Web",
                    "User_Agent" => getUserAgent()
                );
                $this->common_model->insertAdminError($error_array);
            }
        }

        public function converttocustomer()
        {
            if ($this->input->post()) {
                // redirect($this->config->item('base_url') . 'admin/user/property/add/-1/'.$VisitorID);
                $data = $this->visitor_model->converttocustomer();
                $msg = explode('~', @$data->Message);
                if (@$data->ID) {
                    echo json_encode(array('result' => 'Success', 'Message' => $msg[1]));
                } else {
                    echo json_encode(array('result' => 'Fail', 'Message' => $msg[1]));
                }
            }
        }

        public function visitoridle()
        {
            if ($this->input->post()) {
                $data = $this->visitor_model->visitoridle();
                if (@$data->ID) {
                    if ($data->IsIdle == 1) {
                        $Message = label('api_msg_add_visitor_idle_successfully');
                    } else {
                        $Message = label('api_msg_remove_visitor_from_idle');
                    }
                    echo json_encode(array('result' => 'Success', 'Message' => $Message));
                } else {
                    $msg = explode('~', @$data->Message);
                    echo json_encode(array('result' => 'Fail', 'Message' => $msg[1]));
                }
            }
        }

        public function emailexist()
        {
            if ($this->input->post()) {
                $data = $this->visitor_model->emailexist();
                if (@$data->ID) {
                    echo 1;
                } else {
                    $msg = explode('~', $data->Message);
                    echo @$msg[1];
                }
            }
        }

        public function ajax_followup($per_page_record = 10, $page_number = 1)
        {

            $result = array();
            $result['per_page_record'] = $per_page_record;
            $result['page_number'] = $page_number;
            $result['VisitorID'] = $this->input->post('VisitorID');
            $result['data_araay'] = $this->visitor_model->listReminder($per_page_record, $page_number, $this->input->post('VID'));
            if (!isset($result['data_araay'][0]->VisitorReminderID))
                $result['total_records'] = 0;
            else {
                $result['total_records'] = $result['data_araay'][0]->rowcount;
            }

            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

            $ajax_listing = $this->load->view('admin/user/visitor/ajax_listing_followup', $result, TRUE);
            if ($result['total_records'] != 0)
                echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
            else
                echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
        }

        public function addreminder($VisitorID = 0)
        {
            try {
                if ($VisitorID == 0)
                    show_404();
                if (@$this->cur_module->is_insert == 0)
                    show_404();

                $data = $array = array();
                if ($this->input->post()) {

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('Message', 'Message', 'trim|required');
                    $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
                    $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
                    $this->form_validation->set_rules('PastDate', 'PastDate', 'trim|required');
                    $this->form_validation->set_rules('PastTime', 'PastTime', 'trim|required');

                    if ($this->form_validation->run() == TRUE) {
                        $data = $this->input->post();
                        $data['ID'] = 0;
                        $data['VisitorID'] = $VisitorID;
                        $res = $this->visitor_model->InsertReminder($data);
                        delete_cookie('RemoveCount');
                        if (@$res->ID) {
                            redirect($this->config->item('base_url') . 'admin/user/visitor/details/' . $VisitorID . "#reminder");
                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => "Admin",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);
                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/visitor/addreminder');
                        }
                    } else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/user/visitor/addreminder');
                    }
                }

                $this->load->view('admin/includes/header');
                $data['page_name'] = 'addreminder/' . $VisitorID;
                $data['Sites'] = getSites($VisitorID);
                $data['loading_button'] = getLoadingButton();
                $data['VisitorID'] = $VisitorID;
                $data['visit'] = $this->visitor_model->getByID($VisitorID);
                $this->load->view('admin/user/visitor/add_editfollowup', $data);
                $array['page_level_js'] = $this->load->view('admin/user/visitor/add_editfollowup_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $array);
                unset($data, $array);
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

        public function editreminder($VisitorID = 0, $ID = 0)
        {
            try {
                if ($VisitorID == 0 || $ID == 0)
                    show_404();
                if (@$this->cur_module->is_insert == 0)
                    show_404();

                $data = $array = array();
                if ($this->input->post()) {

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('Message', 'Message', 'trim|required');
                    $this->form_validation->set_rules('ReminderDate', 'ReminderDate', 'trim|required');
                    $this->form_validation->set_rules('ReminderTime', 'ReminderTime', 'trim|required');
                    $this->form_validation->set_rules('PastDate', 'PastDate', 'trim|required');
                    $this->form_validation->set_rules('PastTime', 'PastTime', 'trim|required');

                    if ($this->form_validation->run() == TRUE) {
                        $data = $this->input->post();
                        $data['ID'] = $ID;
                        $data['VisitorID'] = $VisitorID;
                        $res = $this->visitor_model->EditReminder($data);
                        if (@$res->ID) {
                            redirect($this->config->item('base_url') . 'admin/user/visitor/details/' . $VisitorID . "#reminder");
                        } else {
                            $error_array = array(
                                "error_message" => $res->Message,
                                "method_name" => $res->Method,
                                "Type" => "Admin",
                                "User_Agent" => getUserAgent()
                            );
                            $this->common_model->insertAdminError($error_array);
                            $this->session->set_flashdata('posterror', label('please_try_again'));
                            redirect($this->config->item('base_url') . 'admin/user/visitor/addreminder');
                        }
                    } else {
                        $this->session->set_flashdata('posterror', label('required_field'));
                        redirect($this->config->item('base_url') . 'admin/user/visitor/addreminder');
                    }
                }
                $this->load->view('admin/includes/header');
                $data['page_name'] = 'editreminder/' . $VisitorID . "/" . $ID;
                $data['loading_button'] = getLoadingButton();
                $data['VisitorID'] = $VisitorID;
                $data['visit'] = $this->visitor_model->getByID($VisitorID);
                $data['data'] = $this->visitor_model->getReminderByID($ID);
                $data['Sites'] = getSites($VisitorID, $data['data']->SitesID);
                $this->load->view('admin/user/visitor/add_editfollowup', $data);
                $array['page_level_js'] = $this->load->view('admin/user/visitor/add_editfollowup_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $array);
                unset($data, $array);
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

        public function addresponse()
        {
            if ($this->input->post()) {
                $data = $this->visitor_model->addResponse();
                if (@$data->ID) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }

        public function changeReminderStatus()
        {
            try {
                if ($this->cur_module->is_status == 0) {
                    echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                    die;
                }
                if ($this->input->post()) {
                    $res = $this->visitor_model->changeReminderStatus($this->input->post());
                    if ($res) {
                        $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                        echo json_encode(array('result' => 'success', 'message' => $message));
                    } else {
                        echo json_encode(array('result' => 'error', label('please_try_again')));
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();

                $error_array = array(
                    "error_message" => $e->getMessage(),
                    "method_name" => __CLASS__ . '->' . __FUNCTION__,
                    "Type" => $this->session->user_data['UserType'] . " Web",
                    "User_Agent" => getUserAgent()
                );
                $this->common_model->insertAdminError($error_array);
            }
        }

        public function export_to_excel()
        {

            if ($this->cur_module->is_export == 0)
                show_404();
            //load our new PHPExcel library
            $this->load->library('excel');
            $res['visitor'] = $this->visitor_model->listData(-1, 1);

            $dataResult['result'] = array();
            if (!empty($res['visitor'])) {
                $dataResult['result'] = $res['visitor'];
            }
            $fields = array("SrNo", "EmployeeName", "FirstName", "LastName", "EmailID", "MobileNo", "LeadType", "InquiryDate", "SitesCount", "Requirenment", "Address", "CompanyName", "Designation");
            //Header Define
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
            if (!empty($res['visitor'])) {
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
            ob_end_clean();
            $filename = 'Visitor.xls';
            //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel');
            //mime type
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter->save('php://output');
            //readfile("designation.xls");
        }

        public function importe()
        {

            $created_by = $this->session->userdata['UserID'];
            $IPAddress = GetIP();
            $usertype = 'Admin Web';
            $file = @$_FILES['userfile']['tmp_name'];

            $csv_mimetypes = array(
                'text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt',
            );
            $info = pathinfo($_FILES['userfile']['name']);

            if (!empty($file) && in_array($_FILES['userfile']['type'], $csv_mimetypes) && $info['extension'] == 'csv') {
                $handle = fopen($file, "r");
                $user_arr = array();
                $c = 0;
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {

                    if ($c != 0 && (@$filesop[1] != '' || @$filesop[2] != '' || @$filesop[4] != '' || @$filesop[9] != '' || @$filesop[10] != '')) {
                        $user_arr[$c]['SNo'] = @$filesop[0];
                        $user_arr[$c]['FirstName'] = @$filesop[1];
                        $user_arr[$c]['LastName'] = @$filesop[2];
                        $user_arr[$c]['EmailID'] = @$filesop[3];
                        $user_arr[$c]['MobileNo'] = @$filesop[4];
                        $user_arr[$c]['Address'] = @$filesop[5];
                        $user_arr[$c]['Profession'] = @$filesop[6];
                        $user_arr[$c]['CompanyName'] = @$filesop[7];
                        if (@$filesop[8] != '') {
                            $Designation_data = $this->visitor_model->getQueryResult("call usp_A_AddDesignationByCSV('" . @$filesop[8] . "','$created_by','$usertype','$IPAddress')");
                        }
                        $user_arr[$c]['DesignationID'] = (@$Designation_data[0]->ID > 0 && @$filesop[8] != '') ? $Designation_data[0]->ID : '0';
                        $user_arr[$c]['Requirement'] = array(@$filesop[9]);
                        $user_arr[$c]['Budget'] = @$filesop[10];
                        $user_arr[$c]['VisitSource'] = array(@$filesop[11]);
                        $user_arr[$c]['VisitorCenter'] = @$filesop[12];
                        $user_arr[$c]['OutDoorLocation'] = @$filesop[13];
                        $entrydate_list = explode(' ', @$filesop[14]);
                        $user_arr[$c]['EntryDate'] = @$entrydate_list[0];
                        $user_arr[$c]['EntryTime'] = @$entrydate_list[1];
                        $user_arr[$c]['Remarks'] = @$filesop[15];
                        $user_arr[$c]['ChannelPartner'] = @$filesop[16];
                        $user_arr[$c]['Status'] = 'on';
                    }
                    $c = $c + 1;
                }

                $failed_content = array();
                $succes_content = array();
                foreach ($user_arr as $key => $value) {

                    $validation = 1;
                    if ($value['FirstName'] == '' || $value['LastName'] == '' || $value['MobileNo'] == '' || $value['Budget'] == '' || $value['EntryDate'] == '' || empty($value['Requirement'])) {
                        $validation = 0;
                    }
                    if (preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) || preg_match('/^([0-9]{10})$/', $value['MobileNo'])) {
                        //echo 'Please enter a valid phone number';
                    } else {
                        $validation = 0;
                    }

                    if (!preg_match('/^([0-9]{0,9})$/', $value['Budget'])) {
                        $validation = 0;
                    }

                    $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                    if (!preg_match($emailval, $value['EmailID']) && $value['EmailID'] != '') {
                        $validation = 0;
                    }
                    if (ctype_alpha(str_replace(' ', '', $value['FirstName'])) === false || ctype_alpha(str_replace(' ', '', $value['LastName'])) === false) {
                        $validation = 0;
                    }

                    if ($validation == 1) {
                        $value['EmailID'] = str_replace(' ', '', trim($value['EmailID']));
                        $res = $this->visitor_model->insert($value);

                        if (@$res->ID) {
                            $succes_content[$key] = $user_arr[$key];
                        } else {
                            $failed_content[$key] = $user_arr[$key];
                            $msg = explode('~', $res->Message);
                            $failed_content[$key]["error_message"] = (@$msg[1]) ? $msg[1] : $res->Message;
                        }
                    } else {
                        $failed_content[$key] = $user_arr[$key];
                        $failed_content[$key]["error_message"] = 'Required fields are missing.';
                        // if(!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) && $value['MobileNo']!='') {
                        //     $failed_content[$key]["error_message"] .= '<br/>or Mobile number not valid.';
                        // }
                        if (preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) || preg_match('/^([0-9]{10})$/', $value['MobileNo'])) {
                            //echo 'Please enter a valid phone number';
                        } else {
                            $failed_content[$key]["error_message"] .= '<br/>or Mobile number not valid.';
                        }
                        $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                        if (!preg_match($emailval, $value['EmailID']) && $value['EmailID'] != '') {
                            $failed_content[$key]["error_message"] .= '<br/>or Email not valid.';
                        }
                        if (ctype_alpha(str_replace(' ', '', $value['FirstName'])) === false || ctype_alpha(str_replace(' ', '', $value['LastName'])) === false) {
                            $failed_content[$key]["error_message"] .= "<br/>or Name not contain letters only.";
                        }
                    }
                }
                // pr($succes_content);echo '<br/>';
                // pr($failed_content);echo '<br/>';
                $Content = '';
                /*$Content .= '<div><p><h4>Successfully inserted : </h4></p><p>';
                $Content .= '<table style="border:1px solid #C8C8C8;">';
                foreach ($succes_content as $key => $row) {
                    $Content .= '<tr>';
                    foreach ($row as $k => $val) { 
                        if($k=='Requirement'){
                            $Content .= '<td style="border:1px solid #D1D1D1;">'.(implode(',', $row['Requirement'])).'</td>';
                        }elseif($k=='VisitSource'){
                            $Content .= '<td style="border:1px solid #D1D1D1;">'.(implode(',', $row['VisitSource'])).'</td>';
                        }else{
                            $Content .= '<td style="border:1px solid #D1D1D1;">'.$val.'</td>';
                        }
                    }
                    $Content .= '</tr>';
                }
                $Content .= '</table></p></div>';*/

                $Content .= '<div><p><h4>Failed to insert : </h4></p><p>';
                $Content .= '<table style="border:1px solid #C8C8C8;">';
                foreach ($failed_content as $key => $row) {
                    $Content .= '<tr>';
                    foreach ($row as $k => $val) {
                        if ($k == 'Requirement') {
                            $Content .= '<td style="border:1px solid #D1D1D1;">' . (implode(',', $row['Requirement'])) . '</td>';
                        } elseif ($k == 'VisitSource') {
                            $Content .= '<td style="border:1px solid #D1D1D1;">' . (implode(',', $row['VisitSource'])) . '</td>';
                        } else {
                            $Content .= '<td style="border:1px solid #D1D1D1;">' . $val . '</td>';
                        }
                    }
                    $Content .= '</tr>';
                }
                $Content .= '</table></p></div>';

                $cc = '';
                $User_data = $this->visitor_model->getQueryResult("call  usp_M_getDeviceByEmployee('$created_by','-1','-1')");
                foreach ($User_data as $k => $val) {
                    if ($created_by == $val->UserID) {
                        $FromEmailID = $val->EmailID;
                        $FirstName = $val->FirstName;
                        $LastName = $val->LastName;
                    }
                    $cc .=  (@$cc) ? $cc : ',' . $cc;
                }

                $this->load->model('admin/bulkmessage_model');
                $this->load->helper("phpmailerautoload");
                $MailBody = $this->bulkmessage_model->get_emailtemplate($id = 3);
                // $array['Attached'] = $PhotoURL;
                $array['ToEmailID'] = $FromEmailID;
                $array['CC'] = $cc;
                $array['Subject']  = DEFAULT_WEBSITE_TITLE . '- Status CSV Uploaded Of Visitor';
                $array['Body'] = $MailBody['Content'];
                $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                $array['FromName'] = DEFAULT_FROM_NAME;
                $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                $array['AltBody'] = '';
                $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{message}', '{base_url}');

                $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $FirstName, $LastName, $back_image_path, $Content, base_url());
                $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                //pr($array['Body']);exit();
                $res = CustomMail($array);
                if ($res == 1) {
                    $sendStatus = 1; //Success
                } else {
                }
                if (!empty($succes_content)) {
                    $this->session->set_flashdata('PostSuccess', 'CSV Uploaded, Please check your email for CSV status.');
                } else {
                    $this->session->set_flashdata('posterror', 'CSV Not proper, Please check your email for CSV status.');
                }
                redirect(base_url() . 'admin/user/visitor');
            } else {
                $this->session->set_flashdata('posterror', 'Please attach csv file for import visitor.');
                redirect(base_url() . 'admin/user/visitor');
            }
        }
    }
