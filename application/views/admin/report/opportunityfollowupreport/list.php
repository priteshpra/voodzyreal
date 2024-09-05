<style>
  a.tabclick {
    overflow: hidden;
    padding: 0 7px;

  }
</style>
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
          <div class="row">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <?php 
                     
                      foreach ($data as $k => $data) { ?>
                        <li class="tab"><a class="tabclick  <?php if ($k==0) {
                          echo 'active';
                        }?>" href="#Visitor" title="<?php echo $data->FirstName.' '.$data->LastName; ?>" data-id="<?php echo $data->UserID; ?>"><?php echo $data->FirstName.' '.$data->LastName; ?></a></li>
                      <?php 
                      }
                    ?>
                  </ul>
                </div>
              </div>
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
                              <form id="submitform" name="submitform" class="submitform" method="post" action="<?php echo site_url("admin/report/opportunityFollowUpReport/export_to_excel");?>">
                                <div class="col s10 m6">
                                  <input type="text" name="FollowUpDate" id="FollowUpDate" value="<?php echo date("d-m-Y"); ?>" class="datepicker empty_validation_class">
                                  <label for="FollowUpDate">Date</label>
                                </div>
                                <input type="hidden" name="EmployeeID" id="EmployeeID" class="EmployeeID">
                              </form>
                          </div>
                          <div class="input-field col m1 s12 right">
                            <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_source');?></th>
                              <th><?php echo label('msg_lbl_name');?></th>
                              <th><?php echo label('msg_lbl_mobileno');?></th>
                              <th><?php echo label('msg_lbl_email');?></th>
                              <th><?php echo label('msg_lbl_message')?></th>
                              <th><?php echo label('msg_lbl_reminderdatetime')?></th>
                              <th><?php echo label('msg_lbl_pastdatetime')?></th>
                              <th><?php echo label('msg_lbl_lateststatus');?></th>
                              <th><?php echo label('msg_lbl_lastfollwupdate');?></th>
                              <th><?php echo label('msg_lbl_nextfollowupdate');?></th>
                              <th class="width_130 center"><?php echo label('msg_lbl_feedback');?></th>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>