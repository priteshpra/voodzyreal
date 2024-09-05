<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/role_model');
        $this->load->helper('common_helper');
    }

    public function index() {
        $role_result = $data = array();
        //$role_result['roles'] = $this->role_model->listRole();
		$this->load->view('admin/includes/header');
		$role_result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
		$this->load->view('admin/role/list', $role_result);
		$data['page_level_js'] = $this->load->view('admin/role/list_js', NULL, TRUE);
		$data['footer']['add_link'] = $this->config->item('base_url') . 'admin/role/add';
		$data['footer']['listing_page'] = 'yes';
		$this->load->view('admin/includes/footer', $data);
		unset($role_result, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['roles'] = $this->role_model->listRole($per_page_record, $page_number);

        if (empty($result['roles']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['roles'][0]->rowcount;
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/role/ajax_listing_role', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="6" style="text-align: center;">'. label('no_records_found') .'</td></tr>', 'b' => ''));
    }

    public function details($ID = 0){
       $this->RoleID = $ID;
        $data = array();
        $_POST['RoleID'] = $data['ID'] = $ID;
        $data['details'] = $this->role_model->getCustomerByRoleID($ID);
        $data['roles_data'] = $this->role_model->getRoleByID($ID);
        $data['role_data'] = $data['roles_data']['role'];
        $data['page_level_js'] = $this->load->view('admin/role/details_js', $data, TRUE);
        $data['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        if(empty($data['details'])){
            show_404();
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/details',$data);
        $this->load->view('admin/includes/footer',$data);
        unset($data);
    }

    public function ajax_roles($per_page_record = 10, $page_number = 1) {
        $result = array();
        $rolename = $_POST['RoleName'];
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['rolemapping'] = $this->role_model->listRoleMapping($per_page_record, $page_number,$rolename);
        
        if (empty($result['rolemapping']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['rolemapping'][0]->rowcount;
        $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);

        $ajax_listing = $this->load->view('admin/role/ajax_listing_rolemapping', $result, TRUE);
        if ($result['total_records'] != 0)
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        else
            echo json_encode(array('a' => '<tr><td colspan="7" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
    }

    public function role_view($clone=0,$level_project=0) {
        $allmodules = $this->role_model->GetAllModules();
        $module_arr = $this->buildTree($allmodules);
        if($this->input->post('RoleID') != 0){
            $RoleID = $this->input->post('RoleID');
            $RoleProject = $this->role_model->GetRoleProjectByRoleID($RoleID);
            $result['level_project'] = 0;
            $result['clone'] = 0;
            $Botharray = $RoleProject[0];
            $botherditarray = $this->role_model->GetModuleByRoleProjectID($Botharray->RoleProjectID);
            unset($RoleProject[0]);
            foreach ($RoleProject as $key => $rolevalue) {
                $modules = array();
                $result['editarray'] = $this->role_model->GetModuleByRoleProjectID($rolevalue->RoleProjectID);
                foreach ($module_arr as $value) {
                    if($value['Type'] == "Web"){
                        $modules['Web'][] = $value;
                    }else if($value['Type'] == "Mobile"){
                        $modules['Mobile'][] = $value;
                    }else if($value['Type'] == "Both" && $clone!=1){
                        $modules['Both'][] = $value;
                    }
                }
                if($clone != 1){
                    $tmp = array_merge($result['editarray'],$botherditarray);
                    $result['editarray'] = array();
                    foreach ($tmp as $key => $value) {
                        $result['editarray'][$value['ModuleID']] = $value;
                    }
                }
                $result['Project'] = "";
                $result['Project'] = getProject($rolevalue->ProjectID);
                $result['modules'] = $modules;
                echo $this->load->view('admin/role/add_edit_view', $result, TRUE);
                $result['clone'] = $clone = 1;
                $result['level_project']++;
                $botherditarray = array();
            }
        }else{
            $result['RoleID'] = 0;
            $result['page'] = "add";
            $result['level_project'] = $level_project;
            $result['clone'] = $clone;
            
            $modules = array();
            foreach ($module_arr as $value) {
                if($value['Type'] == "Web"){
                    $modules['Web'][] = $value;
                }else if($value['Type'] == "Mobile"){
                    $modules['Mobile'][] = $value;
                }else if($value['Type'] == "Both" && $clone!=1){
                    $modules['Both'][] = $value;
                }
            }
            $result['Project'] = getProject();

            $result['modules'] = $modules;
            echo $this->load->view('admin/role/add_edit_view', $result, TRUE);
        }
    }

    public function add() {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $array = $this->input->post(); 
                $project_data = $this->input->post('Project');

                foreach ($project_data as $key => $value) {
                    $params = array();
                    parse_str($value, $params);
                    $array['Project'][$key] = $params;
                } 
                $res = $this->role_model->insertRoleMap($array);
                if ($res == 1) {
                    echo 1;exit;
                } else {
                    $error_array = array(
                        "error_message" => $res->Message,
                        "method_name" => $res->Method,
                        "Type" => "Admin",
                        "User_Agent" => getUserAgent()
                    );
                    $this->common_model->insertAdminError($error_array);
                    exit;
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/role/add');
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/role/add');
            }
        }
        $result['RoleID'] = 0;
        $result['loading_button'] = getLoadingButton();
        $result['page'] = "add";
        // $result['parent_modules'] = $this->role_model->getParentModules();
        $allmodules = $this->role_model->GetAllModules();
        // $result['sub_modules'] = $this->role_model->getChildModules();
        $modules = array();
        // foreach ($allmodules as $value) {
        //     if($value->Type == "Web"){
        //         $modules['Web'][$value->ParentID][] = $value;
        //     }else if($value->Type == "Mobile"){
        //         $modules['Mobile'][$value->ParentID][] = $value;
        //     }else if($value->Type == "Both"){
        //         $modules['Both'][$value->ParentID][] = $value;
        //     }
        // }
        
        $module_arr = $this->buildTree($allmodules);
        foreach ($module_arr as $value) {
            if($value['Type'] == "Web"){
                $modules['Web'][] = $value;
            }else if($value['Type'] == "Mobile"){
                $modules['Mobile'][] = $value;
            }else if($value['Type'] == "Both"){
                $modules['Both'][] = $value;
            }
        }
        $result['Project'] = getProject();

        $result['modules'] = $modules;
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/role/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            $element = (array)$element;
            if ($element['ParentID'] == $parentId) {
                $children = $this->buildTree($elements, $element['ModuleID']);
                if ($children) {
                    $element['ChildModule'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }


    public function edit($role_id = NULL) {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Name', 'Name', 'trim|required');
            $this->form_validation->set_rules('Description', 'Description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $array = $this->input->post();
                $array['ID'] = $role_id;
                $res = $this->role_model->EditRoles($array);
                if (@$res->ID) {
                    redirect($this->config->item('base_url') . 'admin/role');
                } 
                else {
                    $error_array = array(
                        "error_message" => $res->Message,
                        "method_name" => $res->Method,
                        "Type" => "Admin",
                        "User_Agent" => getUserAgent()
                    );
                    $this->common_model->insertAdminError($error_array);
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/role/edit/' . $role_id);
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/role/edit/' . $role_id);
            }
        }
        
        $result = $this->role_model->getRoleByID($role_id);
        if(empty($result['role'])){
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/role/');
            }
        $result['RoleID'] = $role_id;
        $result['loading_button'] = getLoadingButton();
        $result['page'] = "add/$role_id";
        $this->load->view('admin/includes/header');
        $this->load->view('admin/role/add_edit', $result);
        $data['page_level_js'] = $this->load->view('admin/role/add_edit_js', $result, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }

    function changeStatus() {
        try {
            if ($this->input->post()) {
                pr($this->input->post());
                $this->role_model->changeStatus($this->input->post());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    function export_to_excel() {
        
        $this->load->library('excel');
        $album_result['roles'] = $this->role_model->listRole(-1, 1);
        $dataResult['result'] = array();
        if (!empty($album_result['roles'])) {
            $dataResult['result'] = $album_result['roles'];
        }
        $fields = array("SrNo", "RoleName"); //Header Define
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
        if (!empty($album_result['roles'])) {
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
        $filename = 'Roles.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
