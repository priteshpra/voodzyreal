<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Userfeedback extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/userfeedback_model');
        $this->load->model('admin/opportunity_model');
        $this->load->model('admin/visitor_model');
    }

    public function getRecordInfo()
    {
        $result = array();
        $result['data'] = $this->userfeedback_model->listData();
        $html = '';
        if (!isset($result['data']['0']->Message)) {
            foreach ($result['data'] as $key => $value) {
                $html .= '<tr>';
                $html .= '<td>' . $value->FeedbackDate . '</td>';
                $html .= '<td>' . $value->ProjectID . '</td>';
                $html .= '<td>' . $value->Feedback . '</td>';
                $html .= '<td>' . $value->Remarks . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="4" style="text-align:center;">No Record Fond.</td></tr>';
        }

        echo $html;
    }

    public function addFeedback()
    {
        $result = array();
        $array = $this->input->post();
        $result = $this->userfeedback_model->Insert();

        if ($array['ReminderDate'] != '') {
            $data = array();
            $data['OpportunityID'] = @$array['OpportunityID'];
            $data['VisitorID'] = @$array['VisitorID'];
            $data['Message'] = $array['Remarks'];
            $data['ReminderDate'] = $array['ReminderDate'];
            $data['ReminderTime'] = $array['ReminderTime'];
            $data['PastTime'] =  date("H:i");
            $data['PastDate'] =  date("d-m-Y");
            $data['Status'] = 'on';
            if ($data['OpportunityID'] > 0) {
                $this->opportunity_model->InsertReminder($data);
            } else {
                $this->visitor_model->InsertReminder($data);
            }
        }

        echo "Feedback added Successfully.";
    }
}
