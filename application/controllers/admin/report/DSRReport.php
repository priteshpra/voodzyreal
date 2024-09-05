<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DSRReport extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/report_model');
        $this->load->model('admin/common_model');
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/feedback_model');
        $this->load->model('admin/userfeedback_model');
        $this->load->model('admin/opportunity_model');
        $this->load->model('admin/sites_model');
        $this->load->model('admin/employee_model');

        $this->load->helper("phpmailerautoload");

        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",57,0)");
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
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            $data['data'] = $this->common_model->getEmployee();
        }
        else{
            $data['data'] = $this->employee_model->getemployeeBYIDList($this->session->userdata['UserID']);
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/dsrreport/list', $data);
        $data['page_level_js'] = $this->load->view('admin/report/dsrreport/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) 
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        
        $result['data_araay'] = $this->report_model->GetDSRReport($per_page_record, $page_number);

        if(!isset($result['data_araay'][0]->UserFeedbackID))
            $result['total_records'] = 0;
        else{
           $result['total_records'] = $result['data_araay'][0]->rowcount;
        }
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/report/dsrreport/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b'=>''));
    }

    public function dataajax_listing($PageSize = 10, $CurrentPage = 1) 
    {
        $result = array();
        $data = array();

        $data = $this->input->post();

        $result['per_page_record'] = $PageSize;
        $result['page_number'] = $CurrentPage;
        $result['Type'] = $data['Type'] ;

        if ($data['Type'] == 'Visitor') {
            $result['data_araay'] = $this->visitor_model->DSRVisitorlistData($PageSize,$CurrentPage);
        }
        else{
            $result['data_araay'] = $this->opportunity_model->DSROpportunitylistData($PageSize,$CurrentPage);
        }
                
        if(isset($result['data_araay'][0]->Message))
            $result['total_records'] = 0;
        else{
           $result['total_records'] = @$result['data_araay'][0]->rowcount;
        }

        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $ajax_listing = $this->load->view('admin/report/dsrreport/dataajax_listing', $result,TRUE);

        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b'=>''));
    }

    public function sitesajax_listing(){
        $result = array();
        $result['per_page_record'] = -1;
        $result['page_number'] = 1;
        $result['visitorsites'] = $this->sites_model->listData(-1,1);
        if (isset($result['visitorsites'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['visitorsites'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/dsrreport/sitesajax_listing', $result,TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
    }

    public function add() {
        if(@$this->cur_module->is_insert == 0)
                    show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $data = $this->input->post();
            if ($data['Type']=='Visitor') {
                $data['VisitorID'] = $data['ID'];
            }
            else{
                $data['OpportunityID'] = $data['ID'];
            }
            //$data['FeedbackID'] = str_replace ('Feedback_','', $data['FeedbackID']);
            $res = $this->userfeedback_model->DSRReportInsert($data);
            if (@$res->ID) {
                redirect(site_url( 'admin/report/dSRReport'));
            }else{
                $msg = label('please_try_again');
                if(@$res->Message){
                    $arr = explode('~',$res->Message);
                    $msg = @$arr[1];
                }
                $this->session->set_flashdata('posterror', $msg);
                redirect(site_url( 'admin/report/dSRReport/add'));
            }
           
        }
        
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $data['reason_array'] = $this->feedback_model->ListData(-1, 1);
        $data['feedback'] = getFeedbackComboBox();
        $data['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $data['projects'] = getProject(0,-1,$this->UserRoleID);
        $data['page_level_js'] = $this->load->view('admin/report/document/list_js', $data, TRUE);
        $this->load->view('admin/report/dsrreport/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/report/dsrreport/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/add_feedback_model', $data);
        $this->load->view('admin/includes/footer', $res);
        unset($data,$res);
    }

    public function adminDSRReportPDF(){
        $result = array();
        $result['employee'] = $this->common_model->getEmployee();
        $_POST['EmployeeID'] = 2;
        $_POST['ReportDate'] = date('d-m-Y');
        //$result['project'] = $this->userfeedback_model->getProjectByRoleID($result['employee'][0]);
        $result['data'] = $this->report_model->GetDSRReport(-1,1);        

        $html = '';

        $Walk_In=0;
        $Revisit=0;

        $result['dsrttotalvisitcount'] = $this->userfeedback_model->getDSRTotalVisitCount();
        $result['dsrtbrokercount'] = $this->userfeedback_model->getDSRTotalBrokerCount();

        foreach ($result['dsrttotalvisitcount'] as $key => $vs) {
            if ($vs->Count == 1) {
                $Walk_In=$Walk_In+1;
            }
            elseif ($vs->Count > 1) {
                $Revisit=$Revisit+1;
            }
        }

        $html .='<html><head>';
                    $html .= '<style>
                            table, td {
                              border: 1px solid black;
                              border-collapse: collapse;
                            }
                            th, td {
                              padding: 7px;
                            }
                            th{
                                border: 1px solid black;
                                border-collapse: collapse;
                                background-color:#D9D9D9;
                             }
                        </style></head><body>';

        $html .= '<h4>Walk-in: '.$Walk_In.'</h4>';
        $html .= '<h4>Revisit: '.$Revisit.'</h4>';
        $html .= '<h4>From Broker: '.$result['dsrtbrokercount']->Count.'</h4>';

        $result['dsrtleadscount'] = $this->userfeedback_model->getDSRLeadsCount();

        foreach ($result['dsrtleadscount'] as $key => $leadcount) {
            $html .= '<h4>Leads from '.$leadcount->LeadType.': '.$leadcount->Count.'</h4>';
        }
            
        $TotalCalling=0;
        $result['dsrtotalcallingcount'] = $this->userfeedback_model->getDSRTotalCallingCount(1);

        foreach ($result['dsrtotalcallingcount'] as $key => $totalcall) {
            $TotalCalling=$TotalCalling+$totalcall->Count;

        }

        $html .= '<h4>Total Calling : '.$TotalCalling.'</h4>';

        foreach ($result['dsrtotalcallingcount'] as $key => $callcount) {
            $html .= '<h4>'.$callcount->UserFeedback.' : '.$callcount->Count.'</h4>';
        }
                
        $html .= '<table border="1" cellpadding="8">
                  <tr>
                    <th><b>Walk-in Date</b></th>
                    <th><b>Client Name</b></th>
                    <th><b>Mobile No</b></th>
                    <th><b>Reference</b></th>
                    <th><b>Requirements</b></th>
                    <th><b>Project</b></th>
                    <th><b>Feedback</b></th>
                    <th><b>Remarks</b></th>
                  </tr>
                  ';

        foreach ($result['data'] as $key => $value) {
            if($value->VisitorID > 0) {
                $Name = $value->VisitorName;
                $Mobile =  $value->MobileNo;
                $Requirements = @$value->Requirement.' ('.@$value->PropertyInterest.')';
            }
            else{
                $Name = $value->OpportunityName;
                $Mobile =  $value->mobile;
                $Requirements = '';
            }
            $html .= '
                  <tr>
                    <td>03-02-2020</td>
                    <td>'.$Name.'</td>
                    <td>'.$Mobile.'</td>
                    <td>'.@$value->FeedbackType.'</td>
                    <td>'.$Requirements.'</td>
                    <td>'.@$value->ProjectName.'</td>
                    <td>'.@$value->Feedback.'</td>
                    <td>'.@$value->Remarks.'</td>
                  </tr>
                  ';
        }

        $html .= ' </table><br/>';

        foreach ($result['project'] as $key => $value) {

            $resul['dsrprojectcount'] = $this->userfeedback_model->getDSRProjectCount($value->ProjectID);

            $html .= '<table border="1" cellpadding="8">
                  <tr>
                    <td colspan="2" style="text-align:center;"><b>'.$value->Title.' VISIT TILL ON '.date("d-m-Y").'</b></td>
                  </tr>';

            $html .= '      
                  <tr>
                    <td>Total Visit</td>
                    <td>'.$resul['dsrprojectcount'][0]->TotalVisitor.'</td>
                  </tr>';
            foreach ($resul['dsrprojectcount'] as $key => $val) {
                 $html .= '      
                  <tr>
                    <td>'.$val->Feedback.'</td>
                    <td>'.$val->FeedbackCount.'</td>
                  </tr>';
            }
           
                  
            $html .= ' </table><br/>';
        }
        
        $config = array();
        $config['ToEmailID'] = 'upexa.saggisoftsolutions@gmail.com';
        $config['Subject'] = 'DSR Report_Upexa Patel_05-02-2020';
        $config['Body'] = $html;

        CustomMail($config);
    
    }


    public function export_to_excel() {

        
        //load our new PHPExcel library
        $this->load->library('excel');
        
        $result['data_array'] = $this->report_model->GetDSRReport(-1,1);

        /*pr($result['data_array']);
        die(); */
        
        $dataResult['result'] = array();

        if (!empty($result['data_array'])) {
            $dataResult['result'] = $result['data_array'];
        }

        $fields = array("SrNo","FeedbackType", "VisitorName","OpportunityName","OpportunityType","Feedback","Remarks", "CallStartDateTime","CallEndDateTime","MobileNo","mobile","EmailID","email");
       
        
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

        if (!empty($result['data_array']) && !@$result['data_array']->Message) {
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
        $filename = 'DSRReport.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
