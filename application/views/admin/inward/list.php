<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/inward"><?php echo label('msg_lbl_title_inward');?></a></h5>
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
                                        <option value="10"  selected>10</option>
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
                                  <?php if(@$this->cur_module->is_export == 1){?>
                                  <a href="<?php echo site_url("admin/inward/export_to_excel");?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                                  <?php }if(@$this->cur_module->is_insert == 1){?>
                                  <a href="<?php echo site_url("admin/inward/add");?>" class="btn-floating right waves-effect waves-light green accent-6 "><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="search_action card-panel" style="display:none;">  <h4 class="header"><strong> Search</strong></h4>
                                <div class="row m-b-0">
                                  <div class="input-field col s6">
                                    <input type="text" name="VendorName" id="VendorName" class="LetterOnly" class="form-control" maxlength="200">
                                    <label name="VendorName" class=""><?php echo label('msg_lbl_name');?></label>
                                  </div> 
                                  <div class="input-field col s6">
                                    <input id="ChallanNo" name="ChallanNo" type="text" class="empty_validation_class" value="<?php echo @$data->ChallanNo; ?>" maxlength="100" />
                                    <label for="ChallanNo"><?php echo label('msg_lbl_inward_challanno')?></label>
                                  </div>
                                  <div class="input-field col s12 m6">
                                    <input type="text" name="ChallanDate" id="ChallanDate" class="datepicker empty_validation_class" value="<?php echo @$data->ChallanDate; ?>">
                                    <label name="ChallanDate"><?php echo label('msg_lbl_challenDate');?></label>
                                  </div>
                                <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                                &nbsp;&nbsp;&nbsp;
                                <a href="javascript:;" class="clear-all right" onclick="clearAllFilter();return clearfixit();">Clear</a> 
                              </div>
                        </div>
                    </div>
                    <div class="">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th ><?php echo label('msg_lbl_inward_challanimg');?></th>
                                    <th ><?php echo label('msg_lbl_inward_invoiceimg');?></th>
                                    <th ><?php echo label('msg_lbl_title_vendor');?></th>
                                    <th ><?php echo label('msg_lbl_inward_date');?></th>
                                    <th ><?php echo label('msg_lbl_inward_challanno');?></th>
                                    <th ><?php echo label('msg_lbl_project');?></th>
                                    <th ><?php echo label('msg_lbl_inward_item');?></th>
                                    <th ><?php echo label('msg_lbl_inward_total');?></th>
                                    <th class="width_100 actions center"><?php echo label('msg_lbl_status');?></th>
                                    <th class="width_100 actions center"><?php echo label('msg_lbl_actions');?></th>
                                </tr>
                            </thead>
                            <tbody class="TableBody"></tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT-->
<!-- Delete Modal Start -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
            <h5 class="modal-title" id="modal-title">Would you like to delete Invoice Image ?</h5>
       </div>
       <div class="modal-footer">
            <button type="button" id="submit_delete" name="submit_delete"  style="margin-right:15px;margin-left:15px;" class="btn btn-primary">DELETE</button>
            <button type="button" id="submit_close" class="btn btn-secondary modal-action modal-close submit_close" name="submit_close" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>
<!-- Delete Modal End -->
