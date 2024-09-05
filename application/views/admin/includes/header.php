    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="<?php echo label('msg_lbl_site_title_name'); ?>">
        <meta name="keywords" content="<?php echo label('msg_lbl_site_title_name'); ?>">
        <title><?php echo label('msg_lbl_site_title_name'); ?></title>

        <!-- Favicons-->
        <link rel="icon" href="<?php echo $this->config->item('admin_assets'); ?>img/login-logo.jpg" sizes="32x32">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <!-- Favicons-->
        <!-- CORE CSS-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.clockpicker.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- Custome CSS-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- CSS for full screen (Layout-2)-->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- alertify CSS -->
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.css" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/select2.css" rel="stylesheet" />
        <!-- jQuery Library -->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>
        <style type="text/css">
            .notification-badge {
                position: relative;
                right: -23px;
                top: -81px;
                color: black;
                background-color: #f5f1f2;
                margin: 0 -.8em;
                border-radius: 50%;
                padding: 5px 10px;
            }
        </style>
    </head>

    <body>
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->

        <!-- START HEADER -->
        <header id="header" class="page-topbar">
            <!-- start header nav-->
            <div class="navbar-fixed">
                <nav class="cyan">
                    <div class="nav-wrapper">

                        <ul class="left">
                            <li class="no-hover"><a href="#" tabindex="997" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu"></i></a></li>
                            <li>
                                <h1 class="logo-wrapper"><a tabindex="998" href="<?php echo site_url('admin-dashboard'); ?>" class="brand-logo darken-1">
                                        <img class="img-responsive" src="<?php echo $this->config->item('admin_assets'); ?>img/logo_01.jpg">
                                        <!-- <span class="logo-text"><?php echo label('msg_lbl_site_title_name'); ?></span></a> -->
                                </h1>
                            </li>
                        </ul>

                        <ul class="right hide-on-med-and-down">
                            <li><a tabindex='999' href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i title="Fullscreen" class="mdi-action-settings-overscan"></i></a>
                            </li>
                            <li style="padding-right:8px"><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse notifyalert"><i class="mdi-social-notifications" style="color: red;"></i><small class="notification-badge" style="color: red;"><?php echo getNotifactionCount(); ?></small></a>
                            </li>
                        </ul>
                        <ul class="header-project-nav right hide-on-med-and-down hide">
                            <?php echo $this->ProjectCombobox; ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- end header nav-->
        </header>
        <!-- END HEADER -->

        <!-- START MAIN -->
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

                <!-- START LEFT SIDEBAR NAV-->
                <aside id="left-sidebar-nav">
                    <ul id="slide-out" class="side-nav leftside-navigation">
                        <li class="user-details cyan darken-2">
                            <div class="row">
                                <div class="col col s4 m4 l4">
                                    <h3 class="user-h3"><?php echo substr($this->session->userdata['FirstName'], 0, 1); ?></h3>
                                </div>
                                <div class="col col s8 m8 l8 p-0">
                                    <ul id="profile-dropdown" class="dropdown-content">
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>my-profile"><i class="mdi-action-face-unlock"></i>My Profile</a>
                                        </li>
                                        <?php
                                        if ($this->UserRoleID == -2 || $this->UserRoleID == -1) { ?>
                                            <li><a href="<?php echo $this->config->item('base_url'); ?>admin/role"><i class="mdi-action-input"></i>Roles</a>
                                            </li>
                                        <?php } ?>
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>change-password"><i class="mdi-communication-vpn-key"></i>Change Password</a>
                                        </li>
                                        <?php
                                        if ($this->UserRoleID == -2 || $this->UserRoleID == -1) { ?>
                                            <li><a href="<?php echo site_url('/notificationsetting'); ?>"><i class="mdi-social-notifications"></i>Notification</a>
                                            <?php } ?>
                                            </li>
                                            <li><a href="<?php echo $this->config->item('base_url'); ?>logout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                            </li>
                                    </ul>

                                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">
                                        <p class="wrap_content_header"><?php echo $this->session->userdata['FirstName']; ?></p><i class="mdi-navigation-arrow-drop-down right"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php if (in_array("1", $this->module_data)) { ?>
                            <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin-dashboard" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Dashboard</a>
                            </li>
                        <?php }
                        ?>
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <?php if (in_array("2", $this->module_data)) { ?>
                                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-list"></i>Masters</a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/features">
                                                        Features
                                                    </a>
                                                </li>
                                                <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/furnish">
                                                        Furnish
                                                    </a>
                                                </li>
                                                <?php
                                                if (in_array("66", $this->module_data)) { ?>
                                                    <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/area">
                                                            Areas
                                                        </a></li>
                                                <?php } ?>
                                                <?php
                                                if (in_array("49", $this->module_data)) { ?>
                                                    <li style="display:none;"><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/category">
                                                            Category
                                                        </a></li>
                                                <?php
                                                }
                                                if (in_array("66", $this->module_data)) { ?>
                                                    <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/campaign">
                                                            Campaign
                                                        </a></li>
                                                <?php }
                                                if (in_array("67", $this->module_data)) { ?>
                                                    <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/contact">
                                                            Contacts
                                                        </a></li>
                                                <?php }
                                                if (in_array("4", $this->module_data)) { ?>
                                                    <li style="display:none;"><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/cms">
                                                            Content Management System
                                                        </a></li>
                                                <?php }
                                                if (in_array("46", $this->module_data)) { ?>
                                                    <li style="display:none;"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/ChanelPartner">
                                                            Chanel Partner
                                                        </a></li>
                                                <?php }
                                                if (in_array("6", $this->module_data)) { ?>
                                                    <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/designation">
                                                            Designation
                                                        </a></li>
                                                <?php }
                                                if (in_array("7", $this->module_data)) { ?>
                                                    <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/emailtemplate">
                                                            Email Template
                                                        </a></li>
                                                <?php }
                                                if (in_array("51", $this->module_data)) { ?>
                                                    <li> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/feedback">Feedback</a></li>
                                                <?php }
                                                if (in_array("56", $this->module_data)) { ?>
                                                    <li style="display:none;"> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/goods">Goods</a></li>
                                                <?php }
                                                if (in_array("8", $this->module_data)) { ?>
                                                    <li style="display:none;"> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/group">Group</a></li>

                                                <?php }
                                                if (in_array("9", $this->module_data)) { ?>
                                                    <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/message">
                                                            Message
                                                        </a></li>
                                                <?php }
                                                if (in_array("10", $this->module_data)) { ?>
                                                    <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/motivationalquotes">
                                                            Motivational Quotes
                                                        </a></li>
                                                <?php }
                                                if (in_array("13", $this->module_data)) { ?>
                                                    <li class=""> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster">Page Master</a></li>
                                                <?php }
                                                if (in_array("50", $this->module_data)) { ?>
                                                    <li class="" style="display:none;"> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/uom">UOM</a></li>
                                                <?php } ?>
                                                <?php
                                                if (in_array("50", $this->module_data)) { ?>
                                                    <li class=""> <a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/masters/requirements">Requirement</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php }
                                // if(in_array("15",$this->module_data)){
                                ?>
                                <li><a class="wrap_content_header" href="<?php echo $this->config->item('base_url'); ?>admin/sales/property">
                                        <i class="mdi-action-list"></i>Sales Inventory
                                    </a>
                                </li>
                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin/project/project" class="waves-effect waves-cyan"><i class="mdi-communication-business"></i> Project</a>
                                </li>
                                <?php if (1) { ?>
                                    <li class="bold"><a href="<?php echo site_url('admin/opportunity'); ?>" class="waves-effect waves-cyan"><i class="mdi-social-people"></i>Leads</a>
                                    </li>
                                <?php } ?>
                                <li class="no-padding">
                                    <ul class="collapsible collapsible-accordion">
                                        <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-social-person"></i>User</a>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <?php
                                                    // if(in_array("16",$this->module_data)){
                                                    if ($this->UserRoleID == -2 || $this->UserRoleID == -1) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/user/employeedetails">
                                                                Employees
                                                            </a></li>

                                                    <?php }
                                                    ?>
                                                    <li><a href="<?php echo $this->config->item('base_url'); ?>admin/user/customer">
                                                            Customers
                                                        </a></li>

                                                    <?php
                                                    if (in_array("23", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/user/visitor">
                                                                Visitors
                                                            </a></li>

                                                    <?php }
                                                    ?>
                                                    <?php
                                                    if (in_array("52", $this->module_data)) { ?>
                                                        <li style="display:none;"><a href="<?php echo $this->config->item('base_url'); ?>admin/user/vendor">
                                                                Vendor
                                                            </a></li>

                                                    <?php }
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <?php //}
                                if (in_array("25", $this->module_data)) { ?>
                                    <li class="no-padding">
                                        <ul class="collapsible collapsible-accordion">
                                            <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-action-settings-applications"></i>Configuration</a>
                                                <div class="collapsible-body">
                                                    <ul>
                                                        <?php if (in_array("26", $this->module_data)) { ?>
                                                            <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/activitylog">Admin Activity Log</a></li>
                                                        <?php }
                                                        if (in_array("27", $this->module_data)) { ?>
                                                            <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/config">Configuration</a></li>
                                                        <?php }
                                                        if (in_array("28", $this->module_data)) { ?>
                                                            <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/errorlog">Error Log</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>

                                <?php if (in_array("34", $this->module_data)) { ?>
                                    <li class="bold" style="display: none;"><a href="<?php echo $this->config->item('base_url'); ?>admin/bulkmessage" class="waves-effect waves-cyan"><i class="mdi-communication-business"></i> Bulk Message</a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array("53", $this->module_data)) { ?>
                                    <li class="bold" style="display:none;"><a href="<?php echo $this->config->item('base_url'); ?>admin/inward" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Inward</a>
                                    </li>
                                <?php } ?>

                                <?php if (in_array("57", $this->module_data)) { ?>
                                    <li class="bold" style="display: none;"><a href="<?php echo site_url('admin/report/dSRReport'); ?>" class="waves-effect waves-cyan"><i class="mdi-notification-play-install"></i> Daily Sells Report</a>
                                    </li>
                                <?php } ?>
                                <li class="no-padding">
                                    <ul class="collapsible collapsible-accordion">
                                        <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-notification-event-note"></i>Reports</a>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/report'); ?>">Dashboard Report</a></li>
                                                    <?php if (in_array("55", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/FollowUpReport'); ?>">FollowUp Report</a></li>
                                                    <?php } ?>

                                                    <?php if (in_array("58", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/birthday'); ?>">Birthday</a></li>
                                                    <?php } ?>
                                                    <?php if (in_array("59", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/anniversary'); ?>">Anniversary</a></li>
                                                    <?php } ?>
                                                    <!-- <?php if (in_array("61", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/notification'); ?>">Notification</a></li>
                                                    <?php } ?> -->
                                                    <?php if (in_array("62", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/designation'); ?>">Visitor Designation</a></li>
                                                    <?php } ?>
                                                    <?php if (in_array("71", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/opportunity'); ?>">Lead</a></li>
                                                    <?php } ?>
                                                    <!-- <?php if (in_array("64", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/visitor'); ?>">Revisit</a></li>
                                                    <?php } ?> -->
                                                    <!-- <?php if (in_array("65", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/leadtype'); ?>">LeadType</a></li>
                                                    <?php } ?> -->
                                                    <!-- <?php if (in_array("65", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/leadtype'); ?>">Lead Working Status</a></li>
                                                    <?php } ?> -->
                                                    <!-- <?php if (in_array("65", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/leadtype'); ?>">Visitor Conversion</a></li>
                                                    <?php } ?>
                                                    <?php if (in_array("65", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/leadtype'); ?>">Visitor to Customer Conversion</a></li>
                                                    <?php } ?> -->
                                                    <!-- <?php if (in_array("65", $this->module_data)) { ?>
                                                        <li><a class="wrap_content_header" href="<?php echo site_url('admin/report/leadtype'); ?>">Leads</a></li>
                                                    <?php } ?> -->
                                                    <?php if (in_array("60", $this->module_data)) { ?>
                                                        <li><a href="<?php echo site_url('admin/report/opportunityFollowUpReport'); ?>" class="wrap_content_header">Lead Reminder</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </aside>
                <!-- END LEFT SIDEBAR NAV-->
                <aside id="right-sidebar-nav">
                    <ul id="chat-out" class="side-nav rightside-navigation right-aligned ps-container ps-active-y" style="width: 300px; right: 0px;">
                        <li class="li-hover">
                            <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>

                        </li>
                        <li class="li-hover">
                            <ul class="chat-collapsible" data-collapsible="expandable">
                                <li class="active">
                                    <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Notification</div>
                                    <div class="collapsible-body recent-activity" style="display: block;">
                                        <?php

                                        $notificationData = getNotifactions(-1, 1);
                                        if (!isset($notificationData['all_data']['0']->Message)) {
                                            foreach ($notificationData['all_data'] as $key => $value) {
                                                # code...
                                        ?>
                                                <div class="recent-activity-list chat-out-list row">
                                                    <div class="col  recent-activity-list-icon"><i class="mdi-communication-message"></i>
                                                    </div>
                                                    <div class="col s9 recent-activity-list-text" style="margin-top: 5px;">
                                                        <p><?php echo $value->Description; ?></p>
                                                        <span style="font-size: 12px;color: gray;"><?php echo date('d-m-Y h:i A', strtotime($value->CreatedDate)); ?> </span>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </li>

                            </ul>
                        </li>
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
                            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 361px; right: 3px;">
                            <div class="ps-scrollbar-y" style="top: 0px; height: 309px;"></div>
                        </div>
                    </ul>
                </aside>