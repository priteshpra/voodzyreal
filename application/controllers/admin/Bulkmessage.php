  <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Bulkmessage extends Admin_Controller
    {

        function __construct()
        {
            parent::__construct();
            $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",34,0)");
            $tmp->next_result();
            $this->cur_module = $tmp->row();
            if (@$this->cur_module->is_view != 1) {
                show_404();
            }
            $this->load->model('admin/bulkmessage_model');
            $this->load->helper("phpmailerautoload");
        }

        public function index()
        {
            if ($this->input->post()) {
                $data = $this->input->post();

                //$res = $this->bulkmessage_model->insert($data);
                $details = $this->bulkmessage_model->GetDetails($data['Receiver'], @$data['ProjectID']);

                // pr($details); pr($this->input->post()); die;
                $Content = array();
                $msg_body = $this->input->post('Message');
                $sendStatus = 0;
                if ($data['Type'] == 'Mail') {
                    $Content = $this->bulkmessage_model->get_emailtemplate($id = 3);
                }
                if ($data['Receiver'] != 'Custome') {
                    foreach ($details as $key => $_result) {

                        if ($data['Type'] == 'SMS' && @$_result->MobileNo != '') {

                            if (@$_result->MobileNo != '') {
                                $res = sendSMS($_result->MobileNo, $msg_body);
                                if ($res['Status'] != 1) {
                                    $response['Error'] = 102;
                                    $response['Message'] = $res['Message'];
                                } else {
                                    $sendStatus = 1;
                                }
                            }
                        } elseif ($data['Type'] == 'Mail' && @$_result->EmailID != '' && !empty($Content)) {
                            //email otp functionality
                            // $Content = $this->bulkmessage_model->get_emailtemplate($id = 3);

                            // $array['Attached'] = $PhotoURL;
                            $array['ToEmailID'] = $_result->EmailID;
                            $array['Subject']  = DEFAULT_WEBSITE_TITLE . '- ' . $this->input->post('Subject');
                            $array['Body'] = $Content['Content'];
                            $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                            $array['FromName'] = DEFAULT_FROM_NAME;
                            $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                            $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                            $array['AltBody'] = '';
                            $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                            $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                            $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{message}', '{base_url}');

                            $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $_result->FirstName, $_result->LastName, $back_image_path,   $msg_body, base_url());
                            $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                            //pr($array['Body']);exit();
                            $res = CustomMail($array);
                            if ($res == 1) {
                                $sendStatus = 1; //Success
                            } else {
                            }
                        }
                    }
                } else {
                    $MobileData = explode(",", $data['S_MobileNo']);
                    for ($i = 0; $i < count($MobileData); $i++) {
                        $res = sendSMS($MobileData[$i], $msg_body);
                        if ($res['Status'] != 1) {
                            $response['Error'] = 102;
                            $response['Message'] = $res['Message'];
                        } else {
                            $sendStatus = 1;
                        }
                    }
                }
                if ($sendStatus == 1) {
                    redirect($this->config->item('base_url') . '/admin/bulkmessage?m=success');
                } else {
                    redirect($this->config->item('base_url') . '/admin/bulkmessage?m=err');
                }
            } else {
                $res = $data = array();
                $this->load->view('admin/includes/header');
                $res['loading_button'] = getLoadingButton();
                $res['Project'] = getProject();
                $this->load->view('admin/bulkmessage/index', $res);
                $data['page_level_js'] = $this->load->view('admin/bulkmessage/index_js', NULL, TRUE);
                $data['footer']['listing_page'] = 'no';
                $this->load->view('admin/includes/footer', $data);
                unset($res, $data);
            }
        }
    }
