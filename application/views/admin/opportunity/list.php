<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/opportunity"><?php echo label('msg_lbl_opportunity'); ?></a></h5>
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
                                        <option value="10">10</option>
                                        <option value="20" selected>20</option>
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

                                    <?php if (@$this->cur_module->is_insert == 1) { ?>
                                        <a href="<?php echo site_url("admin/opportunity/add"); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>

                                    <?php if (@$this->cur_module->is_export == 1) { ?>
                                        <a href="javascript:void(0);" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <form id="ExportForm" action="<?php echo site_url('admin/opportunity/export_to_excel'); ?>" method="post" class="col s12 SearchAction p-b-20">
                                <div class="search_action card-panel" style="display:none;">
                                    <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                    <div class="row m-b-0">
                                        <?php if ($this->session->userdata['RoleID'] == -1) { ?>
                                            <div class="input-field col s12 m6">
                                                <?php echo @$employee; ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="input-field col s12 m6 hide">
                                                <?php echo @$employee; ?>
                                            </div>
                                        <?php } ?>
                                        <div class="input-field col s6 m6">
                                            <input type="text" name="Name" id="Name" maxlength="100" class="form-control LetterOnly">
                                            <label name="Name" class=""><?php echo label('msg_lbl_name'); ?></label>
                                        </div>

                                        <div class="input-field col s6 m6">
                                            <input type="text" name="MobileNo" id="MobileNo" maxlength="15" class="form-control NumberOnly">
                                            <label name="MobileNo" class=""><?php echo label('msg_lbl_mobileno'); ?></label>
                                        </div>

                                        <div class="input-field col s6 m6">
                                            <input type="text" name="Project" id="Project" maxlength="30" class="form-control">
                                            <label name="Project" class=""><?php echo label('msg_lbl_project'); ?></label>
                                        </div>
                                        <div class="input-field col s6 m6">
                                            <?php echo @$feedback; ?>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <label><?php echo label('msg_lbl_source'); ?></label><br />
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
                                            <label><?php echo label('msg_lbl_requirement'); ?></label><br />
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
                                        <div class="input-field col s12 m12">
                                            <label name="LeadType"><?php echo label('msg_lbl_leadtype') ?></label><br>
                                            <input name="LeadType" type="radio" id="All_LeadType" value="" checked="checked">
                                            <label for="All_LeadType"><?php echo label('msg_lbl_all'); ?></label>
                                            <?php
                                            $leadtype = $this->configdata->LeadType;
                                            $leadtype_array = explode(',', $leadtype);
                                            foreach ($leadtype_array as $value) {
                                            ?>
                                                <input name="LeadType" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>">
                                                <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                            <?php
                                            }
                                            ?>
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
                                    <th><?php echo label('msg_lbl_source'); ?></th>
                                    <th><?php echo label('msg_lbl_project'); ?></th>
                                    <th><?php echo label('msg_lbl_date'); ?></th>
                                    <th><?php echo label('msg_lbl_name'); ?></th>
                                    <th><?php echo label('msg_lbl_email'); ?></th>
                                    <th><?php echo label('msg_lbl_mobileno'); ?></th>
                                    <th><?php echo label('msg_lbl_leadtype'); ?></th>
                                    <th><?php echo label('msg_lbl_employeename'); ?></th>
                                    <th><?php echo label('msg_lbl_lateststatus'); ?></th>
                                    <th><?php echo label('msg_lbl_lastfollwupdate'); ?></th>
                                    <th><?php echo label('msg_lbl_nextfollowupdate'); ?></th>
                                    <th><?php echo label('msg_lbl_remarks'); ?></th>
                                    <th><?php echo label('msg_lbl_reason'); ?></th>
                                    <th><?php echo label('msg_lbl_type'); ?></th>
                                    <th class="width_130 center"><?php echo label('msg_lbl_feedback'); ?></th>
                                    <th class="width_130 center"><?php echo label('msg_lbl_action'); ?></th>
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