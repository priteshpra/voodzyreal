<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/vendor"); ?>"><?php echo label('msg_lbl_title_vendor')?> - <?php echo $data->FirstName . " ".$data->LastName; ?></a></h5>
          <input type="hidden" name="UserID" id="UserID" value="<?php echo @$data->VendorID; ?>">
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
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="active" href="#inward" title="Inward Details">Inward Details</a></li>
                  </ul>
                </div>
              </div>
              <!-- Inward Start -->
              <div id="inward" class="col s12">
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
                              <th><?php echo label('msg_lbl_inward_challanimg');?></th>
                              <th><?php echo label('msg_lbl_inward_invoiceimg');?></th>
                              <th><?php echo label('msg_lbl_title_vendor');?></th>
                              <th><?php echo label('msg_lbl_inward_date');?></th>
                              <th><?php echo label('msg_lbl_inward_challanno');?></th>
                              <th><?php echo label('msg_lbl_project');?></th>
                              <th><?php echo label('msg_lbl_inward_item');?></th>
                              <th><?php echo label('msg_lbl_inward_total');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
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
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT -->