<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
      <i class="mdi-action-search active"></i>
      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title"><a href="<?php echo site_url('admin/user/refund/index/'.$ID); ?>"><?php echo label('msg_lbl_refund');?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->


  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="listing-page">
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
                <div class="col s12 m5">
                <h5>
                <?php 
                  echo $CancelProperty->FirstName . " ".$CancelProperty->LastName . "(" . $CancelProperty->Title ." - ". $CancelProperty->PropertyNo ." )";
                ?>
                </h5>
                </div>
                <div class="col s12 m5 right-align list-page-right-top-icon">
                  <?php if(@$this->cur_module->is_insert == 1 && $CancelProperty->IsDealClosed == 0){?>
                    <a id="AddData" href="<?php echo site_url("admin/user/refund/add/".$ID); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                 <?php } ?>
                 <?php 
                 if($CancelProperty->IsDealClosed == 1){
                    $icon = ISCLOSED_INACTIVE_ICON_CLASS;
                    $Title = "Payment Closed";
                    $cls = "";
                 }else{
                    $icon = ISCLOSED_ACTIVE_ICON_CLASS;
                    $cls = "closedbtn";
                    $Title = "Payment Open";
                 }
                 ?>
                 <a id="ChangeClosed" href="javascript:void(0)" style="margin-right: 10px;" data-id="<?php echo $ID;?>" class="<?php echo $cls;?> btn-floating waves-effect waves-light indigo accent-6">
                  <i class="<?php echo $icon;?> tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $Title;?>"></i>
                </a>
                </div>
              </div>
            </div>
          </div>
            <div class="table-responsive">
              <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="width_200"><?php echo label('msg_lbl_refunddate');?></th>
                        <th class="width_200"><?php echo label('msg_lbl_paymentmode');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_paymentamount');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_gstamount');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_chequeorifccode');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_accountno');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_bankname');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_bankbranch');?></th>
                        <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                    </tr>
                </thead>

                <tbody id="table_body">
                                           
                </tbody> 
              </table>
            </div>
            <div id="table_paging_div"></div>
            <?php echo $view_modal_popup; ?>
        </div>
      </div>
    </div>
  </div>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT