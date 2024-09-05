<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="">Report <span id="reportlabel"></span></a></h5>
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
          <!-- <div class="col s12 m12 l12">
            <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url(); ?>"></a></h5>
          </div>   -->
          <div class="row">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <?php
                    if (@$Role->TotalVisitor == 1) {
                    ?>
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "Visitor") ? 'active' : ''; ?>" href="#Visitor" title="Visitor">Visitor</a></li>
                    <?php
                    }
                    if (@$Role->TotalVisitorReminder == 1) {
                    ?>
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "Followup") ? 'active' : ''; ?>" href="#Followup" title="Followup">Visitors Follow Up</a></li>
                    <?php
                    }
                    if (@$Role->TotalBooking == 1) {
                    ?>
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "Booking") ? 'active' : ''; ?>" href="#Booking" title="Booking">Total Customer</a></li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <?php
              if (@$Role->TotalVisitor == 1) {
              ?>
                <!-- Visitor Start -->
                <div id="Visitor" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="input-field col m9 s12 center">
                              <div class="col s10 m8">
                                <input type="radio" class="DashFilter" name="VisitorFilterType" id="VisitorDaily" value="Daily" <?php echo (@$Visitor == "Daily" || !isset($Visitor)) ? ' checked="checked" ' : ''; ?>>
                                <label for="VisitorDaily">Daily </label>
                                <input type="radio" class="DashFilter" name="VisitorFilterType" id="VisitorWeekly" value="Weekly" <?php echo (@$Visitor == "Weekly") ? ' checked="checked "' : ''; ?>>
                                <label for="VisitorWeekly">Weekly</label>
                                <input type="radio" class="DashFilter" name="VisitorFilterType" id="VisitorMonthly" value="Monthly" <?php echo (@$Visitor == "Monthly") ? ' checked="checked "' : ''; ?>>
                                <label for="VisitorMonthly">Monthly</label>
                                <input type="radio" class="DashFilter" name="VisitorFilterType" id="VisitorYearly" value="Yearly" <?php echo (@$Visitor == "Yearly") ? ' checked="checked "' : ''; ?>>
                                <label for="VisitorYearly">Yearly</label>
                                <input type="radio" class="DashFilter" name="VisitorFilterType" id="VisitorOther" value="Other" <?php echo (@$Visitor == "Other") ? ' checked="checked "' : ''; ?>>
                                <label for="VisitorOther">Other</label>
                              </div>
                            </div>
                            <div class="input-field col m1 s12 right">
                              <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                            </div>
                          </div>
                          <div class="row CustomDateFilter hide">
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomStartDate" id="CustomStartDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomStartDate">Start Date</label>
                            </div>
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomEndDate" id="CustomEndDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomEndDate">End Date</label>
                            </div>
                            <div class="input-field col s2 m2 m-t-20">
                              <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_200"><?php echo label('msg_lbl_type'); ?></th>
                              <th class="width_180"><?php echo label('msg_lbl_name'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_employee'); ?></th>
                              <th class="width_200"><?php echo label('msg_lbl_emailid'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_mobileno'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_leadtype'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_inquiry'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_visitorstatus'); ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_requirement'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_title_visitorsites'); ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_feedback'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                  <?php echo @$feedback_modal_popup; ?>
                </div>
                <!-- Visitor End -->
              <?php
              }
              if (@$Role->TotalVisitorReminder == 1) {
              ?>
                <!-- Followup Start -->
                <div id="Followup" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="input-field col m9 s12 center">
                              <div class="col s10 m8">
                                <input type="radio" class="DashFilter" name="FollowupFilterType" id="FollowupDaily" value="Daily" checked="checked" <?php echo (@$Followup == "Daily" || !isset($Followup)) ? ' checked="checked" ' : ''; ?>>
                                <label for="FollowupDaily">Daily</label>
                                <input type="radio" class="DashFilter" name="FollowupFilterType" id="FollowupWeekly" value="Weekly" <?php echo (@$Followup == "Weekly") ? ' checked="checked "' : ''; ?>>
                                <label for="FollowupWeekly">Weekly</label>
                                <input type="radio" class="DashFilter" name="FollowupFilterType" id="FollowupMonthly" value="Monthly" <?php echo (@$Followup == "Monthly") ? ' checked="checked "' : ''; ?>>
                                <label for="FollowupMonthly">Monthly</label>
                                <input type="radio" class="DashFilter" name="FollowupFilterType" id="FollowupYearly" value="Yearly" <?php echo (@$Followup == "Yearly") ? ' checked="checked "' : ''; ?>>
                                <label for="FollowupYearly">Yearly</label>
                                <input type="radio" class="DashFilter" name="FollowupFilterType" id="FollowupOther" value="Other" <?php echo (@$Followup == "Other") ? ' checked="checked "' : ''; ?>>
                                <label for="FollowupOther">Other</label>
                              </div>
                            </div>
                            <div class="input-field col m1 s12 right">
                              <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                            </div>
                          </div>
                          <div class="row CustomDateFilter hide">
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomStartDate" id="CustomStartDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomStartDate">Start Date</label>
                            </div>
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomEndDate" id="CustomEndDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomEndDate">End Date</label>
                            </div>
                            <div class="input-field col s2 m2 m-t-20">
                              <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_130"><?php echo label('msg_lbl_employeename') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_name') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_mobileno') ?></th>
                              <th class="width_300"><?php echo label('msg_lbl_message') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_reminderdatetime') ?></th>
                              <th class="width_130"><?php echo label('msg_lbl_pastdatetime') ?></th>
                              <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_feedback'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                    <?php echo @$feedback_modal_popup; ?>
                  </div>
                </div>
                <!-- Followup End -->

              <?php
              }
              if (@$Role->TotalBooking == 1) {
              ?>
                <!-- Booking Start -->
                <div id="Booking" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="input-field col m9 s12 center">
                              <div class="col s10 m8">
                                <input type="radio" class="DashFilter" name="BookingFilterType" id="BookingDaily" value="Daily" checked="checked" <?php echo (@$Booking == "Daily" || !isset($Booking)) ? ' checked="checked" ' : ''; ?>>
                                <label for="BookingDaily">Daily</label>
                                <input type="radio" class="DashFilter" name="BookingFilterType" id="BookingWeekly" value="Weekly" <?php echo (@$Booking == "Weekly") ? ' checked="checked "' : ''; ?>>
                                <label for="BookingWeekly">Weekly</label>
                                <input type="radio" class="DashFilter" name="BookingFilterType" id="BookingMonthly" value="Monthly" <?php echo (@$Booking == "Monthly") ? ' checked="checked "' : ''; ?>>
                                <label for="BookingMonthly">Monthly</label>
                                <input type="radio" class="DashFilter" name="BookingFilterType" id="BookingYearly" value="Yearly" <?php echo (@$Booking == "Yearly") ? ' checked="checked "' : ''; ?>>
                                <label for="BookingYearly">Yearly</label>
                                <input type="radio" class="DashFilter" name="BookingFilterType" id="BookingOther" value="Other" <?php echo (@$Booking == "Other") ? ' checked="checked "' : ''; ?>>
                                <label for="BookingOther">Other</label>
                              </div>
                            </div>
                            <div class="input-field col m1 s12 right">
                              <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                            </div>
                          </div>
                          <div class="row CustomDateFilter hide">
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomStartDate" id="CustomStartDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomStartDate">Start Date</label>
                            </div>
                            <div class="input-field col s5 m5 ">
                              <input type="text" name="CustomEndDate" id="CustomEndDate" value="" class="datepicker empty_validation_class">
                              <label for="CustomEndDate">End Date</label>
                            </div>
                            <div class="input-field col s2 m2 m-t-20">
                              <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_180"><?php echo label('msg_lbl_name') ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_emailid') ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_mobileno') ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_address') ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- Booking End -->
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<form id="dashboardfrm" action="<?php echo site_url('admin/report/report/export_to_excel'); ?>" method="post">
  <input type="hidden" name="ReportType" id="ReportType" value="">
  <input type="hidden" name="FilterType" id="FilterType" value="">
  <input type="hidden" name="CustomStartDate" id="CustomStartDate" value="">
  <input type="hidden" name="CustomEndDate" id="CustomEndDate" value="">
</form>
<!-- Modal Structure -->
<div class="admin-table-view-pop-up">
    <div id="FeedbackModal1" class="modal">
        <div class="modal-footer gridhead1 bgglobal">
            <h4 id="feedbackmodel1_title"></h4>
            <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
        </div>
        <div class="modal-content">
            <table>
                <tr>
                    <th>Feedback Date</th>
                    <th>Project</th>
                    <th>Feedback</th>
                    <th>Remarks</th>
                </tr>
                <tbody id="feedback_body1">
                </tbody>
            </table>
        </div>
    </div>
</div>