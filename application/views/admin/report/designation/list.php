<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/report/designation"><?php echo label('msg_lbl_visitor_designation'); ?></a></h5>
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
                                        <label name="LeadType"><?php echo label('msg_lbl_leadtype') ?></label><br>
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
                                    <div class="input-field col s12 m6">
                                        <?= @$designation; ?>
                                    </div>
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
                                    <th class="width_130"><?php echo label('msg_lbl_designation'); ?></th>
                                    <th class="width_80"><?php echo label('msg_lbl_title_visitorsites'); ?></th>
                                    <!-- <th class="width_300"><?php echo label('msg_lbl_requirement'); ?></th> -->
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