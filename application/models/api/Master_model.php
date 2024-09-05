<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_model extends CI_Model 
{
    function __construct() 
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // Start : Result as per Sp query 
    public function getQueryResult($sql){  
        try{
            $query = $this->db->query($sql);
            $query->next_result();        
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQuery($sql){  
        try{
            $query = $this->db->query($sql);
            return $query->result();
        }catch(Exection $e){
            return '';
        }
    }
    
    // Start : Result as per Sp query 
    public function getInlineQueryNoResult($sql){  
        try{
            $query = $this->db->query($sql);
            return 1; //$query->result();
        }catch(Exection $e){
            return '';
        }
    }

    public function userSignup($data) {

        if(!isset($data->NotificationToken)) $data->NotificationToken='';
        if(!isset($data->DeviceUID)) $data->DeviceUID='';
        if(!isset($data->DeviceName)) $data->DeviceName='';
        if(!isset($data->OSVersion)) $data->OSVersion='';
        if(!isset($data->DeviceType)) $data->DeviceType='';

        $data->FirstName = ((isset($data->FirstName )) ? $data->FirstName  : '' );
        $data->LastName = ((isset($data->LastName )) ? $data->LastName  : '' );

        $sql = "call usp_M_SignUp('" . $data->FirstName . "','" .  
                                        $data->LastName . "','" .
                                        $data->EmailID . "','" . 
                                        $data->MobileNo . "','" . 
                                        fnEncrypt($data->Password) . "','".
                                        base_url()."', '" . 
                                        $data->NotificationToken . "', '" . 
                                        $data->DeviceType."','".
                                        $data->DeviceUID."','".
                                        $data->DeviceName."','".
                                        $data->OSVersion."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addVisitor($data)
    {

        if (!isset($data->CompanyName)) $data->CompanyName = '';
        if (!isset($data->DesignationID) || $data->DesignationID == '') $data->DesignationID = '0';
        if (!isset($data->Budget) || $data->Budget == '') $data->Budget = '0';
        if (!isset($data->PromotionalNotifications) || $data->PromotionalNotifications == '') $data->PromotionalNotifications = '1';
        if (!isset($data->Remarks)) $data->Remarks = '';
        if (!isset($data->ChannelPartner)) $data->ChannelPartner = '';
        if (!isset($data->IPAddress)) $data->IPAddress = '';
        if (!isset($data->Profession) || $data->Profession == '') $data->Profession = 'Job';
        if (!isset($data->VisitSource) || $data->VisitSource == '') $data->VisitSource = 'Others';
        if (!isset($data->VisitorCenter)) $data->VisitorCenter = '';
        if (!isset($data->OutDoorLocation)) $data->OutDoorLocation = '';
        if (!isset($data->ProjectID)) $data->ProjectID = 0;
        $data->Status = 1;

        if (!isset($data->ChanelPartnerID) || $data->ChanelPartnerID == '') $data->ChanelPartnerID = '0';
        if (!isset($data->Finance)) $data->Finance = '';
        if (!isset($data->PropertyInterest)) $data->PropertyInterest = '';
        if (!isset($data->PurposeofBuying)) $data->PurposeofBuying = '';
        if (!isset($data->PreferedTimeToCall)) $data->PreferedTimeToCall = '';
        if (!isset($data->InquiryDate)) $data->InquiryDate = '0000-00-00';
        if (!isset($data->LeadType)) $data->LeadType = 'Cold';

        $sql = "call usp_A_AddVisitor('" . $data->EmployeeID . "','" .
            $data->CreatedBy . "','" .
            $data->Status . "','" .
            $data->UserType . "','" .
            $data->IPAddress . "','" .
            $data->FirstName . "','" .
            $data->LastName . "','" .
            $data->MobileNo . "','" .
            $data->Address . "','" .
            @$data->EmailID . "','" .
            $data->CompanyName . "', '" .
            $data->DesignationID . "','" .
            $data->BirthDate . "','" .
            $data->BirthMonth . "','" .
            $data->AnniversaryDate . "','" .
            $data->AnniversaryMonth . "','" .
            $data->OpportunityID . "','" .
            $data->SecondMobileNo . "','" .
            $data->SecondName . "','" .
            $data->VisitorStatus . "')";

        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();

        return $query->row_array();
    }

    public function addDevice($data){
        
            $query = $this->db->query("select Fn_M_AddDevice('" .$data->DeviceName . "','" . $data->DeviceUID . "','" . $data->OSVersion. "','" . $data->NotificationToken . "','" . $data->DeviceType . "','" . $data->UserID. "') as device_status, '".$data->NotificationToken."' as NotificationToken");
            //$query->next_result();
            return $query->row_array();
    }

    public function addCustomer($data) {

        if(!isset($data->EmailID)) $data->EmailID='';
        if(!isset($data->Address)) $data->Address='';
        if(!isset($data->MobileNo1)) $data->MobileNo1='';
        if(!isset($data->IPAddress)) $data->IPAddress='';
        $data->Status = 1;

        $sql = "call usp_A_AddCustomer('" . $data->FirstName . "','" .  
                                        $data->LastName . "','" .
                                        @$data->EmailID . "','" . 
                                        $data->MobileNo . "','" . 
                                        $data->MobileNo1."', '" .
                                        $data->Address . "','". 
                                        $data->CreatedBy."','".
                                        $data->Status."','".
                                        $data->UserType."','".
                                        $data->IPAddress."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addCustomerProperty($data) {

        if(!isset($data->PaymentMode)) $data->PaymentMode='Cheque';
        if(!isset($data->UserType)) $data->UserType='Employee Android';
        if(!isset($data->Status)) $data->Status='1';
        if(!isset($data->IPAddress)) $data->IPAddress='';

        // if(!isset($data->SerialNo)) $data->SerialNo='';
        if(!isset($data->CustomerPanNo)) $data->CustomerPanNo='';
        if(!isset($data->CustomerAdhaarNo)) $data->CustomerAdhaarNo='';
        if(!isset($data->CustomerMobileNo1)) $data->CustomerMobileNo1='';
        if(!isset($data->CustomerSFirstName)) $data->CustomerSFirstName='';
        if(!isset($data->CustomerSLastName)) $data->CustomerSLastName='';
        if(!isset($data->CustomerSAddress)) $data->CustomerSAddress=''; 
        if(!isset($data->CustomerSEmailID)) $data->CustomerSEmailID='';
        if(!isset($data->CustomerSPanNo)) $data->CustomerSPanNo='';
        if(!isset($data->CustomerSAdhaarNo)) $data->CustomerSAdhaarNo='';
        if(!isset($data->CustomerSMobileNo)) $data->CustomerSMobileNo='';
        if(!isset($data->CustomerSMobileNo1)) $data->CustomerSMobileNo1='';
        if(!isset($data->ChannelPartner)) $data->ChannelPartner='';
        if(!isset($data->GSTAmount)) $data->GSTAmount=0;
        if(!isset($data->IsHold)) $data->IsHold=0;
        $data->Status = 1;


        $sql = "call usp_A_AddCustomerProperty('" . $data->CustomerID . "','" .  
                                        $data->PropertyID . "','" .  
                                        $data->PurchaseDate . "','" .  
                                        $data->Amount . "','" .  
                                        $data->GSTAmount . "','" .  
                                        // $data->PaymentMode . "','" .  
                                        // $data->ChequeNo . "','" .  
                                        // $data->IFCCode . "','" .  
                                        // $data->AccountNo . "','" .  
                                        // $data->BankName . "','" .  
                                        // $data->BranchName . "','" .  
                                        // $data->DPRP . "','" .  
                                        $data->CustomerFirstName . "','" .  
                                        $data->CustomerLastName . "','" .  
                                        $data->CustomerAddress . "','" .  
                                        @$data->CustomerEmailID . "','" .  
                                        $data->CustomerPanNo . "','" .  
                                        $data->CustomerAdhaarNo . "','" .  
                                        $data->CustomerMobileNo . "','" .  
                                        $data->CustomerMobileNo1 . "','" .  
                                        $data->CustomerSFirstName . "','" .  
                                        $data->CustomerSLastName . "','" .  
                                        $data->CustomerSAddress . "','" .  
                                        @$data->CustomerSEmailID . "','" .  
                                        $data->CustomerSPanNo . "','" .  
                                        $data->CustomerSAdhaarNo . "','" .  
                                        $data->CustomerSMobileNo . "','" .  
                                        $data->CustomerSMobileNo1 . "','" .  
                                        $data->CreatedBy . "','" .  
                                        $data->Status . "','" .  
                                        $data->UserType . "','" .  
                                        $data->IPAddress."','" .  
                                        base_url()."','" .  
                                        $data->ChannelPartner."','" . 
                                        $data->IsHold."')";

        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addCustomerPayment($data) {

        if(!isset($data->BranchName)) $data->BranchName='';
        if(!isset($data->BankName)) $data->BankName='';
        if(!isset($data->AccountNo)) $data->AccountNo='';
        if(!isset($data->IFCCode)) $data->IFCCode='';
        if(!isset($data->ChequeNo)) $data->ChequeNo='';
        if(!isset($data->IPAddress)) $data->IPAddress='';
        $data->Status = 1;
        if(!isset($data->UserType)) $data->UserType='Employee Android';
        if(!isset($data->MileStone)) $data->MileStone='';
        if(!isset($data->PaymentAmount) || $data->PaymentAmount=='') $data->PaymentAmount='0';
        if(!isset($data->GSTAmount) || $data->GSTAmount=='') $data->GSTAmount='0';
        if(!isset($data->AmountType) || $data->AmountType=='') $data->AmountType='0';

        $sql = "call usp_A_AddCustomerPayment('" . $data->CustomerPropertyID . "','" .  
                                        $data->AmountType . "','" .
                                        $data->PaymentAmount . "','" .
                                        $data->GSTAmount . "','" .
                                        $data->PaymentDate . "','" . 
                                        $data->PaymentMode . "','" . 
                                        $data->ChequeNo."', '" .
                                        $data->IFCCode . "','". 
                                        $data->AccountNo."','". 
                                        $data->BankName."','". 
                                        $data->BranchName."','".  
                                        $data->CreatedBy."','".
                                        $data->Status."','".
                                        $data->UserType."','".
                                        $data->IPAddress."','".
                                        $data->MileStone."','".
                                        base_url()."','".
                                        @$data->UTR."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function addCustomerPropertyDocument($data) {

        
        $data->Status = 1;
        if(!isset($data->IPAddress)) $data->IPAddress='';
        if(!isset($data->UserType)) $data->UserType='Employee Android';

        $sql = "call usp_A_AddCustomerPropertyDocument('" . $data->CustomerPropertyID . "','" .  
                                        $data->DocumentUrl . "','" .
                                        $data->Title . "','" .   
                                        $data->CreatedBy."','".
                                        $data->Status."','".
                                        $data->UserType."','".
                                        $data->IPAddress."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function editAdminDetail($data) {

        if(!isset($data->EmailID)) $data->EmailID='';
        if(!isset($data->Address)) $data->Address='';
        if(!isset($data->MobileNo1)) $data->MobileNo1='';
        if(!isset($data->IPAddress)) $data->IPAddress='';

        $sql = "call usp_A_EditAdminDetail('" . $data->FirstName . "','" .  
                                        $data->LastName . "','" .
                                        $data->MobileNo . "','" . 
                                        $data->ModifiedBy."', '" .
                                        $data->UserID . "','". 
                                        $data->UserType."','".
                                        $data->IPAddress."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    public function updateVisitorReminder($data) {

        if(!isset($data->IPAddress)) $data->IPAddress='';
        $data->ReminderDate = (!isset($data->ReminderDate) || $data->ReminderDate=='') ? '1000-01-01' : $data->ReminderDate;

        $sql = "call usp_A_UpdateVisitorReminder('" . $data->VisitorID . "','" .  
                                        $data->ReminderDate . "','" . 
                                        $data->Message . "','" .
                                        $data->UserID . "','" . 
                                        $data->UserType."', '" .
                                        $data->IPAddress."', '" .
                                        $data->PastDate."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        return $query->row_array();
    }

    // public function userSocialMediaLogin($data) {
        
    //     if(!isset($data->EmailID)) $data->EmailID=''; 
    //     if(!isset($data->MobileNo)) $data->MobileNo='';
    //     if(!isset($data->file_name)) $data->file_name='';
    //     if(!isset($data->NotificationToken)) $data->NotificationToken='';
    //     if(!isset($data->DeviceUID)) $data->DeviceUID='';
    //     if(!isset($data->DeviceName)) $data->DeviceName='';
    //     if(!isset($data->OSVersion)) $data->OSVersion='';
    //     if(!isset($data->DeviceType)) $data->DeviceType='';

    //     $sql = "call usp_M_UserSocialMediaLogin('".$data->FirstName."','". 
    //                                                     $data->LastName."','". 
    //                                                     $data->EmailID."','". 
    //                                                     $data->MobileNo."','" . 
    //                                                     $data->RegistrationType."','" . 
    //                                                     $data->RegistrationID."','". 
    //                                                     base_url()."','". 
    //                                                     $data->file_name."','" . 
    //                                                     $data->NotificationToken."','" . 
    //                                                     $data->DeviceUID."','".
    //                                                     $data->DeviceName."','".
    //                                                     $data->OSVersion."','".
    //                                                     $data->DeviceType."')";

    //     $query = $this->db->query($sql);
    //     $query->next_result();
    //     return $query->result();
    // }

    // public function checkOTPVerification($data){
    //     $query = $this->db->query("call usp_M_OTPVerified('".$data->UserID."','".$data->OTP."')");
    //     $query->next_result();
    //     return $query->result();
    // }

    // public function generateOTP($data, $OTP=''){
    //     if($OTP==''){
    //         $OTP = date('sd');
    //     }
    //     $query = $this->db->query("call usp_M_RegenerateOTP('".$data->UserID."','".$OTP."')");
    //     $query->next_result();
    //     return $query->result();
    // }

    function get_emailtemplate($id){ 
        $sql = "call usp_W_GetEmailTemplateDetailByID('".$id."')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row_array();
        
    }

    public function addCustomerReminder($data) {

        if(!isset($data->Amount)) $data->Amount='';
        if(!isset($data->IPAddress)) $data->IPAddress='';

        $sql = "call usp_M_AddCustomerReminder('" . $data->CustomerPropertyID . "','" .  
                                        $data->Amount . "','" . 
                                        $data->ReminderDate . "','" .
                                        $data->UserID . "','" . 
                                        $data->UserType."','".
                                        $data->IPAddress."','".
                                        $data->Message."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        
        return $query->row_array();
    }

    public function addReminderAction($data) {

        if(!isset($data['IPAddress'])) $data['IPAddress']='';
        if(!isset($data['Subject'])) $data['Subject']='';

        $sql = "call usp_A_AddReminderAction('" . $data['ID'] . "','" .  
                                        $data['ActionType'] . "','" . 
                                        $data['Message'] . "','" .
                                        $data['UserID']."','".
                                        $data['ActionUser']."','".
                                        $data['Subject'] . "','" .   
                                        $data['UserType']."','".
                                        $data['IPAddress']."','".
                                        $data['file_name']."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        
        return $query->row_array();
    }

    public function addReminderResponse($data) {

        if(!isset($data->IPAddress)) $data->IPAddress='';
//usp_M_AddReminderResponse
        $sql = "call usp_A_AddRespose('" . $data->ReminderID . "','" .  
                                        $data->ReminderType . "','" .  
                                        $data->Response . "','" . 
                                        $data->ResponseBy . "','" .
                                        $data->UserType."','".
                                        $data->IPAddress."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        
        return $query->row_array();
    }

    public function setUserNotificationSetting($data) {

        if(!isset($data->IPAddress)) $data->IPAddress='';

        $sql = "call usp_A_SetUserNotificationSetting('" . $data->UserID . "','" .  
                                        $data->IsPush . "','" . 
                                        $data->UserID . "','" .
                                        $data->UserType."','".
                                        $data->IPAddress."','".
                                        $data->VisitorReminder."','".
                                        $data->Customer."','".
                                        $data->CustomerReminder."','".
                                        $data->CustomerProperty."','".
                                        $data->Payment."','".
                                        $data->Document."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        
        return $query->row_array();
    }

    public function addVisitorIdle($data) {

        if(!isset($data->IPAddress)) $data->IPAddress='';

        $sql = "call usp_A_AddVisitorIdle('" . $data->VisitorID . "','" .  
                                        $data->UserID . "','" . 
                                        $data->UserType . "','" .
                                        $data->IPAddress."','" .
                                        $data->IsIdle."')";
        $parameters = array();
        $query = $this->db->query($sql, $parameters);
        $query->next_result();
        
        return $query->row_array();
    }

}