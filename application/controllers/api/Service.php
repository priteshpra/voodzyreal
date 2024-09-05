<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(); ini_set('display_errors', 1);

class Service extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('api/master_model', '', TRUE);
        $this->load->helper("phpmailerautoload");
        $this->load->model('api/FacebookLeadModel');
        $this->load->helper('url');
        $this->output->set_content_type('application/json');
    }

    public function fetchLeads($formId)
    {

        $leads = $this->FacebookLeadModel->getLeads($formId);

        if ($leads) {
            $this->output->set_output(json_encode(['status' => 'success', 'data' => $leads['data']]));
        } else {
            $this->output->set_output(json_encode(['status' => 'error', 'message' => 'Failed to fetch leads.']));
        }
    }

    // check valid JSON
    function checkvalidjson($json)
    {
        $obj = json_decode(stripslashes($json), TRUE);
        if (is_null($obj)) {
            $response['Error'] = 1;
            $response['data'] = "Invalid Json format";
            echo json_encode($response);
            exit();
            //return $response;
        } else {
            $data = json_decode($json);
            return $data;
        }
    }

    function index()
    {

        header('Content-type: application/json');
        $data = file_get_contents('php://input');

        //$data = $this->checkvalidjson($data);
        //$data = decrypt(trim($data->auth),$encryption_key['inputKey'],$encryption_key['blockSize']);

        //var_dump(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data)));die;
        //$obj = json_decode(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data)),true);pr($obj,true);

        if ($data == null) {

            //http://localhost/Samarth_Group_Admin/trunk/api/service


            //$data = '{"method":"userSignup","body":{"FirstName":"FirstName","LastName":"LastName","EmailID":"real@gmail.com","MobileNo":"9876543221","Password":"123456", "NotificationToken":"345gf6gy54y4y456345", "DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"Admin IOS"}}';

            //$data = '{"method":"checkLogin","body":{"EmailID":"real@gmail.com","Password":"123456","NotificationToken":"345gf6gy54y4y456345","DeviceUID":"123456","DeviceName":"iPhone","OSVersion":"7","DeviceType":"IOS"}}';

            //$data = '{"method":"changePassword","body":{"UserID":"2","OldPassword":"123456","Password":"123456"}}';
            ////$data = '{"method":"forgotPassword","body":{"EmailID":"real@gmail.com"}}';

            ////$data = '{"method":"deleteAccount","body":{"UserID":"2"}}';
            //$data = '{"method":"deletePropertyDocument","body":{"CustomerPropertyDocumentID":"2"}}';
            //$data = '{"method":"getGroup","body":{}}';
            //$data = '{"method":"getCountry","body":{}}';
            //$data = '{"method":"getDesignation","body":{}}';
            //$data = '{"method":"getStates","body":{"CountryID":"3"}}';
            //$data = '{"method":"getCities","body":{"StateID":"2"}}';
            //$data = '{"method":"getPropertyByCustomer","body":{"CustomerID":"2"}}';
            //$data = '{"method":"getPropertyMileStoneByProperty","body":{"PropertyID":"2"}}';
            //$data = '{"method":"getConfig","body":{}}';
            //$data = '{"method":"getProjectByRole","body":{"UserID":"1","RoleID":"1", "Type":"IsInsert"}}';
            //$data = '{"method":"getProject","body":{"PageSize":"12","CurrentPage":"1","SearchText":"","Location":"","GroupID":"-1","Status":"-1"}}';
            //$data = '{"method":"getPropertyByProjectID","body":{"ProjectID":"1"}}';
            //$data = '{"method":"getVisitor","body":{"PageSize":"12","CurrentPage":"1","EmployeeID":"-1","Name":"","EmailID":"","MobileNo":"","Profession":"All","DesignationID":"-1","Requirement":"All","Status":"-1"}}';
            //$data = '{"method":"addVisitor","body":{"EmployeeID":"12","Name":"1name","EmailID":"xyz@gmail.com","MobileNo":"9876543210","Address":"12, RL, colony","Profession":"Job","CompanyName":"C Company","DesignationID":"0","Requirement":"2BHK","Budget":"0","VisitSource":"Others","PromotionalNotifications":"1","Remarks":"","ChannelPartner":"","CreatedBy":"UserID","Status":"1","UserType":"Employee Android","VisitorCenter":"","OutDoorLocation":"","EntryDate":"11-22-2017 12:12:12"}}';
            //$data = '{"method":"getCustomer","body":{"PageSize":"12", "CurrentPage":"1", "Name":"", "MobileNo":"", "Status":"-1", "RoleID":"-1", "ProjectID":"-1"}}';
            //$data = '{"method":"getCustomerBySearch","body":{"MobileNo":""}}';
            ////$data = '{"method":"getCustomerPayment","body":{"PageSize":"12","CurrentPage":"1","CustomerID":"3","Status":"-1"}}';
            //$data = '{"method":"getCustomerPayment","body":{"CustomerPropertyID":"3"}}';

            //$data = '{"method":"getCustomerProperty", "body":{"PageSize":"12", "CurrentPage":"1", "CustomerID":"3", "Status":"-1", "ProjectID":"-1", "RoleID":"1"}}';
            //$data = '{"method":"addCustomer","body":{"FirstName":"12","LastName":"1","EmailID":"3","MobileNo":"3","MobileNo1":"3","Address":"3","CreatedBy":"UserID","Status":"1","UserType":"Employee Android"}}';
            //$data = '{"method":"getCustomerPaymentByProperty","body":{"PageSize":"12","CurrentPage":"1","CustomerPropertyID":"1","Status":"-1"}}';
            //$data = '{"method":"getCustomerDocumentByProperty","body":{"PageSize":"12","CurrentPage":"1","CustomerPropertyID":"1"}}';
            //$data = '{"method":"getVisitorReminder","body":{"PageSize":"12","CurrentPage":"1","VisitorID":"1"}}';
            //$data = '{"method":"getMileStoneByCProperty","body":{"PageSize":"12","CurrentPage":"1","CustomerPropertyID":"1"}}';

            //$data = '{"method":"getCustomerReminder","body":{"PageSize":"12","CurrentPage":"1","CustomerID":"1","ProjectID":"-1","RoleID":"-1"}}';
            //$data = '{"method":"addCustomerProperty","body":{"CustomerID":"12","PropertyID":"1","PurchaseDate":"3","PaymentMode":"3","ChequeNo":"3","IFCCode":"3","AccountNo":"123123","BankName":"1","BranchName":"1","DPRP":"1","CustomerFirstName":"1","CustomerLastName":"1","CustomerAddress":"1","CustomerEmailID":"1","CustomerPanNo":"1","CustomerAdhaarNo":"1","CustomerMobileNo":"1","CustomerMobileNo1":"1","CustomerSFirstName":"1","CustomerSLastName":"1","CustomerSAddress":"1","CustomerSEmailID":"1","CustomerSPanNo":"1","CustomerSAdhaarNo":"1","CustomerSMobileNo":"1","CustomerSMobileNo1":"1","CreatedBy":"1","Status":"1","UserType":"Employee Android","IsHold":"0","","GSTAmount":"0"}}';
            // // $data = '{"method":"addCustomerPayment","body":{"CustomerMileStoneID":"12","PaymentAmount":"1","PaymentDate":"2017-03-02","PaymentMode":"3","ChequeNo":"3","IFCCode":"3","AccountNo":"123123","BankName":"1","BranchName":"1","CreatedBy":"1","Status":"1","UserType":"Employee Android","GSTAmount":"0"}}';
            //$data = '{"method":"addCustomerPayment","body":{"CustomerPropertyID":"12","MileStone":"1st payment","PaymentAmount":"1","PaymentDate":"10-23-2017","PaymentMode":"3","ChequeNo":"3","IFCCode":"3","AccountNo":"123123","BankName":"1","BranchName":"1","CreatedBy":"1","Status":"1","UserType":"Employee Android"}}';
            //$data = '{"method":"addCustomerPropertyDocument","body":{"CustomerPropertyID":"12","DocumentUrl":"1","Title":"2017-03-02","CreatedBy":"1","Status":"1","UserType":"Employee Android"}}';
            //$data = '{"method":"getNotification","body":{"PageSize":"12","CurrentPage":"1","UserID":"1"}}';
            //$data = '{"method":"getAdminByID","body":{"UserID":"1"}}';
            //$data = '{"method":"editAdminDetail","body":{"FirstName":"admin","LastName":"admin","MobileNo":"9876543200","ModifiedBy":"2","UserID":"2","UserType":"Employee Android"}}';
            //$data = '{"method":"convertVisitorToCustomer","body":{"VisitorID":"1","UserID":"1","UserType":"Admin Android"}}';
            //$data = '{"method":"addCustomerReminder","body":{"CustomerPropertyID":"1","UserID":"1","ReminderDate":"2017-10-11", "Amount":"1000000","UserType":"Admin Android"}}';
            //$data = '{"method":"updateVisitorReminder","body":{"VisitorID":"1","UserID":"1","ReminderDate":"2017-10-11", "IsIdle":"0","Message":"","UserType":"Admin Android"}}';
            //$data = '{"method":"addReminderAction","body":{"ID":"1","ActionType":"SMS","Message":"2017-10-11", "ReminderActionDate":"12-22-2017","UserID":"1","ActionUser":"Customer","UserType":"Admin Android"}}';
            //$data = '{"method":"getReminderAction","body":{"PageSize":"12","CurrentPage":"1","ID":"1","ActionUser":"Customer"}}';
            ////$data = '{"method":"addReminderResponse","body":{"ReminderActionID":"1","Response":"SMS","ResponseBy":"1","UserType":"Admin Android"}}';
            //$data = '{"method":"setUserNotificationSetting","body":{"UserID":"1","IsPush":"1","UserType":"Admin Android","VisitorReminder":"1", "Customer":"1", "CustomerReminder":"1","CustomerProperty":"1","Payment":"1","Document":"1"}}';
            //$data = '{"method":"addDevice","body":{"UserID":19,"NotificationToken":"eaPQdx8yhfI:APA91bGkZ5fRDZciTKRuXeK1eW5r02-1WhtBR_KsB19Jh2hLSFKSLQoeu8qNEZCVNEYxVszlR5qTu9HaEoN5n0Hnb60raNSeod2oGZ6BlPgRVR0jhLejUIL7jgeWrX9lpz-EUEbyOecY","DeviceName":"Samsung SM-J210F","OSVersion":"6.0.1","DeviceType":"Company Android","DeviceUID":"123456"}}';'
            //$data = '{"method":"getCustomerProcess","body":{"PageSize":"12","CurrentPage":"1","ID":"1","Type":"CustomerProperty"}}';
            //$data = '{"method":"getReminderResponse","body":{"PageSize":"12","CurrentPage":"1","ID":"1","Type":"Customer"}}';
            //$data = '{"method":"addReminderResponse","body":{"ReminderID":"12","ReminderType":"Customer","Response":"Response","ResponseBy":"1","UserType":"Employee Android"}}';
            //$data = '{"method":"cancelledProperty","body":{"CustomerPropertyID":"12","UserID":"2","UserType":"Employee Android"}}';
            //$data = '{"method":"addVisitorIdle","body":{"VisitorID":"12","UserID":"2","UserType":"Employee Android","IsIdle":"1"}}';
            //$data = '{"method":"getDashboard","body":{"UserID":"2","RoleID":"1"}}';
            //$data = '{"method":"getAccessRoleByRoleID","body":{"UserID":"2","RoleID":"1"}}';
            //$data = '{"method":"changePropertyStatus","body":{"Type":"2","CustomerPropertyID":"1"}}';
            //$data = '{"method":"getMileStoneByProperty","body":{"PropertyID":"1"}}';
            //$data = '{"method":"getDashboardCount","body":{"RoleID":"-1","ProjectID":"-1","FilterType":"Daily"}}';
            //$data = '{"method":"getWingwisePropertyByProject","body":{"ProjectID":"1"}}';
        }

        if ($data != '' && $data != NULL) {

            $data = $this->checkvalidjson($data);
            $method = $data->method;
            $json = $data->body;
        } else {
            $method = $this->input->post('method');
            if ($method == "addReminderAction") {
                $json = array(
                    'ID' => $this->input->post('ID'),
                    'ActionType' => $this->input->post('ActionType'),
                    'Subject' => $this->input->post('Subject'),
                    'Message' => $this->input->post('Message'),
                    'UserID' => $this->input->post('UserID'),
                    'ActionUser' => $this->input->post('ActionUser'),
                    'UserType' => $this->input->post('UserType')
                );
            } elseif ($method == "addUploadPics") {
                $json = array(
                    'CustomerPropertyID'    => $this->input->post('CustomerPropertyID'),
                    'UserID'                => $this->input->post('UserID'),
                    'CustomerPropertyDocumentID'
                    => $this->input->post('CustomerPropertyDocumentID'),
                    'UserType'              => $this->input->post('UserType'),
                    'AccessType'            => $this->input->post('AccessType'),
                    'Title'                 => $this->input->post('Title')
                );
            } elseif ($method == "addChallanPhoto") {
                $json = array(
                    'GoodsReceivedNoteID'    => $this->input->post('GoodsReceivedNoteID')
                );
            } elseif ($method == "addEditInvoiceImage") {
                $json = array(
                    'GoodsReceivedNoteID'    => $this->input->post('GoodsReceivedNoteID')
                );
            } else {
                $json = array(
                    'UserID' => $this->input->post('UserID'),
                    'UserType' => $this->input->post('UserType'),
                    'PictureType' => $this->input->post('PictureType'),
                );
            }
        }

        switch ($method) {

            case 'userSignup':
                $res = $this->userSignup($json);
                break;
            case 'checkLogin':
                $res = $this->checkLogin($json);
                break;
            case 'changePassword':
                $res = $this->changePassword($json);
                break;
            case 'forgotPassword':
                $res = $this->forgotPassword($json);
                break;
            case 'getCountry':
                $res = $this->getCountry($json);
                break;
            case 'getDesignation':
                $res = $this->getDesignation($json);
                break;
            case 'getStates':
                $res = $this->getStates($json);
                break;
            case 'getCities':
                $res = $this->getCities($json);
                break;
            case 'getConfig':
                $res = $this->getConfig($json);
                break;
            case 'getGroup':
                $res = $this->getGroup($json);
                break;
            case 'getProjectByRole':
                $res = $this->getProjectByRole($json);
                break;
            case 'getProject':
                $res = $this->getProject($json);
                break;
            case 'getPropertyByCustomer':
                $res = $this->getPropertyByCustomer($json);
                break;
            case 'getPropertyMileStoneByProperty':
                $res = $this->getPropertyMileStoneByProperty($json);
                break;
            case 'getPropertyByProjectID':
                $res = $this->getPropertyByProjectID($json);
                break;
            case 'getVisitor':
                $res = $this->getVisitor($json);
                break;
            case 'addVisitor':
                $res = $this->addVisitor($json);
                break;
            case 'getCustomer':
                $res = $this->getCustomer($json);
                break;
            case 'getCustomerBySearch':
                $res = $this->getCustomerBySearch($json);
                break;
            case 'getCustomerPayment':
                $res = $this->getCustomerPayment($json);
                break;
            case 'getCustomerProperty':
                $res = $this->getCustomerProperty($json);
                break;
            case 'addCustomer':
                $res = $this->addCustomer($json);
                break;
            case 'getCustomerPaymentByProperty':
                $res = $this->getCustomerPaymentByProperty($json);
                break;
            case 'getCustomerDocumentByProperty':
                $res = $this->getCustomerDocumentByProperty($json);
                break;
            case 'getVisitorReminder':
                $res = $this->getVisitorReminder($json);
                break;
            case 'getMileStoneByCProperty':
                $res = $this->getMileStoneByCProperty($json);
                break;
            case 'getCustomerReminder':
                $res = $this->getCustomerReminder($json);
                break;
            case 'addCustomerProperty':
                $res = $this->addCustomerProperty($json);
                break;
            case 'addCustomerPayment':
                $res = $this->addCustomerPayment($json);
                break;
            case 'addCustomerPropertyDocument':
                $res = $this->addCustomerPropertyDocument($json);
                break;
            case 'getNotification':
                $res = $this->getNotification($json);
                break;
            case 'getAdminByID':
                $res = $this->getAdminByID($json);
                break;
            case 'editAdminDetail':
                $res = $this->editAdminDetail($json);
                break;
            case 'addUploadPics':
                $res = $this->addUploadPics($json);
                break;
            case 'deletePropertyDocument':
                $res = $this->deletePropertyDocument($json);
                break;
            case 'deleteAccount':
                $res = $this->deleteAccount($json);
                break;
            case 'convertVisitorToCustomer':
                $res = $this->convertVisitorToCustomer($json);
                break;
            case 'addCustomerReminder':
                $res = $this->addCustomerReminder($json);
                break;
            case 'updateVisitorReminder':
                $res = $this->updateVisitorReminder($json);
                break;
            case 'addReminderAction':
                $res = $this->addReminderAction($json);
                break;
            case 'getReminderAction':
                $res = $this->getReminderAction($json);
                break;
            case 'addReminderResponse':
                $res = $this->addReminderResponse($json);
                break;
            case 'setUserNotificationSetting':
                $res = $this->setUserNotificationSetting($json);
                break;
            case 'addDevice':
                $res = $this->addDevice($json);
                break;
            case 'getCustomerProcess':
                $res = $this->getCustomerProcess($json);
                break;
            case 'getReminderResponse':
                $res = $this->getReminderResponse($json);
                break;
            case 'addVisitorIdle':
                $res = $this->addVisitorIdle($json);
                break;
            case 'cancelledProperty':
                $res = $this->cancelledProperty($json);
                break;
            case 'getDashboard':
                $res = $this->getDashboard($json);
                break;
            case 'getAccessRoleByRoleID':
                $res = $this->getAccessRoleByRoleID($json);
                break;
            case 'changePropertyStatus':
                $res = $this->changePropertyStatus($json);
                break;
            case 'getMileStoneByProperty':
                $res = $this->getMileStoneByProperty($json);
                break;
            case 'getDashboardCount':
                $res = $this->getDashboardCount($json);
                break;
            case 'getWingwisePropertyByProject':
                $res = $this->getWingwisePropertyByProject($json);
                break;
            case 'getChanelPartners':
                $res = $this->getChanelPartners($json);
                break;
            case 'getEmployee':
                $res = $this->getEmployee($json);
                break;
            case 'addmisscall':
                $res = $this->addmisscall($json);
                break;
            case 'getCategory':
                $res = $this->getCategory($json);
                break;
            case 'getUOM':
                $res = $this->getUOM($json);
                break;
            case 'getGoods':
                $res = $this->getGoods($json);
                break;
            case 'getVendor':
                $res = $this->getVendor($json);
                break;
            case 'addInward':
                $res = $this->addInward($json);
                break;
            case 'getInward':
                $res = $this->getInward($json);
                break;
            case 'addChallanPhoto':
                $res = $this->addChallanPhoto($json);
                break;
            case 'addEditInvoiceImage':
                $res = $this->addEditInvoiceImage($json);
                break;
            case 'addCustomerPayment_new':
                $res = $this->addCustomerPayment_new($json);
                break;
            case 'deleteInvoiceImg':
                $res = $this->deleteInvoiceImg($json);
                break;
            case 'getInwardByVendorID':
                $res = $this->getInwardByVendorID($json);
                break;
            case 'addOpportunity':
                $res = $this->addOpportunity($json);
                break;
            case 'addOpportunityData':
                $res = $this->addOpportunityData($json);
                break;
            case 'getOpportunity':
                $res = $this->getOpportunity($json);
                break;
            case 'getReason':
                $res = $this->getReason($json);
                break;
            case 'getFeedback':
                $res = $this->getFeedback($json);
                break;
            case 'addUserFeedback':
                $res = $this->addUserFeedback($json);
                break;
            case 'getUserFeedback':
                $res = $this->getUserFeedback($json);
                break;
            case 'assignLead':
                $res = $this->assignLead($json);
                break;
            case 'reassignLead':
                $res = $this->reassignLead($json);
                break;
            case 'getVisitorLead':
                $res = $this->getVisitorLead($json);
                break;
            case 'getVisitorSites':
                $res = $this->getVisitorSites($json);
                break;
            case 'getOpportunityReminder':
                $res = $this->getOpportunityReminder($json);
                break;
            case 'addOpportunityReminder':
                $res = $this->addOpportunityReminder($json);
                break;
            case 'editOpportunityReminder':
                $res = $this->editOpportunityReminder($json);
                break;
            case 'addVisitorReminder':
                $res = $this->addVisitorReminder($json);
                break;
            case 'editVisitorReminder':
                $res = $this->editVisitorReminder($json);
                break;
            case 'getArea':
                $res = $this->getArea($json);
                break;
            case 'getLeadProcess':
                $res = $this->getLeadProcess($json);
                break;
            case 'getRequirementValue':
                $res = $this->getRequirementValue($json);
                break;
            case 'editVisitorSites':
                $res = $this->editVisitorSites($json);
                break;
            case 'editVisitor':
                $res = $this->editVisitor($json);
                break;
            case 'convertToCustomer':
                $res = $this->convertToCustomer($json);
                break;
            case 'addVisitorSites':
                $res = $this->addVisitorSites($json);
                break;
            case 'addLead':
                $res = $this->addLead($json);
                break;
            case 'editLead':
                $res = $this->editLead($json);
                break;
            case 'getDashboardLeadDetails':
                $res = $this->getDashboardLeadDetails($json);
                break;
            case 'getDashboardLeadReminder':
                $res = $this->getDashboardLeadReminder($json);
                break;
            case 'getDashboardVisitorReminder':
                $res = $this->getDashboardVisitorReminder($json);
                break;
            case 'addMagicBricsData':
                $res = $this->addMagicBricsData($json);
                break;
            case 'deleteLeadReminder':
                $res = $this->deleteLeadReminder($json);
                break;
            case 'deleteVisitorReminder':
                $res = $this->deleteVisitorReminder($json);
                break;
            case 'getOpportunityByID':
                $res = $this->getOpportunityByID($json);
                break;
            case 'getVisitorByID':
                $res = $this->getVisitorByID($json);
                break;
            case 'testnotify':
                $res = $this->testnotify($json);
                break;
            default:
                $res = array('default' => array('Error' => 400, 'Message' => label('api_msg_service_not_found')));
                break;
        }

        echo json_encode($res);
        exit;
        /*echo json_encode(array('auth'=> encrypt( json_encode((!empty($res)) ? $res :'Not responding'),
                                                    $encryption_key['inputKey'],
                                                    $encryption_key['blockSize']
                                                ))); exit;*/
    }

    /*** All Api methods start from here ***/

    function testnotify($data)
    {
        $pushNotificationArr = array(
            'device_id' => 'dPl-odTzREuc9WWj9_fkX5:APA91bF-JpIpyqyMw3jCMPh1Nw1Jrnj-QhX1mxuSQEuYYrIN4pCoCHuOJkbZrQdWhKGe67FQ6qmvMo76CjyRa8kJLcu3PH-8nE0rK5Z_BvgEStarw0z84gbFozke0WZtArnujmZEf-o-',
            'message' => "Test",
            'title' => DEFAULT_WEBSITE_TITLE,
            'event' => 'Add Customer',
            'ActionType' => 'AddCustomer',
            'detail' => ''
        );
        //pr($pushNotificationArr);
        $res = sendPushNotification($pushNotificationArr);
        pr($res);
    }

    function getVisitorByID($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitorByID('" . $data->ID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_data_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getVisitorByID' => $response);
    }

    function getOpportunityByID($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_M_GetOpportunityByID('" . $data->ID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_data_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getOpportunityByID' => $response);
    }


    function deleteVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } else {
                $TableName = "sssm_visitorreminder";
                $FieldName = "VisitorReminderID";

                $_result = $this->master_model->getInlineQueryNoResult("call usp_A_ChangeStatus('" . $TableName . "','" . $FieldName . "','" . $data->ID . "','0','" . $data->UserID . "')");

                $response['Error'] = 200;
                $response['Message'] = label('api_msg_reminder_delete_successfully');
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('deleteVisitorReminder' => $response);
    }

    function deleteLeadReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } else {
                $TableName = "ss_opportunityreminder";
                $FieldName = "OpportunityReminderID";

                $_result = $this->master_model->getInlineQueryNoResult("call usp_A_ChangeStatus('" . $TableName . "','" . $FieldName . "','" . $data->ID . "','0','" . $data->UserID . "')");

                $response['Error'] = 200;
                $response['Message'] = label('api_msg_reminder_delete_successfully');
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('deleteLeadReminder' => $response);
    }

    function addMagicBricsData()
    {

        $data = $this->input->get();
        $IP = getIP();
        $add_opportunity = $this->master_model->getQueryResult("call usp_A_AddOpportunityAPI('MagicBreaks','1','1','Admin Web','" . $IP . "','" .
            $data['city'] . "','" .
            $data['dt'] . "','" .
            $data['email'] . "','','','','" .
            $data['mobile'] . "','" .
            $data['msg'] . "','" .
            $data['name'] . "','','" .
            @$data['project'] . "','','','','','')");

        $assign = $this->master_model->getQueryResult("call usp_A_GetCampaignAPI('MagicBreaks','" . @$data['project'] . "')");

        if (!isset($assign['0']->Message)) {
            $this->master_model->getQueryResult("call usp_A_UpdateAssignBy('" . $assign['0']->AssignByType . "','1','" . $add_opportunity['0']->ID . "','Admin Web',$IP)");
        }

        if (isset($add_opportunity)) {
            $response['Error'] = 200;
            $response['Message'] = "Data Added Successfully";
            $response['data'] = $add_opportunity;
        } else if (isset($add_opportunity['Message']) && $add_opportunity['Message'] != '') {
            $msg = explode('~', $add_opportunity['Message']);
            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
            $response['Message'] = $msg[1];
            $response['data'] = $add_opportunity;
        } else {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }

        echo json_encode($response);
    }


    function getDashboardVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->EmployeeID) || $data->EmployeeID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'EmployeeID not found.';
            } else if (!isset($data->FilterType) || $data->FilterType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'FilterType not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;

                $_result = $this->master_model->getQueryResult("call usp_MA_DashboardReport('" . $data->PageSize . "','" . $data->CurrentPage . "','-1','-1','Web','Followup','" . $data->FilterType . "','','','" . $data->EmployeeID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->VisitorReminderID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_reminder_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getDashboardVisitorReminder' => $response);
    }

    function getDashboardLeadReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->EmployeeID) || $data->EmployeeID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'EmployeeID not found.';
            } else if (!isset($data->FilterType) || $data->FilterType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'FilterType not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;

                $_result = $this->master_model->getQueryResult("call usp_MA_DashboardLeadFollowUpReport('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->FilterType . "','" . $data->EmployeeID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->OpportunityReminderID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_reminder_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getDashboardLeadReminder' => $response);
    }

    function getCustomerProcess($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerID) || $data->CustomerID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CustomerID not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;

                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerProcess('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerID . "','CustomerProperty')");

                if (isset($_result) && !empty($_result) && @$_result['0']->CustomerProcessID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_get_process_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerProcess' => $response);
    }

    function getDashboardLeadDetails($data)
    {
        try {
            $response = array();
            if (!isset($data->EmployeeID) || $data->EmployeeID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'EmployeeID not found.';
            } else if (!isset($data->FilterType) || $data->FilterType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'FilterType not found.';
            } else if (!isset($data->AssignStatus) || $data->AssignStatus == '') {
                $response['Error'] = 102;
                $response['Message'] = 'AssignStatus not found.';
            } else {

                if ($data->AssignStatus == 'OverDue') {
                    $_result = $this->master_model->getQueryResult("call usp_A_GetOpprtunityOverDue('" .
                        $data->PageSize . "','" .
                        $data->CurrentPage . "','" .
                        $data->Name . "','" .
                        $data->MobileNo . "','" .
                        $data->EmployeeID . "','" .
                        $data->FilterType . "')");
                } else {
                    $_result = $this->master_model->getQueryResult("call usp_A_GetOpprtunityAssignStatus('" .
                        $data->PageSize . "','" .
                        $data->CurrentPage . "','" .
                        $data->Name . "','" .
                        $data->MobileNo . "','" .
                        $data->EmployeeID . "','" .
                        $data->AssignStatus . "','" .
                        $data->FilterType . "')");
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_data_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getOpportunity' => $response);
    }


    function editLead($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = getIP();
                    $add_opportunity = $this->master_model->getQueryResult("call usp_A_EditOpportunity('" .
                        $data->Type . "','" .
                        $data->Dt . "','" .
                        $data->UserID . "','1','" .
                        $data->OpportunityID . "','Admin Web','" . $IP . "','" .
                        $data->EmailID . "','" .
                        $data->MobileNo . "','" .
                        $data->Message . "','" .
                        $data->Name . "','" .
                        $data->ProjectID . "','" .
                        $data->Area . "','" .
                        $data->Budget . "','" .
                        $data->Purpose . "','" .
                        $data->TypesofRequirement . "','" .
                        $data->LeadType . "','" .
                        $data->Address . "','" .
                        $data->Requirement . "','" .
                        $data->RequirementValue     . "')");

                    if (isset($add_opportunity)) {
                        $response['Error'] = 200;
                        $response['Message'] = "Lead Update Successfully";
                        $response['data'] = $add_opportunity;
                    } else if (isset($add_opportunity['Message']) && $add_opportunity['Message'] != '') {
                        $msg = explode('~', $add_opportunity['Message']);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = $add_opportunity;
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_something_went_wrong');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editLead' => $response);
    }

    function addLead($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = getIP();
                    $add_opportunity = $this->master_model->getQueryResult("call usp_A_AddOpportunity('" .
                        $data->Type . "','" .
                        $data->UserID . "','1','Admin Web','" . $IP . "','" .
                        $data->Dt . "','" .
                        $data->EmailID . "','" .
                        $data->MobileNo . "','" .
                        $data->Message . "','" .
                        $data->Name . "','" .
                        $data->ProjectID . "','" .
                        $data->Area . "','" .
                        $data->Budget . "','" .
                        $data->Purpose . "','" .
                        $data->TypesofRequirement . "','" .
                        $data->LeadType . "','" .
                        $data->Address . "','" .
                        $data->Requirement . "','" .
                        $data->RequirementValue     . "')");

                    if (isset($add_opportunity)) {
                        $response['Error'] = 200;
                        $response['Message'] = "Lead Added Successfully";
                        $response['data'] = $add_opportunity;
                    } else if (isset($add_opportunity['Message']) && $add_opportunity['Message'] != '') {
                        $msg = explode('~', $add_opportunity['Message']);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = $add_opportunity;
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_something_went_wrong');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addLead' => $response);
    }

    function addVisitorSites($data)
    {
        try {
            $response = array();
            if (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } else {

                $IP = GetIP();
                foreach ($data->item as $key => $value) {
                    $_result = $this->master_model->getQueryResult("call usp_A_AddVisitorSites('" .
                        $data->VisitorID . "','" .
                        $data->UserID . "','1','" .
                        $data->UserType . "','" .
                        $IP . "','" .
                        $data->ProjectID . "','" .
                        $data->UserID  . "','" .
                        $value->Remarks  . "','" .
                        $data->EntryDate  . "','" .
                        $data->Finance  . "','" .
                        $data->PurposeofBuying  . "','" .
                        $data->PreferedTimeToCall  . "','" .
                        $data->InquiryDate  . "','" .
                        $data->LeadType  . "','" .
                        $value->SiteName  . "')");
                }


                if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_update_sites_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addVisitorSites' => $response);
    }

    function convertToCustomer($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } else {

                $IP = GetIP();

                $_result = $this->master_model->getQueryResult("call usp_M_ConvertVisitorToCustomer('" .
                    $data->VisitorID . "','" .
                    $data->UserID . "','" .
                    $data->UserType . "','" .
                    $IP . "')");

                if (isset($_result) && !empty($_result)  && isset($_result['0']->CustomerID)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_conertto_customer_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('convertToCustomer' => $response);
    }


    function editVisitor($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = GetIP();
                    $_result = $this->master_model->getQueryResult("call usp_A_EditVisitor('" .
                        $data->UserID . "','" .
                        $data->UserID . "','1','" .
                        $data->VisitorID . "','" .
                        $data->UserType . "','" .
                        $IP . "','" .
                        $data->FirstName . "','" .
                        $data->LastName . "','" .
                        $data->Address . "','" .
                        $data->CompanyName . "', '" .
                        $data->DesignationID . "','" .
                        $data->BirthDate . "','" .
                        $data->BirthMonth . "','" .
                        $data->AnniversaryDate . "','" .
                        $data->AnniversaryMonth . "','" .
                        $data->SecondMobileNo . "','" .
                        $data->SecondName . "','" .
                        $data->MobileNo . "','" .
                        $data->VisitorStatus . "','" .
                        $data->EmailID . "')");

                    if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                        $response['Error'] = 200;
                        $response['Message'] = label('msg_lbl_update_visitor_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editVisitor' => $response);
    }


    function editVisitorSites($data)
    {
        try {
            $response = array();
            if (!isset($data->SitesID) || $data->SitesID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'SitesID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_EditVisitorSites('" .
                    $data->ProjectID . "','" .
                    $data->UserID . "','1','" .
                    $data->SitesID . "','" .
                    $data->UserType . "','" .
                    $IP . "','" .
                    $data->UserID  . "','" .
                    $data->SiteName  . "','" .
                    $data->Remarks  . "','" .
                    $data->EntryDate  . "','" .
                    $data->Finance  . "','" .
                    $data->PurposeofBuying  . "','" .
                    $data->PreferedTimeToCall  . "','" .
                    $data->InquiryDate  . "','" .
                    $data->LeadType  . "')");

                if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_update_sites_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editVisitorSites' => $response);
    }

    function getRequirementValue($data)
    {
        try {
            $response = array();
            if (!isset($data->Requirenemnt) || $data->Requirenemnt == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Requirenemnt not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetRequirenmentvalue('1','1','" .
                    $data->Requirenemnt . "','1')");

                $array = array();
                if (isset($_result[0]->Value)) {
                    $array = explode(',', $_result[0]->Value);
                }

                $requirement = array();
                foreach ($array as $key => $value) {
                    $requirement[$key]['value'] = $_result[0]->Requirenemnt;
                    $requirement[$key]['Requirenemnt'] = $value;
                }

                $requirement = json_encode($requirement);

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_process_listed_successfully');
                    $response['data'] = json_decode($requirement);
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getRequirementValue' => $response);
    }

    function getLeadProcess($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } elseif (!isset($data->OpportunityID)) {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetLeadProcess('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->OpportunityID . "','" .
                    $data->VisitorID . "','1')");

                if (isset($_result) && !empty($_result) && isset($_result['0']->LeadProcessID)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_process_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getLeadProcess' => $response);
    }

    function getArea($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_A_GetArea('-1','1','','783','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_area_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getArea' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getArea' => $response);
        }
    }

    function editVisitorReminder($data)
    {
        try {
            $response = array();
            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } elseif (!isset($data->Message) || $data->Message == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found.';
            } elseif (!isset($data->ReminderDate) || $data->ReminderDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ReminderDate not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = GetIP();
                    $_result = $this->master_model->getQueryResult("call usp_A_EditVisitorReminder('" .
                        $data->ID . "','" .
                        $data->Message . "','" .
                        $data->ReminderDate . "','" .
                        $data->PastDate . "','" .
                        $data->UserID . "','1','" .
                        $data->UserType . "','" .
                        $IP . "','" .
                        $data->SitesID . "')");

                    if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                        $response['Error'] = 200;
                        $response['Message'] = label('msg_lbl_update_lead_reminder_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editVisitorReminder' => $response);
    }

    function addVisitorReminder($data)
    {
        try {
            $response = array();
            if (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } elseif (!isset($data->Message) || $data->Message == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found.';
            } elseif (!isset($data->ReminderDate) || $data->ReminderDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ReminderDate not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = GetIP();
                    $_result = $this->master_model->getQueryResult("call usp_A_AddVisitorReminder('" .
                        $data->VisitorID . "','" .
                        $data->Message . "','" .
                        $data->ReminderDate . "','" .
                        $data->PastDate . "','" .
                        $data->UserID . "','1','" .
                        $data->UserType . "','" .
                        $IP . "','" .
                        $data->SitesID . "')");

                    if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                        $response['Error'] = 200;
                        $response['Message'] = label('msg_lbl_add_visitor_reminder_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addVisitorReminder' => $response);
    }

    function editOpportunityReminder($data)
    {
        try {
            $response = array();
            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ID not found.';
            } elseif (!isset($data->Message) || $data->Message == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found.';
            } elseif (!isset($data->ReminderDate) || $data->ReminderDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ReminderDate not found.';
            } else {
                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = GetIP();
                    $_result = $this->master_model->getQueryResult("call usp_A_EditOpportunityReminder('" .
                        $data->ID . "','" .
                        $data->Message . "','" .
                        $data->ReminderDate . "','" .
                        $data->PastDate . "','" .
                        $data->UserID . "','1','" .
                        $data->UserType . "','" .
                        $IP . "')");

                    if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                        $response['Error'] = 200;
                        $response['Message'] = label('msg_lbl_update_lead_reminder_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editOpportunityReminder' => $response);
    }

    function addOpportunityReminder($data)
    {
        try {
            $response = array();
            if (!isset($data->OpportunityID) || $data->OpportunityID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } elseif (!isset($data->Message) || $data->Message == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found.';
            } elseif (!isset($data->ReminderDate) || $data->ReminderDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ReminderDate not found.';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");
                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {
                    $IP = GetIP();
                    $_result = $this->master_model->getQueryResult("call usp_A_AddOpportunityReminder('" .
                        $data->OpportunityID . "','" .
                        $data->Message . "','" .
                        $data->ReminderDate . "','" .
                        $data->PastDate . "','" .
                        $data->UserID . "','1','" .
                        $data->UserType . "','" .
                        $IP . "')");

                    if (isset($_result) && !empty($_result)  && !isset($_result['0']->Message)) {
                        $response['Error'] = 200;
                        $response['Message'] = label('msg_lbl_add_lead_reminder_successfully');
                        $response['data'] = $_result;
                    } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                        $msg = explode('~', $_result[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_error_occurred');
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addOpportunityReminder' => $response);
    }

    function getOpportunityReminder($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } elseif (!isset($data->OpportunityID) || $data->OpportunityID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_GetOpportunityReminder('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->OpportunityID . "')");

                if (isset($_result) && !empty($_result) && isset($_result['0']->OpportunityReminderID)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_lead_reminder_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getOpportunityReminder' => $response);
    }

    function getVisitorSites($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitorSites('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->VisitorID . "','1')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_visitor_sites_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getVisitorSites' => $response);
    }

    function getVisitorLead($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitLeads('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->VisitorID . "','1')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_visitor_lead_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getVisitorLead' => $response);
    }

    function reassignLead($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->OpportunityID)) {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } elseif (!isset($data->ReasonID)) {
                $response['Error'] = 102;
                $response['Message'] = 'ReasonID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_UpdateReAssignBy('" .
                    $data->UserID . "','1','" .
                    $data->OpportunityID . "','Admin Android','" .
                    $IP  . "','" .
                    $data->Remarks . "','" .
                    $data->ReasonID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $_opportunity = $this->master_model->getQueryResult("call usp_A_GetOpportunityByID('" .
                        $data->OpportunityID . "')");

                    $datastr =  'ReAssign Lead Name is (' . $_opportunity['0']->Name . ')';

                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $data->UserID . "')");

                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Lead Reminder',
                                'event' => '',
                                'ActionType' => '',
                                'detail' => ''
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }

                    $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");
                    foreach ($Userata as $key => $value) {
                        $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                            $value->UserID . "')");


                        if (!isset($EmployeeData['0']->Message)) {
                            foreach ($EmployeeData as $key => $devicevalue) {
                                $pushNotificationArr = array(
                                    'device_id' => $devicevalue->DeviceTokenID,
                                    'message' =>  $datastr,
                                    'title' => 'Lead Reminder',
                                    'event' => '',
                                    'ActionType' => '',
                                    'detail' => ''
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                        }
                    }

                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_reassign_lead_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('reassignLead' => $response);
    }

    function assignLead($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->OpportunityID)) {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_A_UpdateAssignBy('" .
                    $data->UserID . "','1','" .
                    $data->OpportunityID . "','Admin Android','" .
                    $IP  . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $_opportunity = $this->master_model->getQueryResult("call usp_A_GetOpportunityByID('" .
                        $data->OpportunityID . "')");

                    $datastr =  'New Lead Assign Name is (' . $_opportunity['0']->Name . ')';

                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $data->UserID . "')");

                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Lead Reminder',
                                'event' => '',
                                'ActionType' => '',
                                'detail' => ''
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }

                    $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");
                    foreach ($Userata as $key => $value) {
                        $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                            $value->UserID . "')");


                        if (!isset($EmployeeData['0']->Message)) {
                            foreach ($EmployeeData as $key => $devicevalue) {
                                $pushNotificationArr = array(
                                    'device_id' => $devicevalue->DeviceTokenID,
                                    'message' =>  $datastr,
                                    'title' => 'Lead Reminder',
                                    'event' => '',
                                    'ActionType' => '',
                                    'detail' => ''
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                        }
                    }

                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_assign_lead_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('assignLead' => $response);
    }

    function getUserFeedback($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } elseif (!isset($data->OpportunityID)) {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_GetUserFeedbackByID('" .
                    $data->VisitorID . "','" .
                    $data->OpportunityID . "','" .
                    $data->UserID  . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_feedback_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getUserFeedback' => $response);
    }

    function addUserFeedback($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserID not found.';
            } elseif (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VisitorID not found.';
            } elseif (!isset($data->OpportunityID)) {
                $response['Error'] = 102;
                $response['Message'] = 'OpportunityID not found.';
            } elseif (!isset($data->FeedbackID)) {
                $response['Error'] = 102;
                $response['Message'] = 'FeedbackID not found.';
            } elseif (!isset($data->CallStartDateTime)) {
                $response['Error'] = 102;
                $response['Message'] = 'CallStartDateTime not found.';
            } elseif (!isset($data->CallEndDateTime)) {
                $response['Error'] = 102;
                $response['Message'] = 'CallEndDateTime not found.';
            } elseif (!isset($data->Remarks)) {
                $response['Error'] = 102;
                $response['Message'] = 'Remarks not found.';
            } elseif (!isset($data->SitesID)) {
                $response['Error'] = 102;
                $response['Message'] = 'SitesID not found.';
            } elseif (!isset($data->ProjectID)) {
                $response['Error'] = 102;
                $response['Message'] = 'ProjectID not found.';
            } elseif (!isset($data->Type)) {
                $response['Error'] = 102;
                $response['Message'] = 'Type not found.';
            } elseif (!isset($data->FeedbackDate)) {
                $response['Error'] = 102;
                $response['Message'] = 'FeedbackDate not found.';
            } else {

                $IP = GetIP();
                $_result = $this->master_model->getQueryResult("call usp_AddUserFeedback('" .
                    $data->UserID . "','" .
                    $data->UserID . "','1','Admin Android','" .
                    $IP . "','" .
                    $data->VisitorID . "','" .
                    $data->OpportunityID . "','" .
                    $data->FeedbackID . "','" .
                    $data->CallStartDateTime . "','" .
                    $data->CallEndDateTime . "','" .
                    $data->Remarks . "','" .
                    $data->SitesID . "','" .
                    $data->ProjectID . "','" .
                    $data->Type . "','" .
                    $data->FeedbackDate . "')");

                if ($data->ReminderDate != '') {
                    $PastDate = date("Y-m-d") . ' ' . date("H:i");
                    if ($data->OpportunityID > 0) {
                        $this->master_model->getQueryResult("call usp_A_AddOpportunityReminder('" .
                            $data->OpportunityID . "','" .
                            $data->Remarks . "','" .
                            $data->ReminderDate . ' ' . $data->ReminderTime . "','" .
                            $PastDate . "','" .
                            $data->UserID . "','1','Admin Android','" .
                            $IP . "')");
                    } else {
                        $this->master_model->getQueryResult("call usp_A_AddVisitorReminder('" .
                            $data->VisitorID . "','" .
                            $data->Remarks . "','" .
                            $data->ReminderDate . ' ' . $data->ReminderTime . "','" .
                            $PastDate . "','" .
                            $data->UserID . "','1','Admin Android','" .
                            $IP . "','" .
                            $data->SitesID . "')");
                    }
                }

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_feedback_added_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addUserFeedback' => $response);
    }

    function getReason($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_A_GetReason('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_reason_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getReason' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getReason' => $response);
        }
    }

    function getFeedback($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_GetFeedback('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_feedback_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getFeedback' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getFeedback' => $response);
        }
    }

    function getOpportunity($data)
    {
        try {
            $response = array();
            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } elseif (!isset($data->EmployeeID)) {
                $response['Error'] = 102;
                $response['Message'] = 'EmployeeID not found.';
            } elseif (!isset($data->Name)) {
                $response['Error'] = 102;
                $response['Message'] = 'Name not found.';
            } elseif (!isset($data->MobileNo)) {
                $response['Error'] = 102;
                $response['Message'] = 'MobileNo not found.';
            } elseif (!isset($data->Project)) {
                $response['Error'] = 102;
                $response['Message'] = 'Project not found.';
            } elseif (!isset($data->Source)) {
                $response['Error'] = 102;
                $response['Message'] = 'Source not found.';
            } elseif (!isset($data->Feedback)) {
                $response['Error'] = 102;
                $response['Message'] = 'Feedback not found.';
            } elseif (!isset($data->LeadType)) {
                $response['Error'] = 102;
                $response['Message'] = 'LeadType not found.';
            } elseif (!isset($data->Requirement)) {
                $response['Error'] = 102;
                $response['Message'] = 'Requirement not found.';
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetOpprtunityAPI('" .
                    $data->PageSize . "','" .
                    $data->CurrentPage . "','" .
                    $data->Name . "','" .
                    $data->MobileNo . "','" .
                    $data->Project . "','" .
                    $data->Source . "','" .
                    $data->Feedback . "','" .
                    $data->LeadType . "','" .
                    $data->Requirement . "','" .
                    $data->EmployeeID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_opportunity_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getOpportunity' => $response);
    }

    function addOpportunityData($data)
    {
        try {
            $response = array();
            if (!isset($data->city) || $data->city == '') {
                $response['Error'] = 102;
                $response['Message'] = 'city not found.';
            } else if (!isset($data->dt) && $data->dt == '') {
                $response['Error'] = 102;
                $response['Message'] = 'dt not found';
            } else if (!isset($data->mobile) && $data->mobile == '') {
                $response['Error'] = 102;
                $response['Message'] = 'mobile not found';
            } else if (!isset($data->name) && $data->name == '') {
                $response['Error'] = 102;
                $response['Message'] = 'name not found';
            } else {
                $IP = getIP();
                $add_opportunity = $this->master_model->getQueryResult("call usp_A_AddOpportunityAPI('" .
                    $data->Type . "','1','1','Admin Web','" . $IP . "','" .
                    $data->city . "','" .
                    $data->dt . "','" .
                    $data->email . "','" .
                    $data->isd . "','" .
                    $data->locality . "','" .
                    $data->loginid . "','" .
                    $data->mobile . "','" .
                    $data->msg . "','" .
                    $data->name . "','" .
                    $data->pid . "','" .
                    $data->project . "','" .
                    $data->subject . "','" .
                    $data->time . "','" .
                    $data->tranType . "','" .
                    $data->VTime . "','" .
                    $data->vdate . "')");

                $assign = $this->master_model->getQueryResult("call usp_A_GetCampaignAPI('" . $data->Type . "','" . $data->project . "')");

                if (!isset($assign['0']->Message)) {
                    $this->master_model->getQueryResult("call usp_A_UpdateAssignBy('" . $assign['0']->AssignByType . "','1','" . $add_opportunity['0']->ID . "','Admin Web',$IP)");
                }

                if (isset($add_opportunity)) {
                    $response['Error'] = 200;
                    $response['Message'] = "Data Added Successfully";
                    $response['data'] = $add_opportunity;
                } else if (isset($add_opportunity['Message']) && $add_opportunity['Message'] != '') {
                    $msg = explode('~', $add_opportunity['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_opportunity;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addOpportunity' => $response);
    }

    function addOpportunity($data)
    {
        try {
            $response = array();
            if (!isset($data->city) || $data->city == '') {
                $response['Error'] = 102;
                $response['Message'] = 'city not found.';
            } else if (!isset($data->dt) && $data->dt == '') {
                $response['Error'] = 102;
                $response['Message'] = 'dt not found';
            } else if (!isset($data->mobile) && $data->mobile == '') {
                $response['Error'] = 102;
                $response['Message'] = 'mobile not found';
            } else if (!isset($data->name) && $data->name == '') {
                $response['Error'] = 102;
                $response['Message'] = 'name not found';
            } else {
                $IP = getIP();
                $add_opportunity = $this->master_model->getQueryResult("call usp_A_AddOpportunityAPI('MagicBricks','1','1','Admin Web','" . $IP . "','" .
                    $data->city . "','" .
                    $data->dt . "','" .
                    $data->email . "','" .
                    $data->isd . "','" .
                    $data->locality . "','" .
                    $data->loginid . "','" .
                    $data->mobile . "','" .
                    $data->msg . "','" .
                    $data->name . "','" .
                    $data->pid . "','" .
                    $data->project . "','" .
                    $data->subject . "','" .
                    $data->time . "','" .
                    $data->tranType . "','" .
                    $data->VTime . "','" .
                    $data->vdate . "')");

                if (isset($add_opportunity)) {
                    $response['Error'] = 200;
                    $response['Message'] = "Data Added Successfully";
                    $response['data'] = $add_opportunity;
                } else if (isset($add_opportunity['Message']) && $add_opportunity['Message'] != '') {
                    $msg = explode('~', $add_opportunity['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_opportunity;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addOpportunity' => $response);
    }

    function getInwardByVendorID($data)
    {
        try {
            $response = array();

            if (!isset($data->PageSize) || $data->PageSize == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PageSize not found.';
            } elseif (!isset($data->CurrentPage) || $data->CurrentPage == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CurrentPage not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetVendor('" . $data->PageSize . "','" . $data->CurrentPage . "','','','1')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    foreach ($_result as $k => $val) {

                        $_result[$k]->InwardDate = $this->master_model->getQueryResult("call usp_M_GetInwardMaster_ListbyVendorID('-1','1','" . base_url() . "','" . $val->VendorID . "')");

                        if (isset($_result[$k]->InwardDate) && !empty($_result[$k]->InwardDate) && !isset($_result[$k]->InwardDate['0']->Message)) {
                            foreach ($_result[$k]->InwardDate as $i => $value) {
                                $_result[$k]->InwardDate[$i]->Item = $this->master_model->getQueryResult("call usp_M_GetInwardItem_List('" . $value->GoodsReceivedNoteID . "')");
                                if (isset($_result[$k]->InwardDate[$i]->Item) && !empty($_result[$k]->InwardDate[$i]->Item) && !isset($_result[$k]->InwardDate[$i]->Item['0']->Message)) {
                                } else {
                                    $_result[$k]->InwardDate[$i]->Item = array();
                                }
                            }
                        } else {
                            $_result[$k]->InwardDate = array();
                        }
                    }
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }


                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_inward_listed');
                    $response['rowcount'] = $_result['0']->rowcount;
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getInwardByVendorID' => $response);
    }

    function deleteInvoiceImg($data)
    {
        try {
            $response = array();
            if (!isset($data->GoodsReceivedNoteID) || $data->GoodsReceivedNoteID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'GoodsReceivedNoteID not found.';
            } else {
                $IP = getIP();
                $_result = $this->master_model->getQueryResult("call usp_A_UpdateInvoiceImage(
                        '" . $data->GoodsReceivedNoteID . "','')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = 'Delete Image Successfully';
                    $response['data'] = $_result['0'];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('deleteInvoiceImg' => $response);
    }

    function addEditInvoiceImage($data)
    {
        try {
            $response = array();
            if (!isset($data['GoodsReceivedNoteID']) || $data['GoodsReceivedNoteID'] == '') {
                $response['error'] = 102;
                $response['message'] = 'GoodsReceivedNoteID not found';
            } else {
                $IP = GetIP();

                if ($_FILES['Image']['error'] == 0) {

                    $path           = INVOICE_UPLOAD_PATH;
                    $max_size       = INVOICE_MAX_SIZE;
                    $allowed_types  = INVOICE_ALLOWED_TYPES;

                    $imageNameTime = time();
                    $file_name = $imageNameTime . "_" . $data['GoodsReceivedNoteID'];
                    $CV_real_name = @$_FILES['Image']['name'];

                    $uploadFile = 'Image';
                    $result = array();
                    $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                    if (isset($result['error']) && @$result['error'] != '') {
                        $result['error'] = str_replace('<p>', '', $result['error']);
                        $result['error'] = str_replace('</p>', '', $result['error']);
                    }

                    if ($result['status'] == 1) {

                        $uploadedFileName = $result['upload_data']['file_name'];

                        $SourcePath     = INVOICE_UPLOAD_PATH . $uploadedFileName;
                        $DesPath        = INVOICE_THUMB_UPLOAD_PATH . $uploadedFileName;
                        $max_width      = INVOICE_THUMB_MAX_WIDTH;
                        $max_height     = INVOICE_THUMB_MAX_HEIGHT;

                        list($w, $h, $type, $attr) = getimagesize($SourcePath);
                        if (!(($w <= $max_width) && ($h <= $max_height))) {
                            $ratio = $max_width / $w;
                            $new_w = $max_width;
                            $new_h = $h * $ratio;

                            if ($new_h > $max_height) {
                                $ratio = $max_height / $h;
                                $new_h = $max_height;
                                $new_w = $w * $ratio;
                            }
                        } else {
                            $new_w = $w;
                            $new_h = $h;
                        }
                        $new_image = imagecreatetruecolor($new_w, $new_h);
                        $type = explode('.', $uploadedFileName);
                        switch (strtolower($type[1])) {
                            case 'jpeg':
                            case 'jpg':
                            case 'JPG':
                                $image = imagecreatefromjpeg($SourcePath);
                                break;
                            case 'png':
                            case 'PNG':
                                $image = imagecreatefrompng($SourcePath);
                                break;
                            case 'gif':
                                $image = imagecreatefromgif($SourcePath);
                                break;
                            default:
                                exit('Unsupported type: ' . $SourcePath);
                        }
                        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                        imagejpeg($new_image, $DesPath, 90);

                        $FlagImage = '1';
                    } else {
                        $FlagImage = '0';
                    }
                } else {
                    $FlagImage = '0';
                }

                $_result = $this->master_model->getQueryResult("call usp_A_UpdateInvoiceImage(
                        '" . $data['GoodsReceivedNoteID'] . "',
                        '" . $uploadedFileName . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_image_upload_successfully');
                    $response['data'] = $_result['0'];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addEditInvoiceImage' => $response);
    }

    function addChallanPhoto($data)
    {
        try {
            $response = array();
            if (!isset($data['GoodsReceivedNoteID']) || $data['GoodsReceivedNoteID'] == '') {
                $response['error'] = 102;
                $response['message'] = 'GoodsReceivedNoteID not found';
            } else {
                $IP = GetIP();

                if ($_FILES['Image']['error'] == 0) {

                    $path           = INWARD_UPLOAD_PATH;
                    $max_size       = INWARD_MAX_SIZE;
                    $allowed_types  = INWARD_ALLOWED_TYPES;

                    $imageNameTime = time();
                    $file_name = $imageNameTime . "_" . $data['GoodsReceivedNoteID'];
                    $CV_real_name = @$_FILES['Image']['name'];

                    $uploadFile = 'Image';
                    $result = array();
                    $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                    if (isset($result['error']) && @$result['error'] != '') {
                        $result['error'] = str_replace('<p>', '', $result['error']);
                        $result['error'] = str_replace('</p>', '', $result['error']);
                    }

                    if ($result['status'] == 1) {

                        $uploadedFileName = $result['upload_data']['file_name'];

                        $SourcePath     = INWARD_UPLOAD_PATH . $uploadedFileName;
                        $DesPath        = INWARD_THUMB_UPLOAD_PATH . $uploadedFileName;
                        $max_width      = INWARD_THUMB_MAX_WIDTH;
                        $max_height     = INWARD_THUMB_MAX_HEIGHT;

                        list($w, $h, $type, $attr) = getimagesize($SourcePath);
                        if (!(($w <= $max_width) && ($h <= $max_height))) {
                            $ratio = $max_width / $w;
                            $new_w = $max_width;
                            $new_h = $h * $ratio;

                            if ($new_h > $max_height) {
                                $ratio = $max_height / $h;
                                $new_h = $max_height;
                                $new_w = $w * $ratio;
                            }
                        } else {
                            $new_w = $w;
                            $new_h = $h;
                        }
                        $new_image = imagecreatetruecolor($new_w, $new_h);
                        $type = explode('.', $uploadedFileName);
                        switch (strtolower($type[1])) {
                            case 'jpeg':
                            case 'jpg':
                            case 'JPG':
                                $image = imagecreatefromjpeg($SourcePath);
                                break;
                            case 'png':
                            case 'PNG':
                                $image = imagecreatefrompng($SourcePath);
                                break;
                            case 'gif':
                                $image = imagecreatefromgif($SourcePath);
                                break;
                            default:
                                exit('Unsupported type: ' . $SourcePath);
                        }
                        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                        imagejpeg($new_image, $DesPath, 90);

                        $FlagImage = '1';
                    } else {
                        $FlagImage = '0';
                    }
                } else {
                    $FlagImage = '0';
                }

                $_result = $this->master_model->getQueryResult("call usp_A_UpdateChallanImage(
                        '" . $data['GoodsReceivedNoteID'] . "',
                        '" . $uploadedFileName . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_image_upload_successfully');
                    $response['data'] = $_result['0'];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addChallanPhoto' => $response);
    }

    function getInward($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetInwardMaster_List(
                    '" . $data->PageSize . "',
                    '" . $data->CurrentPage . "'
                )");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                foreach ($_result as $k => $val) {
                    $_result[$k]->Item = $this->master_model->getQueryResult("call usp_M_GetInwardItem_List('" . $val->GoodsReceivedNoteID . "')");
                    if (isset($_result[$k]->Item) && !empty($_result[$k]->Item) && !isset($_result[$k]->Item['0']->Message)) {
                    } else {
                        $_result[$k]->Item = array();
                    }
                }
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_inward_listed');
                $response['data'] = $_result;
                $response['rowcount'] = $_result['0']->rowcount;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getInward' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getInward' => $response);
        }
    }

    function addInward($data)
    {
        try {
            $response = array();
            if (!isset($data->UserType) || $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'UserType not found.';
            } else if (!isset($data->EmployeeID) && $data->EmployeeID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Employee Code not found';
            } else if (!isset($data->VendorID) && $data->VendorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'VendorID not found';
            } else if (!isset($data->ChallanNo) && $data->ChallanNo == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ChallanNo not found';
            } else if (!isset($data->ChallanDate) && $data->ChallanDate == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ChallanDate not found';
            } else if (!isset($data->TotalPrice) && $data->TotalPrice == '') {
                $response['Error'] = 102;
                $response['Message'] = 'TotalPrice not found';
            } else if (!isset($data->CategoryID) && $data->CategoryID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CategoryID not found';
            } else if (!isset($data->ProjectID) && $data->ProjectID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ProjectID not found';
            } else {
                $IP = getIP();
                $_result = $this->master_model->getQueryResult("call usp_A_AddInward(
                        '" . $data->UserType . "',
                        '" . $IP . "',
                        '" . $data->EmployeeID . "','1',
                        '" . $data->VendorID . "',
                        '" . $data->ChallanNo . "',
                        '" . $data->ChallanPhoto . "',
                        '" . $data->ChallanDate . "',
                        '" . $data->TotalPrice . "',
                        '" . $data->CategoryID . "',
                        '" . $data->ProjectID . "'
                    )");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {

                    $length = sizeof($data->item);
                    for ($i = 0; $i < $length; $i++) {
                        $_resultItem = $this->master_model->getQueryResult("call usp_A_AddInwardItem
                            (   
                                '" . $data->UserType . "',
                                '" . $IP . "',
                                '" . $data->EmployeeID . "','1',
                                '" . $_result['0']->ID . "',
                                '" . $data->item[$i]->GoodsID . "',
                                '" . $data->item[$i]->Qty . "',
                                '" . $data->item[$i]->UOMID . "',
                                '" . $data->item[$i]->Rate . "',
                                '" . $data->item[$i]->FinalPrice . "'
                            )");
                    }

                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_inward_added');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addInward' => $response);
    }

    function getVendor($data)
    {
        try {
            $response = array();

            if (!isset($data->CategoryID) || $data->CategoryID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CategoryID not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetVendorbyCategoryID('" . $data->CategoryID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_vendor_listed');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getVendor' => $response);
    }

    function getGoods($data)
    {
        try {
            $response = array();
            if (!isset($data->CategoryID) || $data->CategoryID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'CategoryID not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetGoodbyCategoryID('" . $data->CategoryID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('msg_lbl_goods_listed');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getGoods' => $response);
    }

    function getUOM($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_GetUOM('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_uom_listed');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getUOM' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getUOM' => $response);
        }
    }

    function getCategory($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_GetCategory('-1','1','','1')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_category_listed');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getCategory' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getCategory' => $response);
        }
    }

    function addmisscall($data)
    {
        try {
            $response = array();
            if (!isset($data->MsgId) || $data->MsgId == '') {
                $response['Error'] = 102;
                $response['Message'] = 'MsgId not found.';
            } else if (!isset($data->LongCode) && $data->LongCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Long Code not found';
            } else if (!isset($data->RcvFrom) && $data->RcvFrom == '') {
                $response['Error'] = 102;
                $response['Message'] = 'RcvFrom not found';
            } else if (!isset($data->RcvTime) && $data->RcvTime == '') {
                $response['Error'] = 102;
                $response['Message'] = 'RcvTime not found';
            } else if (!isset($data->MsgText) && $data->MsgText == '') {
                $response['Error'] = 102;
                $response['Message'] = 'MsgText not found';
            } else {
                $IP = getIP();
                $add_misscall = $this->master_model->getQueryResult("call usp_A_AddMisscallAPI('" . $data->MsgId . "','1','1','Admin Web','" . $IP . "','" . $data->LongCode . "','" . $data->RcvFrom . "','" . $data->RcvTime . "','" . $data->MsgText . "')");

                if (isset($add_misscall)) {
                    $response['Error'] = 200;
                    $response['Message'] = "Misscall Added Successfully";
                    $response['data'] = $add_misscall;
                } else if (isset($add_misscall['Message']) && $add_misscall['Message'] != '') {
                    $msg = explode('~', $add_misscall['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_misscall;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addmisscall' => $response);
    }


    function getEmployee($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetEmployeeCombobox()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_employee_listed_success');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getEmployee' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getEmployee' => $response);
        }
    }

    function getChanelPartners($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetChanelPartners()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('msg_lbl_chanel_partners_listed_success');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getChanelPartners' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getChanelPartners' => $response);
        }
    }

    function getGroup($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetGroup()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_group_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getGroup' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getGroup' => $response);
        }
    }

    function getCountry($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetCountry()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_country_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getCountry' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getCountry' => $response);
        }
    }

    function getDesignation($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetDesignation()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_designation_listed_successfully');
                $response['data'] = $_result;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            return array('getDesignation' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getDesignation' => $response);
        }
    }

    function getStates($data)
    {
        try {
            $response = array();

            if (@$data->CountryID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Country not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetState('" . $data->CountryID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_state_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getStates' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getStates' => $response);
        }
    }

    function getCities($data)
    {
        try {
            $response = array();

            if (@$data->StateID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'State not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetCity('" . $data->StateID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_cities_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getCities' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getCities' => $response);
        }
    }

    function getPropertyByCustomer($data)
    {
        try {
            $response = array();

            if (@$data->CustomerID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetPropertyByCustomer('" . $data->CustomerID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_property_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getPropertyByCustomer' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getPropertyByCustomer' => $response);
        }
    }

    function getPropertyMileStoneByProperty($data)
    {
        try {
            $response = array();

            if (@$data->PropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_GetPropertyMileStoneByProperty('" . $data->PropertyID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_property_milestone_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getPropertyMileStoneByProperty' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getPropertyMileStoneByProperty' => $response);
        }
    }

    function getConfig($data)
    {
        try {
            $response = array();

            $_result = $this->master_model->getQueryResult("call usp_M_GetConfig()");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_get_config_successfully');
                $_result[0]->Requirement = explode(',', $_result[0]->Requirement);
                $_result[0]->LeadType = explode(',', $_result[0]->LeadType);
                $response['data'] = $_result[0];
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }

            return array('getConfig' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getConfig' => $response);
        }
    }

    function getPage()
    {
        $response = array();
        $PageID = @$_GET['PageID'];
        $PageName = @$_GET['PageName'];

        if ($PageID == '' && $PageName == '') {
            $response['Error'] = 102;
            $response['Message'] = label('api_msg_page_not_found');
        } else {
            $PageID = ($PageID == 0) ? '' : $PageID;

            if ((!isset($PageID) && !isset($PageName)) || ($PageID == '' && $PageName == '')) {
                $PageID = 1;
            }
            if (!isset($PageName)) {
                $PageName = '';
            }

            $page_result = $this->master_model->getQueryResult("call usp_M_GetCMSPage('" . $PageID . "','" . $PageName . "')");
            if (isset($page_result[0]->CMSID) && $page_result[0]->CMSID > 0  && $page_result[0]->Content != '') {
                echo $page_result[0]->Content;
                die;
            }
        }
        echo json_encode($response);
        exit();
    }

    function userSignup($data)
    {
        try {
            $response = array();

            //IN `_FirstName` VARCHAR(150), IN `_LastName` VARCHAR(150), IN `_OwnerName` VARCHAR(150), IN `_EmailID` VARCHAR(250), IN `_MobileNo` VARCHAR(13), IN `_DOB` VARCHAR(50), IN `_Gender` ENUM('Male','Female'), IN `_Password` VARCHAR(50), IN `_RegistrationType` ENUM('Regular','Facebook','Google','Linkedin','Twitter'), IN `_RegId` VARCHAR(50), IN `_ProfilePic` VARCHAR(200), IN `_path` VARCHAR(250), IN `_NotificationToken` TEXT, IN `_DeviceType` ENUM('Admin Web','Employee Web','Company Web','Mentor Web','Candidate Web','Admin Android','Employee Android','Company Android','Mentor Android','Candidate Android','Admin IOS','Employee IOS','Company IOS','Mentor IOS','Candidate IOS'), IN `_DeviceUID` VARCHAR(50), IN `_DeviceName` VARCHAR(50), IN `_DeviceOS` VARCHAR(20), IN `_OSVersion` VARCHAR(20), IN `_OTP` INT

            if (!isset($data->FirstName) || $data->FirstName == '') {
                $response['Error'] = 102;
                $response['Message'] = 'First name not found.';
            } else if (!isset($data->LastName) && $data->LastName == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Last name not found';
            } else if (!isset($data->Password) && $data->Password == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Password not found';
            } else if ((!isset($data->EmailID) && $data->EmailID == '') || (!isset($data->MobileNo) && $data->MobileNo == '')) {
                $response['Error'] = 102;
                $response['Message'] = 'Email and mobile not found';
            } else {

                $add_user = $this->master_model->userSignup($data);

                if (isset($add_user['UserID']) && $add_user['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_add_profile_successfully');

                    $response['data'] = $add_user;
                    $response['Role'] = array();
                    $_role = $this->getRoleByID($data->RoleID, '-1');
                    if (!empty($_role))
                        $response['Role'] = $_role;

                    $Content = $this->master_model->get_emailtemplate($id = 1);
                    // $Content = '<div><center>{logo} &nbsp; &nbsp; {WebsiteName}</center><br/>Hello, <br/><br/> {message_content} <br/><br/>Thnaks<br/>Support team.</div>';
                    // $EmailSubject = $data->Subject;
                    $array['ToEmailID'] = $data->EmailID;
                    $array['Subject']  = DEFAULT_WEBSITE_TITLE . '- ' . $Content['EmailSubject'];
                    $array['Body'] = $Content['Content'];
                    $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['FromName'] = DEFAULT_FROM_NAME;
                    $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                    $array['AltBody'] = '';
                    $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                    $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  

                    $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{account_login_link}', '{base_url}');
                    $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $data->FirstName, $data->LastName, $back_image_path, base_url() . 'admin-login', base_url());
                    $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                    //pr($array['Body']);exit();
                    $res = CustomMail($array);
                    if ($res == 1) {
                        //Success
                    }
                } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                    $msg = explode('~', $add_user['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_user;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('userSignup' => $response);
    }

    function checkLogin($data)
    {
        $response = array();
        if (@$data->EmailID == '') {
            $response['Error'] = 102;
            $response['Message'] = label('api_msg_email_not_found');
        } else if ($data->Password == '') {
            $response['Error'] = 102;
            $response['Message'] = label('api_msg_password_not_found');
        } else {

            if (!isset($data->NotificationToken)) $data->NotificationToken = '';
            if (!isset($data->DeviceUID)) $data->DeviceUID = '';
            if (!isset($data->DeviceName)) $data->DeviceName = '';
            if (!isset($data->OSVersion)) $data->OSVersion = '';
            if (!isset($data->DeviceType)) $data->DeviceType = '';

            $data->DeviceName = getStringClean($data->DeviceName);

            //echo "call usp_M_CheckLogin('".$data->EmailID."','".fnEncrypt($data->Password)."','".base_url().'assets/uploads/company/'."','".$data->NotificationToken."','".$data->DeviceUID."','".$data->DeviceName."','".$data->OSName."','".$data->DeviceType."')";
            $_result = $this->master_model->getQueryResult("call usp_M_CheckLogin('" . $data->EmailID . "','" . fnEncrypt($data->Password) . "','" . base_url() . 'assets/uploads/company/' . "','" . $data->NotificationToken . "','" . $data->DeviceUID . "','" . $data->DeviceName . "','" . $data->OSVersion . "','" . $data->DeviceType . "')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_login_successfully');

                $add_user = (array) $_result[0];

                $response['data'] = $add_user;
                $response['Role'] = array();
                $_role = $this->getRoleByID($add_user['RoleID'], '-1');
                if (!empty($_role))
                    $response['Role'] = $_role;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0] && $msg[0] != 0) ? $msg[0] : '103';
                $response['Message'] = @$msg[1];
                $response['data'] = array(); //$_result;
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
        }
        return array('checkLogin' => $response);
    }

    // Change password for all type of user
    function changePassword($data)
    {
        try {
            $response = array();
            if (@$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } elseif (@$data->OldPassword == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_old_password_not_found');
            } elseif (@$data->Password == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_password_not_found');
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_ChangePassword('" . $data->UserID . "','" . fnEncrypt($data->OldPassword) . "','" . fnEncrypt($data->Password) . "')");

                if (isset($_result[0]->Message)) {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('changePassword' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('changePassword' => $response);
        }
    }

    // Forgot password for all type of user
    function forgotPassword($data)
    {
        try {
            $response = array();
            if (@$data->EmailID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_email_not_found');
            } else {
                $random_string = str_replace('=', '', base64_encode(date('dHs')));
                $data->random_string = $random_string;
                $forgot_password_result = $this->master_model->getQueryResult("call usp_M_ForgotPassword('" . $data->EmailID . "')");

                if (isset($forgot_password_result['0']->Password) && $forgot_password_result['0']->Password != '') {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_new_password_send_by_mail');
                    $response['data'] = $forgot_password_result['0'];

                    /* It is remaining ::
                    $email_details = $this->email_template_model->getEmailTemplateDetailsByEmailTemplateTitle('reset_password_email');
                    $search_array = array('##RESET_PASSWORD_LINK##');                
                    $replace_array = array($data->reset_password_link);
                    $body = str_replace($search_array, $replace_array, $email_details['Content']);
                    sendEmail($data->email_id), $email_details->EmailSubject,$body);*/

                    $Content = $this->master_model->get_emailtemplate($id = 6);
                    // $Content = '<div><center>{logo} &nbsp; &nbsp; {WebsiteName}</center><br/>Hello, <br/><br/> {message_content} <br/><br/>Thnaks<br/>Support team.</div>';
                    // $EmailSubject = $data->Subject;
                    $array['ToEmailID'] = $data->EmailID;
                    $array['Subject']  = DEFAULT_WEBSITE_TITLE . '- ' . $Content['EmailSubject'];
                    $array['Body'] = $Content['Content'];
                    $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['FromName'] = DEFAULT_FROM_NAME;
                    $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                    $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                    $array['AltBody'] = '';
                    $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                    $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';  

                    $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{password}', '{base_url}');
                    $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $forgot_password_result['0']->FirstName, $forgot_password_result['0']->LastName, $back_image_path, fnDecrypt($forgot_password_result['0']->Password), base_url());
                    $array['Body'] = str_replace($data1, $datavalue, $array['Body']);

                    $res = CustomMail($array);
                    if ($res == 1) {
                        //Success
                    }
                } elseif (isset($forgot_password_result['UserID']) && $forgot_password_result['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_new_password_send_by_mail');
                    $response['data'] = $forgot_password_result;
                    $response['password_data'] = $data;
                    /* It is remaining ::
                    $email_details = $this->email_template_model->getEmailTemplateDetailsByEmailTemplateTitle('reset_password_email');
                    $search_array = array('##RESET_PASSWORD_LINK##');                
                    $replace_array = array($data->reset_password_link);
                    $body = str_replace($search_array, $replace_array, $email_details['Content']);
                    sendEmail($data->email_id), $email_details->EmailSubject,$body);*/
                } elseif (isset($forgot_password_result['0']->Message)) {
                    $msg = explode('~', $forgot_password_result['0']->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    //$response['employeeForgotPassword']['data'] = $forgot_password_result;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('forgotPassword' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('forgotPassword' => $response);
        }
    }

    function getProjectByRole($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } elseif (!isset($data->RoleID) || $data->RoleID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Role not found.';
            } else {
                $data->UserID = (isset($data->UserID) || @$data->UserID != '') ? $data->UserID : '-1';
                $data->RoleID = (isset($data->RoleID) || @$data->RoleID != '') ? $data->RoleID : '-1';
                $data->Type = (isset($data->Type) || @$data->Type != '') ? $data->Type : 'All';

                $_result = $this->master_model->getQueryResult("call usp_A_GetProjectByRole('" . $data->UserID . "','" . $data->RoleID . "','" . $data->Type . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_project_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getProjectByRole' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getProjectByRole' => $response);
        }
    }

    function getProject($data)
    {
        try {
            $response = array();

            // if (!isset($data->JobPostID) || $data->JobPostID == ''){
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Job not found.';
            // } else {
            $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
            $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
            $data->SearchText = (isset($data->SearchText) || @$data->SearchText != '') ? $data->SearchText : '';
            $data->Location = (isset($data->Location) || @$data->Location != '') ? $data->Location : '';
            $data->GroupID = (isset($data->GroupID) || @$data->GroupID != '') ? $data->GroupID : '-1';
            $data->Status = (isset($data->Status) || @$data->Status != '') ? $data->Status : '-1';

            $_result = $this->master_model->getQueryResult("call usp_A_GetProject('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->SearchText . "','" . $data->Location . "','" . $data->GroupID . "','" . $data->Status . "')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_project_listed_successfully');
                $response['data'] = $_result;
                $response['rowcount'] = $_result['0']->rowcount;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            // }
            return array('getProject' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getProject' => $response);
        }
    }

    function getPropertyByProjectID($data)
    {
        try {
            $response = array();

            if (!isset($data->ProjectID) || $data->ProjectID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Project not found.';
            } else {
                // $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                // $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                $data->ProjectID = (isset($data->ProjectID) || @$data->ProjectID != '') ? $data->ProjectID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetPropertyByProjectID('" . $data->ProjectID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_property_listed_successfully');
                    $response['data'] = $_result;
                    //$response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
            return array('getPropertyByProjectID' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('getPropertyByProjectID' => $response);
        }
    }

    function getVisitor($data)
    {
        try {
            $response = array();

            $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
            $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
            $data->EmployeeID = (isset($data->EmployeeID) || @$data->EmployeeID != '') ? $data->EmployeeID : '-1';
            $data->DesignationID = (isset($data->DesignationID) || @$data->DesignationID != '') ? $data->DesignationID : '-1';
            $data->Name = (isset($data->Name) || @$data->Name != '') ? $data->Name : '';
            $data->EmailID = (isset($data->EmailID) || @$data->EmailID != '') ? $data->EmailID : '';
            $data->MobileNo = (isset($data->MobileNo) || @$data->MobileNo != '') ? $data->MobileNo : '';
            $data->Profession = (isset($data->Profession) || @$data->Profession != '') ? $data->Profession : 'All';
            $data->Requirement = (isset($data->Requirement) || @$data->Requirement != '') ? $data->Requirement : 'All';
            $data->RoleID = (isset($data->RoleID) || @$data->RoleID != '') ? $data->RoleID : '0';
            $data->ProjectID = (isset($data->ProjectID) || @$data->ProjectID != '') ? $data->ProjectID : '0';
            $data->Status = 1; //(isset($data->Status) || @$data->Status!='') ? $data->Status : '-1';

            $_result = $this->master_model->getQueryResult("call usp_A_GetVisitor('" .
                $data->PageSize . "','" .
                $data->CurrentPage . "','" .
                $data->EmployeeID . "','" .
                $data->Name . "','" .
                $data->EmailID . "','" .
                $data->MobileNo . "','" .
                $data->Profession . "','" .
                $data->DesignationID . "','" .
                $data->Requirement . "','" .
                $data->Status . "','" .
                $data->RoleID . "','" .
                $data->ProjectID . "')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_visitor_listed_successfully');
                $response['data'] = $_result;
                $response['rowcount'] = $_result['0']->rowcount;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            // }

        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getVisitor'=>$response);
        }
        return array('getVisitor' => $response);
    }

    function addVisitor($data)
    {
        try {
            $response = array();
            if (!isset($data->EmployeeID) || $data->EmployeeID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {
                //usp_M_CheckPassCode

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->EmployeeID . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->EmployeeID) || $data->EmployeeID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Employee not found.';
                    } else if (!isset($data->FirstName) && $data->FirstName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'FirstName not found';
                    } else if (!isset($data->LastName) && $data->LastName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'LastName not found';
                    } else if (!isset($data->MobileNo) && $data->MobileNo == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Mobile number not found';
                    } else if (!isset($data->EntryDate) && $data->EntryDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'EntryDate not found';
                    } else {

                        $data->Address = getStringClean($data->Address);
                        $data->FirstName = getStringClean($data->FirstName);
                        $data->LastName = getStringClean($data->LastName);

                        $add_user = $this->master_model->addVisitor($data);

                        if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_add_visitor_successfully');

                            $response['data'] = $add_user;

                            // if ($data->UserType == "Employee IOS" || $data->UserType == "Admin IOS") {
                            //     $data->ReminderDate = $data->ReminderDate . " " . $data->ReminderTime;
                            // } else {
                            //     $data->ReminderDate = $data->ReminderDate;
                            // }


                            // $data->PastDate = $data->EntryDate;
                            // $data->VisitorID = $add_user['ID'];
                            // $data->UserID = $data->EmployeeID;
                            // $data->Message = str_replace('.', '', label('api_msg_followup_new_visitor')) . '(' . $data->FirstName . ' ' . $data->LastName . ').';

                            // $reminder = $this->master_model->updateVisitorReminder($data);
                        } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                            $msg = explode('~', $add_user['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                            $response['data'] = $add_user;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('addVisitor' => $response);
    }

    function getCustomer($data)
    {
        try {
            $response = array();

            // if (!isset($data->CustomerID) || $data->CustomerID == ''){
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Customer not found.';
            // } else {
            $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
            $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
            $data->Name = (isset($data->Name) || @$data->Name != '') ? $data->Name : '';
            $data->EmailID = (isset($data->EmailID) || @$data->EmailID != '') ? $data->EmailID : '';
            $data->MobileNo = (isset($data->MobileNo) || @$data->MobileNo != '') ? $data->MobileNo : '';
            $data->Status = (isset($data->Status) || @$data->Status != '') ? $data->Status : '-1';
            $data->RoleID = (isset($data->RoleID) || @$data->RoleID != '') ? $data->RoleID : '-1';
            $data->ProjectID = (isset($data->ProjectID) || @$data->ProjectID != '') ? $data->ProjectID : '-1';
            $data->PropertyID = (isset($data->PropertyID) || @$data->PropertyID != '') ? $data->PropertyID : '-1';
            $data->UserID = (isset($data->UserID) || @$data->UserID != '') ? $data->UserID : '-1';

            $_result = $this->master_model->getQueryResult("call usp_A_GetCustomer('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->Name . "','" . $data->MobileNo . "','" . $data->Status . "','" . $data->EmailID . "','" . $data->RoleID . "','" . $data->ProjectID . "','Mobile','" . $data->PropertyID . "','" . $data->UserID . "')");

            if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                $response['Error'] = 200;
                $response['Message'] = label('api_msg_customer_listed_successfully');
                $response['data'] = $_result;
                $response['rowcount'] = $_result['0']->rowcount;
            } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                $msg = explode('~', $_result[0]->Message);
                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                $response['Message'] = $msg[1];
                $response['data'] = array();
            } else {
                $response['Error'] = 104;
                $response['Message'] = label('api_msg_error_occurred');
            }
            // }

        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getCustomer'=>$response);
        }
        return array('getCustomer' => $response);
    }

    function getCustomerBySearch($data)
    {
        try {
            $response = array();

            if (!isset($data->MobileNo) || $data->MobileNo == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Mobile number not found.';
            } else {
                $data->MobileNo = (isset($data->MobileNo) || @$data->MobileNo != '') ? $data->MobileNo : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerBySearch('" . $data->MobileNo . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_listed_successfully');
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerBySearch' => $response);
    }

    function getCustomerPayment($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer property not found.';
            } else {
                // $data->PageSize = (isset($data->PageSize) || $data->PageSize!='') ? $data->PageSize : 10;
                // $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage!='') ? $data->CurrentPage : 1;
                // $data->CustomerID = (isset($data->CustomerID) || @$data->CustomerID!='') ? $data->CustomerID : '-1';
                // $data->Status = (isset($data->Status) || @$data->Status!='') ? $data->Status : '-1';
                $data->CustomerPropertyID = (isset($data->CustomerPropertyID) || @$data->CustomerPropertyID != '') ? $data->CustomerPropertyID : '-1';
                //$_result = $this->master_model->getQueryResult("call usp_A_GetCustomerPayment('".$data->PageSize."','".$data->CurrentPage."','".$data->CustomerID."','".$data->Status."')");
                $_result = $this->master_model->getQueryResult("call usp_M_GetCustomerPayment('" . $data->CustomerPropertyID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_payment_listed_successfully');
                    $response['data'] = $_result;
                    //$response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getCustomerPayment'=>$response);
        }
        return array('getCustomerPayment' => $response);
    }

    function getCustomerProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerID) || $data->CustomerID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->CustomerID = (isset($data->CustomerID) || @$data->CustomerID != '') ? $data->CustomerID : '-1';
                $data->Status = (isset($data->Status) || @$data->Status != '') ? $data->Status : '-1';
                $data->ProjectID = (isset($data->ProjectID) || @$data->ProjectID != '') ? $data->ProjectID : '-1';
                $data->RoleID = (isset($data->RoleID) || @$data->RoleID != '') ? $data->RoleID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerProperty('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerID . "','" . $data->Status . "','" . base_url() . "','" . $data->ProjectID . "','" . $data->RoleID . "','Mobile')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_property_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerProperty' => $response);
    }

    function addCustomer($data)
    {
        try {
            $response = array();

            if (!isset($data->CreatedBy) || $data->CreatedBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->CreatedBy . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->FirstName) || $data->FirstName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'First name not found.';
                    } else if (!isset($data->LastName) && $data->LastName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Last name not found';
                    } else if (!isset($data->MobileNo) && $data->MobileNo == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Mobile number not found';
                    } else if (!isset($data->CreatedBy) && $data->CreatedBy == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Logedin user not found';
                    } else {

                        $data->Address = (@$data->Address != '') ? getStringClean($data->Address) : '';
                        $data->FirstName = getStringClean($data->FirstName);
                        $data->LastName = getStringClean($data->LastName);
                        $add_user = $this->master_model->addCustomer($data);
                        $add_user['Customer'] = $add_user;

                        if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_add_customer_successfully');
                            $data->CustomerID = $add_user['ID'];
                            $response['data'] = $data;

                            $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($data->CreatedBy,'Customer','-1')");
                            if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)) {
                                $Message = $add_user['EmployeeFirstName'] . ' ' . $add_user['EmployeeLastName'] . ' has added ' . $data->FirstName . ' ' . $data->LastName . '(customer).';
                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "','" . $data->CreatedBy . "','" . $add_user['ID'] . "','AddCustomer') as IsNotificationAdded, 'Success' as Status");
                                }
                                foreach ($_DeviceResult as $d_val) {
                                    //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                                    if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                        // $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$data->CreatedBy."', '".$add_user['ID']."','AddCustomer') as IsNotificationAdded, 'Success' as Status");
                                        $pushNotificationArr = array(
                                            'device_id' => $d_val->DeviceTokenID,
                                            'message' => $Message,
                                            'title' => DEFAULT_WEBSITE_TITLE,
                                            'event' => 'Add Customer',
                                            'ActionType' => 'AddCustomer',
                                            'detail' => (array) $add_user
                                        );
                                        //pr($pushNotificationArr);
                                        $res = sendPushNotification($pushNotificationArr);
                                        //pr($res);
                                    }
                                }
                            }

                            // if(@$data->DeviceType!=''){
                            //     $activity_data = new stdClass();
                            //     $activity_data->MethodName='Api - customerSignup';
                            //     $activity_data->ActivityDescription='has signup';
                            //     $activity_data->UserID=$add_user['UserID'];
                            //     $activity_data->DeviceType=@$data->DeviceType;
                            //     $activity_data->IPAddress=@$data->IPAddress;
                            //     $activity_res = $this->master_model->addActivityLog($activity_data);
                            // }

                        } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                            $msg = explode('~', $add_user['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                            $response['data'] = $add_user;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addCustomer' => $response);
    }

    function getCustomerPaymentByProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->CustomerPropertyID = (isset($data->CustomerPropertyID) || @$data->CustomerPropertyID != '') ? $data->CustomerPropertyID : '-1';
                $data->Status = (isset($data->Status) || @$data->Status != '') ? $data->Status : '-1';

                $_result = $this->master_model->getQueryResult("call usp_M_GetCustomerPaymentByCProperty('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerPropertyID . "','" . $data->Status . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_payment_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerPaymentByProperty' => $response);
    }

    function getCustomerDocumentByProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->CustomerPropertyID = (isset($data->CustomerPropertyID) || @$data->CustomerPropertyID != '') ? $data->CustomerPropertyID : '-1';
                //$data->Status = (isset($data->Status) || @$data->Status!='') ? $data->Status : '-1';

                $_result = $this->master_model->getQueryResult("call usp_M_GetCustomerDocumentByCProperty('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerPropertyID . "','" . base_url() . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_document_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerDocumentByProperty' => $response);
    }

    function getVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->VisitorID = (isset($data->VisitorID) || @$data->VisitorID != '') ? $data->VisitorID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetVisitorReminder('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->VisitorID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->VisitorReminderID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_visitor_reminder_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getVisitorReminder' => $response);
    }

    function getMileStoneByCProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->CustomerPropertyID = (isset($data->CustomerPropertyID) || @$data->CustomerPropertyID != '') ? $data->CustomerPropertyID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetMileStoneByCProperty('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerPropertyID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->ProjectMileStoneID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_milestone_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getMileStoneByCProperty' => $response);
    }

    function getMileStoneByProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->PropertyID) || $data->PropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Property not found.';
            } else {
                $data->PropertyID = (isset($data->PropertyID) || @$data->PropertyID != '') ? $data->PropertyID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetMileStoneByProperty('" . $data->PropertyID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->ProjectMileStoneID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_milestone_listed_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getMileStoneByProperty' => $response);
    }

    function getCustomerReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->CustomerID) || $data->CustomerID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer not found.';
            } elseif (!isset($data->Type) || $data->Type == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Type not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->CustomerID = (isset($data->CustomerID) || @$data->CustomerID != '') ? $data->CustomerID : '-1';
                $data->ProjectID = (isset($data->ProjectID) || @$data->ProjectID != '') ? $data->ProjectID : '-1';
                $data->RoleID = (isset($data->RoleID) || @$data->RoleID != '') ? $data->RoleID : '-1';


                $_result = $this->master_model->getQueryResult("call usp_A_GetCustomerReminder('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->CustomerID . "','" . $data->Type . "','" . $data->ProjectID . "','" . $data->RoleID . "','Mobile')");

                if (isset($_result) && !empty($_result) && @$_result['0']->CustomerReminderID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_customer_reminder_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getCustomerReminder' => $response);
    }

    function addCustomerProperty($data)
    {
        try {
            $response = array();

            if (!isset($data->CreatedBy) || $data->CreatedBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->CreatedBy . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->CustomerID) || $data->CustomerID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer not found.';
                    } else if (!isset($data->PropertyID) || $data->PropertyID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Property not found';
                    } else if (!isset($data->PurchaseDate) || $data->PurchaseDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Purchase date not found';
                    } else if ((!isset($data->Amount) || $data->Amount == '') && @$data->IsHold == 0) {
                        $response['Error'] = 102;
                        $response['Message'] = 'Amount not found';
                    } else if (!isset($data->CustomerFirstName) && $data->CustomerFirstName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer first name not found';
                    } else if (!isset($data->CustomerLastName) && $data->CustomerLastName == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer last name not found';
                    } else if (!isset($data->CustomerAddress) && $data->CustomerAddress == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer address not found';
                    } else if (!isset($data->CustomerMobileNo) && $data->CustomerMobileNo == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer mobile not found';
                    } else if (!isset($data->CreatedBy) && $data->CreatedBy == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Logedin user not found';
                    } else if (@$data->CustomerID == '-1' && (!isset($data->VisitorID) || $data->VisitorID == '')) {
                        $response['Error'] = 102;
                        $response['Message'] = 'Visitor not found';
                    } else {
                        $temp_flag = 0;
                        if ($data->CustomerID == '-1' && isset($data->VisitorID)) {
                            if (!isset($data->IPAddress)) $data->IPAddress = '';
                            if (!isset($data->UserType)) $data->UserType = 'Employee Android';
                            $_result = $this->master_model->getQueryResult("call usp_M_ConvertVisitorToCustomer('" .
                                $data->VisitorID . "','" .
                                $data->CreatedBy . "','" .
                                $data->UserType . "','" .
                                $data->IPAddress . "')");
                            if (isset($_result) && !empty($_result) && isset($_result['0']->ID) && $_result['0']->ID > 0) {

                                $temp_flag = 1;
                                $data->CustomerID = $_result['0']->ID;
                            } else if (isset($_result['0']->Message) && $_result['0']->Message != '') {
                                $msg = explode('~', $_result['0']->Message);
                                $response['Error'] = '106'; //($msg[0]) ? $msg[0] : '103';
                                $response['Message'] = @$msg[1];
                                $response['data'] = $_result;
                            } else {
                                $response['Error'] = 104;
                                $response['Message'] = label('api_msg_something_went_wrong');
                            }
                        } else {
                            $temp_flag = 1;
                        }

                        if ($temp_flag == 1) {

                            $data->CustomerAddress = getStringClean($data->CustomerAddress);
                            $data->CustomerFirstName = getStringClean($data->CustomerFirstName);
                            $data->CustomerLastName = getStringClean($data->CustomerLastName);

                            $data->PurchaseDate = GetDateInFormat($data->PurchaseDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                            $add_user = $this->master_model->addCustomerProperty($data);

                            if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                                $response['Error'] = 200;
                                $response['Message'] = label('api_msg_add_customer_property_successfully');
                                $response['data'] = $add_user;


                                $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($data->CreatedBy,'CustomerProperty','" . @$add_user['ProjectID'] . "')");

                                if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)) {
                                    $Message = $add_user['EmployeeFirstName'] . ' ' . $add_user['EmployeeLastName'] . ' has added property ' . $add_user['ProjectTitle'] . '(' . $add_user['PropertyNo'] . ')' . ' of ' . $add_user['FirstName'] . ' ' . $add_user['LastName'] . '(customer).';
                                    $NoOfUser = array();
                                    foreach ($_DeviceResult as $key => $value) {
                                        $NoOfUser[$value->UserID] = $value;
                                    }

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','AddCustomerProperty') as IsNotificationAdded, 'Success' as Status");
                                    }
                                    foreach ($_DeviceResult as $d_val) {
                                        if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                            $pushNotificationArr = array(
                                                'device_id' => $d_val->DeviceTokenID,
                                                'message' => $Message,
                                                'title' => DEFAULT_WEBSITE_TITLE,
                                                'event' => 'Add Customer Property',
                                                'ActionType' => 'AddCustomerProperty',
                                                'detail' => (array) $add_user
                                            );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                }
                            } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                                $msg = explode('~', $add_user['Message']);
                                $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                                $response['Message'] = $msg[1];
                                $response['data'] = $add_user;
                            } else {
                                $response['Error'] = 104;
                                $response['Message'] = label('api_msg_something_went_wrong');
                            }
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addCustomerProperty' => $response);
    }

    function addCustomerPayment($data)
    {
        try {
            $response = array();

            if (!isset($data->CreatedBy) || $data->CreatedBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->CreatedBy . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer property not found.';
                    } else if (!isset($data->AmountType) && $data->AmountType == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Amount Type not found';
                    } else if (!isset($data->PaymentAmount) && $data->PaymentAmount == '' && ($data->AmountType == 0 || $data->AmountType == 1)) {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment amount not found';
                    } else if (!isset($data->GSTAmount) && $data->GSTAmount == '' && ($data->AmountType == 0 || $data->AmountType == 1)) {
                        $response['Error'] = 102;
                        $response['Message'] = 'GST amount not found';
                    } else if (!isset($data->PaymentDate) && $data->PaymentDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment date not found';
                    } else if (!isset($data->PaymentMode) && $data->PaymentMode == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment mode not found';
                    } else if ((!isset($data->ChequeNo) || $data->ChequeNo == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'ChequeNo or IFCCode not found';
                    } else if ((!isset($data->BankName) || $data->BankName == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'BankName not found';
                    } else if ((!isset($data->BranchName) || $data->BranchName == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'BranchName not found';
                    } else if (!isset($data->CreatedBy) && $data->CreatedBy == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Logedin user not found';
                    } else if (!isset($data->MileStone) || $data->MileStone == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'MileStone not found';
                    } else {

                        $data->PaymentDate = GetDateInFormat($data->PaymentDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                        $data->BankName = getStringClean($data->BankName);
                        $data->BranchName = getStringClean($data->BranchName);
                        $data->MileStone = getStringClean($data->MileStone);
                        $add_user = $this->master_model->addCustomerPayment($data);

                        if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_add_payment_successfully');
                            $data->CustomerID = $add_user['ID'];
                            $response['data'] = $data;
                            $response['data']->detail = $add_user;


                            $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($data->CreatedBy,'Payment','" . @$add_user['ProjectID'] . "')");
                            if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)) {

                                $Message = $add_user['EmployeeFirstName'] . ' ' . $add_user['EmployeeLastName'] . ' has added payment of ' . $add_user['Title'] . '(' . $add_user['PropertyNo'] . ').';

                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','AddCustomerPayment') as IsNotificationAdded, 'Success' as Status");
                                }

                                foreach ($_DeviceResult as $d_val) {
                                    if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                        $pushNotificationArr = array(
                                            'device_id' => $d_val->DeviceTokenID,
                                            'message' => $Message,
                                            'title' => DEFAULT_WEBSITE_TITLE,
                                            'event' => 'Add Customer Payment',
                                            'ActionType' => 'AddCustomerPayment',
                                            'detail' => (array) $add_user
                                        );
                                        $res = sendPushNotification($pushNotificationArr);
                                    }
                                }

                                if ($add_user['PaymentPush'] == 'ATS') {

                                    $Message = $add_user['Title'] . '(' . $add_user['PropertyNo'] . ') has ready for ATS.';

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','ATSPayment') as IsNotificationAdded, 'Success' as Status");
                                    }

                                    foreach ($_DeviceResult as $d_val) {
                                        if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                            $pushNotificationArr = array(
                                                'device_id' => $d_val->DeviceTokenID,
                                                'message' => $Message,
                                                'title' => DEFAULT_WEBSITE_TITLE,
                                                'event' => 'ATS Payment Reminder',
                                                'ActionType' => 'AddCustomer',
                                                'detail' => (array) $add_user
                                            );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                } elseif ($add_user['PaymentPush'] == 'SD') {

                                    $Message = $add_user['Title'] . '(' . $add_user['PropertyNo'] . ') has ready for Sale Deed.';

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','SDPayment') as IsNotificationAdded, 'Success' as Status");
                                    }
                                    foreach ($_DeviceResult as $d_val) {
                                        if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                            $pushNotificationArr = array(
                                                'device_id' => $d_val->DeviceTokenID,
                                                'message' => $Message,
                                                'title' => DEFAULT_WEBSITE_TITLE,
                                                'event' => 'Sale Deed Payment Reminder',
                                                'ActionType' => 'AddCustomer',
                                                'detail' => (array) $add_user
                                            );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                }
                            }
                        } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                            $msg = explode('~', $add_user['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                            $response['data'] = $add_user;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addCustomerPayment' => $response);
    }

    function addCustomerPayment_new($data)
    {
        try {
            $response = array();

            if (!isset($data->CreatedBy) || $data->CreatedBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->CreatedBy . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer property not found.';
                    } else if (!isset($data->AmountType) && $data->AmountType == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Amount Type not found';
                    } else if (!isset($data->PaymentAmount) && $data->PaymentAmount == '' && ($data->AmountType == 0 || $data->AmountType == 1)) {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment amount not found';
                    } else if (!isset($data->GSTAmount) && $data->GSTAmount == '' && ($data->AmountType == 0 || $data->AmountType == 1)) {
                        $response['Error'] = 102;
                        $response['Message'] = 'GST amount not found';
                    } else if (!isset($data->PaymentDate) && $data->PaymentDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment date not found';
                    } else if (!isset($data->PaymentMode) && $data->PaymentMode == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Payment mode not found';
                    } else if ((!isset($data->ChequeNo) || $data->ChequeNo == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'ChequeNo or IFCCode not found';
                    } else if ((!isset($data->BankName) || $data->BankName == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'BankName not found';
                    } else if ((!isset($data->BranchName) || $data->BranchName == '') && @$data->PaymentMode == 'Cheque') {
                        $response['Error'] = 102;
                        $response['Message'] = 'BranchName not found';
                    } else if (!isset($data->CreatedBy) && $data->CreatedBy == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Logedin user not found';
                    } else if (!isset($data->MileStone) || $data->MileStone == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'MileStone not found';
                    } else {

                        $data->PaymentDate = GetDateInFormat($data->PaymentDate, DATE_FORMAT, DATABASE_DATE_FORMAT);
                        $data->BankName = getStringClean($data->BankName);
                        $data->BranchName = getStringClean($data->BranchName);
                        $data->MileStone = getStringClean($data->MileStone);
                        $add_user = $this->master_model->addCustomerPayment($data);

                        if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_add_payment_successfully');
                            $data->CustomerID = $add_user['ID'];
                            $response['data'] = $data;
                            $response['data']->detail = $add_user;


                            $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($data->CreatedBy,'Payment','" . @$add_user['ProjectID'] . "')");
                            if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)) {

                                $Message = $add_user['EmployeeFirstName'] . ' ' . $add_user['EmployeeLastName'] . ' has added payment of ' . $add_user['Title'] . '(' . $add_user['PropertyNo'] . ').';

                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }

                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','AddCustomerPayment') as IsNotificationAdded, 'Success' as Status");
                                }

                                foreach ($_DeviceResult as $d_val) {
                                    if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                        $pushNotificationArr = array(
                                            'device_id' => $d_val->DeviceTokenID,
                                            'message' => $Message,
                                            'title' => DEFAULT_WEBSITE_TITLE,
                                            'event' => 'Add Customer Payment',
                                            'ActionType' => 'AddCustomerPayment',
                                            'detail' => (array) $add_user
                                        );
                                        $res = sendPushNotification($pushNotificationArr);
                                    }
                                }

                                if ($add_user['PaymentPush'] == 'ATS') {

                                    $Message = $add_user['Title'] . '(' . $add_user['PropertyNo'] . ') has ready for ATS.';

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','ATSPayment') as IsNotificationAdded, 'Success' as Status");
                                    }

                                    foreach ($_DeviceResult as $d_val) {
                                        if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                            $pushNotificationArr = array(
                                                'device_id' => $d_val->DeviceTokenID,
                                                'message' => $Message,
                                                'title' => DEFAULT_WEBSITE_TITLE,
                                                'event' => 'ATS Payment Reminder',
                                                'ActionType' => 'AddCustomer',
                                                'detail' => (array) $add_user
                                            );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                } elseif ($add_user['PaymentPush'] == 'SD') {

                                    $Message = $add_user['Title'] . '(' . $add_user['PropertyNo'] . ') has ready for Sale Deed.';

                                    foreach ($NoOfUser as $val) {
                                        $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $data->CreatedBy . "', '" . $add_user['ID'] . "','SDPayment') as IsNotificationAdded, 'Success' as Status");
                                    }
                                    foreach ($_DeviceResult as $d_val) {
                                        if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                            $pushNotificationArr = array(
                                                'device_id' => $d_val->DeviceTokenID,
                                                'message' => $Message,
                                                'title' => DEFAULT_WEBSITE_TITLE,
                                                'event' => 'Sale Deed Payment Reminder',
                                                'ActionType' => 'AddCustomer',
                                                'detail' => (array) $add_user
                                            );
                                            $res = sendPushNotification($pushNotificationArr);
                                        }
                                    }
                                }
                            }
                        } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                            $msg = explode('~', $add_user['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                            $response['data'] = $add_user;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addCustomerPayment_new' => $response);
    }

    function addUploadPics($data = array())
    {

        $response           = $_result              = $result           = array();
        $AccessType         = $data['AccessType'];
        $UserID             = $data['UserID'];
        $CustomerPropertyDocumentID
            = $data['CustomerPropertyDocumentID'];
        $Title              = @$data['Title'];
        $UserType           = @$data['UserType'];
        $CustomerPropertyID = $data['CustomerPropertyID'];

        if (!isset($UserID) || $UserID == '') {
            $response['Error']      = 102;
            $response['Message']    = label('api_msg_user_not_found');
        } elseif ((!isset($AccessType) || $AccessType == '') || ($AccessType != 'Gallery' && $AccessType != 'PropertyDocument')) {
            $response['Error'] = 102;
            $response['Message'] = 'Access type not found';
        } else {

            if (@$_FILES['ImageData']['error'] == 0 && !empty($_FILES['ImageData'])) {

                if ($AccessType == 'Gallery') {
                    $pathMain       = PROJECT_Gallery_UPLOAD_PATH;
                    $pathThumb      = PROJECT_Gallery_THUMB_UPLOAD_PATH;
                    $path           = PROJECT_Gallery_UPLOAD_PATH;
                    $max_size       = PROJECT_Gallery_MAX_SIZE;
                    $allowed_types  = PROJECT_Gallery_ALLOWED_TYPES; //PROFILE_PIC_ALLOWED_TYPES;
                } elseif ($AccessType == 'PropertyDocument') {
                    $pathMain       = PROJECT_DOCUMENT_UPLOAD_PATH;
                    $path           = PROJECT_DOCUMENT_UPLOAD_PATH;
                    $pathThumb      = PROJECT_DOCUMENT_THUMB_UPLOAD_PATH;
                    $max_size       = PROJECT_DOCUMENT_MAX_SIZE;
                    $allowed_types  = PROJECT_DOCUMENT_ALLOWED_TYPES; //PROFILE_PIC_ALLOWED_TYPES;
                }

                $imageNameTime = time();
                $file_name = $imageNameTime . "_" . $data['UserID'];
                $CV_real_name = @$_FILES['ImageData']['name'];

                $uploadFile = 'ImageData';
                $result = array();
                $result = do_upload($uploadFile, $allowed_types, $path, $file_name);

                if (isset($result['error']) && @$result['error'] != '') {
                    $result['error'] = str_replace('<p>', '', $result['error']);
                    $result['error'] = str_replace('</p>', '', $result['error']);
                }

                if ($result['status'] == 1) {
                    $uploadedFileName = $result['upload_data']['file_name'];

                    if ($AccessType == 'Gallery') {
                        $_result = $this->master_model->getQueryResult("call usp_M_EditProfilePic('" . $UserID . "','" . $uploadedFileName . "')");
                        $SourcePath     = PROJECT_Gallery_UPLOAD_PATH . $uploadedFileName;
                        $DesPath        = PROJECT_Gallery_THUMB_UPLOAD_PATH . $uploadedFileName;
                        $max_width      = PROJECT_Gallery_THUMB_MAX_WIDTH;
                        $max_height     = PROJECT_Gallery_THUMB_MAX_HEIGHT;

                        if (@$_result[0]->OldPic != '') {
                            unlink(PROJECT_Gallery_UPLOAD_PATH . $_result[0]->OldPic);
                            unlink(PROJECT_Gallery_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                        }
                    } elseif ($AccessType == 'PropertyDocument') {


                        if (!isset($Status)) $Status = '1';
                        if (!isset($IPAddress)) $IPAddress = '';
                        if (!isset($UserType)) $UserType = 'Employee Android';
                        if (@$CustomerPropertyDocumentID == '') $CustomerPropertyDocumentID = 0;

                        $_result = $this->master_model->getQueryResult("call usp_A_AddCustomerPropertyDocument('" . $CustomerPropertyID . "','" . $uploadedFileName . "','" . $Title . "','" . $UserID . "','" . $Status . "','" . $UserType . "','" . $IPAddress . "','" . base_url() . "','" . $CustomerPropertyDocumentID . "')");

                        // $SourcePath     = PROJECT_DOCUMENT_UPLOAD_PATH . $uploadedFileName;
                        // $DesPath        = PROJECT_DOCUMENT_THUMB_UPLOAD_PATH . $uploadedFileName;
                        // $max_width      = PROJECT_DOCUMENT_THUMB_MAX_WIDTH;
                        // $max_height     = PROJECT_DOCUMENT_THUMB_MAX_HEIGHT;

                        // if(@$_result[0]->OldPic!=''){
                        //     unlink(PROJECT_DOCUMENT_UPLOAD_PATH . $_result[0]->OldPic);
                        //     unlink(PROJECT_DOCUMENT_THUMB_UPLOAD_PATH . $_result[0]->OldPic);
                        // }
                    }


                    $response['addUploadPics']['Error'] = 200;
                    $response['addUploadPics']['Message'] = label('api_msg_image_upload_successfully');

                    $response['addUploadPics']['data'] = $_result[0];
                    $response['addUploadPics']['image_data'] = $result;
                    if ($AccessType == 'Gallery') {
                        $response['addUploadPics']['PhotoURL'] = str_replace('./', '', base_url() . PROJECT_Gallery_UPLOAD_PATH . $uploadedFileName);
                    } elseif ($AccessType == 'PropertyDocument') {
                        $response['addUploadPics']['PhotoURL'] = str_replace('./', '', base_url() . PROJECT_DOCUMENT_UPLOAD_PATH . $uploadedFileName);
                        $response['addUploadPics']['DocDate'] = date('d M Y');
                        $response['addUploadPics']['DocName'] = @$CV_real_name;
                        $response['addUploadPics']['Message'] = label('api_msg_document_upload_successfully');


                        $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($UserID,'Document','" . @$_result[0]->ProjectID . "')");
                        if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)) {
                            $Message = $_result[0]->Emp_name . ' has added property document of ' . $_result[0]->Title . '(' . $_result[0]->PropertyNo . ').';
                            $NoOfUser = array();
                            foreach ($_DeviceResult as $key => $value) {
                                $NoOfUser[$value->UserID] = $value;
                            }

                            foreach ($NoOfUser as $val) {
                                $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $Message . "' , '" . $UserID . "', '" . $_result[0]->ID . "','AddCustomerDocument') as IsNotificationAdded, 'Success' as Status");
                            }
                            foreach ($_DeviceResult as $d_val) {
                                //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                                if (!empty($d_val->DeviceTokenID) && !empty($Message)) {

                                    // $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$UserID."', '".$_result[0]->ID."','AddCustomerDocument') as IsNotificationAdded, 'Success' as Status");
                                    $pushNotificationArr = array(
                                        'device_id' => $d_val->DeviceTokenID,
                                        'message' => $Message,
                                        'title' => DEFAULT_WEBSITE_TITLE,
                                        'event' => 'Add Customer Document',
                                        'ActionType' => 'AddCustomerDocument',
                                        'detail' => (array) $_result[0]
                                    );
                                    //pr($pushNotificationArr);
                                    $res = sendPushNotification($pushNotificationArr);
                                    //pr($res);
                                }
                            }
                        }
                    } else {
                        $response['addUploadPics']['PhotoURL'] = '';
                        $response['addUploadPics']['Error'] = 102;
                        $response['addUploadPics']['Message'] = label('api_msg_error_occurred');
                        $response['addUploadPics']['data'] = $_result;
                        $response['addUploadPics']['image_data'] = $result;
                    }
                } else {
                    $response['addUploadPics']['Error'] = 102;
                    $response['addUploadPics']['Message'] = label('api_msg_error_occurred');
                    $response['addUploadPics']['data'] = $_result;
                    $response['addUploadPics']['image_data'] = $result;
                }
            } elseif ($CustomerPropertyDocumentID != '' && $Title != '') {

                if (!isset($Status)) $Status = '1';
                if (!isset($IPAddress)) $IPAddress = '';
                if (!isset($UserType)) $UserType = 'Employee Android';
                if (@$CustomerPropertyDocumentID == '') $CustomerPropertyDocumentID = 0;

                $_result = $this->master_model->getQueryResult("call usp_A_AddCustomerPropertyDocument('" . $CustomerPropertyID . "','','" . $Title . "','" . $UserID . "','" . $Status . "','" . $UserType . "','" . $IPAddress . "','" . base_url() . "','" . $CustomerPropertyDocumentID . "')");

                if (@$_result[0]->ID > 0) {

                    $response['addUploadPics']['Error'] = 200;
                    $response['addUploadPics']['Message'] = explode('~', @$_result[0]->Message)[1];
                    $response['addUploadPics']['data'] = $_result;
                } elseif (@$_result[0]->Message != '') {
                    $response['addUploadPics']['Error'] = 102;
                    $response['addUploadPics']['Message'] = explode('~', @$_result[0]->Message)[1];
                } else {
                    $response['addUploadPics']['Error'] = 102;
                    $response['addUploadPics']['Message'] = label('api_msg_error_occurred');
                }
            } else {
                $response['addUploadPics']['Error'] = 102;
                $response['addUploadPics']['Message'] = label('api_msg_error_occurred');
            }
        }

        return $response; //exit();
    }

    function getNotification($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->UserID = (isset($data->UserID) || @$data->UserID != '') ? $data->UserID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_M_GetNotification('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->UserID . "','" . base_url() . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->NotificationID > 0) {
                    foreach ($_result as $k => $val) {

                        $_result[$k]->detail = json_decode($_result[$k]->Detail);

                        unset($_result[$k]->Detail);
                    }

                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_notification_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getNotification' => $response);
    }

    function getAdminByID($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else {

                $_result = $this->master_model->getQueryResult("call usp_A_GetAdminByID('" . $data->UserID . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->UserID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_get_detail_successfully');
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getAdminByID' => $response);
    }

    function editAdminDetail($data)
    {
        try {
            $response = array();

            if (!isset($data->FirstName) || $data->FirstName == '') {
                $response['Error'] = 102;
                $response['Message'] = 'First name not found.';
            } else if (!isset($data->LastName) && $data->LastName == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Last name not found';
            } else if (!isset($data->MobileNo) && $data->MobileNo == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Mobile number not found';
            } else if (!isset($data->ModifiedBy) && $data->ModifiedBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ModifiedBy not found';
            } else if (!isset($data->UserID) && $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Logedin user not found';
            } else {

                $add_user = $this->master_model->editAdminDetail($data);

                if (isset($add_user['UserID']) && $add_user['UserID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_edit_user_successfully');
                    $response['data'] = $add_user;

                    $response['Role'] = array();
                    $_role = $this->getRoleByID($add_user['RoleID'], '-1');
                    if (!empty($_role))
                        $response['Role'] = $_role;
                    // if(@$data->DeviceType!=''){
                    //     $activity_data = new stdClass();
                    //     $activity_data->MethodName='Api - customerSignup';
                    //     $activity_data->ActivityDescription='has signup';
                    //     $activity_data->UserID=$add_user['UserID'];
                    //     $activity_data->DeviceType=@$data->DeviceType;
                    //     $activity_data->IPAddress=@$data->IPAddress;
                    //     $activity_res = $this->master_model->addActivityLog($activity_data);
                    // }

                } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                    $msg = explode('~', $add_user['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = $add_user;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('editAdminDetail' => $response);
    }

    function updateVisitorReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->UserID) || $data->UserID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = label('api_msg_user_not_found');
                    } else if (!isset($data->VisitorID) && $data->VisitorID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Visitor not found';
                    } else if (!isset($data->ReminderDate) && $data->ReminderDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Next reminder date not found';
                    } else if (!isset($data->ReminderTime) && $data->ReminderTime == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Next reminder time not found';
                    } else if (!isset($data->UserType) && $data->UserType == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'User type not found';
                    } else {

                        $data->IsIdle = (!isset($data->IsIdle) || $data->IsIdle == '') ? 0 : $data->IsIdle;

                        if ($data->IsIdle != 1) {
                            $data->ReminderDate = GetDateTimeInFormat($data->ReminderDate . ' ' . $data->ReminderTime, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT);
                        } else {
                            $data->ReminderDate = date('Y-m-d H:i:s');
                        }

                        $data->PastDate = (!isset($data->PastDate) || $data->PastDate == '') ? '1000-01-01' : $data->PastDate;
                        $data->PastTime = (!isset($data->PastTime) || $data->PastTime == '') ? '00:00:00' : $data->PastTime;
                        $data->PastDate = $data->PastDate . ' ' . $data->PastTime;

                        if ($data->PastDate != '1000-01-01 00:00:00') {
                            $data->PastDate = GetDateTimeInFormat($data->PastDate, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT);
                        }

                        $add_user = $this->master_model->updateVisitorReminder($data);

                        if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                            $response['Error'] = 200;
                            if ($data->IsIdle != 1) {
                                $response['Message'] = label('api_msg_add_visitor_reminder_successfully');
                            } else {
                                $response['Message'] = label('api_msg_visitor_not_interested');
                            }
                            $response['data'] = $add_user;
                        } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                            $msg = explode('~', $add_user['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = @$msg[1];
                            $response['data'] = $add_user;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('updateVisitorReminder' => $response);
    }

    function deletePropertyDocument($data)
    {
        try {
            $response = array();
            if (@$data->CustomerPropertyDocumentID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_customer_property_document_not_found');
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_DeleteField('sssm_customerpropertydocument','CustomerPropertyDocumentID','" . $data->CustomerPropertyDocumentID . "')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_property_deleted_successfully');
                    //$response['data'] = $_result[0];
                } else if (isset($_result[0]->Message)) {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('deletePropertyDocument' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('deletePropertyDocument' => $response);
        }
    }

    function deleteAccount($data)
    {
        try {
            $response = array();
            if (@$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else {
                $_result = $this->master_model->getQueryResult("call usp_M_ChangeStatus('sssm_admindetails','UserID','" . $data->UserID . "','1','" . $data->UserID . "','IsDeleted')");

                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_account_deleted_successfully');
                    //$response['data'] = $_result[0];
                } else if (isset($_result[0]->Message)) {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('deleteAccount' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('deleteAccount' => $response);
        }
    }

    function convertVisitorToCustomer($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else if (!isset($data->VisitorID) && $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Visitor not found';
            } else if (!isset($data->UserType) && $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User type not found';
            } else {

                if (!isset($data->IPAddress)) $data->IPAddress = '';
                $_result = $this->master_model->getQueryResult("call usp_M_ConvertVisitorToCustomer('" . $data->VisitorID . "','" . $data->UserID . "','" . $data->UserType . "','" . $data->IPAddress . "')");

                if (isset($_result) && !empty($_result) && isset($_result['0']->ID) && $_result['0']->ID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_convert_visitor_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != '') {
                    $msg = explode('~', $_result['0']->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = $_result;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('convertVisitorToCustomer' => $response);
    }

    function addCustomerReminder($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (!isset($data->CustomerPropertyID) || $data->CustomerPropertyID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer not found.';
                    } else if (!isset($data->UserID) && $data->UserID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = label('api_msg_user_not_found');
                    } else if (!isset($data->ReminderDate) && $data->ReminderDate == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Reminder date not found';
                    } else if (!isset($data->ReminderTime) && $data->ReminderTime == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Reminder time not found';
                    } else if (!isset($data->Message) && $data->Message == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Message not found';
                    } else {

                        // $r_date = DateTime::createFromFormat("m-d-Y H:i:s" , $data->ReminderDate.' '.$data->ReminderTime);
                        // $data->ReminderDate = $r_date->format('Y-m-d H:i:s');
                        //$data->ReminderDate = $data->ReminderDate;
                        $data->ReminderDate = GetDateTimeInFormat($data->ReminderDate . ' ' . $data->ReminderTime, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT);

                        $_result = $this->master_model->addCustomerReminder($data);

                        if (isset($_result['ID']) && $_result['ID'] > 0) {
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_add_customer_reminder_successfully');

                            $response['data'] = $_result;
                            // if(@$data->DeviceType!=''){
                            //     $activity_data = new stdClass();
                            //     $activity_data->MethodName='Api - customerSignup';
                            //     $activity_data->ActivityDescription='has signup';
                            //     $activity_data->UserID=$_result['UserID'];
                            //     $activity_data->DeviceType=@$data->DeviceType;
                            //     $activity_data->IPAddress=@$data->IPAddress;
                            //     $activity_res = $this->master_model->addActivityLog($activity_data);
                            // }

                        } else if (isset($_result['Message']) && $_result['Message'] != '') {
                            $msg = explode('~', $_result['Message']);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                            $response['data'] = $_result;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('addCustomerReminder' => $response);
    }

    /*function addReminderAction($data) {
        try{
            $response = array();

            if (!isset($data->ID) || $data->ID == ''){
                $response['Error'] = 102;
                $response['Message'] = 'Action ID not found.';
            }else if (!isset($data->ActionType) || $data->ActionType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ActionType not found';
            }else if (!isset($data->Message) || $data->Message == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found';
            }else if ((!isset($data->Subject) || $data->Subject == '') && @$data->ActionType=='Mail') {
                $response['Error'] = 102;
                $response['Message'] = 'Message not found';
            }else if ((COUNT($data->Message) > 800) && @$data->ActionType=='SMS') {
                $response['Error'] = 102;
                $response['Message'] = 'Message size is to long.';
            // }else if (!isset($data->ReminderActionDate) || $data->ReminderActionDate == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Reminder action date not found';
            // }else if (!isset($data->ReminderActionTime) || $data->ReminderActionTime == '') {
            //     $response['Error'] = 102;
            //     $response['Message'] = 'Reminder action time not found';
            }else if (!isset($data->ActionUser) || $data->ActionUser == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer or visitor type not found';
            }else if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            }else if (!isset($data->UserType) || $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_type_not_found');
            } else {

                // $r_date = DateTime::createFromFormat("m-d-Y H:i:s" , $data->ReminderActionDate.' '.$data->ReminderActionTime);
                // $data->ReminderActionDate = $r_date->format('Y-m-d H:i:s');
                // $data->ReminderActionDate = $data->ReminderActionDate;

                    $data->Message = getStringClean(base64_decode($data->Message));
                    $_result = $this->master_model->addReminderAction($data);

                    if (isset($_result['ID']) && $_result['ID'] > 0) {

                        // $_CustomerResult = $this->master_model->getQueryResult("call usp_M_getCustomerDetailByAction($data->ActionUser,$data->ID)");

                        if($data->ActionType=='SMS' && @$_result['MobileNo']!=''){

                            if(@$_result['MobileNo']!=''){
                                $res = sendSMS($_result['MobileNo'],$data->Message);
                                if($res==0){
                                    //fail
                                }
                            }
                            
                        }elseif ($data->ActionType=='Mail' && @$_result['EmailID']!='') {
                                //email otp functionality
                                $Content = $this->master_model->get_emailtemplate($id = 3);
                                // $Content = '<div><center>{logo} &nbsp; &nbsp; {WebsiteName}</center><br/>Hello, <br/><br/> {message_content} <br/><br/>Thnaks<br/>Support team.</div>';
                                // $EmailSubject = $data->Subject;
                                $array['ToEmailID'] = $_result['EmailID'];
                                $array['Subject']  = DEFAULT_WEBSITE_TITLE.'- '.$data->Subject;
                                $array['Body'] = $Content['Content']; 
                                $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                                $array['FromName'] = DEFAULT_FROM_NAME;
                                $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                                $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                                $array['AltBody'] = '';  
                                $image_path = base_url().DEFAULT_EMAIL_IMAGE.'login-logo.png';  
                                $back_image_path = '';//base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                                $data1 = array('{site_name}','{logo}','{first_name}','{last_name}','{back_image}','{message}','{base_url}');

                                $datavalue = array(DEFAULT_WEBSITE_TITLE,$image_path, $_result['FirstName'], $_result['LastName'], $back_image_path,   $data->Message, base_url());
                                $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                                //pr($array['Body']);exit();
                                $res = CustomMail($array);
                                if($res==1){
                                    //Success
                                }
                        }

                        $response['Error'] = 200;
                        if($data->ActionType=='SMS'){
                            $response['Message'] = label('api_msg_send_sms_successfully');
                        }elseif ($data->ActionType=='Mail'){
                            $response['Message'] = label('api_msg_send_mail_successfully');
                        }

                        $response['data'] = $_result;
                        // if(@$data->DeviceType!=''){
                        //     $activity_data = new stdClass();
                        //     $activity_data->MethodName='Api - customerSignup';
                        //     $activity_data->ActivityDescription='has signup';
                        //     $activity_data->UserID=$_result['UserID'];
                        //     $activity_data->DeviceType=@$data->DeviceType;
                        //     $activity_data->IPAddress=@$data->IPAddress;
                        //     $activity_res = $this->master_model->addActivityLog($activity_data);
                        // }

                    } else if (isset($_result['Message']) && $_result['Message']!='') {
                        $msg = explode('~',$_result['Message']);
                        if(count($msg) >=2 ){
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = $msg[1];
                        }else{
                            $response['Error'] = '103';
                            $response['Message'] = $_result['Message'];
                        }
                        $response['data'] = $_result;
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = label('api_msg_something_went_wrong');
                    }
            }
        } catch(Exception $e){
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('addReminderAction'=>$response);
    } */

    function addReminderAction($data = array())
    {
        try {
            $response           = $_result              = $result           = array();
            // $ID         = $data['ID'];
            // $ActionType         = $data['ActionType'];
            // $Message         = $data['Message'];
            // $Subject         = $data['Subject'];
            // $AccessType         = $data['AccessType'];
            // $AccessType         = $data['AccessType'];
            // $AccessType         = $data['AccessType'];
            if (!isset($data['ID']) || $data['ID'] == '') {
                $response['Message'] = 'Action ID not found.';
            } else if (!isset($data['ActionType']) || $data['ActionType'] == '') {

                $response['Message'] = 'ActionType not found';
            } else if (!isset($data['Message']) || $data['Message'] == '') {

                $response['Message'] = 'Message not found';
            } else if ((!isset($data['Subject']) || $data['Subject'] == '') && @$data['ActionType'] == 'Mail') {

                $response['Message'] = 'Message not found';
            } else if ((strlen($data['Message']) > 800) && @$data['ActionType'] == 'SMS') {

                $response['Message'] = 'Message size is to long.';
            } else if (!isset($data['ActionUser']) || $data['ActionUser'] == '') {

                $response['Message'] = 'Customer or visitor type not found';
            } else if (!isset($data['UserID']) || $data['UserID'] == '') {

                $response['Message'] = label('api_msg_user_not_found');
            } else if (!isset($data['UserType']) || $data['UserType'] == '') {

                $response['Message'] = label('api_msg_user_type_not_found');
            } else {

                $data['file_name'] = $PhotoURL = '';

                if (isset($_FILES['ImageData']) && $_FILES['ImageData']['error'] == 0) {

                    $path           = EMAIL_DOCUMENT_UPLOAD_PATH;
                    $max_size       = EMAIL_DOCUMENT_MAX_SIZE;
                    $allowed_types  = EMAIL_DOCUMENT_ALLOWED_TYPES;

                    $data['file_name'] = time() . "_" . $data['UserID'];

                    $uploadFile = 'ImageData';
                    $result = do_upload($uploadFile, $allowed_types, $path, $data['file_name']);

                    if (isset($result['error']) && @$result['error'] != '') {
                        $result['error'] = str_replace('<p>', '', $result['error']);
                        $result['error'] = str_replace('</p>', '', $result['error']);
                    }

                    if ($result['status'] == 1) {
                        $uploadedFileName = $result['upload_data']['file_name'];
                        $PhotoURL = str_replace('./', '', base_url() . EMAIL_DOCUMENT_UPLOAD_PATH . $uploadedFileName);
                    } elseif (isset($result['error']) && @$result['error'] != '') {
                        $result['error'] = str_replace('<p>', '', $result['error']);
                        $result['error'] = str_replace('</p>', '', $result['error']);
                    }
                }

                $email_body = $data['Message'];
                $data['Message'] = getStringClean($data['Message']);
                $_result = $this->master_model->addReminderAction($data);

                if (isset($_result['ID']) && $_result['ID'] > 0) {
                    $response['Error'] = 200;
                    $response['data'] = $_result;
                    $response['image_data'] = @$result;

                    if ($data['ActionType'] == 'SMS' && @$_result['MobileNo'] != '') {

                        if (@$_result['MobileNo'] != '') {
                            $res = sendSMS($_result['MobileNo'], $email_body);
                            if ($res['Status'] != 1) {
                                $response['Error'] = 102;
                                $response['Message'] = $res['Message'];
                            }
                        }
                    } elseif ($data['ActionType'] == 'Mail' && @$_result['EmailID'] != '') {
                        //email otp functionality
                        $Content = $this->master_model->get_emailtemplate($id = 3);

                        $array['Attached'] = $PhotoURL;
                        $array['ToEmailID'] = $_result['EmailID'];
                        $array['Subject']  = DEFAULT_WEBSITE_TITLE . '- ' . $data['Subject'];
                        $array['Body'] = $Content['Content'];
                        $array['FromEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['FromName'] = DEFAULT_FROM_NAME;
                        $array['ReplyEmailID'] = DEFAULT_ADMIN_EMAIL;
                        $array['ReplayName'] = DEFAULT_ADMIN_EMAIL;
                        $array['AltBody'] = '';
                        $image_path = base_url() . DEFAULT_EMAIL_IMAGE . 'login-logo.png';
                        $back_image_path = ''; //base_url().DEFAULT_EMAIL_IMAGE.'background-1.jpg';           
                        $data1 = array('{site_name}', '{logo}', '{first_name}', '{last_name}', '{back_image}', '{message}', '{base_url}');

                        $datavalue = array(DEFAULT_WEBSITE_TITLE, $image_path, $_result['FirstName'], $_result['LastName'], $back_image_path,   $email_body, base_url());
                        $array['Body'] = str_replace($data1, $datavalue, $array['Body']);
                        $res = CustomMail($array);
                        if ($res == 1) {
                            //Success
                        }
                    }

                    if ($data['ActionType'] == 'SMS') {
                        $response['Message'] = label('api_msg_send_sms_successfully');
                    } elseif ($data['ActionType'] == 'Mail') {
                        $response['Message'] = label('api_msg_send_mail_successfully');
                    }
                } else if (isset($_result['Message']) && $_result['Message'] != '') {
                    $msg = explode('~', $_result['Message']);
                    if (count($msg) >= 2) {
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                    } else {
                        $response['Error'] = '103';
                        $response['Message'] = $_result['Message'];
                    }
                    $response['data'] = $_result;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('addReminderAction' => $response);
    }

    function getReminderAction($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Action ID not found.';
            } else if (!isset($data->ActionUser) || $data->ActionUser == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer or visitor type not found';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;
                $data->ID = (isset($data->ID) || @$data->ID != '') ? $data->ID : '-1';

                $_result = $this->master_model->getQueryResult("call usp_A_GetReminderAction('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->ID . "','" . $data->ActionUser . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->ReminderActionID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_process_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getReminderAction' => $response);
    }

    function addReminderResponse($data)
    {
        try {
            $response = array();

            if (!isset($data->ReminderID) || $data->ReminderID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Reminder not found.';
            } else if (!isset($data->ReminderType) || $data->ReminderType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Reminder type not found';
            } else if (!isset($data->Response) || $data->Response == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Response not found';
            } else if (!isset($data->ResponseBy) || $data->ResponseBy == '') {
                $response['Error'] = 102;
                $response['Message'] = 'ResponseBy not found';
            } else if (!isset($data->UserType) || $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_type_not_found');
            } else {

                $data->Response = getStringClean($data->Response);
                $_result = $this->master_model->addReminderResponse($data);

                if (isset($_result['ID']) && $_result['ID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_add_reminder_response_successfully');

                    $response['data'] = $_result;
                    // if(@$data->DeviceType!=''){
                    //     $activity_data = new stdClass();
                    //     $activity_data->MethodName='Api - customerSignup';
                    //     $activity_data->ActivityDescription='has signup';
                    //     $activity_data->UserID=$_result['UserID'];
                    //     $activity_data->DeviceType=@$data->DeviceType;
                    //     $activity_data->IPAddress=@$data->IPAddress;
                    //     $activity_res = $this->master_model->addActivityLog($activity_data);
                    // }

                } else if (isset($_result['Message']) && $_result['Message'] != '') {
                    $msg = explode('~', $_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $_result;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('addReminderResponse' => $response);
    }

    /* Cron Job */
    function sendRemainder()
    {

        $_ReminderCustomerResult = $this->master_model->getQueryResult("call usp_M_getCustomerRemainder('" . base_url() . "')");

        if (!empty($_ReminderCustomerResult))
            foreach ($_ReminderCustomerResult as $rc_val) {
                if (isset($rc_val->CustomerReminderID)) {

                    $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($rc_val->ReminderBy,'CustomerReminder','" . @$rc_val->ProjectID . "')");

                    if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)  && !empty($rc_val->Message)) {
                        $NoOfUser = array();
                        foreach ($_DeviceResult as $key => $value) {
                            $NoOfUser[$value->UserID] = $value;
                        }

                        foreach ($NoOfUser as $val) {
                            $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $rc_val->Message . "' , '" . $rc_val->ReminderBy . "', '" . $rc_val->CustomerReminderID . "','CustomerReminder') as IsNotificationAdded, 'Success' as Status");
                        }
                        foreach ($_DeviceResult as $d_val) {
                            //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                            if (!empty($d_val->DeviceTokenID) && !empty($rc_val->Message)) {

                                // $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$rc_val->Message."' , '".$rc_val->ReminderBy."', '".$rc_val->CustomerReminderID."','CustomerReminder') as IsNotificationAdded, 'Success' as Status");
                                $pushNotificationArr = array(
                                    'device_id' => $d_val->DeviceTokenID,
                                    'message' => $rc_val->Message,
                                    'title' => DEFAULT_WEBSITE_TITLE,
                                    'event' => 'Customer Reminder',
                                    'ActionType' => 'CustomerReminder',
                                    'detail' => (array) $rc_val
                                );
                                //pr($pushNotificationArr);
                                $res = sendPushNotification($pushNotificationArr);
                                // pr($res);
                            }
                        }
                    }
                }
            }

        $_ReminderVisitorResult = $this->master_model->getQueryResult("call usp_M_getVisitorRemainder()");
        if (!empty($_ReminderVisitorResult) && @$_ReminderVisitorResult[0]->VisitorReminderID > 0)
            foreach ($_ReminderVisitorResult as $rv_val) {
                if (isset($rv_val->VisitorReminderID)) {
                    $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($rv_val->ReminderBy,'VisitorReminder','-1')");

                    if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message) && !empty($rv_val->Message)) {
                        $NoOfUser = array();
                        foreach ($_DeviceResult as $key => $value) {
                            $NoOfUser[$value->UserID] = $value;
                        }

                        foreach ($NoOfUser as $val) {
                            $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $rv_val->Message . "' , '" . $rv_val->ReminderBy . "', '" . $rv_val->VisitorReminderID . "','VisitorReminder') as IsNotificationAdded, 'Success' as Status");
                        }
                        foreach ($_DeviceResult as $d_val) {
                            if (!empty($d_val->DeviceTokenID) && !empty($rv_val->Message)) {

                                // $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$rv_val->Message."' , '".$rv_val->ReminderBy."', '".$rv_val->VisitorReminderID."','VisitorReminder') as IsNotificationAdded, 'Success' as Status");
                                $pushNotificationArr = array(
                                    'device_id' => $d_val->DeviceTokenID,
                                    'message' => $rv_val->Message,
                                    'title' => DEFAULT_WEBSITE_TITLE,
                                    'event' => 'Visitor Reminder',
                                    'ActionType' => 'VisitorReminder',
                                    'detail' => (array) $rv_val
                                );
                                $res = sendPushNotification($pushNotificationArr);
                            }
                        }
                    }
                }
            }
    }

    function setUserNotificationSetting($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Process not found.';
            } else if (!isset($data->IsPush)) {
                $response['Error'] = 102;
                $response['Message'] = 'Push notification setting not found';
            } else if (!isset($data->UserType) || $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_type_not_found');
            } else {

                $data->IsPush = ($data->IsPush == '') ? '0' : $data->IsPush;
                $data->VisitorReminder = ($data->VisitorReminder == '') ? '0' : $data->VisitorReminder;
                $data->CustomerReminder = ($data->CustomerReminder == '') ? '0' : $data->CustomerReminder;
                $data->Customer = ($data->Customer == '') ? '0' : $data->Customer;
                $data->CustomerProperty = ($data->CustomerProperty == '') ? '0' : $data->CustomerProperty;
                $data->Payment = ($data->Payment == '') ? '0' : $data->Payment;
                $data->Document = ($data->Document == '') ? '0' : $data->Document;

                $_result = $this->master_model->setUserNotificationSetting($data);

                if (isset($_result['ID']) && $_result['ID'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_update_notification_setting_successfully');

                    $response['data'] = $_result;
                    // if(@$data->DeviceType!=''){
                    //     $activity_data = new stdClass();
                    //     $activity_data->MethodName='Api - customerSignup';
                    //     $activity_data->ActivityDescription='has signup';
                    //     $activity_data->UserID=$_result['UserID'];
                    //     $activity_data->DeviceType=@$data->DeviceType;
                    //     $activity_data->IPAddress=@$data->IPAddress;
                    //     $activity_res = $this->master_model->addActivityLog($activity_data);
                    // }

                } else if (isset($_result['Message']) && $_result['Message'] != '') {
                    $msg = explode('~', $_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $_result;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            //return array('getConfig'=>$response);
        }
        return array('setUserNotificationSetting' => $response);
    }

    function addDevice($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else if (!isset($data->NotificationToken) ||     $data->NotificationToken == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Notification token not found';
            } else if (!isset($data->DeviceType) || $data->DeviceType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Device type not found';
            } else if (!isset($data->DeviceUID) || $data->DeviceUID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'DeviceUID not found';
            } else {

                if (!isset($data->DeviceName)) $data->DeviceName = '';
                if (!isset($data->OSVersion)) $data->OSVersion = '';

                $_result = $this->master_model->addDevice($data);

                if (isset($_result['device_status']) && $_result['device_status'] > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_add_device_successfully');
                    $response['data'] = $_result;
                } else if (isset($_result['Message']) && $_result['Message'] != '') {
                    $msg = explode('~', $_result['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addDevice' => $response);
    }

    function getReminderResponse($data)
    {
        try {
            $response = array();

            if (!isset($data->ID) || $data->ID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } elseif (!isset($data->Type) || $data->Type == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Type not found.';
            } else {
                $data->PageSize = (isset($data->PageSize) || $data->PageSize != '') ? $data->PageSize : 10;
                $data->CurrentPage = (isset($data->CurrentPage) || $data->CurrentPage != '') ? $data->CurrentPage : 1;

                $_result = $this->master_model->getQueryResult("call usp_A_GetResponse('" . $data->PageSize . "','" . $data->CurrentPage . "','" . $data->ID . "','" . $data->Type . "')");

                if (isset($_result) && !empty($_result) && @$_result['0']->ResponseID > 0) {

                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_reminder_response_listed_successfully');
                    $response['data'] = $_result;
                    $response['rowcount'] = $_result['0']->rowcount;
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getReminderResponse' => $response);
    }

    function cancelledProperty($data)
    {
        try {
            $response = array();
            if (@$data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } elseif (@$data->CustomerPropertyID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Customer property not found.';
            } elseif (@$data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_type_not_found');
            } else {

                if (!isset($data->IPAddress)) $data->IPAddress = '';

                $_result = $this->master_model->getQueryResult("call usp_A_CancelledProperty('" . $data->CustomerPropertyID . "','" . $data->UserID . "','" . $data->UserType . "','" . $data->IPAddress . "')");

                if (isset($_result[0]->ID) && $_result[0]->ID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_cancelled_property_successfully');
                    $response['data'] = $_result[0];
                } else if (isset($_result[0]->Message)) {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = @$msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('cancelledProperty' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('cancelledProperty' => $response);
        }
    }

    function addVisitorIdle($data)
    {
        try {
            $response = array();

            if (!isset($data->VisitorID) || $data->VisitorID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Visitor not found.';
            } else if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } else if (!isset($data->UserType) || $data->UserType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User type not found';
            } else if (!isset($data->IsIdle) || $data->IsIdle == '') {
                $response['Error'] = 102;
                $response['Message'] = 'IsIdle not found';
            } else {


                $add_user = $this->master_model->addVisitorIdle($data);

                if (isset($add_user['ID']) && $add_user['ID'] > 0) {
                    $response['Error'] = 200;
                    if ($data->IsIdle == 1) {
                        $response['Message'] = label('api_msg_add_visitor_idle_successfully');
                    } else {
                        $response['Message'] = label('api_msg_remove_visitor_from_idle');
                    }
                    $response['data'] = $add_user;

                    // $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee($data->CreatedBy)");
                    // if(!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)){  
                    //     $Message = $add_user['EmployeeFirstName'].' '.$add_user['EmployeeLastName'].' has added property of ('.$add_user['FirstName'].' '.$add_user['LastName'].').';
                    //     foreach ($_DeviceResult as $d_val) { 
                    //         //pr($d_val->DeviceTokenID);pr($rc_val->Message);
                    //         if(!empty($d_val->DeviceTokenID) && !empty($Message)){  

                    //             $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('".$d_val->UserID."', '".$Message."' , '".$data->CreatedBy."', '".$add_user['ID']."','addVisitorIdle') as IsNotificationAdded, 'Success' as Status");
                    //             $pushNotificationArr = array('device_id'=>$d_val->DeviceTokenID,
                    //                         'message'=>$Message,
                    //                         'title'=>DEFAULT_WEBSITE_TITLE,
                    //                         'ActionType'=>'addVisitorIdle',
                    //                         'detail'=> (array) $add_user
                    //                     );
                    //             //pr($pushNotificationArr);
                    //             $res = sendPushNotification($pushNotificationArr);
                    //             //pr($res);
                    //         }
                    //     }
                    // }

                } else if (isset($add_user['Message']) && $add_user['Message'] != '') {
                    $msg = explode('~', $add_user['Message']);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = $add_user;
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('addVisitorIdle' => $response);
    }

    function getDashboard($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } elseif (!isset($data->RoleID) || $data->RoleID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Role not found.';
            } else {

                $data->RoleID = (!isset($data->RoleID) || $data->RoleID == '') ? '-1' : $data->RoleID;
                //$_result = $this->master_model->getQueryResult("call usp_M_GetCurrentMotivationalQuote()");
                $_config = $this->master_model->getQueryResult("call usp_M_GetConfig()");
                // $_role = $this->getRoleByID($data->RoleID,'-1');

                $response['role'] = array();
                $_role = $this->getRoleByID($data->RoleID, '-1');
                if (!empty($_role))
                    $response['role'] = $_role;

                if (isset($_config) && !empty($_config) && !isset($_config['0']->Message)) {
                    @$_config[0]->Requirement = explode(',', $_config[0]->Requirement);
                    @$_config[0]->CommercialRequirement = explode(',', $_config[0]->CommercialRequirement);
                    @$_config[0]->LeadType = explode(',', @$_config[0]->LeadType);
                    $_config_arr = $_config[0];
                } else {
                    $_config_arr = array();
                }


                if (isset($_config) && !empty($_config) && @$_config['0']->ConfigID > 0) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_get_dashboard_successfully');
                    //$response['data'] = $_result[0];
                    $response['config'] = $_config_arr;
                    $response['role'] = $_role;
                } else if (isset($_config['0']->Message) && $_config['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getDashboard' => $response);
    }

    function getDashboardCount($data)
    {
        try {
            $response = array();

            // if (!isset($data->UserID) || $data->UserID == ''){
            //     $response['Error'] = 102;
            //     $response['Message'] = label('api_msg_user_not_found');
            // } else
            if (!isset($data->RoleID) || $data->RoleID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Role not found.';
            } elseif (!isset($data->FilterType) || $data->FilterType == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Filter type not found.';
            } else {

                $data->RoleID = (!isset($data->RoleID) || $data->RoleID == '') ? '-1' : $data->RoleID;
                $data->ProjectID = (!isset($data->ProjectID) || $data->ProjectID == '') ? '-1' : $data->ProjectID;
                $_result = $this->master_model->getQueryResult("call usp_MA_Dashboard('" . $data->RoleID . "','" . $data->ProjectID . "','Mobile','" . $data->FilterType . "','" . @$data->UserID . "')");

                if (isset($_result) && !empty($_result)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_get_dashboard_successfully');
                    $response['data'] = $_result[0];
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getDashboardCount' => $response);
    }

    function getRoleByID($RoleID, $ProjectID = '-1')
    {
        $_role_arr = $_role_project_arr = array();
        $i = 1;
        if ($RoleID == '0') {
            $_role_arr['Visitor'] = array(
                "RoleMapID" => "0",
                "RoleProjectID" => "0",
                "ModuleID" => "0",
                "is_insert" => "1",
                "is_view" => "1",
                "is_edit" => "1",
                "is_status" => "0",
                "is_export" => "0",
                "is_sms" => "1",
                "is_mail" => "1",
                "is_call" => "1",
                "is_push" => "1",
                "is_response" => "1",
                "is_convert" => "1",
                "is_price" => "0",
                "ModuleName" => "Visitor",
                "Type" => "Mobile",
                "ParentID" => "0",
                "ProjectID" => "0"
            );
            $_role_arr['Visitor_Reminder'] = array(
                "RoleMapID" => "0",
                "RoleProjectID" => "0",
                "ModuleID" => "0",
                "is_insert" => "1",
                "is_view" => "1",
                "is_edit" => "1",
                "is_status" => "0",
                "is_export" => "0",
                "is_sms" => "1",
                "is_mail" => "1",
                "is_call" => "1",
                "is_push" => "1",
                "is_response" => "1",
                "is_convert" => "1",
                "is_price" => "0",
                "ModuleName" => "Visitor",
                "Type" => "Mobile",
                "ParentID" => "0",
                "ProjectID" => "0"
            );
        } else {
            $_role = $this->master_model->getQueryResult("call usp_M_GetRoleMappingByID('" . $RoleID . "','" . $ProjectID . "')");

            $getVisitor = 0;

            if (isset($_role) && !empty($_role) && !isset($_role['0']->Message)) {
                foreach ($_role as $k => $val) {
                    if ($val->ProjectID == 0 && ($val->ModuleName == 'Visitor' or $val->ModuleName == 'Visitor_Reminder')) {
                        $_role_arr[$val->ModuleName] = $val;
                        $getVisitor = 1;
                        if (!isset($_role_project_arr['Project'][$val->ProjectID]['ProjectID'])) {
                            $_role_project_arr['Project'][$val->ProjectID]['ProjectID'] = $val->ProjectID;
                        }
                        $_role_project_arr['Project'][$val->ProjectID][$val->ModuleName] = $val;
                    } else {
                        $getVisitor = 1;
                        if ($val->ModuleName == 'Visitor' or $val->ModuleName == 'Visitor_Reminder') {
                            continue;
                        }
                        if (!isset($_role_project_arr['Project'][$val->ProjectID]['ProjectID'])) {
                            $_role_project_arr['Project'][$val->ProjectID]['ProjectID'] = $val->ProjectID;
                        }
                        $_role_project_arr['Project'][$val->ProjectID][$val->ModuleName] = $val;
                    }
                }
                foreach ($_role_project_arr['Project'] as $k2 => $val2) {
                    $_role_arr['Project'][] = $val2;
                }

                if (1) {
                    $_role_arr['Visitor'] = array(
                        "RoleMapID" => "0",
                        "RoleProjectID" => "0",
                        "ModuleID" => "0",
                        "is_insert" => "1",
                        "is_view" => "1",
                        "is_edit" => "1",
                        "is_status" => "0",
                        "is_export" => "0",
                        "is_sms" => "1",
                        "is_mail" => "1",
                        "is_call" => "1",
                        "is_push" => "1",
                        "is_response" => "1",
                        "is_convert" => "1",
                        "is_price" => "0",
                        "ModuleName" => "Visitor",
                        "Type" => "Mobile",
                        "ParentID" => "0",
                        "ProjectID" => "0"
                    );

                    $_role_arr['Visitor_Reminder'] = array(
                        "RoleMapID" => "0",
                        "RoleProjectID" => "0",
                        "ModuleID" => "0",
                        "is_insert" => "1",
                        "is_view" => "1",
                        "is_edit" => "1",
                        "is_status" => "0",
                        "is_export" => "0",
                        "is_sms" => "1",
                        "is_mail" => "1",
                        "is_call" => "1",
                        "is_push" => "1",
                        "is_response" => "1",
                        "is_convert" => "1",
                        "is_price" => "0",
                        "ModuleName" => "Visitor",
                        "Type" => "Mobile",
                        "ParentID" => "0",
                        "ProjectID" => "0"
                    );
                }
            } else {
                $_role_arr['Visitor'] = array(
                    "RoleMapID" => "0",
                    "RoleProjectID" => "0",
                    "ModuleID" => "0",
                    "is_insert" => "1",
                    "is_view" => "1",
                    "is_edit" => "1",
                    "is_status" => "0",
                    "is_export" => "0",
                    "is_sms" => "1",
                    "is_mail" => "1",
                    "is_call" => "1",
                    "is_push" => "1",
                    "is_response" => "1",
                    "is_convert" => "1",
                    "is_price" => "0",
                    "ModuleName" => "Visitor",
                    "Type" => "Mobile",
                    "ParentID" => "0",
                    "ProjectID" => "0"
                );
                $_role_arr['Visitor_Reminder'] = array(
                    "RoleMapID" => "0",
                    "RoleProjectID" => "0",
                    "ModuleID" => "0",
                    "is_insert" => "1",
                    "is_view" => "1",
                    "is_edit" => "1",
                    "is_status" => "0",
                    "is_export" => "0",
                    "is_sms" => "1",
                    "is_mail" => "1",
                    "is_call" => "1",
                    "is_push" => "1",
                    "is_response" => "1",
                    "is_convert" => "1",
                    "is_price" => "0",
                    "ModuleName" => "Visitor",
                    "Type" => "Mobile",
                    "ParentID" => "0",
                    "ProjectID" => "0"
                );
            }
        }
        return $_role_arr;
    }

    function getAccessRoleByRoleID($data)
    {
        try {
            $response = array();

            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = label('api_msg_user_not_found');
            } elseif (!isset($data->RoleID) || $data->RoleID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Role not found.';
            } else {

                $_role = $this->getRoleByID($data->RoleID, '-1');

                if (isset($_role) && !empty($_role) && !isset($_role['0']->Message)) {
                    $response['Error'] = 200;
                    $response['Message'] = label('api_msg_get_role_successfully');
                    $response['data'] = $_role;
                } else if (isset($_role['0']->Message) && $_role['0']->Message != "") {
                    $msg = explode('~', $_role[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_error_occurred');
                }
            }
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
        }
        return array('getAccessRoleByRoleID' => $response);
    }

    function changePropertyStatus($data)
    {
        try {
            $response = array();
            if (!isset($data->UserID) || $data->UserID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'User not found.';
            } else if (!isset($data->PassCode) && $data->PassCode == '') {
                $response['Error'] = 102;
                $response['Message'] = 'PassCode not found';
            } else {

                $_PassCodeResult = $this->master_model->getQueryResult("call usp_M_CheckPassCode('" . $data->UserID . "','" . $data->PassCode . "')");

                if (@$_PassCodeResult[0]->UserID > 0 && !isset($_PassCodeResult[0]->Message)) {

                    if (@$data->CustomerPropertyID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Customer property not found.';
                    } elseif (@$data->Type == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'Type not found.';
                    } elseif (@$data->UserID == '') {
                        $response['Error'] = 102;
                        $response['Message'] = 'User not found.';
                    } else {

                        $_result = $this->master_model->getQueryResult("call usp_M_ChangePropertyStatus('" . $data->Type . "','" . $data->CustomerPropertyID . "','" . $data->UserID . "')");

                        if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                            if ($data->Type == 'Verified') {
                                $_type = 'AddCustomerProperty';
                            } elseif ($data->Type == 'SD') {
                                $_type = 'SaleDeedPayment';
                            } else {
                                $_type = $data->Type . 'Payment';
                            }
                            $response['Error'] = 200;
                            $response['Message'] = label('api_msg_change_property_status_successfully');
                            $_result[0]->Type = $data->Type;
                            $response['data'] = $_result[0];

                            $_DeviceResult = $this->master_model->getQueryResult("call usp_M_getDeviceByEmployee(" . @$data->UserID . ",'Payment','-1')");

                            if (!empty($_DeviceResult) && !isset($_DeviceResult[0]->Message)  && !empty($_result[0]->msg)) {
                                $NoOfUser = array();
                                foreach ($_DeviceResult as $key => $value) {
                                    $NoOfUser[$value->UserID] = $value;
                                }
                                foreach ($NoOfUser as $val) {
                                    $addnotification = $this->master_model->getInlineQuery("SELECT Fn_A_AddNotification('" . $val->UserID . "', '" . $_result[0]->msg . "' , '" . $data->UserID . "', '" . $data->CustomerPropertyID . "','" . $_type . "') as IsNotificationAdded, 'Success' as Status");
                                }
                                foreach ($_DeviceResult as $d_val) {
                                    if (!empty($d_val->DeviceTokenID) && !empty($_result[0]->msg)) {

                                        $pushNotificationArr = array(
                                            'device_id' => $d_val->DeviceTokenID,
                                            'message' => $_result[0]->msg,
                                            'title' => DEFAULT_WEBSITE_TITLE,
                                            'event' => @$data->Type,
                                            'ActionType' => 'AddCustomer',
                                            'detail' => (array) $_result[0]
                                        );
                                        // pr($pushNotificationArr);
                                        $res = sendPushNotification($pushNotificationArr);
                                        // pr($res);
                                    }
                                }
                            }
                        } else if (isset($_result[0]->Message)) {
                            $msg = explode('~', $_result[0]->Message);
                            $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                            $response['Message'] = @$msg[1];
                            $response['data'] = array();
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = label('api_msg_something_went_wrong');
                        }
                    }
                } else if (isset($_PassCodeResult[0]->Message) && $_PassCodeResult[0]->Message != '') {
                    $msg = explode('~', $_PassCodeResult[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = label('api_msg_something_went_wrong');
                }
            }
            return array('changePropertyStatus' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = label('api_msg_something_went_wrong');
            return array('changePropertyStatus' => $response);
        }
    }

    function getWingwisePropertyByProject($data)
    {
        try {
            $response = array();
            $_wing_wise_property = array();

            if (!isset($data->ProjectID) || $data->ProjectID == '') {
                $response['Error'] = 102;
                $response['Message'] = 'Project not found.';
            } else {
                $_result = $this->master_model->getQueryResult("call usp_A_GetProjectByID('" . $data->ProjectID . "')");
                if (isset($_result) && !empty($_result) && !isset($_result['0']->Message)) {
                    if ($_result['0']->Prefix == "0") {
                        $_result_wings = $this->master_model->getQueryResult("call usp_A_GetWingsByPrefix('" . ($_result['0']->Prefix) . "','" . $data->ProjectID . "')");
                    } else {
                        $_result_wings = $this->master_model->getQueryResult("call usp_A_GetWingsByPrefix('" . count($_result['0']->Prefix) . "','" . $data->ProjectID . "')");
                    }
                    if (isset($_result_wings) && !empty($_result_wings) && !isset($_result_wings['0']->Message)) {
                        foreach ($_result_wings as $key => $value) {
                            $_result_property = $this->master_model->getQueryResult("call usp_A_GetPropertyByWings('" . $value->Wings . "','" . $value->PrefixLen . "','" . $data->ProjectID . "')");
                            if (isset($_result_property) && !empty($_result_property) && !isset($_result_property['0']->Message)) {
                                $_wing_wise_property[$value->Wings] = $_result_property;
                            }
                        }

                        if (isset($_wing_wise_property) && !empty($_wing_wise_property)) {
                            $_result = array();
                            foreach ($_wing_wise_property as $k2 => $val2) {
                                $_result[] = array('wings' => $k2, 'property' => $val2);
                            }
                            $response['Error'] = 200;
                            $response['Message'] = 'Property listed successfully.';
                            $response['data'] = $_result;
                        } else {
                            $response['Error'] = 104;
                            $response['Message'] = 'Error has been occurred please try again later.';
                        }
                    } else if (isset($_result_wings['0']->Message) && $_result_wings['0']->Message != "") {
                        $msg = explode('~', $_result_wings[0]->Message);
                        $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                        $response['Message'] = $msg[1];
                        $response['data'] = array();
                    } else {
                        $response['Error'] = 104;
                        $response['Message'] = 'Error has been occurred please try again later.';
                    }
                } else if (isset($_result['0']->Message) && $_result['0']->Message != "") {
                    $msg = explode('~', $_result[0]->Message);
                    $response['Error'] = ($msg[0]) ? $msg[0] : '103';
                    $response['Message'] = $msg[1];
                    $response['data'] = array();
                } else {
                    $response['Error'] = 104;
                    $response['Message'] = 'Error has been occurred please try again later.';
                }
            }
            return array('getWingwisePropertyByProject' => $response);
        } catch (Exception $e) {
            $response['Error'] = 104;
            $response['Message'] = 'Something went wrong.';
            return array('getWingwisePropertyByProject' => $response);
        }
    }

    // -------------- Send Push notification--------------------
    function mobile_notify($UserID = 17, $DeviceTokenID='')
    {
        $DeviceTokenID = 'el3fUG4L54k:APA91bEbwTOmYik81ixvhbRvdwMXHIDa2C-EBKFBQywDYio934kbka2aaIu1GPXKouzpIq-hQz4gtLnKMx-MnDsTwkyTYqmrMfJFVIRwYntAwf28lyKKkZii-Uhlx5Lh0W7Av2Yke1Ek';
        $pushNotificationArr = array(
            'device_id' => $DeviceTokenID,
            'message' => 'Send msg for testing',
            'title' => 'Samarth',
            'detail' => array(
                'UserID' => $UserID,
                'ActionType' => 'test'
            )
        );
        $res = sendPushNotification($pushNotificationArr);
        print_r($res);
        die;
    }

    function test_SMS()
    {
        $res = sendSMS('123', '123');
        print_r($res);
        die;
    }


    /*** End Api ***/
}
