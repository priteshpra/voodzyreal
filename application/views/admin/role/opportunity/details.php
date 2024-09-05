<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/opportunity"); ?>"><?php echo label('msg_lbl_opportunity')?></a></h5>
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
              <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/opportunity/details/".$data->OpportunityID); ?>"><?php echo $data->Name; ?></a></h5>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <?php 
                    if(@$this->reminder_module->is_view == 1){
                    ?>
                    <li class="tab"><a class="tabclick active" href="#reminder" title="Opportunity Reminder">Opportunity Reminder</a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <?php 
              if(@$this->reminder_module->is_view == 1){
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
                                if(@$this->reminder_module->is_insert == 1){
                                ?>
                                  <a href="<?php echo site_url("admin/opportunity/addreminder/".$OpportunityID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                <?php } ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_300"><?php echo label('msg_lbl_message')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_reminderdatetime')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_pastdatetime')?></th>
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                              <th class="width_130 center"><?php echo label('msg_lbl_action');?></th>
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