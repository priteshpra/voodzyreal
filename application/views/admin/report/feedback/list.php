<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/report/feedback"><?php echo label('msg_lbl_feedback'); ?></a></h5>
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
                                    <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                    <input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
                                    <label for="All"><?php echo label('msg_lbl_all'); ?></label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
                                    <label for="Filter"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;

                                </div>
                                <div class="col s12 m4 right-align list-page-right-top-icon">
                                    <a class="btn-floating waves-effect waves-light grey right">
                                        <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                    <?php if (@$this->cur_module->is_export == 1) { ?>
                                        <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <form id="ExportForm" action="<?php echo site_url('admin/report/feedback/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20">
                                <div class="search_action card-panel" style="display:none;">
                                    <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                    <div class="row m-b-0">

                                        <div class="input-field col s6 m6 ">
                                            <input type="text" name="FromDate" id="FromDate" value="<?php echo date('01-m-Y'); ?>" class="datepicker empty_validation_class">
                                            <label for="FromDate">Start Date</label>
                                        </div>
                                        <div class="input-field col s6 m6 ">
                                            <input type="text" name="EndDate" id="EndDate" value="<?php echo date('d-m-Y'); ?>" class="datepicker empty_validation_class">
                                            <label for="EndDate">End Date</label>
                                        </div>

                                        <div class="input-field col s6 m6">
                                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                                            </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all'); ?>
                                            </a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo label('msg_lbl_feedback'); ?></th>
                                    <th><?php echo label('msg_lbl_phone'); ?></th>
                                    <th><?php echo label('msg_lbl_reference'); ?></th>
                                    <th><?php echo label('msg_lbl_99acres'); ?></th>
                                    <th><?php echo label('msg_lbl_facebook'); ?></th>
                                    <th><?php echo label('msg_lbl_magicbreaks'); ?></th>
                                    <th><?php echo label('msg_lbl_homeonline'); ?></th>
                                    <th><?php echo label('msg_lbl_googleads'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="TableBody"></tbody>
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
                <?php echo @$feedback_modal_popup; ?>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT