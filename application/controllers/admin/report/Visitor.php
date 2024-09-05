<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",64,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (@$this->cur_module->is_view != 1) {
            show_404();
        }
        $this->load->model('admin/report_model');
        $this->load->model('admin/config_model');
        $this->load->model('admin/feedback_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function index()
    {
        $res = $data = array();
        $this->load->view('admin/includes/header');
        $res['projects'] = getProject(0, -1, $this->UserRoleID);
        $res['designation'] = getDesignation();
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $res['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $res['employee'] = getEmployee();
        $res['designation'] = getDesignation();
        $res['reason_array'] = $this->feedback_model->ListData(-1, 1);
        $this->load->view('admin/report/visitor/list', $res);
        $data['page_level_js'] = $this->load->view('admin/report/visitor/list_js', NULL, TRUE);
        $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/report/visitor/add';
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
        $result['visitor'] = $this->report_model->VisitorFromEndDatelistData($per_page_record, $page_number);
        if (isset($result['visitor'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['visitor'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/visitor/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }


    public function export_to_excel()
    {

        if ($this->cur_module->is_export == 0)
            show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['visitor'] = $this->report_model->VisitorFromEndDatelistData(-1, 1);

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
        $filename = 'VisitorReports.xls';
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel');
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("designation.xls");
    }
}
