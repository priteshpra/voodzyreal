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
                   
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "Verified")?'active':'';?>" href="#Visitor" data-tab="Verified" title="Verified">Total Verified</a></li>
                   
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "ATS")?'active':'';?>" href="#Followup" data-tab="ATS" title="ATS">Total ATS</a></li>
                   
                      <li class="tab"><a class="tabclick <?php echo ($ReportType == "SD")?'active':'';?>" href="#Collection" data-tab="sd" title="SD">Total SD</a></li>
                    
                  </ul>
                </div>
              </div>
             
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
                              
                          </div>
                          <div class="input-field col m1 s12 right">
                          <?php if(@$this->cur_module->is_export == 1){?>
                            <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                            <?php }?>
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
                            <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_100"><?php echo label('msg_lbl_propertyno')?></th>
                              <th class="width_100"><?php echo label('msg_lbl_serialno')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_name')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_secondname')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_purchasedate')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_amount')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_gstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remainingamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remaininggstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_noofpayment')?></th>
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
              <!-- Visitor End -->
              
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
                            
                          </div>
                          <div class="input-field col m1 s12 right">
                          <?php if(@$this->cur_module->is_export == 1){?>
                            <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                          <?php }?>
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
                            <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_100"><?php echo label('msg_lbl_propertyno')?></th>
                              <th class="width_100"><?php echo label('msg_lbl_serialno')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_name')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_secondname')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_purchasedate')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_amount')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_gstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remainingamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remaininggstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_noofpayment')?></th>
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
              <!-- Followup End -->
              
              <!-- Collection Start -->
              <div id="Collection" class="col s12">
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
                           
                          </div>
                          <div class="input-field col m1 s12 right">
                          <?php if(@$this->cur_module->is_export == 1){?>
                            <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                          <?php }?>
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
                            <button class="btn waves-effect waves-light right button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_100"><?php echo label('msg_lbl_propertyno')?></th>
                              <th class="width_100"><?php echo label('msg_lbl_serialno')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_name')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_secondname')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_purchasedate')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_amount')?></th>
                              <th class="width_130"><?php echo label('msg_lbl_gstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remainingamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_remaininggstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_noofpayment')?></th>
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
              <!-- Collection End -->             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<form id="dashboardfrm" action="<?php echo site_url('admin/report/CustomerProperty/export_to_excel');?>" method="post">
    <input type="hidden" name="ReportType" id="ReportType" value="">
    <input type="hidden" name="FilterType" id="FilterType" value="">
    <input type="hidden" name="CustomStartDate" id="CustomStartDate" value="">
    <input type="hidden" name="CustomEndDate" id="CustomEndDate" value="">
</form>