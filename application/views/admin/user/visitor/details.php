<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/visitor"); ?>"><?php echo label('msg_lbl_title_visitor') ?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="candidate-details-box">
        <div class="card-panel">
          <div class="row">
            <div class="col s12 m12 l12">
              <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/visitor/details/" . $data->VisitorID); ?>"><?php echo $data->FirstName . " " . $data->LastName; ?></a></h5>
              <div class="right">
                <?php
                if (@$this->cur_module->is_mail == 1) {
                ?>
                  <a href="javascript:void(0);" data-id="<?php echo $data->VisitorID; ?>" data-type="Mail" data-user="Visitor" class="reminderbtn btn-floating waves-effect waves-light orange accent-4">
                    <i class="mdi-communication-email tooltipped" data-position="top" data-delay="50" data-tooltip="Send Mail"></i>
                  </a>
                <?php
                }
                if (@$this->cur_module->is_sms == 1) {
                ?>
                  <!-- <a href="javascript:void(0);" data-id="<?php echo $data->VisitorID; ?>" data-type="SMS" data-user="Visitor" class="reminderbtn btn-floating waves-effect waves-light indigo">
                  <i class="mdi-communication-textsms tooltipped" data-position="top" data-delay="50" data-tooltip="Send SMS"></i>
                </a> -->
                <?php
                }
                ?>
                <input type="hidden" name="visidle" id="visidle" value="<?php echo $data->IsIdle; ?>">
                <a href="javascript:void(0);" class="isidle btn-floating waves-effect waves-light black">
                  <i class="<?php echo ($data->IsIdle == 1) ? VISITOR_IDLE : VISITOR_NOT_IDLE; ?> tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo ($data->IsIdle == 1) ? label("msg_idle") : label("msg_not_idle"); ?>"></i>
                </a>
                <?php
                if (@$this->cur_module->is_convert == 1) {
                ?>
                  <a href="<?php if ($data->IsCustomer == 0) {
                              echo base_url() . 'admin/user/property/add/-1/' . $data->VisitorID;
                            } else {
                              echo base_url() . 'admin/user/property/add/' . $data->CustomerID . '/' . $data->VisitorID;
                            } ?>" class="<?php echo ($data->IsCustomer == 0) ? 'ConvertToCustomer' : ''; ?> modal-trigger btn-floating waves-effect waves-light green">
                    <i class="mdi-notification-sync tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo ($data->IsCustomer == 0) ? 'Convert To Customer' : 'Already Converted'; ?>"></i>
                  </a>
                <?php } ?>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col s12">
                <h5><?php echo @$data->Name; ?></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="tabclick active" href="#basic" title="Basic Details">Basic Details</a></li>
                    <!-- <li class="tab"><a class="tabclick" href="#visitleads" title="Visitor Leads">Visit Leads</a></li> -->
                    <li class="tab"><a class="tabclick" href="#sites" title="Visitor Sites">Sites</a></li>
                    <?php
                    if (@$this->reminder_module->is_view == 1) {
                    ?>
                      <li class="tab"><a class="tabclick" href="#reminder" title="Visitor Reminder">Visitor Reminder</a></li>
                    <?php } ?>
                    <li class="tab"><a class="tabclick" href="#Process" title="Process">Process</a></li>
                  </ul>
                </div>
              </div>
              <!-- Basic Details Start -->
              <div id="basic" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="FirstName" value="<?php echo @$data->FirstName; ?>" readonly type="text" />
                        <label for="FirstName" class="active"><?php echo label('msg_lbl_firstname'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="LastName" value="<?php echo @$data->LastName; ?>" readonly type="text" />
                        <label for="LastName" class="active"><?php echo label('msg_lbl_lastname'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="EmailID" value="<?php echo @$data->EmailID; ?>" readonly type="text" />
                        <label for="EmailID" class="active"><?php echo label('msg_lbl_emailid'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="MobileNo" value="<?php echo @$data->MobileNo; ?>" readonly type="text" />
                        <label for="MobileNo" class="active"><?php echo label('msg_lbl_mobileno'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="BirthDate" value="<?php echo @$data->BirthDate . '/' . @$data->BirthMonth; ?>" readonly type="text" />
                        <label for="BirthDate" class="active"><?php echo label('msg_lbl_birthdate'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="AnniversaryDate" value="<?php echo @$data->AnniversaryDate . '/' . @$data->AnniversaryMonth; ?>" readonly type="text" />
                        <label for="AnniversaryDate" class="active"><?php echo label('msg_lbl_anniversarydate'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="EmployeeName" value="<?php echo @$data->EmployeeName; ?>" readonly type="text" />
                        <label for="EmployeeName" class="active"><?php echo label('msg_lbl_employee'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <textarea id="Address" readonly class="materialize-textarea"><?= @$data->Address ?></textarea>
                        <label for="Address" class="active"><?php echo label('msg_lbl_address'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="project" value="<?php echo @$visitlead['0']->project; ?>" readonly type="text" />
                        <label for="project" class="active"><?php echo label('msg_lbl_project'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Budget" value="<?php echo @$visitlead['0']->Budget; ?>" readonly type="text" />
                        <label for="Budget" class="active"><?php echo label('msg_lbl_budget'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="Area" value="<?php echo @$visitlead['0']->Area; ?>" readonly type="text" />
                        <label for="Area" class="active"><?php echo label('msg_lbl_area'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Purpose" value="<?php echo @$visitlead['0']->Purpose; ?>" readonly type="text" />
                        <label for="Purpose" class="active"><?php echo label('msg_lbl_purpose'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="LeadType" value="<?php echo @$visitlead['0']->LeadType; ?>" readonly type="text" />
                        <label for="LeadType" class="active"><?php echo label('msg_lbl_leadtype'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="TypesofRequirement" value="<?php echo @$visitlead['0']->TypesofRequirement; ?>" readonly type="text" />
                        <label for="TypesofRequirement" class="active"><?php echo label('msg_lbl_typeofrequirements'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="Requirement" value="<?php echo @$visitlead['0']->Requirement; ?>" readonly type="text" />
                        <label for="Requirement" class="active"><?php echo label('msg_lbl_specification'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="RequirementValue" value="<?php echo @$visitlead['0']->RequirementValue; ?>" readonly type="text" />
                        <label for="RequirementValue" class="active"><?php echo label('msg_lbl_requirement'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="Type" value="<?php echo @$visitlead['0']->Type; ?>" readonly type="text" />
                        <label for="Type" class="active"><?php echo label('msg_lbl_type'); ?></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Basic Details End -->
              <!-- Visitor Leads Start -->
              <div id="visitleads" class="col s12 hide">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="PageSize" class="PageSize select_materialize" data-div="visitleads">
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
                            <th class="width_300"><?php echo label('msg_lbl_name') ?></th>
                            <th class="width_300"><?php echo label('msg_lbl_emailid') ?></th>
                            <th class="width_300"><?php echo label('msg_lbl_mobileno') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_budget') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_area') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_typeofrequirements') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_leadtype') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_requirement') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_specification') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_status'); ?></th>
                            <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
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
              <!-- Visitor Leads End -->
              <!-- Sites Start -->
              <div id="sites" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="PageSize" class="PageSize select_materialize" data-div="sites">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <?php
                            if (@$this->reminder_module->is_insert == 1) {
                            ?>
                              <a href="<?php echo site_url("admin/user/sites/add/" . $VisitorID); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_300"><?php echo label('msg_lbl_project') ?></th>
                            <th class="width_300"><?php echo label('msg_lbl_sitename') ?></th>
                            <th class="width_300"><?php echo label('msg_lbl_remarks') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_finance') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_purposebuying') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_timetocall') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_inquiry') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_entrydate') ?></th>
                            <th class="width_130"><?php echo label('msg_lbl_leadtype') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_status'); ?></th>
                            <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
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
              <!-- Sites End -->
              <?php
              if (@$this->reminder_module->is_view == 1) {
              ?>
                <!-- Reminder Start -->
                <div id="reminder" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="PageSize" class="PageSize select_materialize" data-div="reminder">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col s12 m10 right-align list-page-right-top-icon">
                              <?php
                              if (@$this->reminder_module->is_insert == 1) {
                              ?>
                                <a href="<?php echo site_url("admin/user/visitor/addreminder/" . $VisitorID); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_130"><?php echo label('msg_lbl_sitename') ?></th>
                              <th class="width_300"><?php echo label('msg_lbl_message') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_reminderdatetime') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_pastdatetime') ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_status'); ?></th>
                              <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
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
                <!-- Reminder End -->
              <?php
              }
              ?>
              <!-- Process Start -->
              <div id="Process" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="PageSize" class="PageSize select_materialize" data-div="Process">
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
                            <th class="width_300"><?php echo "Message"; ?></th>
                            <th class="width_130"><?php echo "Process Date"; ?></th>
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
              <!-- Processs End -->
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
<!-- Modal Structure -->
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
<!-- Add Response Modal Start -->
<div class="admin-table-view-pop-up">
  <div id="addresponsemodal" class="modal addresponsemodal">
    <div class="modal-footer gridhead1 bgglobal">
      <h4 id="response_title"></h4>
      <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
    </div>
    <div class="modal-content">
      <form id="reminderform">
        <input type="hidden" id="ReminderID" value="0">
        <div class="row">
          <div class="input-field col s12">
            <textarea name="Response" id="Response" class="materialize-textarea" maxlength="200"></textarea>
            <label for="Response"><?php echo label('msg_lbl_response'); ?></label>
          </div>
        </div>
        <div class="clearfix input-field col s6">
          <button class="btn waves-effect waves-light right" type="button" id="response_submit" name="response_submit">Submit</button>
          <?php echo $loading_button; ?>
          <span class="modal-close right close-button">Cancel</span>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Response Modal End -->