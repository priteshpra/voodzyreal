<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Opportunity extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",71,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (empty($this->cur_module)) {
            show_404();
        }
        $this->load->model('admin/report_model');
        $this->load->model('admin/feedback_model');
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['reason_array'] = $this->feedback_model->ListData(-1, 1);
        $array['projects'] = getProject(0, -1, $this->UserRoleID);
        $array['feedback'] = getFeedbackComboBox();

        if ($this->session->userdata['RoleID'] == -1) {
            $array['employee'] = getEmployee();
        } else {
            $array['employee'] = getEmployee($this->session->userdata['UserID']);
        }
        
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $array['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $this->load->view('admin/report/opportunity/list', $array);
        $data['page_level_js'] = $this->load->view('admin/report/opportunity/list_js', NULL, TRUE);
        $this->load->view('admin/includes/add_feedback_model', $array);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['per_page_record'] = $PageSize;
        $res['page_number'] = $CurrentPage;
        $res['data_array'] = $this->report_model->OpportunityListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/report/opportunity/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="16" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
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
            "ReminderReminderDate" => "Next Follow up Date",
            "EmployeeName"=>"Employee Name"
        );

        $this->load->library('excel');
        // $array['data'] = $this->report_model->OpportunityAssignStatus(-1,1);
        $_POST['AssignType'] = 'Lost';
        $array['data'] = $this->report_model->OpportunityListData(-1, 1);
        
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
        $filename = 'OpportunityReports.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
