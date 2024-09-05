<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('REGISTRATION_FORM', serialize(array('IOS', 'Android', 'Admin', 'Web')));
define('USER_TYPE', serialize(array('1' => 'Admin', '2' => 'Vendor', '3' => 'Customer', '4' => 'Subscribe')));
define('REGISTRATION_TYPE', serialize(array('Regular', 'Facebook', 'GooglePlus', 'Twitter')));
//$reg_type = unserialize (REGISTRATION_TYPE); //use it
//define('BASEPATH');
define('ACTIVE', 			1);
define('INACTIVE', 			0);
define('PER_PAGE_RECORD', 	30);
define('ADMIN', 			1);

define('MALE', 		"Male");
define('FEMALE', 	"Female");
/* Alert Messages */
define('SUCCESS_ACTIVE_MESSEGE', 	'Status is Active Now.');
define('SUCCESS_INACTIVE_MESSEGE', 	'Status is InActive Now.');
define('SUCCESS_INSERT_MESSEGE', 	'Record has been Added Successfully.');
define('SUCCESS_REQUIRED_MESSEGE', 	'Enter all required field.');
define('SUCCESS_UPDATE_MESSEGE', 	'Record has been Updated Successfully.');
define('CATCH_ERROR', 				'Something went Wrong, Please Try Later.');
define('AMENITY_NOT_AVAILABLE', 	'Amenity not Available');
define('ENTER_VALID_DATE',			'Enter Valid Date');
define('ReSOURCE_NOT_AVAILABLE',	'Resource not Available');

define('CHANGE_STATUS',			'status_change');
define('ACTIVE_ICON_CLASS', 	'mdi-navigation-check status_change active_status_icon');
define('INACTIVE_ICON_CLASS', 	'mdi-navigation-close status_change inactive_status_icon');
define('AACTIVE_ICON_CLASS', 	'mdi-navigation-check active_status_icon');
define('AINACTIVE_ICON_CLASS', 	'mdi-navigation-close inactive_status_icon');
define('LOADING_ICON_CLASS', 	'fa fa-spinner fa-spin fa-fw margin-bottom loading_status_icon');
define('EDIT_ICON_CLASS', 		'mdi-editor-mode-edit');
define('REFUND_ICON_CLASS', 		'mdi-notification-sync');
define('VISITOR_IDLE', 		'mdi-action-alarm-off');
define('VISITOR_NOT_IDLE', 		'mdi-action-alarm-on');
define('VERIFIED', 		'assets/admin/img/check_01.png');
define('NOT_VERIFIED', 		'assets/admin/img/check_03.png');
define('NOT_PERMISSION_NOT_VERIFIED', 		'assets/admin/img/check_02.png');

define('SD_CLASS_ACTIVE', 		'assets/admin/img/icon_01.png');
define('SD_CLASS_INACTIVE', 		'assets/admin/img/icon_03.png');
define('NOT_ABLE_SD_CLASS_INACTIVE', 		'assets/admin/img/icon_02.png');

define('ATS_CLASS_ACTIVE', 		'assets/admin/img/ats_icon_01.png');
define('ATS_CLASS_INACTIVE', 		'assets/admin/img/ats_icon_03.png');
define('NOT_ABLE_ATS_CLASS_INACTIVE', 		'assets/admin/img/ats_icon_02.png');

define('DELETE_ICON_CLASS', 	'mdi-action-delete');
define('DOWNLOAD_ICON_CLASS', 	'mdi-file-file-download');
define('VIEW_ICON_CLASS', 		'mdi-action-visibility');
define('INFO_ICON_CLASS', 		'mdi-action-info');
define('PLUS_ICON_CLASS', 		'fa fa-plus');


define('ISCLOSED_ACTIVE_ICON_CLASS', 		'mdi-maps-layers');
define('ISCLOSED_INACTIVE_ICON_CLASS', 		'mdi-maps-layers-clear');


define('DEFAULT_IMAGE', 		'assets/admin/img/noimage.gif');
define('DATE_TIME_FORMAT', 		'd-m-Y H:i:s');
define('DATE_FORMAT', 			'd-m-Y');
define('DEFAULT_DATE_TIME', 	'1000-01-01 00:00:00');
define('DEFAULT_DATE', 			'1000-01-01');
define('DATABASE_DATE_TIME_FORMAT', 'Y-m-d H:i:s');
define('DATABASE_DATE_FORMAT', 	'Y-m-d');


