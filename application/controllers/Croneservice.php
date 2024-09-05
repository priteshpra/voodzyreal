<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Croneservice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->load->model('api/master_model', '', TRUE);
        $this->load->model('admin/opportunity_model');
        $this->load->model('admin/visitor_model');
    }

    public function leadremindernofity()
    {
        $data = $this->opportunity_model->listReminderNotificationData();
        if (isset($data['0']->OpportunityReminderID)) {
            $datastr = '';
            foreach ($data as $key => $value) {
                $datastr = 'Lead of ' . $value->name . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';
                if ($value->RoleID != '-1') {
                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $value->ReminderBy . "')");

                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Lead Reminder',
                                'event' => '',
                                'ActionType' => 'Lead Reminder',
                                'detail' => '',
                                'ID' => $value->OpportunityID
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }
                }
            }

            foreach ($data as $key => $value) {
                $datastr = 'Lead of ' . $value->name . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';

                $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");
                foreach ($Userata as $key => $uservalue) {
                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $uservalue->UserID . "')");


                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Lead Reminder',
                                'event' => '',
                                'ActionType' => 'Lead Reminder',
                                'detail' => '',
                                'ID' => $value->OpportunityID
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }
                }
            }
        }
    }

    public function visitorremindernofity()
    {
        $data = $this->visitor_model->listReminderNotificationData();
        if (isset($data['0']->VisitorReminderID)) {
            $datastr = '';
            foreach ($data as $key => $value) {
                $datastr .= 'Visitor of ' . $value->VisitorName . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';
                if ($value->RoleID != '-1') {
                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $value->ReminderBy . "')");

                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Visitor Reminder',
                                'event' => '',
                                'ActionType' => 'Visitor Reminder',
                                'detail' => '',
                                'ID' => $value->VisitorID
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }
                }
            }

            foreach ($data as $key => $value) {
                $datastr .= 'Visitor of ' . $value->VisitorName . ' (' . @$value->MobileNo . ')' . ' has new reminder (' . $value->Message . ')';

                $Userata =  $this->master_model->getQueryResult("call usp_M_GetUserByRoleID()");

                foreach ($Userata as $key => $uservalue) {
                    $EmployeeData =  $this->master_model->getQueryResult("call usp_A_GetDeviceInfoByID('" .
                        $uservalue->UserID . "')");

                    if (!isset($EmployeeData['0']->Message)) {
                        foreach ($EmployeeData as $key => $devicevalue) {
                            $pushNotificationArr = array(
                                'device_id' => $devicevalue->DeviceTokenID,
                                'message' =>  $datastr,
                                'title' => 'Visitor Reminder',
                                'event' => '',
                                'ActionType' => 'Visitor Reminder',
                                'detail' => '',
                                'ID' => $value->VisitorID
                            );
                            $res = sendPushNotification($pushNotificationArr);
                        }
                    }
                }
            }
        }
    }
}
