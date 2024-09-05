<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/customer"); ?>">Customer</a></h5>
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
          <div class="col s12 m12 l12 clearfix">
            <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/customer/details/" . $Customer->CustomerID); ?>"><?php echo $Customer->FirstName . " " . $Customer->LastName; ?></a></h5>
            <div class="right">
              <?php
              // if(@$this->cur_module->is_sms == 1){
              ?>
              <!-- <a href="javascript:void(0)" data-id="<?php //echo $Customer->CustomerID;
                                                          ?>" data-type="Mail" data-user="Customer" class="reminderbtn btn-floating waves-effect waves-light orange accent-4">
                <i class="mdi-communication-email tooltipped" data-position="top" data-delay="50" data-tooltip="Send Mail"></i>
              </a> -->
              <?php
              // }if(@$this->cur_module->is_mail == 1){
              ?>
              <!-- <a href="javascript:void(0)" data-id="<?php //echo $Customer->CustomerID;
                                                          ?>" data-type="SMS" data-user="Customer" class="reminderbtn btn-floating waves-effect waves-light indigo">
                <i class="mdi-communication-textsms tooltipped" data-position="top" data-delay="50" data-tooltip="Send SMS"></i>
              </a> -->
              <?php //} 
              ?>
            </div>
          </div>
          <div class="row m-t-20">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box scrollbar z-depth-1">
                    <li class="tab"><a class="tabclick active" href="#basic" title="Basic ">Customer Details</a></li>
                    <li class="tab"><a class="tabclick" href="#property" title="Property">Property</a></li>
                    <li class="tab"><a class="tabclick active" href="#process" title="Process">Process</a></li>
                  </ul>
                </div>
              </div>
              <!-- Customer Basic Details Start -->
              <div id="basic" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">

                      <div class="input-field col s12 m6">
                        <input id="FirstName" value="<?php echo @$Customer->FirstName; ?>" type="text" readonly />
                        <label for="FirstName" class="active"><?php echo label('msg_lbl_firstname'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="LastName" value="<?php echo @$Customer->LastName; ?>" type="text" readonly />
                        <label for="LastName" class="active"><?php echo label('msg_lbl_lastname'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="EmailID" value="<?php echo @$Customer->EmailID; ?>" type="text" readonly />
                        <label for="EmailID" class="active"><?php echo label('msg_lbl_emailid'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Address" value="<?php echo @$Customer->Address; ?>" type="text" readonly />
                        <label for="Address" class="active"><?php echo label('msg_lbl_address'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="MobileNo" value="<?php echo @$Customer->MobileNo; ?>" type="text" readonly />
                        <label for="MobileNo" class="active"><?php echo label('msg_lbl_mobileno'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="MobileNo1" value="<?php echo @$Customer->MobileNo1; ?>" type="text" readonly />
                        <label for="MobileNo1" class="active"><?php echo label('msg_lbl_mobileno1'); ?></label>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- Customer Basic Details End -->
              <!-- Customer Property Start -->
              <div id="property" class="col s12">
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

                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <?php
                            if (@$this->property_module->is_insert == 1 /*|| ($this->ProjectID != -1 && @$this->property_module->is_insert == 1)*/) {
                            ?>
                              <a href="<?php echo site_url("admin/user/property/add/" . $CustomerID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                                <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                              </a>
                            <?php } ?>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_200"><?php echo label('msg_lbl_project') ?></th>
                            <th class="width_100"><?php echo label('msg_lbl_serialno') ?></th>
                            <th class="width_180"><?php echo label('msg_lbl_name') ?></th>
                            <th class="width_150"><?php echo label('msg_lbl_purchasedate') ?></th>
                            <!-- <th class="width_200"><?php echo label('msg_lbl_chanel_partners') ?></th> -->
                            <th class="width_200 actions center"><?php echo label('msg_lbl_ishold') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_status') ?></th>
                            <th class="width_200 center"><?php echo label('msg_lbl_action') ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Customer Property End -->
              <div id="process" class="col s12">
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
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_200"><?php echo label('msg_lbl_employeename') ?></th>
                            <th class="width_200"><?php echo label('msg_lbl_processdate') ?></th>
                            <th class="width_500"><?php echo label('msg_lbl_description') ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $view_modal_popup; ?>
<!-- Add Reminder Modal Structure Start -->
<div class="admin-table-view-pop-up">
  <div id="reminderpopup" class="modal reminderpopup">
    <div class="modal-footer gridhead1 bgglobal">
      <h4 id="reminder_title"></h4>
      <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
    </div>
    <div class="modal-content">
      <form id="reminderform" enctype="multipart/form-data">
        <input type="hidden" id="method" name="method" value="addReminderAction">
        <input type="hidden" id="ID" name="ID">
        <input type="hidden" id="ActionType" name="ActionType">
        <input type="hidden" id="UserID" name="UserID" value="<?php echo @$this->session->userdata['UserID']; ?>">
        <input type="hidden" id="ActionUser" name="ActionUser">
        <input type="hidden" id="UserType" name="UserType" value="Admin Web">
        <div id="Subjectdiv" class="input-field col s6">
          <input type="text" name="Subject" id="Subject" maxlength="50" value="">
          <label for="Subject"><?php echo label('msg_lbl_subject'); ?></label>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea name="Message" id="Message" class="materialize-textarea" maxlength="200"></textarea>
            <label for="Message"><?php echo label('msg_lbl_message'); ?></label>
          </div>
        </div>
        <div class="m-t-20" id="attenchmentdiv">
          <label class="imageview-label">Upload Doc,Image or Pdf File</label>
          <div class="row">
            <div class="file-field input-fieldcol col s12 m10 m-t-10">
              <input tabindex="999" class="file-path empty_validation_class" id="editImageURL" name="editImageURL" value="" readonly="" type="text">
              <div class="btn">
                <span>File</span>
                <input type="file" name="ImageData" id="ImageData" class="file document" />
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix input-field col s6">
          <button class="btn waves-effect waves-light right" type="button" id="reminder_submit" name="reminder_submit">Submit</button>
          <?php echo $loading_button; ?>
          <span class="modal-close right close-button">Cancel</span>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Reminder Modal Structure End -->
<!-- Cancel Property Modal Structure Start -->
<div class="admin-table-view-pop-up">
  <div id="CancelPropertyModal" class="modal CancelPropertyModal">
    <div class="modal-footer gridhead1 bgglobal">
      <h4>Cancel Property</h4>
      <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
    </div>
    <div class="modal-content">
      <form id="FrmCancelProperty" enctype="multipart/form-data">
        <input type="hidden" name="CustomerPropertyID" id="CustomerPropertyID">
        <input type="hidden" name="TotalPayedAmount" id="TotalPayedAmount">
        <input type="hidden" name="TotalPayedGSTAmount" id="TotalPayedGSTAmount">
        <div class="row">
          <div class="input-field col s6">
            Total Basic Amount : <i class="fa fa-inr"></i> <span id="TotalAmount"></span>
          </div>
          <div class="input-field col s6">
            Total Paid Basic Amount : <i class="fa fa-inr"></i> <span id="PayedAmount"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            Total GST Amount : <i class="fa fa-inr"></i> <span id="TotalGST"></span>
          </div>
          <div class="input-field col s6">
            Total Paid GST Payment : <i class="fa fa-inr"></i> <span id="PayedGST"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="text" class="LetterOnly empty_validation_class" name="Reason" id="Reason" maxlength="250">
            <label for="Reason">Reason</label>
          </div>
          <div class="input-field col s6">
            <input type="text" class="NumberOnly AmountOnly empty_validation_class" name="RefundAmount" id="RefundAmount">
            <label class="active" for="RefundAmount">Refund Amount</label>
          </div>
          <div class="input-field col s6">
            <input type="text" class="NumberOnly AmountOnly empty_validation_class" name="RefundGSTAmount" id="RefundGSTAmount">
            <label class="active" for="RefundGSTAmount">Refund GST Amount</label>
          </div>
          <div class="input-field col s6">
            <input type="checkbox" class="" name="IsCancelFee" id="IsCancelFee">
            <label for="IsCancelFee">Is Cancel Fee?</label>
          </div>
          <div id="cancelfeediv" class="input-field col s6 hide">
            <input type="text" class="NumberOnly AmountOnly" name="CancelFeeAmount" id="CancelFeeAmount">
            <label for="CancelFeeAmount">Cancel Fees Amount</label>
          </div>
        </div>
        <div class="clearfix input-field col s6">
          <button class="btn waves-effect waves-light right" type="button" id="cancel_submit" name="cancel_submit">Submit</button>
          <?php echo $loading_button; ?>
          <span class="modal-close right close-button">Cancel</span>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Cancel Property Modal Structure Start -->