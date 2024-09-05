<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getUserType')) {
    function getUserType()
    {
        $user_type['types'] = array('Admin' => '1', 'Vendor' => '2', 'Customer' => '3', 'Subscribe' => '4');
        return $user_type;
    }
}

/**
 * Purpose : drop-down box of Country
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCountryCombobox')) {
    function getCountryCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCountryCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/country_combo_box', $data, TRUE);
    }
}

if (!function_exists('getEmployee')) {
    function getEmployee($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['SelectedName'] = "";
        $data['all_data'] = $CI->common_model->getEmployee();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/employee_combo_box', $data, TRUE);
    }
}

if (!function_exists('getVisitor')) {
    function getVisitor($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getVisitor();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/visitor_combo_box', $data, TRUE);
    }
}

if (!function_exists('getDesignation')) {
    function getDesignation($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getDesignation();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/designation_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of State
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getStateCombobox')) {
    function getStateCombobox($Selected = 0, $CountryID = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getStateCombobox($Selected, $CountryID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/state_combo_box', $data, TRUE);
    }
}

if (!function_exists('getOnlyStateCombobox')) {
    function getOnlyStateCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetOnlyState();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/state_combo_box_only', $data, TRUE);
    }
}



if (!function_exists('getLocationTypeCombobox')) {
    function getLocationTypeCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getLocationTypeCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/location_type_combo_box', $data, TRUE);
    }
}


/**
 * Purpose : drop-down box of Pages
 * Parameters :
 *      @Selected = (optional) pass this parameter if any page needs to be pre-selected
 * Developer : Zalak
 */
if (!function_exists('getPageCombobox')) {
    function getPageCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getPageCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/pagename_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of City
 * Parameters :
 *      @Selected = (optional) pass this parameter if any country needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCityCombobox')) {
    function getCityCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetOnlyCity();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/city_combo_box', $data, TRUE);
    }
}

if (!function_exists('getUser')) {
    function getUser($selected_admin_id = 0)
    {
        $CI = &get_instance();
        $CI->load->model('admin/rolemapping_model');
        $data = array();
        $data['admin'] = $CI->rolemapping_model->getUser();
        $data['selected_admin_id'] = $selected_admin_id;
        //pr($data);exit;
        return $CI->load->view('common_view_files/admin_combo_box', $data, TRUE);
    }
}

if (!function_exists('getAllRolesForCombobox')) {
    function getAllRolesForCombobox($selected_role_id = 0)
    {
        $CI = &get_instance();
        $CI->load->model('admin/role_model');
        $data = array();
        $data['all_roles'] = $CI->role_model->getRoleComboBox();
        $data['selected_role_id'] = $selected_role_id;
        return $CI->load->view('common_view_files/roles_combo_box', $data, TRUE);
    }
}

if (!function_exists('getAllCountryForCombobox')) {
    function getAllCountryForCombobox($selected_country_id = 0)
    {
        $CI = &get_instance();
        $CI->load->model('admin/country_model');
        $data = array();
        $data['all_countries'] = $CI->country_model->getCountryComboBox();
        $data['selected_country_id'] = $selected_country_id;

        return $CI->load->view('common_view_files/country_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Employeeinouttime
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Employeeinouttime needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getEmployeeCombobox')) {

    function getEmployeeCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getEmployeeCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/employeeinouttime_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of User
 * Parameters :
 *      @Selected = (optional) pass this parameter if any User needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getUserCombobox')) {

    function getUserCombobox($Selected = 0, $usertype = '')
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getUserCombobox($usertype);
        //pr($data['all_data']);exit;
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/user_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Group
 * Parameters :
 * @Selected = (optional) pass this parameter if any Group needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getGroupCombobox')) {

    function getGroupCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->GetOnlyGroup();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/group_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of language
 * Parameters :
 *      @Selected = (optional) pass this parameter if any language needs to be pre-selected
 * Developer : Gopi
 */
if (!function_exists('getLanguageCombobox')) {

    function getLanguageCombobox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getLanguageCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/language_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Property
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Property needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getPropertyCombobox')) {
    function getPropertyCombobox($Selected = 0, $ProjectID = 0, $Select2 = 0, $Type = "")
    {
        $CI = &get_instance();
        $data = array();
        if ($Type == "All") {
            $data['all_data'] = $CI->common_model->GetAllPropertyCombobox($ProjectID);
        } elseif ($Type == "Purchase") {
            $data['all_data'] = $CI->common_model->GetPurchaseProperty($ProjectID);
        } else {
            $data['all_data'] = $CI->common_model->getPropertyCombobox($ProjectID);
        }
        $data['Selected'] = $Selected;
        $data['Select2'] = $Select2;
        return $CI->load->view('common_view_files/property_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Property
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Property needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCustomerPropertyCombobox')) {
    function getCustomerPropertyCombobox($Selected = 0, $CustomerID = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCustomerPropertyCombobox($CustomerID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/customerproperty_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Customer MileStone by Customer PropertyID
 * Parameters :
 *      @Selected = (optional) pass this parameter if any CustomerMileStone needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getCustomerMileStoneCombobox')) {
    function getCustomerMileStoneCombobox($Selected = 0, $CustomerPropertyID = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getCustomerMileStoneCombobox($CustomerPropertyID);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/customermilestone_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Project
 * Parameters :
 *      @Selected = (optional) pass this parameter if any CustomerMileStone needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getProject')) {
    function getProject($Selected = 0, $GroupID = -1, $RoleID = -1, $disabled = 0, $OnlyOne = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['all_data'] = $CI->common_model->getProjectByRoleID($RoleID);
        $data['Selected'] = $Selected;
        $data['disabled'] = $disabled;
        $data['OnlyOne'] = $OnlyOne;
        return $CI->load->view('common_view_files/project_combo_box', $data, TRUE);
    }
}
/**
 * Purpose : drop-down box of Project
 * Parameters :
 *      @Selected = (optional) pass this parameter if any CustomerMileStone needs to be pre-selected
 * Developer : Nilay
 */
if (!function_exists('getProjectByRoleID')) {
    function getProjectByRoleID($RoleID = -1, $Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $data['ProjectID'] = $Selected;
        $data['all_data'] = $CI->common_model->getProjectByRoleID($RoleID);
        return $CI->load->view('common_view_files/projectbyrole_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of chanel partner
 * Parameters :
 *      @Selected = (optional) pass this parameter if any chanel partner needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getChanelPartner')) {

    function getChanelPartner($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $Selected = (int)$Selected;
        $data['ChanelPartnerID'] = $Selected;
        $data['all_data'] = $CI->common_model->getChanelPartnersCombobox($Selected);
        return $CI->load->view('common_view_files/chanelpartner_combo_box', $data, TRUE);
    }
}


/**
 * Purpose : drop-down box of category
 * Parameters :
 *      @Selected = (optional) pass this parameter if any category needs to be pre-selected
 * Developer : Upexa
 */

if (!function_exists('getCategoryComboBox')) {
    function getCategoryComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $Selected = (int)$Selected;
        $CI->load->model('admin/category_model');
        $data['CategoryID'] = $Selected;
        $_POST['Status'] = 1;
        $data['all_data'] = $CI->category_model->ListData(-1, 1);
        //$data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/category_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of vendor
 * Parameters :
 *      @Selected = (optional) pass this parameter if any vendor needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getVendor')) {
    function getVendor($CategoryID = 0, $Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $CI->load->model('admin/vendor_model');
        $_POST['CategoryID'] = $CategoryID;
        $data['all_data'] = $CI->vendor_model->VendorNameCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/vendor_combo_box', $data, TRUE);
    }
}


/**
 * Purpose : drop-down box of UOM
 * Parameters :
 *      @Selected = (optional) pass this parameter if any UOM needs to be pre-selected
 * Developer : Upexa
 */

if (!function_exists('getUOMComboBox')) {
    function getUOMComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data['SelectedName'] = "";
        $CI->load->model('admin/uom_model');
        $_POST['Status'] = 1;
        $res = $CI->uom_model->ListData(-1, 1);
        $data['all_data'] = $CI->uom_model->ListData(-1, 1);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/uom_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Goods
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Goods needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getGoods')) {
    function getGoods($CategoryID = 0, $Selected = 0)
    {
        $_POST['CategoryID'] = $CategoryID;
        $CI = &get_instance();
        $data = array();
        $CI->load->model('admin/goods_model');
        $data['all_data'] = $CI->goods_model->GoodsNameCombobox();
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/goods_combo_box', $data, TRUE);
    }
}

if (!function_exists('getMonth')) {

    function getMonth($DynamicID = '', $Selected = 0)
    {

        $CI = &get_instance();
        $data = array();
        $Selected = (int)$Selected;
        $data['Month'] = $Selected;
        $data['DynamicID'] = $DynamicID;
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/month_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of feedback
 * Parameters :
 *      @Selected = (optional) pass this parameter if any feedback needs to be pre-selected
 * Developer : Upexa
 */

if (!function_exists('getFeedbackComboBox')) {
    function getFeedbackComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $Selected = (int)$Selected;
        $CI->load->model('admin/feedback_model');
        $data['FeedbackID'] = $Selected;
        $_POST['Status'] = 1;
        $data['all_data'] = $CI->feedback_model->ListData(-1, 1);
        //$data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/feedback_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Area
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Area needs to be pre-selected
 * Developer : Upexa
 */

if (!function_exists('getAreaComboBox')) {
    function getAreaComboBox($Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $CI->load->model('admin/area_model');
        $data['AreaName'] = $Selected;
        $_POST['Status'] = 1;
        $data['all_data'] = $CI->area_model->ListData(-1, 1);
        $data['AreaID'] = $Selected;
        return $CI->load->view('common_view_files/area_combo_box', $data, TRUE);
    }
}

/**
 * Purpose : drop-down box of Leads
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Leads needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getLeads')) {
    function getLeads($VisitorID = 0, $Selected = 0)
    {
        $_POST['VisitorID'] = $VisitorID;
        $CI = &get_instance();
        $data = array();
        $CI->load->model('admin/visitorleads_model');
        $data['all_data'] = $CI->visitorleads_model->listData(-1, 1);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/visitorleads_combo_box', $data, TRUE);
    }
}

if (!function_exists('addNotifaction')) {
    function addNotifaction($notificationArray)
    {

        $CI = &get_instance();
        $CI->load->model('admin/notification_model');
        $data['all_data'] = $CI->notification_model->Insert($notificationArray);
        $data['Selected'] = $Selected;
        return 1;
    }
}

if (!function_exists('getNotifactionCount')) {
    function getNotifactionCount()
    {
        $CI = &get_instance();
        $CI->load->model('admin/notification_model');
        $data['all_data'] = $CI->notification_model->getNotificationCount();
        //print_r($data['all_data'][0]->NotificationCount);exit();
        if (!isset($data['all_data']['0']->Message)) {
            return $data['all_data'][0]->NotificationCount;
        } else {
            return 0;
        }
    }
}


if (!function_exists('getNotifactions')) {
    function getNotifactions()
    {
        $CI = &get_instance();
        $CI->load->model('admin/notification_model');
        $data['all_data'] = $CI->notification_model->listData(-1, 1);
        return $data;
    }
}

/**
 * Purpose : drop-down box of Sites
 * Parameters :
 *      @Selected = (optional) pass this parameter if any Sites needs to be pre-selected
 * Developer : Upexa
 */
if (!function_exists('getSites')) {
    function getSites($VisitorID = -1, $Selected = 0)
    {
        $CI = &get_instance();
        $data = array();
        $CI->load->model('admin/sites_model');
        $_POST['VisitorID'] = $VisitorID;
        $data['all_data'] = $CI->sites_model->listData(-1, 1);
        $data['Selected'] = $Selected;
        return $CI->load->view('common_view_files/sites_combo_box', $data, TRUE);
    }
}
