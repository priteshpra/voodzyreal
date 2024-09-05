<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/opportunity"); ?>"><?php echo label('msg_lbl_opportunity') ?></a></h5>
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
              <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/opportunity/details/" . $data->OpportunityID); ?>"><?php echo $data->Name; ?></a></h5>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="tabclick active" href="#basic" title="Lead Details">Lead Details</a></li>
                    <?php
                    if (@$this->reminder_module->is_view == 1) {
                    ?>
                      <li class="tab"><a class="tabclick" href="#reminder" title="Opportunity Reminder">Opportunity Reminder</a></li>
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
                        <input id="Name" value="<?php echo @$data->Name; ?>" readonly type="text" />
                        <label for="Name" class="active"><?php echo label('msg_lbl_name'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Type" value="<?php echo @$data->Type; ?>" readonly type="text" />
                        <label for="Type" class="active"><?php echo label('msg_lbl_type'); ?></label>
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
                        <input id="project" value="<?php echo @$data->project; ?>" readonly type="text" />
                        <label for="project" class="active"><?php echo label('msg_lbl_project'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Area" value="<?php echo @$data->Area; ?>" readonly type="text" />
                        <label for="Area" class="active"><?php echo label('msg_lbl_area'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="Budget" value="<?php echo @$data->Budget; ?>" readonly type="text" />
                        <label for="Budget" class="active"><?php echo label('msg_lbl_budget'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="LeadType" value="<?php echo @$data->LeadType; ?>" readonly type="text" />
                        <label for="LeadType" class="active"><?php echo label('msg_lbl_leadtype'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="TypesofRequirement" value="<?php echo @$data->TypesofRequirement; ?>" readonly type="text" />
                        <label for="TypesofRequirement" class="active"><?php echo label('msg_lbl_typeofrequirements'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="RequirementValue" value="<?php echo @$data->RequirementValue; ?>" readonly type="text" />
                        <label for="RequirementValue" class="active"><?php echo label('msg_lbl_specification'); ?></label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input id="Requirement" value="<?php echo @$data->Requirement; ?>" readonly type="text" />
                        <label for="Requirement" class="active"><?php echo label('msg_lbl_requirement'); ?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="Purpose" value="<?php echo @$data->Purpose; ?>" readonly type="text" />
                        <label for="Purpose" class="active"><?php echo label('msg_lbl_purpose'); ?></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Basic Details End -->
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
                                <a href="<?php echo site_url("admin/opportunity/addreminder/" . $OpportunityID); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
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

              <!-- Processs End -->
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

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--end container-->
</section>
<!-- END CONTENT -->

<?php echo @$view_modal_popup; ?>