<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project extends Admin_Controller {

    public function __construct() {
        parent::__construct();       
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",29,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();           
        }
        $property_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",30,0)");
        $property_tmp->next_result();
        $this->property_module = $property_tmp->row();
        $milestone_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",31,0)");
        $milestone_tmp->next_result();
        $this->milestone_module = $milestone_tmp->row();
        $gallery_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",32,0)");
        $gallery_tmp->next_result();
        $this->gallery_module = $gallery_tmp->row();
        $rules_tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",33,0)");
        $rules_tmp->next_result();
        $this->rules_module = $rules_tmp->row();
        
        $this->load->model('admin/project_model');
    }

    public  function index($per_page_record = 10  , $page_number = 1){
        $this->load->view('admin/includes/header');
        $project_result = $data = array();
        $project_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $this->load->view('admin/project/list',$project_result);
        $data['page_level_js'] = $this->load->view('admin/project/list_js', NULL, TRUE);  
        
        $this->load->view('admin/includes/footer',$data);
        unset($project_result,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['project_array'] = $this->project_model->listProject($per_page_record  , $page_number);
        if(@$result['project_array'][0]->Message)
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['project_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/project/ajax_listing_project', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
   
    public function add() {
        if($this->cur_module->is_insert == 0)
                        show_404();
        if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Title', 'Title', 'trim|required');
                $this->form_validation->set_rules('Location', 'Location', 'trim|required');
                $this->form_validation->set_rules('Description', 'Description', 'trim|required');
                $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required');
                $this->form_validation->set_rules('ATSPercentage', 'ATSPercentage', 'trim|required');
                if($this->form_validation->run() == TRUE){
                    $res = $this->project_model->insert($this->input->post());
                    if(@$res->ID){
                        redirect($this->config->item('base_url') . 'admin/project/project');
                    }else{
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/project/project/add');
                    }
                }else{
                    
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/project/project/add');
                }
            } 
            else {
                $result = array();
                $result['group'] = getGroupCombobox();
                $result['loading_button'] = getLoadingButton(); 
                $result['page_name'] = 'add';
                $this->load->view('admin/includes/header');
                $this->load->view('admin/project/add_edit', $result);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/project/add_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data);
            }

    }
    public  function edit($ID = 0)
    {
        if($this->cur_module->is_edit == 0)
                show_404();        
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Title', 'Title', 'trim|required');
            $this->form_validation->set_rules('Location', 'Location', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required');
            $this->form_validation->set_rules('ATSPercentage', 'ATSPercentage', 'trim|required');
            
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['ProjectID'] = $ID;
                $res = $this->project_model->update($data);
                if(@$res->ID){
                    redirect($this->config->item('base_url') . 'admin/project/project');
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/project/project/edit/'.$ID);
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/project/project/edit/'.$ID);
            }
        }else{

            $result = array();
            $data['ProjectID'] = $ID;
            $result['loading_button'] = getLoadingButton();
            $result['page_name'] = 'edit/'.$ID;
            $result['Project'] = $this->project_model->getByID($ID);
            if(@$result['Project']->Message){
                show_404();
                die;
            }
            $this->load->view('admin/includes/header');     
            $result['group'] = getGroupCombobox($result['Project']->GroupID);
            $this->load->view('admin/project/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/project/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);
        
        }
    }
    public function editproject($ID = 0){
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Title', 'Title', 'trim|required');
            $this->form_validation->set_rules('Location', 'Location', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            $this->form_validation->set_rules('GroupID', 'GroupID', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['ProjectID'] = $ID;
                $res = $this->project_model->update($data);
                if(@$res->ID){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }else{
            show_404();
        }
    }
    public  function details($ID = 0){
        if($this->cur_module->is_view == 0)
                show_404();        
        $result = array();
        $data['ProjectID'] = $ID;
        $result['loading_button'] = getLoadingButton();
        $result['Project'] = $this->project_model->getByID($ID);
        $result['Rule'] = $this->project_model->GetProjectRule($ID);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $result['ProjectID'] = $ID;
        if(@$result['Project']->Message){
            show_404();
            die;
        }

        $this->load->view('admin/includes/header');     
        $result['group'] = getGroupCombobox($result['Project']->GroupID);
        $this->load->view('admin/project/details',$result);
        $data['page_level_js'] = $this->load->view('admin/project/details_js', $result, TRUE);
        $this->load->view('admin/includes/footer',$data);
        
    }
    public function editrules($ProjectID){
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Rule', 'Rule', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['ProjectID'] = $ProjectID;
                $res = $this->project_model->AddEditProjectRule($data);
                if(@$res->ID){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }

    }



    function changeStatus() 
    {
        if($this->cur_module->is_status == 0){
                echo json_encode(array('result' => 'error','message'=>label('not_eligible_for_change')));
                die;
        }
        try{
            if ($this->input->post()){
                    $res = $this->project_model->changeStatus($this->input->post());
                    if($res){
                        $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                        echo json_encode(array('result' => 'success','message'=>$message));
                    }else{
                        echo json_encode(array('result' => 'error',label('please_try_again')));
                    }
                }
        }catch (Exception $e){
            echo json_encode(array('result' => 'error','message'=>$e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }

        
    }
    public function ajax_milestone($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->project_model->listMileStone($per_page_record  , $page_number);
        if(empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $ajax_listing = $this->load->view('admin/project/ajax_listing_milestone', $result,TRUE);
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
        $res['Data'] = $this->project_model->listProject(-1, 1);

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
    }
}
