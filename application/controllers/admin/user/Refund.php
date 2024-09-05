<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Refund extends Admin_Controller {

    public function __construct() {
        parent::__construct();       
        $this->cur_module = array();

        $this->load->model('admin/refund_model');
        $this->load->model('admin/customerproperty_model','property_model');
    }

    public  function index($ID = 0){

        $res = $data = array();
        $res['ID'] = $ID;
        $res['data'] = $this->property_model->getByID($ID);
        $res['CancelProperty'] = $this->refund_model->getCancelByCPID($ID);
        if($ID == 0 || $res['data']->IsCancelled == 0){
            show_404();
            exit;
        }
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45,". @$res['data']->ProjectID.")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();           
        }
        $this->load->view('admin/includes/header');
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/user/refund/list',$res);
        $data['page_level_js'] = $this->load->view('admin/user/refund/list_js', NULL, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($res,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $CustomerPropertyID = $this->input->post('CustomerPropertyID');
        $CustomerProperty = $this->property_model->getByID($CustomerPropertyID);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45,". @$CustomerProperty->ProjectID.")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();


        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        
        $CancelProperty = $this->refund_model->getCancelByCPID($CustomerPropertyID);
        $result['IsDealClosed'] = $CancelProperty->IsDealClosed;
        $result['data_array'] = $this->refund_model->listData($per_page_record  , $page_number);
        if(@$result['data_array'][0]->Message)
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/user/refund/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="10" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
   
    public function add($CustomerPropertyID = 0) {
        $CustomerProperty = $this->property_model->getByID($CustomerPropertyID);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45,". @$CustomerProperty->ProjectID.")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if($this->cur_module->is_insert == 0 || $CustomerProperty->IsDealClosed == 1)
                        show_404();
        if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('RefundDate', 'RefundDate', 'trim|required');
                $this->form_validation->set_rules('BankName', 'BankName', 'trim|required');
                $this->form_validation->set_rules('BranchName', 'BranchName', 'trim|required');
                if($this->form_validation->run() == TRUE){
                    $data = $this->input->post();
                    $res = $this->refund_model->insert($this->input->post());
                    if(@$res->ID){
                        redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID . "#refund");
                    }else{
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/refund/add/'.$CustomerPropertyID);
                    }
                }else{
                    
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/refund/add/'.$CustomerPropertyID);
                }
            } 
            else {
                $result = array();
                $result['loading_button'] = getLoadingButton(); 
                $result['Page'] = 'add/'.$CustomerPropertyID;
                $result['CustomerPropertyID'] = $CustomerPropertyID;
                $result['CancelProperty'] = $this->refund_model->getCancelByCPID($CustomerPropertyID);
                $this->load->view('admin/includes/header');
                $this->load->view('admin/user/refund/add_edit', $result);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/user/refund/add_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data);
            }

    }
    public  function edit($ID = 0)
    {   
        $result['data'] = $this->refund_model->getByID($ID);
        $CustomerProperty = $this->property_model->getByID(@$result['data']->CustomerPropertyID);
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",45,". @$CustomerProperty->ProjectID.")");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if($this->cur_module->is_edit == 0 || $CustomerProperty->IsDealClosed == 1)
                show_404();

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('RefundDate', 'RefundDate', 'trim|required');
            $this->form_validation->set_rules('BankName', 'BankName', 'trim|required');
            $this->form_validation->set_rules('BranchName', 'BranchName', 'trim|required');
            
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();

                $res = $this->refund_model->update($data);
                $CustomerPropertyID = $this->input->post('CustomerPropertyID');
                if(@$res->ID){
                    redirect($this->config->item('base_url') . 'admin/user/property/details/'.$CustomerPropertyID . "#refund");
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/refund/edit/'.$ID);
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/refund/edit/'.$ID);
            }
        }else{

            $result = array();
            $data['ProjectID'] = $ID;
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/'.$ID;
            $result['data'] = $this->refund_model->getByID($ID);
            if(@$result['data']->Message){
                show_404();
                die;
            }
            $result['CustomerPropertyID'] = $result['data']->CustomerPropertyID;
            $result['CancelProperty'] = $this->refund_model->getCancelByCPID($result['CustomerPropertyID']);
            $this->load->view('admin/includes/header');     
            $this->load->view('admin/user/refund/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/refund/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }
    public function ChangeRefund($id = 0){
        $res = $this->refund_model->ChangeRefund($id);
        if(@$res->ID){
            echo 1;
        }else{
            echo 0;
        }


    }
     
    public function getReamainingPayment($ID = 0,$CPID = 0){
        $res = $this->refund_model->getRemainingAmount($ID,$CPID);
        $res1 = $this->refund_model->getGSTRemainingAmount($ID,$CPID);
        echo json_encode(array('RemainingAmount'=>@$res->TotalRemainingAmount, 'RemainingGSTAmount'=>@$res1->TotalGSTRemainingAmount));
    }    
    public function export_to_excel() {
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $res['Data'] = $this->refund_model->listProject(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['Data'])) {
            $dataResult['result'] = $res['Data'];
        }
        $fields = array("SrNo", "Title", "Location", "Description", "GroupName"); 
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
        if (!empty($res['Data'])) {
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
        $filename = 'Project.xls'; 
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
