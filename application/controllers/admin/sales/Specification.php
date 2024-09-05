<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Specification extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",31,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (@$this->cur_module->is_view != 1) {
            show_404();
        }
        $this->load->model('admin/specification_model');
    }
    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['ProjectID'] = $this->input->post('ProjectID');
        $result['data_array'] = $this->specification_model->listData($per_page_record, $page_number);
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $ajax_listing = $this->load->view('admin/propertys/specification/ajax_listing', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }
    function changeStatus()
    {
        try {
            if ($this->input->post()) {
                $res = $this->specification_model->changeStatus($this->input->post());
                if ($res) {
                    $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                    echo json_encode(array('result' => 'success', 'message' => $message));
                } else {
                    echo json_encode(array('result' => 'error', label('please_try_again')));
                }
            }
        } catch (Exception $e) {
            echo json_encode(array('result' => 'error', 'message' => $e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function add($ProjectID)
    {
        if ($this->cur_module->is_insert == 0)
            show_404();
        try {
            $data = $array = array();
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('InstalmentNo', 'InstalmentNo', 'trim|required');
                $this->form_validation->set_rules('MileStone', 'MileStone', 'trim|required');
                $this->form_validation->set_rules('Percentage', 'Percentage', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $data['SaleInventoryID'] = $ProjectID;
                    $res = $this->specification_model->insert($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/sales/property/details/' . $ProjectID . '#milestone');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);

                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/sales/specification/add/' . $ProjectID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/sales/specification/add/' . $ProjectID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['Page'] = 'add/' . $ProjectID;
            $data['ProjectID'] = $ProjectID;
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/propertys/specification/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/propertys/specification/add_js', NULL, TRUE);
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
    public  function edit($ProjectID = 0, $ID = 0)
    {
        if ($this->cur_module->is_edit == 0)
            show_404();
        if ($ProjectID == 0 || $ID == 0) {
            show_404();
            die;
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('InstalmentNo', 'InstalmentNo', 'trim|required');
            $this->form_validation->set_rules('MileStone', 'MileStone', 'trim|required');
            $this->form_validation->set_rules('Percentage', 'Percentage', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['PropertyspecificationID'] = $ID;
                $data['SaleInventoryID'] = $ProjectID;
                $res = $this->specification_model->update($data);
                if (@$res->ID) {
                    redirect($this->config->item('base_url') . 'admin/sales/property/details/' . $ProjectID . '#milestone');
                } else {
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/sales/specification/edit/' . $ProjectID . "/" . $ID);
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/sales/specification/edit/' . $ProjectID . "/" . $ID);
            }
        } else {
            $result = array();
            $result['ProjectID'] = $ProjectID;
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/' . $ProjectID . "/" . $ID;
            $result['MileStone'] = $this->specification_model->getByID($ID);
            if (@$result['MileStone']->Message) {
                show_404();
                die;
            }
            $this->load->view('admin/includes/header');
            $this->load->view('admin/propertys/specification/add_edit', $result);
            $data['page_level_js'] = $this->load->view('admin/propertys/specification/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $data);
        }
    }
}
