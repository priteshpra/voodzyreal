<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Video extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",21," . $this->ProjectID . ")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        $this->load->model('admin/document_model');
    }
    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['CustomerID'] = $this->input->post('CustomerID');
        $result['IsCancelled'] = $this->input->post('IsCancelled');
        $result['data_array'] = $this->document_model->videoListData($per_page_record, $page_number);
        if (isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $ajax_listing = $this->load->view('admin/user/video/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else {
            echo json_encode(array('a' => '<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
        }
    }

    function changeStatus()
    {
        try {
            if ($this->input->post()) {
                $res = $this->document_model->changeStatus($this->input->post());
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
}
