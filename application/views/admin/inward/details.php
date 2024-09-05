<!--START CONTENT -->
<section id="complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/inward"); ?>"><?php echo label('msg_lbl_title_inward')?></a></h5>
          <input type="hidden" name="GoodsReceivedNoteID" id="GoodsReceivedNoteID" value="<?php echo @$data->GoodsReceivedNoteID; ?>">
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
                    <li class="tab"><a class="active" href="#inward" title="Inward Items">Inward Items</a></li>
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
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                  <?php if(@$this->cur_module->is_insert == 1){?>
                                  <a href="<?php echo site_url("admin/inward/itemadd/".$data->GoodsReceivedNoteID);?>" class="btn-floating right waves-effect waves-light green accent-6 "><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_title_goods');?></th>
                              <th><?php echo label('msg_lbl_inward_qty');?></th>
                              <th><?php echo label('msg_lbl_inward_rate');?></th>
                              <th><?php echo label('msg_lbl_inward_finalprice');?></th>
                              <th><?php echo label('msg_lbl_title_uom');?></th>
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