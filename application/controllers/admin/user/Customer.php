 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Admin_Controller {

    public function __construct() {
        parent::__construct();       
        $Propertytmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",18," . $this->ProjectID .")");
        $Propertytmp->next_result();
        $this->property_module =  $Propertytmp->row();
        $this->load->model('admin/customer_model');
    }

    public  function index($per_page_record = 10  , $page_number = 1){
        $result = $data = array();
        $this->load->view('admin/includes/header');
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        if($this->ProjectID == -1){
            /*$result['Project'] = getProject(0,-1,$this->UserRoleID);*/
            $result['Property'] = getPropertyCombobox(0,0,"Purchase");
        }else{
            //$result['Project'] = getProject($this->ProjectID,-1,$this->UserRoleID,0,1);
            $result['Property'] = getPropertyCombobox(0,$this->ProjectID,1,"Purchase");
        }
        $this->load->view('admin/user/customer/list',$result);
        $data['page_level_js'] = $this->load->view('admin/user/customer/list_js', NULL, TRUE);  
        $this->load->view('admin/includes/footer',$data);
        unset($result,$data);
    }

    public function ajax_listing($per_page_record = 10  , $page_number = 1){
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['data_array'] = $this->customer_model->listdata($per_page_record,$page_number);

        if (isset($result['data_array'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['data_array'][0]->rowcount;
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $ajax_listing = $this->load->view('admin/user/customer/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
            echo json_encode(array('a'=>'<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b'=>''));
    }

    public function processajax_listing($per_page_record = 10, $page_number = 1)
        {
            $result = array();
            $result['per_page_record'] = $per_page_record;
            $result['page_number'] = $page_number;
            $result['data_array'] = $this->customer_model->listProcess($per_page_record, $page_number);

            if (isset($result['data_array'][0]->Message))
                $result['total_records'] = 0;
            else
                $result['total_records'] = $result['data_array'][0]->rowcount;

            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
            $ajax_listing = $this->load->view('admin/user/customer/process_ajax_listing', $result, TRUE);
            if ($result['total_records'] != 0)
                echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
            else
                echo json_encode(array('a' => '<tr><td colspan="8" style="text-align: center;">No Records Found.</td></tr>', 'b' => ''));
        }
   
    public function add(){
        show_404();
        if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('EmailID', 'EmailID', 'trim|required');
                $this->form_validation->set_rules('Address', 'Address', 'trim|required');
                $this->form_validation->set_rules('MobileNo', 'MobileNo', 'trim|required');
                if($this->form_validation->run() == TRUE){
                    $res = $this->customer_model->insert($this->input->post());

                    if(@$res->ID){
                        $user_ID = @$this->session->userdata['UserID'];
                        redirect($this->config->item('base_url') . 'admin/user/property/add/'.@$res->ID);
                    }else{
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/customer/add');
                    }
                }else{
                    
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/customer/add');
                }
            } 
            else {
                $result = array();
                $result['group'] = getGroupCombobox();
                $result['loading_button'] = getLoadingButton(); 
                $result['Page'] = 'add';
                $this->load->view('admin/includes/header');
                $this->load->view('admin/user/customer/add_edit', $result);
                $data = array();
                $data['page_level_js'] = $this->load->view('admin/user/customer/add_js', NULL, TRUE);
                $this->load->view('admin/includes/footer', $data);
                unset($data);
            }
    }

    public  function edit($ID = 0){
        /*if($this->cur_module->is_edit == 0)
                show_404();        */
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required');
                $this->form_validation->set_rules('LastName', 'LastName', 'trim|required');
                $this->form_validation->set_rules('Address', 'Address', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $data = $this->input->post();
                $data['ProjectID'] = $ID;
                $res = $this->customer_model->update($data);
                if(@$res->ID){
                    redirect($this->config->item('base_url') . 'admin/user/customer');
                }else{
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/customer/edit/'.$ID);
                }
            }else{
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/customer/edit/'.$ID);
            }
        }else{
            $result = array();
            $result['loading_button'] = getLoadingButton();
            $result['Page'] = 'edit/'.$ID;
            $result['Customer'] = $this->customer_model->getByID($ID);
            if(@$result['Customer']->Message){
                show_404();
                die;
            }
            $this->load->view('admin/includes/header');     
            $this->load->view('admin/user/customer/add_edit',$result);
            $data['page_level_js'] = $this->load->view('admin/user/customer/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer',$data);        
        }
    }

    public function changeStatus(){
        try{
            if ($this->input->post()){
                    $res = $this->customer_model->changeStatus($this->input->post());
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

    public function EmailMobExist(){
        try{
            if ($this->input->post()){
                    $res = $this->customer_model->EmailMobExist($this->input->post('EmailID'),$this->input->post('MobileNo'),$this->input->post('CustomerID'));
                    if(@$res->Message){
                        echo json_encode(array('Result' => 'Error','Message' => $res->Message));
                    }else{
                        $message = ($this->input->post('status') == 1)?label('status_active'):label('status_inactive');    
                        echo json_encode(array('Result' => 'Success'));
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

    public function details($CustomerID = 0){
        $data = $result = array();
        $result['CustomerID'] = $CustomerID;
        $result['Customer'] = $this->customer_model->getByID($CustomerID);
        if(isset($result['Customer']->Message)){
            show_404();
            exit;
        }
        $this->load->view('admin/includes/header');
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup',NULL, TRUE);  
        $result['loading_button'] = getLoadingButton(); 
        $this->load->view('admin/user/customer/details',$result);
        $data['page_level_js'] = $this->load->view('admin/user/customer/details_js', $result, TRUE);
        $this->load->view('admin/includes/footer',$data);
    }
    
    public function export_to_excel() {
        $this->load->library('excel');
        $res['Data'] = $this->customer_model->listdata(-1, 1);

        $dataResult['result'] = array();
        if (!empty($res['Data'])) {
            $dataResult['result'] = $res['Data'];
        }
        $fields = array("SrNo", "FirstName", "LastName", "EmailID", "MobileNo", "MobileNo1", "Address"); 
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
        $filename = 'Customer.xls'; 
        //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); 
        //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); 
        //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
        //readfile("designation.xls");
    }


    public function importe(){
            $created_by = $this->session->userdata['UserID'];
            $IPAddress = GetIP();
            $usertype = 'Admin Web';
            $file = @$_FILES['userfile']['tmp_name'];
           
            $csv_mimetypes = array(
                'text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt',
            );
            $info = pathinfo($_FILES['userfile']['name']);

            if(!empty($file) && in_array($_FILES['userfile']['type'], $csv_mimetypes) && $info['extension'] == 'csv'){
                $handle = fopen($file, "r");
                $user_arr = array();
                $failed_content = array();
                $succes_content = array();
                $c = 0;
                while(($filesop = fgetcsv($handle, 1000, ",")) !== false){

                    if($c!=0 && (@$filesop[1]!='' || @$filesop[2]!='' || @$filesop[3]!='' || @$filesop[4]!='')){  
                        $user_arr[$c]['SNo'] = @$filesop[0];
                        $user_arr[$c]['FirstName'] = @$filesop[1];
                        $user_arr[$c]['LastName'] = @$filesop[2];
                        $user_arr[$c]['EmailID'] = @$filesop[3];
                        $user_arr[$c]['MobileNo'] = @$filesop[4];
                        $user_arr[$c]['MobileNo1'] = @$filesop[5];
                        $user_arr[$c]['Address'] = getStringClean(@$filesop[6]);
                        $user_arr[$c]['Status'] = 'on';
                    }
                    $c = $c + 1;
                }
                
                foreach ($user_arr as $key => $value) {
                    $validation = 1;
                    if($value['FirstName']=='' || $value['LastName']=='' || $value['MobileNo']=='' || $value['Address']==''){
                        $validation = 0;
                    }
                    if(preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) || preg_match('/^([0-9]{10})$/', $value['MobileNo']) ) {
                        //echo 'Please enter a valid phone number';
                    }else{
                        $validation = 0;
                    }
                    $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                    if(!preg_match($emailval, $value['EmailID'])){
                        $validation = 0;
                    }
                    if(ctype_alpha(str_replace(' ', '', $value['FirstName'])) === false || ctype_alpha(str_replace(' ', '', $value['LastName'])) === false){
                        $validation = 0;
                    }

                    if($validation == 1){
                        $res = $this->customer_model->insert($value);
                        
                        if (@$res->ID) {
                            $succes_content[$key] = $user_arr[$key];
                        }else{
                            $failed_content[$key] = $user_arr[$key];
                            $msg = explode('~', $res->Message);
                            $failed_content[$key]["error_message"] = (@$msg[1]) ? $msg[1] : $res->Message;
                        }
                    }else{
                            $failed_content[$key] = $user_arr[$key];
                            $failed_content[$key]["error_message"] = 'Required fields are missing.';
                            // if(!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) && $value['MobileNo']!='') {
                            //     $failed_content[$key]["error_message"] .= '<br/>or Mobile number not valid.';
                            // }
                            $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                            if(!preg_match($emailval, $value['EmailID']) && $value['EmailID']!=''){
                                $failed_content[$key]["error_message"] .= '<br/>or Email not valid.';
                            }

                            if(preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $value['MobileNo']) || preg_match('/^([0-9]{10})$/', $value['MobileNo']) ) {
                                //echo 'Please enter a valid phone number';
                            }else{
                                $failed_content[$key]["error_message"] .= '<br/>or Mobile number not valid.';
                            }
                            if(ctype_alpha(str_replace(' ', '', $value['FirstName'])) === false || ctype_alpha(str_replace(' ', '', $value['LastName'])) === false){
                                $failed_content[$key]["error_message"] .= "<br/>or Name not contain letters only.";
                            }
                    }
                }
                // pr($succes_content);echo '<br/>';
                // pr($failed_content);echo '<br/>';
                $Content = '';
                $Content .= '<div><p><h4>Successfully inserted : </h4></p><p>';
                $Content .= '<table style="border:1px solid #C8C8C8;">';
                foreach ($succes_content as $key => $row) {
                    $Content .= '<tr>';
                    foreach ($row as $k => $val) { 
                            $Content .= '<td style="border:1px solid #D1D1D1;">'.$val.'</td>';
                    }
                    $Content .= '</tr>';
                }
                $Content .= '</table></p></div>';

                
                $Content .= '<div><p><h4>Failed to insert : </h4></p><p>';
                $Content .= '<table style="border:1px solid #C8C8C8;">';
                foreach ($failed_content as $key => $row) {
                    $Content .= '<tr>';
                    foreach ($row as $k => $val) { 
                            $Content .= '<td style="border:1px solid #D1D1D1;">'.$val.'</td>';
                    }
                    $Content .= '</tr>';
                }
                $Content .= '</table></p></div>';
                    $cc = '';
                    // $this->load->model('admin/visitor_model');
                    // $User_data = $this->visitor_model->getQueryResult("call  usp_M_getDeviceByEmployee('$created_by','-1')");
                    $User_data = $this->common_model->getDeviceByEmployee($created_by,'-1','-1');
                    foreach ($User_data as $k => $val) {
                        if($created_by==$val->UserID){
                            $FromEmailID = $val->EmailID;
                            $FirstName = $val->FirstName;
                            $LastName = $val->LastName;
                        }
                        $cc .=  (@$cc) ? $cc : ','.$cc;
                    }
                    
                    $this->load->model('admin/bulkmessage_model');
                    $this->load->helper("phpmailerautoload");
                    $MailBody = $this->bulkmessage_model->get_emailtemplate($id = 3);
                    // $array['Attached'] = $PhotoURL;
                    $array['ToEmailID'] = $FromEmailID;
                    $array['CC'] = $cc;
                    $array['Subject']  = DEFAULT_WEBSITE_TITLE.'- Status CSV Uploaded Of Customer';
                    $array['Body'] = $MailBody['Content']; 
                    $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['FromName'] = DEFAULT_FROM_NAME;
                    $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                    $array['AltBody'] = '';  
                    $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                    $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                    $data1      = array('{site_name}','{logo}','{first_name}','{last_name}','{back_image}','{message}','{base_url}');

                    $datavalue  = array(DEFAULT_WEBSITE_TITLE,$image_path, $FirstName, $LastName, $back_image_path, $Content, base_url());
                    $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                    //pr($array['Body']);exit();
                    $res = CustomMail($array);
                    if($res==1){
                        $sendStatus = 1;//Success
                    }else{
                        
                    }
                    if(!empty($succes_content)){
                        $this->session->set_flashdata('PostSuccess','CSV Uploaded, Please check your email for CSV status.');
                    }else{
                        $this->session->set_flashdata('posterror','CSV Not proper, Please check your email for CSV status.');
                    }
                    redirect(base_url().'admin/user/customer');
            }else{
                $this->session->set_flashdata('posterror', 'Please attach csv file for import customer.');
                redirect(base_url().'admin/user/customer');
            }

    }

}
