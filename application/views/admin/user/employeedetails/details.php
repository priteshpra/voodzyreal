<?php //pr($details);exit;?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/employeedetails"); ?>"><?php echo label('msg_lbl_title_employeedetails');?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
<!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right candidate-details-box" id="company-details-box">
        <div class="card-panel">  
          <div class="row">
            <div class="row">
              <div class="col s12">
                <h5><?php echo @$details->FirstName.' '.@$details->LastName ;?></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="active" href="#basicdetails" title="Basic Details">Basic Details</a></li>
                    <li class="tab"><a class="active deviceinfo" href="#deviceinfo" title="Device Info">Device Info</a></li>
                    <li class="tab"><a class="tabclick" href="#change_password" title="Change Password">Change Password</a></li>
                    <li class="tab"><a class="tabclick" href="#passcode" title="Notification Setting">Change Passcode</a></li>
                    <li class="tab"><a class="tabclick" href="#notification" title="Notification Setting">Notification Setting</a></li>
                  </ul>
                </div>
              </div>
              <!-- Basic Details Start -->
              <div id="basicdetails" class="col s12">
                <form class="col s12" id="editbasicForm" method="post">
                  <input type="hidden" name="cUserID" value="<?php echo $details->UserID;?>">
                  <ul class="collapsible collapsible-accordion m-t-0" data-collapsible="accordion">
                    <li class="active">
                      <div class="collapsible-header active"><i class="mdi-action-account-circle"></i>Basic Details</div>
                      <div class="collapsible-body" style="display: none;">
                        <div class="padding15 clearfix">
                          <div class="input-field col s6">
                            <input id="FirstName" name="FirstName" type="text" class="LetterOnly" value="<?php echo @$details->FirstName; ?>"  maxlength="50" readonly />
                            <label class="active" for="FirstName"><?php echo label('msg_lbl_first_name')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="LastName" name="LastName" type="text" class="LetterOnly" value="<?php echo @$details->LastName; ?>"  maxlength="50" readonly/>
                            <label class="active" for="LastName"><?php echo label('msg_lbl_last_name')?></label>
                          </div>
                          <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->EmailID?>" readonly>
                              <label class="active">Email Id</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <input id="MobileNo" name="MobileNo" type="text" class="MobileNo" value="<?php echo @$details->MobileNo; ?>"  maxlength="13" readonly />
                            <label class="active" for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                          </div>
                          
                          <div class="input-field col s12">
                            <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea" readonly ><?=@$details->Address?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address')?></label>
                          </div>
                         
                        </div>
                      </div>
                    </li>
                  </ul>
                </form>
              </div>
              <!-- Basic Details End -->

              <!-- Device Info Start -->
              <div id="deviceinfo" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                            <span><label>Data Display :</label></span> &nbsp;&nbsp;
                            <input name="data_displayup" type="radio" id="Allup" value="All" checked="checked" class="changeFilter" data-div="deviceinfo">
                            <label for="Allup">All</label>
                            <input name="data_displayup" type="radio" id="Filterup" value="Filter" class="changeFilter" data-div="deviceinfo">
                            <label for="Filterup">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="deviceinfo" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header m-b-0"><strong> Search</strong></h4>
                          <div class="row m-b-0">
                            <div class="row">
                              <div class="input-field col s12 m6">
                                  <input id="DeviceName" name="DeviceName" type="text" maxLength="100"   class="LetterOnly"/>
                                  <label for="DeviceName"><?php echo label('msg_lbl_devicename');?></label>
                              </div>
                              <div class="input-field col s12 m6">
                                  <input id="DeviceOS" name="DeviceOS" type="text" maxLength="40"   class="LetterOnly"/>
                                  <label for="DeviceOS"><?php echo label('msg_lbl_deviceos');?></label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="input-field col s12 m6">
                                  <input id="OSVersion" name="OSVersion" type="text" maxLength="40"   class="NumberLetter"/>
                                  <label for="OSVersion"><?php echo label('msg_lbl_osversion');?></label>
                              </div>
                            </div>
                          </div>
                          <div class="search_action_button" style="padding-bottom:15px;">
                            <button class="btn waves-effect waves-light right" type="button" id="deviceinfo_submit" name="deviceinfo_submit">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="deviceinfo">Clear</a> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                             <th class="width_180"><?php echo label('msg_lbl_devicename')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_deviceos')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_osversion')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_devicetokenid')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_devicetype')?></th>
                              <th class="actions center"><?php echo label('msg_lbl_onlyaction');?></th>
                          </tr>
                        </thead>
                          <tbody id="deviceinfo_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="deviceinfo_table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Device Info End -->


              <!-- Change Password Start -->
              <div id="change_password" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="table-responsive">
                      <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <div class="collapsible-header"><i class="mdi-action-https"></i>Change Password</div>
                        <div class="padding15 clearfix">
                          <div class="input-field col s12 m6">
                              <input type="password" class="empty_validation_class" name="new_password" id="new_password" maxlength="100">
                              <label class="active">New Password</label>
                          </div>
                          <div class="input-field col s12 m6">
                              <input type="password" class="empty_validation_class" name="confirm_password" id="confirm_password" maxlength="100">
                              <label class="active">Confirm Password</label>
                          </div>
                          <div class="input-field col s12 m-b-10 m-t-0">
                              <button class="btn waves-effect waves-light right" id="change_password_button" type="button">Submit
                              </button>
                             <br>
                             <br>

                          </div>
                        </div>
                      </div>
                      </ul>
                    </div>
                    <div id="pastbook_table_paging_div"></div>
                </div>
              </div>
              <!-- Change Password End -->

              <!-- Change Passcode Start -->
              <div id="passcode" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="table-responsive">
                      <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <div class="collapsible-header"><i class="mdi-action-https"></i>Change Passcode</div>
                        <div class="padding15 clearfix">
                          <div class="input-field col s12 m6">
                              <input type="password" class="empty_validation_class" name="new_passcode" id="new_passcode" maxlength="10">
                              <label class="active">New Passcode</label>
                          </div>
                          <div class="input-field col s12 m6">
                              <input type="password" class="empty_validation_class" name="confirm_passcode" id="confirm_passcode" maxlength="10">
                              <label class="active">Confirm Passcode</label>
                          </div>
                          <div class="input-field col s12 m-b-10 m-t-0">
                              <button class="btn waves-effect waves-light right" id="change_passcode_button" type="button">Submit
                              </button>
                             <br>
                             <br>
                          </div>
                        </div>
                      </div>
                      </ul>
                    </div>
                    <div id="pastbook_table_paging_div"></div>
                </div>
              </div>
              <!-- Change Passcode End -->

              <!-- Change Notification Start -->
              <div id="notification" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="table-responsive">
                      <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <div class="collapsible-header"><i class="mdi-action-https"></i>Notification Setting</div>
                        <!-- Start  -->
                        <form name="notform" id="notform">
                          <div class="row">
                            <div class="switch col s3 m3 ">
                              Is Push : 
                              <label>
                                Off
                                <input type="checkbox" name="IsPush" id="IsPush" <?php if($data->IsPush==1) echo " checked ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                            <div class="switch col s3 m3">
                              Visitor Reminder : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="VisitorReminder" id="VisitorReminder" <?php if($data->VisitorReminder==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                            <div class="switch col s3 m3">
                              Customer : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="Customer" id="Customer" <?php if($data->Customer==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                            <div class="switch col s3 m3">
                              Customer Reminder : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="CustomerReminder" id="CustomerReminder" <?php if($data->CustomerReminder==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="row">
                            <div class="switch col s3 m3">
                              Customer Property : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="CustomerProperty" id="CustomerProperty" <?php if($data->CustomerProperty==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                            <div class="switch col s3 m3">
                              Customer Payment : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="Payment" id="Payment" <?php if($data->Payment==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                            <div class="switch col s3 m3">
                              Customer Document : 
                              <label>
                                Off
                                <input class="chkcls" type="checkbox" name="Document" id="Document" <?php if($data->Document==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                                <span class="lever"></span> On
                              </label>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m12">
                                <button class="btn waves-effect waves-light right district" type="submit" id="submit_button_not" name="submit_buttonsubmit_button_not" ><?php echo label('msg_lbl_submit');?>
                                </button>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                        </form>
                        <!-- END  -->
                      </div>
                      </ul>
                    </div>
                    <div id="pastbook_table_paging_div"></div>
                </div>
              </div>
              <!-- Change Notification End -->              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="display:none;" class="cancel_popup modal-trigger" href="#modal-popup-box">Status</div> 
  <form id="cancelform">
        <div id="modal-popup-box" class="modal">
          <div class="modal-content">
            <h4 class="header">Cancel Booking Description</h4>
            <div class="input-field col s12">
                <textarea id="cancel_message" name="message" class="materialize-textarea"></textarea>
               <input type="hidden" id="c_orderstatus" name="c_orderstatus">
               <input type="hidden" id="c_order_id" name="c_order_id">
                <label for="message" class="">Message</label>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close cancel_msg_btn">Submit</a>
          </div>
        </div>  
    </form>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT -->

    <?php echo @$view_modal_popup; ?>