<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/report_model');
        $this->load->model('admin/feedback_model');
    }

    public function index()
    {
        $data = $res = array();
        if ($this->input->post()) {
            $div = $this->input->post('FilterDiv');
            $data['FilterType'] = $data[$div] = $this->input->post('FilterType');
            $data['ReportType'] = $div;
        } else {
            $data['ReportType'] = 'Visitor';
            $data['FilterType'] = $data['Visitor'] = 'Daily';
        }
        $data['reason_array'] = $this->feedback_model->ListData(-1, 1);
        $data['Role'] = $this->report_model->ReportRole();
        $data['projects'] = getProject(0, -1, $this->UserRoleID);
        $data['feedback_modal_popup'] = $this->load->view('admin/includes/userfeedback_modal_popup', NULL, TRUE);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/report/list', $data);
        $this->load->view('admin/includes/add_feedback_model', $data);
        $data['page_level_js'] = $this->load->view('admin/report/report/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $result = array();
        $result['per_page_record'] = $PageSize;
        $result['page_number'] = $CurrentPage;
        $result['data_array'] = $this->report_model->listData($PageSize, $CurrentPage);
        $div = $this->input->post('ReportType');
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/report/Ajax_' . $div, $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
        unset($result);
    }

    public function report1()
    {
        $this->load->view('admin/includes/header');
        $data['loading_button'] = getLoadingButton();
        $data['Project'] = getProject(0, -1, $this->UserRoleID);
        $this->load->view('admin/report/report/report1', $data);
        $array['page_level_js'] = $this->load->view('admin/report/report/report1_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $array);
        unset($data, $array);
    }

    public function export_to_excel()
    {
        if ($this->input->post()) {
        }
        //load our new PHPExcel library
        $this->load->library('excel');
        $div = $this->input->post('ReportType');
        $result['data_array'] = $this->report_model->listData(-1, 1);
        /*  pr($result['data_array']);
          die(); */
        $dataResult['result'] = array();

        if (!empty($result['data_array'])) {
            $dataResult['result'] = $result['data_array'];
        }
        //pr($dataResult['result']);exit;
        if ($div == "Visitor") {
            $fields = array("SrNo", "FirstName", "LastName", "EmployeeFirstName", "EmployeeLastName", "EmailID", "MobileNo", "ChannelPartner", "EntryDate", "Address", "Profession", "CompanyName", "Designation", "Requirement", "Budget", "Remarks"); //Header Define
        } elseif ($div == "Followup") {
            $fields = array("SrNo", "Message", "ReminderDate", "PastDate"); //Header Define
        } elseif ($div == "Booking") {
            $fields = array("SrNo", "PropertyNo", "SerialNo", "ChannelPartner", "CustomerFirstName", "CustomerLastName", "CustomerSFirstName", "CustomerSLastName", "PurchaseDate", "Amount", "GSTAmount", "RemainingPayment", "RemainingGSTPayment", "TotalNoOfPayment"); //Header Define
        } elseif ($div == "Collection") {
            $fields = array("SrNo", "PropertyNo", "MileStone", "PaymentDate", "PaymentMode", "PaymentAmount", "GSTAmount", "ChequeNo", "IFCCode", "AccountNo", "BankName", "BranchName"); //Header Define
        } else {
            $fields = array("SrNo", "PropertyNo", "RefundDate", "PaymentMode", "RefundAmount", "GSTAmount", "ChequeNo", "IFCCode", "AccountNo", "BankName", "BranchName"); //Header Define
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
        if (!empty($result['data_array']) && !@$result['data_array'][0]->Message) {
            foreach ($dataResult['result'] as $rr => $data) {

                $col = 0;
                foreach ($fields as $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;
                    if ($field == 'RemainingPayment' || $field == 'PaymentAmount' || $field == 'Amount') {
                        if ($data->is_price == 0)
                            $data->$field = "-";
                    }
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Report-' . @$this->input->post('ReportType') . '-' . @$this->input->post('FilterType') .  '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
    public function export_to_excel_report1()
    {
        $this->load->library('excel');
        $ProjectID = $this->input->post('ProjectID');
        $res['Fields'] = $this->report_model->ExportByProject();
        $dataResult['result'] = array();
        //Header Define
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($res['Fields'] as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field->Wings));
            $col++;
        }
        //Set Headers of Excel
        $SerialNo = 1;
        $col = 0;
        $red = "FF0000";
        $green = "3A7E1E";
        $orange = "0000FF";
        foreach ($res['Fields'] as $field) {
            $property = $this->report_model->GetPropertyByWings($field->Wings, $field->PrefixLen, $ProjectID);
            $row = 2;
            $column = PHPExcel_Cell::stringFromColumnIndex($col);
            foreach ($property as $key => $value) {
                $val = $value->PropertyNo;
                if ($value->Flag == "0") {
                    $color = $green;
                } else if ($value->Flag == "1") {
                    $color = $orange;
                    $val = $value->PropertyNo . "-" . $value->CustomerFirstName . " " . $value->CustomerLastName . "\nAmount: " . $value->Amount . "\nRemaining Amount: " . $value->RemainingPayment . "\nreceived Amount: " . $value->TotalPayment;
                } else if ($value->Flag == "2") {
                    $color = $red;
                    $val = $value->PropertyNo . "-" . $value->CustomerFirstName . " " . $value->CustomerLastName . "\nAmount: " . $value->Amount . "\nRemaining Amount: " . $value->RemainingPayment . "\nreceived Amount: " . $value->TotalPayment;
                } else {
                    $color = "";
                }
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val);
                $this->excel->getActiveSheet()
                    ->getStyle($column . $row)
                    ->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => $color)
                            ), 'font' => array(
                                'color' => array('rgb' => "FFFFFF")
                            ), 'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        )
                    )
                    ->getAlignment()->setWrapText(true);;
                $row++;
            }
            $col++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Allocated_report_project.xls';
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
