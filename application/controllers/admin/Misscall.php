<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Misscall extends Admin_Controller {

    public function __construct() {
        parent::__construct();       
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",48,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();           
        }
        $this->load->model('admin/misscall_model');
    }

    public  function index($per_page_record = 10  , $page_number = 1){
        $this->load->view('admin/includes/header');
        $project_result = $data = array();
        $project_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/misscall/list',$project_result);
        $data['page_level_js'] = $this->load->view('admin/misscall/list_js', NULL, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($project_result,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['project_array'] = $this->misscall_model->listData($per_page_record  , $page_number);
        if(@$result['project_array'][0]->Message)
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['project_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        $ajax_listing = $this->load->view('admin/misscall/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function export_to_excel() {
        
        if($this->cur_module->is_export == 0)
                        show_404();
        //load our new PHPExcel library
        $this->load->library('excel');
        $area_result['area'] = $this->misscall_model->listData(-1, 1);

        $dataResult['result'] = array();
        if (!empty($area_result['area'])) {
            $dataResult['result'] = $area_result['area'];
        }
        $fields = array("SrNo", "MsgId","LongCode","RcvFrom","RcvTime","MsgText"); 
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
        if (!empty($area_result['area'])) {
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
        $filename = 'Misscall.xls'; 
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); 
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); 
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("area.xls");
    }
   
}
