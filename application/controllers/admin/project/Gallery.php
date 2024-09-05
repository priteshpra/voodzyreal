<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Admin_Controller {

  public function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",32,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();           
        }
        $this->load->model('admin/gallery_model');
    }
    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->gallery_model->listData($per_page_record  , $page_number);
        if(empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        
        
        $ajax_listing = $this->load->view('admin/project/gallery/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }
    public function add($ProjectID) {
        if($this->cur_module->is_insert == 0)
                        show_404();
        try {
            $data = $array = array();
            if ($this->input->post()) {
                    $url = site_url("admin/project/gallery/add/".$ProjectID);
                    $config = array("max_width" => PROJECT_Gallery_MAX_WIDTH,
                        "max_height" => PROJECT_Gallery_MAX_HEIGHT,
                        'max_size' => PROJECT_Gallery_MAX_SIZE,
                        'path' => PROJECT_Gallery_UPLOAD_PATH,
                        'allowed_types' => PROJECT_Gallery_ALLOWED_TYPES,
                        'tpath' => PROJECT_Gallery_THUMB_UPLOAD_PATH,
                        'twidth' => PROJECT_Gallery_THUMB_MAX_WIDTH,
                        'theight' => PROJECT_Gallery_THUMB_MAX_HEIGHT
                    );
                    
                    $data = $this->input->post();
                    $data['ProjectID'] = $ProjectID;
                    $data['ImagePath'] = FileUploadURL("ImagePath", "EditImagePath", $config, '', $url);
                    $res = $this->gallery_model->insert($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/project/project/details/'.$ProjectID.'#gallery');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => $this->session->user_data['UserType'] . " Web",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                       
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/project/gallery/add/'.$ProjectID);
                    }
            }
            $this->load->view('admin/includes/header');
            $data['ProjectID'] = $ProjectID;
            $data['loading_button'] = getLoadingButton();
            $this->load->view('admin/project/gallery/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/project/gallery/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data,$array);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => $this->session->user_data['UserType'] . " Web",
                "User_Agent" => getUserAgent()
                );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public function delete($ID){
        $this->common_model->delete("sssm_projectgallery","ProjectGalleryID",$ID);
        echo 1;
    }
}
