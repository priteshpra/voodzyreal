<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Opportunity extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",60,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/opportunity_model');
        $this->load->model('admin/feedback_model');
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/requirement_model');

        $this->load->model('admin/reason_model');

        $this->load->model('api/master_model', '', TRUE);

        $reminder_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",24,0)");
        $reminder_tmp->next_result();
        $this->reminder_module = $reminder_tmp->row();
        $this->configdata = $this->config_model->getConfig();
        $this->RequirenmentData = $this->requirement_model->ListData(-1, 1);
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['reason_array'] = $this->feedback_model->ListData(-1, 1);

        if ($this->session->userdata['RoleID'] == -1) {
            $array['employee'] = getEmployee();
        } else {
            $array['employee'] = getEmployee($this->session->userdata['UserID']);
        }

        $array['projects'] = getProject(0, -1, $this->UserRoleID);
        $array['feedback'] = getFeedbackComboBox();
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $array['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $this->load->view('admin/opportunity/list', $array);
        $data['page_level_js'] = $this->load->view('admin/opportunity/list_js', NULL, TRUE);
        $this->load->view('admin/includes/add_feedback_model', $array);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['per_page_record'] = $PageSize;
        $res['page_number'] = $CurrentPage;
        $res['data_array'] = $this->opportunity_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/opportunity/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function dash_ajax_listing($per_page_record = 10, $page_number = 1)
    {

        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_araay'] = $this->opportunity_model->DashboardFollowUplistData($per_page_record, $page_number);
        if (!isset($result['data_araay'][0]->OpportunityReminderID))
            $result['total_records'] = 0;
        else {
            $result['total_records'] = $result['data_araay'][0]->rowcount;
        }

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

        $ajax_listing = $this->load->view('admin/opportunity/ajax_listing_dashboard', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }

    public function leadajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['per_page_record'] = $PageSize;
        $res['page_number'] = $CurrentPage;
        $res['data_array'] = $this->opportunity_model->listLeadProcess($PageSize, $CurrentPage);
        if (!isset($res['data_array'][0]->LeadProcessID))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/opportunity/lead_ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function assignalert()
    {
        $data = $this->opportunity_model->listAssignNotificationData();

        if (isset($data['0']->OpportunityID)) {
            $datastr = '';
            foreach ($data as $key => $value) {
                $datastr .= 'Assign Lead ' . $value->Name;
            }
            echo json_encode($datastr);
        } else {
            echo json_encode('');
        }
    }

    public function reminderalert()
    {
        $data = $this->opportunity_model->listReminderNotificationData();
        if (isset($data['0']->OpportunityReminderID)) {
            $datastr = '';
            foreach ($data as $key => $value) {
                $datastr .= 'Lead of ' . $value->name . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';
            }
            echo json_encode($datastr);
        } else {
            echo json_encode('');
        }
    }

    public function add()
    {
        try {
            if (@$this->cur_module->is_insert == 0)
                show_404();
            $data = $array = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Name', 'Name', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $res = $this->opportunity_model->Insert($this->input->post());
                    if (@$res->ID) {
                        delete_cookie('RemoveCount');
                        redirect($this->config->item('base_url') . 'admin/opportunity');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);

                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/opportunity/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/opportunity/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['employee'] = getEmployee($this->session->userdata['UserID']);
            $data['Area'] = getAreaComboBox();
            $data['projects'] = getProject(0, -1, $this->UserRoleID);
            $this->load->view('admin/opportunity/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/opportunity/add_edit_js', NULL, TRUE);
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
        $data = $res = array();
        $data['visitor'] = $this->opportunity_model->GetByID($ID);
        if (@$this->cur_module->is_edit == 0)
            show_404();
        if (@$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/opportunity'));
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $res = $this->opportunity_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/opportunity'));
                } else {
                    $msg = label('please_try_again');
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/opportunity/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/opportunity/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['loading_button'] = getLoadingButton();
        $data['employee'] = getEmployee($this->session->userdata['UserID']);
        $data['Area'] = getAreaComboBox($data['visitor']->Area);
        $data['projects'] = getProject(0, -1, $this->UserRoleID);

        $this->load->view('admin/opportunity/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/opportunity/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }


    public function assign($ID)
    {
        try {
            if (@$this->cur_module->is_insert == 0)
                show_404();
            $data = $array = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('OpportunityID', 'OpportunityID', 'trim|required');
                $this->form_validation->set_rules('UserID', 'UserID', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $AssignData = $this->input->post();
                    $res = $this->opportunity_model->updateAssignLead($AssignData);
                    delete_cookie('RemoveCount');
                    if (@$res->ID) {

                        $_opportunity = $this->master_model->getQueryResult("call usp_A_GetOpportunityByID('" .
                            $AssignData['OpportunityID'] . "')");

                        $datastr =  'New Lead Assign Name is (' . $_opportunity['0']->Name . ')';

                        $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                            $AssignData['UserID'] . "')");

                        if (!isset($EmployeeData['0']->Message)) {
                            foreach ($EmployeeData as $key => $devicevalue) {
                                $pushNotificationArr = array(
                                    'device_id' => $devicevalue->DeviceTokenID,
                                    'message' =>  $datastr,
                                    'title' => 'Lead Reminder',
                                    'event' => '',
                                    'ActionType' => '',
                                    'detail' => ''
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                        }

                        $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");
                        foreach ($Userata as $key => $value) {
                            $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                                $value->UserID . "')");


                            if (!isset($EmployeeData['0']->Message)) {
                                foreach ($EmployeeData as $key => $devicevalue) {
                                    $pushNotificationArr = array(
                                        'device_id' => $devicevalue->DeviceTokenID,
                                        'message' =>  $datastr,
                                        'title' => 'Lead Reminder',
                                        'event' => '',
                                        'ActionType' => '',
                                        'detail' => ''
                                    );
                                    $res = sendPushNotification($pushNotificationArr);
                                }
                            }
                        }

                        redirect($AssignData['PreviousURL']);
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);

                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/opportunity/assign');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/opportunity/assign');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'assign';
            $data['loading_button'] = getLoadingButton();
            $data['employee'] = getEmployee($this->session->userdata['UserID']);
            $data['ID'] = $ID;
            $this->load->view('admin/opportunity/assignadd_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/opportunity/assignadd_edit_js', NULL, TRUE);
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

    public function reassign($ID)
    {
        try {
            $data = $array = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('OpportunityID', 'OpportunityID', 'trim|required');
                $this->form_validation->set_rules('UserID', 'UserID', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $res = $this->opportunity_model->updateReAssignLead($data);
                    delete_cookie('RemoveCount');
                    if (@$res->ID) {

                        $_opportunity = $this->master_model->getQueryResult("call usp_A_GetOpportunityByID('" .
                            $data['OpportunityID'] . "')");

                        $datastr =  'ReAssign Lead Name is (' . $_opportunity['0']->Name . ')';

                        $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                            $data['UserID'] . "')");

                        if (!isset($EmployeeData['0']->Message)) {
                            foreach ($EmployeeData as $key => $devicevalue) {
                                $pushNotificationArr = array(
                                    'device_id' => $devicevalue->DeviceTokenID,
                                    'message' =>  $datastr,
                                    'title' => 'Lead Reminder',
                                    'event' => '',
                                    'ActionType' => '',
                                    'detail' => ''
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                        }

                        $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");
                        foreach ($Userata as $key => $value) {
                            $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                                $value->UserID . "')");


                            if (!isset($EmployeeData['0']->Message)) {
                                foreach ($EmployeeData as $key => $devicevalue) {
                                    $pushNotificationArr = array(
                                        'device_id' => $devicevalue->DeviceTokenID,
                                        'message' =>  $datastr,
                                        'title' => 'Lead Reminder',
                                        'event' => '',
                                        'ActionType' => '',
                                        'detail' => ''
                                    );
                                    $res = sendPushNotification($pushNotificationArr);
                                }
                            }
                        }

                        redirect($this->config->item('base_url') . 'admin/opportunity');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);

                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/opportunity/reassign');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/opportunity/reassign');
                }
            }
            $this->load->view('admin/includes/header');
            $data['reason_array'] = $this->reason_model->ListData(-1, 1);
            $data['page_name'] = 'reassign';
            $data['loading_button'] = getLoadingButton();
            $data['employee'] = getEmployee($this->session->userdata['UserID']);
            $data['ID'] = $ID;
            $this->load->view('admin/opportunity/reassignadd_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/opportunity/reassignadd_edit_js', NULL, TRUE);
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

    public function convertToVisitor($ID = NULL)
    {

        try {
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $res = $this->visitor_model->insert($data);
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
            $data['page_name'] = 'add';
            $data['visitor'] = $this->opportunity_model->getByID($ID);

            if (empty($data['visitor'])) {
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/user/visitor/');
            }

            $data['loading_button'] = getLoadingButton();
            $data['designation'] = getDesignation();
            $data['employee'] = getEmployee($this->session->userdata['UserID']);
            $data['BirthMonth'] = getMonth('BirthMonth');
            $data['AnniversaryMonth'] = getMonth('AnniversaryMonth');

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

    public function ajax_followup($per_page_record = 10, $page_number = 1)
    {

        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['OpportunityID'] = $this->input->post('OpportunityID');
        $result['data_araay'] = $this->opportunity_model->listReminder($per_page_record, $page_number, $this->input->post('OpportunityID'));
        if (!isset($result['data_araay'][0]->OpportunityReminderID))
            $result['total_records'] = 0;
        else {
            $result['total_records'] = $result['data_araay'][0]->rowcount;
        }

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);

        $ajax_listing = $this->load->view('admin/opportunity/ajax_listing_followup', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="9" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }

    public function changeReminderStatus()
    {
        try {
            if ($this->reminder_module->is_status == 0) {
                echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->opportunity_model->changeReminderStatus($this->input->post());
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

    public function addreminder($OpportunityID = 0)
    {
        try {
            if ($OpportunityID == 0)
                show_404();
            if (@$this->reminder_module->is_insert == 0)
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
                    $data['OpportunityID'] = $OpportunityID;
                    $res = $this->opportunity_model->InsertReminder($data);
                    delete_cookie('RemoveCount');
                    if (@$res->ID) {
                        if (isset($data['PreviousURL'])) {
                            redirect($data['PreviousURL']);
                        } else {
                            redirect($this->config->item('base_url') . 'admin/opportunity/details/' . $OpportunityID . "#reminder");
                        }
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/opportunity/addreminder');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/opportunity/addreminder');
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'addreminder/' . $OpportunityID;
            $data['loading_button'] = getLoadingButton();
            $data['OpportunityID'] = $OpportunityID;
            $this->load->view('admin/opportunity/add_editfollowup', $data);
            $array['page_level_js'] = $this->load->view('admin/opportunity/add_editfollowup_js', NULL, TRUE);
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

    public function editreminder($OpportunityID = 0, $ID = 0)
    {
        try {
            if ($OpportunityID == 0 || $ID == 0)
                show_404();
            if (@$this->reminder_module->is_insert == 0)
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
                    $data['OpportunityID'] = $OpportunityID;
                    $res = $this->opportunity_model->EditReminder($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/opportunity/details/' . $OpportunityID . "#reminder");
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/opportunity/addreminder');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/opportunity/addreminder');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'editreminder/' . $OpportunityID . "/" . $ID;
            $data['loading_button'] = getLoadingButton();
            $data['OpportunityID'] = $OpportunityID;
            $data['data'] = $this->opportunity_model->getReminderByID($ID);
            $this->load->view('admin/opportunity/add_editfollowup', $data);
            $array['page_level_js'] = $this->load->view('admin/opportunity/add_editfollowup_js', NULL, TRUE);
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

    public function assignLead()
    {
        $this->opportunity_model->updateAssignLead();
        echo "Lead Assign Successfully.";
    }

    public function export_to_excel()
    {
        if ($this->cur_module->is_export == 0)
            show_404();
        $array = array();
        $fields = array(
            "Rno" => "Sr No",
            "Type" => "Source",
            "name" => "Name",
            "email" => "Email",
            "mobile" => "Mobile",
            "project" => "Project",
            "locality" => "Locality",
            "city" => "City",
            "msg" => "msg",
            "dt" => "Date",
            "time" => "Time",
            "VTime" => "VTime",
            "subject" => "subject",
            "tranType" => "tranType",
            "loginid" => "loginid",
            "ReminderMessage" => "Latest Status",
            "ReminderPastDate" => "Last Follow up Date",
            "ReminderReminderDate" => "Next Follow up Date"
        );

        $this->load->library('excel');
        $array['data'] = $this->opportunity_model->ListData(-1, 1);
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');
        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $key => $field) {
            $column = PHPExcel_Cell::stringFromColumnIndex($col);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field))
                ->getStyle($column . "1")->getFont()->setBold(true);
            $col++;
        }
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['data'] as $rr => $data) {
                if (@$data->Message) {
                    break;
                }
                $col = 0;
                foreach ($fields as $key => $field) {
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$key);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Opportunity.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function details($ID = 0)
    {
        $this->UserID = $ID;
        $data = array();
        $_POST['UserID'] = $data['OpportunityID'] = $ID;
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $data['data'] = $this->opportunity_model->getByID($ID);
        $data['loading_button'] = getLoadingButton();
        $data['page_level_js'] = $this->load->view('admin/opportunity/details_js', $data, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/opportunity/details', $data);
        $this->load->view('admin/includes/footer', $data);
        unset($data);
    }
}
