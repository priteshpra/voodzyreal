<?php //pr($visitor);
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/opportunity/"><strong><?php echo label('msg_lbl_opportunity') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/opportunity/<?php echo $page_name; ?>">
                    <input id="OpportunityID" name="OpportunityID" value="<?php echo @$visitor->OpportunityID; ?>" type="hidden" />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input id="ProjectID" name="ProjectID" type="text" class="empty_validation_class" maxlength="100" />
                            <label for="ProjectID"><?php echo label('msg_lbl_project') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="Name" name="Name" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$visitor->Name; ?>" maxlength="100" />
                            <label for="Name"><?php echo label('msg_lbl_name') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailId'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" type="email" class="" value="<?php echo @$visitor->EmailID; ?>" maxlength="250" <?php if (isset($visitor->VisitorID)) {
                                                                                                                                                    echo 'readonly';
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?> />
                            <label for="EmailID"><?php echo label('msg_lbl_emailid') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_mobileno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$visitor->MobileNo; ?>" maxlength="15" <?php if (isset($visitor->VisitorID)) {
                                                                                                                                                                                    echo 'readonly';
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo '';
                                                                                                                                                                                } ?> />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_passcode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password" maxlength="5" class="NumberOnly empty_validation_class" autocomplete="off" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?php echo @$employee; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="EntryDate" id="EntryDate" value="<?php
                                                                                        if (isset($visitor->VisitorID)) {
                                                                                            echo isset($visitor->EntryDate) ? GetDateTimeInFormat(@$visitor->EntryDate, DATABASE_DATE_TIME_FORMAT, DATE_FORMAT) : "";
                                                                                        } else
                                                                                            echo date("d-m-Y"); ?>" class="datepickerval empty_validation_class">
                            <label name="EntryDate" class=""><?php echo label('msg_lbl_entrydate') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea name="Message" id="Message" maxlength="500" class="materialize-textarea"></textarea>
                            <label for="Message"><?php echo label('msg_lbl_message') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_budget'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Budget" name="Budget" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$visitor->Budget; ?>" maxlength="9" />
                            <label for="Budget"><?php echo label('msg_lbl_budget') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <label name="LeadType"><?php echo label('msg_lbl_leadtype') ?></label><br>
                            <?php
                            $leadtype = $this->configdata->LeadType;
                            $leadtype_array = explode(',', $leadtype);
                            foreach ($leadtype_array as $value) {
                            ?>
                                <input name="LeadType" type="radio" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo ((isset($visitor->LeadType) && @$visitor->LeadType == $value)) ? 'checked="checked"' : ''; ?> <?php if (!isset($visitor->LeadType) && $value == 'Cold') {
                                                                                                                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                                                                                                                    } ?> class="leadtype">
                                <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_typeofrequirements'); ?></label><br />
                            <input name="TypesofRequirement" type="radio" id="Residency" value="Residency" checked="checked">
                            <label for="Residency"><?php echo label('msg_lbl_residency'); ?></label>
                            <input name="TypesofRequirement" type="radio" id="Commercial" value="Commercial">
                            <label for="Commercial"><?php echo label('msg_lbl_commercial') ?></label>
                            <input name="TypesofRequirement" type="radio" id="Industry" value="Industry">
                            <label for="Industry"><?php echo label('msg_lbl_industry') ?></label>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_requirement'); ?></label><br />
                            <?php
                            $array = array();
                            if (isset($visitor->Requirement)) {
                                $array = explode(',', $visitor->Requirement);
                            }
                            ?>
                            <div id="ResidencyDiv" class="<?php if (@$visitor->ProjectType == "Commercial" ) {
                                                                echo "hide";
                                                            } ?>">
                                <?php
                                $requirement = $this->configdata->Requirement;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="Requirement[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                            <div id="CommercialDiv" class="<?php if (@$visitor->ProjectType == "Residency" || !@$visitor->ProjectType) {
                                                                echo "hide";
                                                            } ?>">
                                <?php
                                $requirement = $this->configdata->CommercialRequirement;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="Requirement[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <label><?php echo label('msg_lbl_purpose'); ?></label><br />
                            <input name="Purpose" type="radio" id="Lease" value="Lease" checked="checked">
                            <label for="Lease"><?php echo label('msg_lbl_lease'); ?></label>
                            <input name="Purpose" type="radio" id="Sell " value="Sell ">
                            <label for="Sell "><?php echo label('msg_lbl_sell') ?></label>
                            <input name="Purpose" type="radio" id="Both " value="Both ">
                            <label for="Both "><?php echo label('msg_lbl_both') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input id="Area" name="Area" type="text" class="empty_validation_class LettterOnly" maxlength="30" />
                            <label for="Area"><?php echo label('msg_lbl_area') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea"></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <label><?php echo label('msg_lbl_source'); ?></label><br />
                            <input name="Source" type="radio" id="Phone" value="Phone" checked="checked">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($visitor->Status) && @$visitor->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/opportunity" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>