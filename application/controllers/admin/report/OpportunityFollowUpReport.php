<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class OpportunityFollowUpReport extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/report_model');
        $this->load->model('admin/common_model');
        $this->load->model('admin/employee_model');
        $this->load->model('admin/feedback_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",60,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }

    }

    public function index() 
    {
        $data = $res = array();
        
        $data['Role'] = $this->report_model->ReportRole();
        $data['reason_array'] = $this->feedback_model->ListData(-1, 1);
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            $data['data'] = $this->common_model->getEmployee();
        }
        else{
            $data['data'] = $this->employee_model->getemployeeBYIDList($this->session->userdata['UserID']);
        }

        $data['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);

        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/opportunityfollowupreport/list', $data);
        $this->load->view('admin/includes/add_feedback_model', $data);
        $data['page_level_js'] = $this->load->view('admin/report/opportunityfollowupreport/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) 
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        
        $result['data_araay'] = $this->report_model->GetOpportunityFollowupReport($per_page_record, $page_number);
        if(!isset($result['data_araay'][0]->OpportunityReminderID))
            $result['total_records'] = 0;
        else{
           $result['total_records'] = $result['data_araay'][0]->rowcount;
        }
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/report/opportunityfollowupreport/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="15" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b'=>''));
    }

    

    public function export_to_excel() {
        
        //load our new PHPExcel library
        $this->load->library('excel');
        $div = $this->input->post('ReportType');
        
        $result['data_array'] = $this->report_model->GetOpportunityFollowupReport(-1,1);

          /*pr($result['data_array']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($result['data_array'])) {
            $dataResult['result'] = $result['data_array'];
        }

        $fields = array("SrNo", "EmployeeFirstName","EmployeeLastName","Type","name","mobile","email","Message", "ReminderDate","PastDate","ReminderMessage","ReminderPastDate","ReminderReminderDate");
       
        
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
        if (!empty($result['data_array']) && !$result['data_array']->Message) {
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
        $filename = 'OpportunityReminder.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
