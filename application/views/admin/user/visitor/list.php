<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/user/visitor"><?php echo label('msg_lbl_title_visitor'); ?></a></h5>
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

                                        <a href="<?php echo site_url("admin/user/visitor/export_to_excel"); ?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>

                                        <?php if (@$this->UserRoleID == -1 || @$this->UserRoleID == -2) { ?>
                                            <a href="javascript:;" onclick="$('#importmodal').openModal();" class="export-excel btn-floating right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-upload tooltipped" data-position="top" data-delay="50" data-tooltip="Import Excel"></i></a>
                                        <?php } ?>

                                        <!-- <?php }
                                            if (@$this->cur_module->is_insert == 1) { ?>
                                        <a href="<?php echo site_url("admin/user/visitor/add"); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a> -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="search_action card-panel" style="display:none;">
                                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <?php echo $employee; ?>
                                    </div>
                                    <div class="input-field col s12 m6">

                                        <input id="Name" name="Name" type="text" class="LetterOnly" maxlength="100" />
                                        <label for="Name"><?php echo label('msg_lbl_name') ?></label>
                                    </div>
                                </div>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <input id="EmailID" name="EmailID" type="text" class="" maxlength="250" />
                                        <label for="EmailID"><?php echo label('msg_lbl_email') ?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="MobileNo" name="MobileNo" type="text" class=" MobileNo" maxlength="13" />
                                        <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                                    </div>
                                </div>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6">
                                        <label name="LeadType"><?php echo label('msg_lbl_leadtype') . ' (Lead)' ?></label><br>
                                        <input name="LeadType" type="radio" id="LeadType" value="All" checked="checked">
                                        <label for="LeadType"><?php echo label('msg_lbl_all'); ?></label>
                                        <?php
                                        $leadtype = $this->configdata->LeadType;
                                        $leadtype_array = explode(',', $leadtype);
                                        foreach ($leadtype_array as $value) {
                                        ?>
                                            <input name="LeadType" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" class="leadtype">
                                            <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="input-field col s12 m12">
                                    <label><?php echo label('msg_lbl_source') . ' (Lead)'; ?></label><br />
                                    <input name="Source" type="radio" id="All_" value="" checked="checked">
                                    <label for="All_"><?php echo label('msg_lbl_all'); ?></label>
                                    <input name="Source" type="radio" id="Phone" value="Phone">
                                    <label for="Phone"><?php echo label('msg_lbl_phone'); ?></label>
                                    <input name="Source" type="radio" id="Reference" value="Reference">
                                    <label for="Reference"><?php echo label('msg_lbl_reference') ?></label>
                                    <input name="Source" type="radio" id="Facebook" value="Facebook">
                                    <label for="Facebook"><?php echo label('msg_lbl_facebook') ?></label>
                                    <input name="Source" type="radio" id="99Acres" value="99Acres">
                                    <label for="99Acres"><?php echo label('msg_lbl_99acres'); ?></label>
                                    <input name="Source" type="radio" id="MagicBreaks" value="MagicBreaks">
                                    <label for="MagicBreaks"><?php echo label('msg_lbl_magicbreaks'); ?></label>
                                    <input name="Source" type="radio" id="Website" value="Website">
                                    <label for="Website"><?php echo label('msg_lbl_website'); ?></label>
                                    <input name="Source" type="radio" id="Hoardings" value="Hoardings">
                                    <label for="Hoardings"><?php echo label('msg_lbl_hoardings'); ?></label>
                                    <input name="Source" type="radio" id="Newspapers" value="Newspapers">
                                    <label for="Newspapers"><?php echo label('msg_lbl_newspapers'); ?></label>
                                    <input name="Source" type="radio" id="DigitalMarketing" value="DigitalMarketing">
                                    <label for="DigitalMarketing"><?php echo label('msg_lbl_digitalmarketing'); ?></label>
                                    <input name="Source" type="radio" id="PP" value="PP">
                                    <label for="PP"><?php echo label('msg_lbl_pp'); ?></label>
                                    <input name="Source" type="radio" id="MP" value="MP">
                                    <label for="MP"><?php echo label('msg_lbl_mp'); ?></label>
                                    <input name="Source" type="radio" id="HP" value="HP">
                                    <label for="HP"><?php echo label('msg_lbl_hp'); ?></label>
                                    <input name="Source" type="radio" id="BulkSMS" value="BulkSMS">
                                    <label for="BulkSMS"><?php echo label('msg_lbl_bluksms'); ?></label>
                                    <input name="Source" type="radio" id="RealtyServe" value="RealtyServe">
                                    <label for="RealtyServe"><?php echo label('msg_lbl_realtyserve'); ?></label>
                                    <input name="Source" type="radio" id="AP" value="AP">
                                    <label for="AP"><?php echo label('msg_lbl_ap'); ?></label>
                                    <input name="Source" type="radio" id="PK" value="PK">
                                    <label for="PK"><?php echo label('msg_lbl_pk'); ?></label>
                                    <input name="Source" type="radio" id="RG" value="RG">
                                    <label for="RG"><?php echo label('msg_lbl_rg'); ?></label>
                                    <input name="Source" type="radio" id="NP" value="NP">
                                    <label for="NP"><?php echo label('msg_lbl_np'); ?></label>
                                    <input name="Source" type="radio" id="PD" value="PD">
                                    <label for="PD"><?php echo label('msg_lbl_pd'); ?></label>
                                    <input name="Source" type="radio" id="SL" value="SL">
                                    <label for="SL"><?php echo label('msg_lbl_sl'); ?></label>
                                </div>
                                <div class="input-field radio_input_field_add_edit col s12 m12">
                                    <label><?php echo label('msg_lbl_requirement') . ' (Lead)'; ?></label><br />
                                    <input name="Requirement" type="radio" id="All_Requirement" value="" checked="checked">
                                    <label for="All_Requirement"><?php echo label('msg_lbl_all'); ?></label>
                                    <?php
                                    $requirement = $this->configdata->CommercialRequirement;
                                    $requirement_array = explode(',', $requirement);
                                    foreach ($requirement_array as $value) {
                                    ?>
                                        <input name="Requirement" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" class="requirement">
                                        <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $requirement = $this->configdata->Requirement;
                                    $requirement_array = explode(',', $requirement);
                                    foreach ($requirement_array as $value) {
                                    ?>
                                        <input name="Requirement" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" class="requirement">
                                        <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $requirement = $this->configdata->IndustryRequirement;
                                    $requirement_array = explode(',', $requirement);
                                    foreach ($requirement_array as $value) {
                                    ?>
                                        <input name="Requirement" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" class="requirement">
                                        <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m6 hide">

                                        <label><?php echo label('msg_lbl_profession'); ?></label><br />
                                        <input name="Profession" type="radio" id="All_Profession" value="All" checked="checked">
                                        <label for="All_Profession"><?php echo label('msg_lbl_all'); ?></label>
                                        <input name="Profession" type="radio" id="Business" value="Business">
                                        <label for="Business"><?php echo label('msg_lbl_business') ?></label>
                                        <input name="Profession" type="radio" id="Job" value="Job">
                                        <label for="Job"><?php echo label('msg_lbl_job'); ?></label>
                                    </div>
                                    <!-- <div class="input-field col s12 m6">
                                        <?= @$designation; ?>
                                    </div> -->
                                </div>
                                <div class="row m-b-0">
                                    <div class="input-field col s12 m12 hide">
                                        <label><?php echo label('msg_lbl_requirement'); ?></label><br />
                                        <input name="Requirement" type="radio" id="All_Requirement" value="All" checked="checked">
                                        <label for="All_Requirement"><?php echo label('msg_lbl_all'); ?></label>
                                        <?php
                                        $requirement = $this->configdata->CommercialRequirement;
                                        $requirement_array = explode(',', $requirement);
                                        foreach ($requirement_array as $value) {
                                        ?>
                                            <input name="Requirement" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" class="requirement">
                                            <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="width_200"><?php echo label('msg_lbl_type'); ?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_name'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_employee'); ?></th>
                                    <th class="width_200"><?php echo label('msg_lbl_emailid'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_mobileno'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_leadtype'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_inquiry'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_visitorstatus'); ?></th>
                                    <!-- <th class="width_300"><?php echo label('msg_lbl_address'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_companyname'); ?></th>
                                    <th class="width_130"><?php echo label('msg_lbl_designation'); ?></th>  -->
                                    <th class="width_130"><?php echo label('msg_lbl_requirement'); ?></th>
                                    <th class="width_80"><?php echo label('msg_lbl_title_visitorsites'); ?></th>
                                    <!-- <th class="width_130"><?php echo label('msg_lbl_secondname'); ?></th>
                                    <th class="width_200"><?php echo label('msg_lbl_secondmobileno'); ?></th> -->
                                    <th class="width_200 actions center" style="width: 170px;"><?php echo label('msg_lbl_feedback'); ?></th>
                                    <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="table_body" class="table_body">
                            </tbody>
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
<!-- END CONTENT-->

<!-- Import Visitor Modal Start -->
<div id="importmodal" class="modal fade admin-table-view-pop-up" role="dialog">
    <div class="modal-dialog">
        <div class="modal-footer gridhead1 bgglobal">
            <h4 id="response_title">Import Visitor</h4>
            <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
        </div>
        <div class="modal-content">
            <div class="col s12"><a href="<?php echo base_url(); ?>assets/admin/sample/Visitor.csv" download style="color:#000 !important;">Download Sample CSV</a></div>
            <form id="importform" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/user/visitor/importe" method="post">
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
<!-- Import Visitor Modal End 