/* For Project Gallery*/
define('PROJECT_Gallery_MAX_HEIGHT',		-1);
define('PROJECT_Gallery_MAX_WIDTH',			-1);
define('PROJECT_Gallery_MAX_SIZE',			102400);
define('PROJECT_Gallery_ALLOWED_TYPES',		'gif|jpg|png|jpeg|mp4');
define('PROJECT_Gallery_UPLOAD_PATH',		'./assets/uploads/projectgallery/');

define('PROJECT_Gallery_THUMB_MAX_WIDTH',	250);
define('PROJECT_Gallery_THUMB_MAX_HEIGHT',	250);
define('PROJECT_Gallery_THUMB_UPLOAD_PATH',	'./assets/uploads/projectgallery/thumbnail/');
/* For Customer Document Image*/
define('PROJECT_DOCUMENT_MAX_HEIGHT',		-1);
define('PROJECT_DOCUMENT_MAX_WIDTH',		-1);
define('PROJECT_DOCUMENT_MAX_SIZE',			102400000000);
define('PROJECT_DOCUMENT_ALLOWED_TYPES',	'gif|jpg|png|jpeg|pdf|doc|docx');
define('PROJECT_DOCUMENT_UPLOAD_PATH',		'./assets/uploads/document/');

define('PROJECT_DOCUMENT_THUMB_MAX_WIDTH',	250);
define('PROJECT_DOCUMENT_THUMB_MAX_HEIGHT',	250);
define('PROJECT_DOCUMENT_THUMB_UPLOAD_PATH',	'./assets/uploads/document/thumbnail/');

define('EMAIL_DOCUMENT_MAX_WIDTH',			-1);
define('EMAIL_DOCUMENT_MAX_HEIGHT',			-1);
define('EMAIL_DOCUMENT_MAX_SIZE',			102400);
define('EMAIL_DOCUMENT_ALLOWED_TYPES',		'gif|jpg|png|jpeg|pdf|doc|docx');
define('EMAIL_DOCUMENT_UPLOAD_PATH',		'./assets/uploads/mail/');

define('DEFAULT_ADMIN_EMAIL',				'shripa.saggisoftsolutions@gmail.com');//'hairartist@virtualtryon.biz');
define('DEFAULT_ADMIN_EMAIL_PASSWORD',		'Shripa@321');
define('DEFAULT_FROM_NAME',					'info');
define('DEFAULT_EMAIL_IMAGE',				'assets/front/images/email/');
define('DEFAULT_WEBSITE_TITLE',				'Parikh CRM');

define('ROLEACTIONS', serialize(array('is_insert','is_view','is_edit','is_status','is_export','is_sms','is_mail','is_call','is_push','is_response','is_convert','is_price','is_ats','is_sd','is_verify','is_cancel')));


define('INWARD_MAX_HEIGHT',		-1);
define('INWARD_MAX_WIDTH',			-1);
define('INWARD_MAX_SIZE',			102400);
define('INWARD_ALLOWED_TYPES',		'gif|jpg|png|jpeg');
define('INWARD_UPLOAD_PATH',		'./assets/uploads/inward/');

define('INWARD_THUMB_MAX_WIDTH',	250);
define('INWARD_THUMB_MAX_HEIGHT',	250);
define('INWARD_THUMB_UPLOAD_PATH',	'./assets/uploads/inward/thumbnail/');

define('INVOICE_MAX_HEIGHT',		-1);
define('INVOICE_MAX_WIDTH',			-1);
define('INVOICE_MAX_SIZE',			102400);
define('INVOICE_ALLOWED_TYPES',		'gif|jpg|png|jpeg');
define('INVOICE_UPLOAD_PATH',		'./assets/uploads/invoice/');

define('INVOICE_THUMB_MAX_WIDTH',	250);
define('INVOICE_THUMB_MAX_HEIGHT',	250);
define('INVOICE_THUMB_UPLOAD_PATH',	'./assets/uploads/invoice/thumbnail/');

/* For Customer Video Image*/
define('PROJECT_VIDEO_MAX_HEIGHT',		-1);
define('PROJECT_VIDEO_MAX_WIDTH',		-1);
define('PROJECT_VIDEO_MAX_SIZE',			102400000000);
define('PROJECT_VIDEO_ALLOWED_TYPES',	'mp4|MP4');
define('PROJECT_VIDEO_UPLOAD_PATH',		'./assets/uploads/video/');

