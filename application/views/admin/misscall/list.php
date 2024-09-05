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
          <h5 class="breadcrumbs-title"><a href="<?php echo base_url(); ?>admin/misscall"><?php echo label('msg_lbl_misscall_title');?></a></h5>
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
                <div class="col s12 m10 right-align list-page-right-top-icon">
                  <?php if(@$this->cur_module->is_export == 1){?>
                    <a href="<?php echo site_url();?>admin/misscall/export_to_excel"  class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
				          <?php } ?>
			          </div>
              </div>
            </div>
          </div>

            <div class="table-responsive">
              <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="width_200"><?php echo label('msg_lbl_misscal_msgid');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_misscal_longcode');?></th>
                        <th class="width_200"><?php echo label('msg_lbl_misscal_rcvfrom');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_misscal_rcvtime');?></th>
                        <th class="width_180"><?php echo label('msg_lbl_misscal_msgtext');?></th>
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