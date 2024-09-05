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
          <h5 class="breadcrumbs-title"><a href="<?php echo base_url(); ?>admin/user/Customer"> Customer</a></h5>
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
                <div class="col m6 s12 center m-t-20">
                    <span><label>Data Display :</label></span> &nbsp;&nbsp;
                    <input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
                    <label for="All">All</label>
                    <input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
                    <label for="Filter">Filter</label>  &nbsp;&nbsp;
                </div>  
                <div class="col s12 m4 right-align list-page-right-top-icon">
                  <a class="btn-floating waves-effect waves-light grey right">
                  <i id="display_action" onclick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
				          <?php //if(@$this->cur_module->is_export == 1){?>
                      <a href="<?php echo site_url("admin/user/customer/export_to_excel");?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                      <?php if(@$this->UserRoleID == -1 || @$this->UserRoleID == -2){?>
                          <a href="javascript:;" onclick="$('#importmodal').openModal();" class="export-excel btn-floating right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-upload tooltipped" data-position="top" data-delay="50" data-tooltip="Import Excel"></i></a>
                      <?php } ?>
                </div>
              </div>
            </div>
            <div class="col s12">
              <div class="search_action card-panel" style="display:none;">  <h4 class="header"><strong> Search</strong></h4>
                <div class="row m-b-0">
                  <div class="input-field col s6">
                    <input type="text" name="Name" id="Name" class="LetterOnly" class="form-control" maxlength="200">
                    <label name="Name" class=""><?php echo label('msg_lbl_name');?></label>
                  </div> 
        					<div class="input-field col s6">
        						<input type="text" name="MobileNo" id="MobileNo" class="MobileNo" maxlength="13">
        						<label name="MobileNo" class="" ><?php echo label('msg_lbl_mobileno');?></label>
        					</div>
                  <!-- <div id="ProjectDiv" class="input-field col s6">
                    <?php echo $Project;?>
                  </div> -->
                  <div id="PropertyDiv" class="input-field col s6">
                    <?php echo $Property;?>
                  </div>
                  <div class="input-field search_label_radio col s6">
                    <div name="status" class="form-control search_div m-t-10 left">Status</div>
                    <input name="Status_search" type="radio" id="All_Status_search" value="-1" checked="checked">
                    <label for="All_Status_search">All</label>
                    <input name="Status_search" type="radio" id="Active" value="1">
                    <label for="Active">Active</label> 
                    <input name="Status_search" type="radio" id="InActive" value="0">
                    <label for="InActive">InActive</label>
                  </div>
                </div>
                <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                &nbsp;&nbsp;&nbsp;
                <a href="javascript:;" class="clear-all right" onclick="clearAllFilter();return clearfixit();">Clear</a> 
              </div>
            </div>
          </div>
            <div class="table-responsive">
              <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="width_180">Name</th>
                        <th class="width_130"><?php echo label('msg_lbl_employee');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_propertydetails');?></th>
                        <th class="width_250"><?php echo label('msg_lbl_emailid');?></th>
                        <th class="width_130"><?php echo label('msg_lbl_mobileno');?></th>
                        <th class="width_130"><?php echo label('msg_lbl_mobileno1');?></th>
                        <th class="width_300"><?php echo label('msg_lbl_address');?></th>
                        <th class="center"><?php echo label('msg_lbl_status');?></th>
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
<!-- END CONTENT-->
<!-- Import Customer Modal Start -->
  <div id="importmodal" class="modal fade admin-table-view-pop-up" role="dialog">
    <div class="modal-dialog">
      <div class="modal-footer gridhead1 bgglobal">      
        <h4 id="response_title">Import Customer</h4>
          <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
      </div>
      <div class="modal-content"> 
          <div class="col s12"><a href="<?php echo base_url();?>assets/admin/sample/Customer.csv" download style="color:#000 !important;">Download Sample CSV</a></div> 
          <form id="importform" enctype="multipart/form-data" action="<?php echo base_url();?>admin/user/customer/importe" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <h4 class=" col s12" style="color:#000 !important;">Upload CSV</h4>
                        <input class=" col s12" type="file" name="userfile" id="userfile" />
                    </div>      
                </div>
                <div class="clearfix input-field col s6">
                  <button class="btn waves-effect waves-light right" id="import_submit" name="import_submit">Submit</button>
                  <span class="modal-close right close-button">Cancel</span>
                </div>   
          </form>
      </div>
    </div>
  </div>
<!-- Import Customer Modal End -->