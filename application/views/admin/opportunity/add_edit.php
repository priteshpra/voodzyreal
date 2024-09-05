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
                            <input id="ProjectID" name="ProjectID" type="text" class="empty_validation_class" maxlength="100" value="<?php echo @$visitor->project; ?>" />
                            <label for="ProjectID"><?php echo label('msg_lbl_project') ?><span style="color:red;">*</span></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="Name" name="Name" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$visitor->Name; ?>" maxlength="100" />
                            <label for="Name"><?php echo label('msg_lbl_name') ?><span style="color:red;">*</span></label>
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
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?><span style="color:red;">*</span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="EntryDate" id="EntryDate" value="<?php
                                                                                        if (isset($visitor->VisitorID)) {
                                                                                            echo isset($visitor->EntryDate) ? GetDateTimeInFormat(@$visitor->EntryDate, DATABASE_DATE_TIME_FORMAT, DATE_FORMAT) : "";
                                                                                        } else
                                                                                            echo date("d-m-Y"); ?>" class=" empty_validation_class" readonly>
                            <label name="EntryDate" class=""><?php echo label('msg_lbl_entrydate') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea name="Message" id="Message" maxlength="500" class="materialize-textarea"><?php echo @$visitor->msg; ?></textarea>
                            <label for="Message"><?php echo label('msg_lbl_description') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_budget'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Budget" name="Budget" type="text" class="empty_validation_class" value="<?php echo @$visitor->Budget; ?>" maxlength="20" />
                            <label for="Budget"><?php echo label('msg_lbl_budget') ?><span style="color:red;">*</span></label>
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
                            <label><?php echo label('msg_lbl_typeofrequirements'); ?><span style="color:red;">*</span></label><br />
                            <input name="TypesofRequirement" type="radio" id="Residency" value="Residency" checked="checked" <?php echo ((isset($visitor->TypesofRequirement) && @$visitor->TypesofRequirement == 'Residency')) ? 'checked="checked"' : ''; ?>>
                            <label for="Residency"><?php echo label('msg_lbl_residency'); ?></label>
                            <input name="TypesofRequirement" type="radio" id="Commercial" value="Commercial" <?php echo ((isset($visitor->TypesofRequirement) && @$visitor->TypesofRequirement == 'Commercial')) ? 'checked="checked"' : ''; ?>>
                            <label for="Commercial"><?php echo label('msg_lbl_commercial') ?></label>
                            <input name="TypesofRequirement" type="radio" id="Industry" value="Industry" <?php echo ((isset($visitor->TypesofRequirement) && @$visitor->TypesofRequirement == 'Industry')) ? 'checked="checked"' : ''; ?>>
                            <label for="Industry"><?php echo label('msg_lbl_industry') ?></label>
                            <input name="TypesofRequirement" type="radio" id="Agriculture" value="Agriculture" <?php echo ((isset($visitor->TypesofRequirement) && @$visitor->TypesofRequirement == 'Agriculture')) ? 'checked="checked"' : ''; ?>>
                            <label for="Agriculture"><?php echo label('msg_lbl_agriculture') ?></label>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_specification'); ?><span style="color:red;">*</span></label><br />
                            <?php
                            $array = array();
                            if (isset($visitor->RequirementValue)) {
                                $array = explode(',', $visitor->RequirementValue);
                            }
                            ?>
                            <div class="ResidencyDiv" class="">
                                <?php
                                $requirement = $this->configdata->RequirementValue;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="RequirementValue[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="CommercialDiv hide">
                                <?php
                                $requirement = $this->configdata->CommercialRequirementValue;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="RequirementValue[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="IndustryDiv hide">
                                <?php
                                $requirement = $this->configdata->IndustryRequirementValue;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="RequirementValue[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="AgricultureDiv hide">
                                <?php
                                $requirement = $this->configdata->AgricultureRequirementValue;
                                $requirement_array = explode(',', $requirement);
                                foreach ($requirement_array as $value) {
                                ?>
                                    <input name="RequirementValue[]" type="checkbox" id="<?php echo RemoveSpace($value); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?> class="requirement">
                                    <label for="<?php echo RemoveSpace($value); ?>"><?php echo $value; ?></label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_requirement'); ?></label><br />
                            <?php
                            $array = array();
                            if (isset($visitor->Requirement)) {
                                $array = explode(',', $visitor->Requirement);
                            }
                            ?>
                            <?php
                            foreach ($this->RequirenmentData as $key => $data) {
                            ?>
                                <div class="hide SpecificationData" id="<?php echo 'My_' . str_replace(' ', '', @$data->Requirenemnt); ?>">
                                    <?php
                                    $requirement = $data->Value;
                                    $requirement_array = explode(',', $requirement);
                                    foreach ($requirement_array as $value) {
                                    ?>
                                        <input class="Specification" name="Requirement[]" type="checkbox" id="<?php echo RemoveSpace($value . $data->Requirenemnt); ?>" value="<?php echo $value; ?>" <?php echo (in_array($value, $array)) ? 'checked="checked" ' : ''; ?>>
                                        <label for="<?php echo RemoveSpace($value . $data->Requirenemnt); ?>"><?php echo $value; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="input-field col s12 m6">
                            <label><?php echo label('msg_lbl_purpose'); ?></label><br />
                            <input name="Purpose" type="radio" id="Lease" value="Lease" checked="checked" <?php echo ((isset($visitor->Purpose) && @$visitor->Purpose == 'Lease')) ? 'checked="checked"' : ''; ?>>
                            <label for="Lease"><?php echo label('msg_lbl_lease'); ?></label>
                            <input name="Purpose" type="radio" id="Purchase " value="Purchase" <?php echo ((isset($visitor->Purpose) && @$visitor->Purpose == 'Purchase')) ? 'checked="checked"' : ''; ?>>
                            <label for="Purchase "><?php echo label('msg_lbl_purchase') ?></label>
                            <input name="Purpose" type="radio" id="Both " value="Both" <?php echo ((isset($visitor->Purpose) && @$visitor->Purpose == 'Both')) ? 'checked="checked"' : ''; ?>>
                            <label for="Both "><?php echo label('msg_lbl_both') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <?php echo @$Area; ?>
                        </div>
                        <div class="input-field col s12 m6 hide AreaValue">
                            <input id="AreaName" name="AreaName" type="text" class="LetterOnly" value="<?php echo @$data->AreaName; ?>" maxlength="100" />
                            <label for="AreaName"><?php echo label('msg_lbl_area') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea"><?php echo @$visitor->Address; ?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <label><?php echo label('msg_lbl_source'); ?></label><br />
                            <input name="Source" type="radio" id="Phone" value="Phone" checked="checked" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Phone')) ? 'checked="checked"' : ''; ?>>
                            <label for="Phone"><?php echo label('msg_lbl_phone'); ?></label>
                            <input name="Source" type="radio" id="Reference" value="Reference" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Reference')) ? 'checked="checked"' : ''; ?>>
                            <label for="Reference"><?php echo label('msg_lbl_reference') ?></label>
                            <input name="Source" type="radio" id="Facebook" value="Facebook" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Facebook')) ? 'checked="checked"' : ''; ?>>
                            <label for="Facebook"><?php echo label('msg_lbl_facebook') ?></label>
                            <input name="Source" type="radio" id="99Acres" value="99Acres" <?php echo ((isset($visitor->Type) && @$visitor->Type == '99Acres')) ? 'checked="checked"' : ''; ?>>
                            <label for="99Acres"><?php echo label('msg_lbl_99acres'); ?></label>
                            <input name="Source" type="radio" id="MagicBreaks" value="MagicBreaks" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'MagicBreaks')) ? 'checked="checked"' : ''; ?>>
                            <label for="MagicBreaks"><?php echo label('msg_lbl_magicbreaks'); ?></label>
                            <input name="Source" type="radio" id="Website" value="Website" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Website')) ? 'checked="checked"' : ''; ?>>
                            <label for="Website"><?php echo label('msg_lbl_website'); ?></label>
                            <input name="Source" type="radio" id="Hoardings" value="Hoardings" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Hoardings')) ? 'checked="checked"' : ''; ?>>
                            <label for="Hoardings"><?php echo label('msg_lbl_hoardings'); ?></label>
                            <input name="Source" type="radio" id="Newspapers" value="Newspapers" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Newspapers')) ? 'checked="checked"' : ''; ?>>
                            <label for="Newspapers"><?php echo label('msg_lbl_newspapers'); ?></label>
                            <input name="Source" type="radio" id="DigitalMarketing" value="DigitalMarketing" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'DigitalMarketing')) ? 'checked="checked"' : ''; ?>>
                            <label for="DigitalMarketing"><?php echo label('msg_lbl_digitalmarketing'); ?></label>
                            <input name="Source" type="radio" id="PP" value="PP" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'PP')) ? 'checked="checked"' : ''; ?>>
                            <label for="PP"><?php echo label('msg_lbl_pp'); ?></label>
                            <input name="Source" type="radio" id="MP" value="MP" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'MP')) ? 'checked="checked"' : ''; ?>>
                            <label for="MP"><?php echo label('msg_lbl_mp'); ?></label>
                            <input name="Source" type="radio" id="HP" value="HP" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'HP')) ? 'checked="checked"' : ''; ?>>
                            <label for="HP"><?php echo label('msg_lbl_hp'); ?></label>
                            <input name="Source" type="radio" id="BulkSMS" value="BulkSMS" <?php echo ((isset($data->Source) && @$data->Type == 'BulkSMS')) ? 'checked="checked"' : ''; ?>>
                            <label for="BulkSMS"><?php echo label('msg_lbl_bluksms'); ?></label>
                            <input name="Source" type="radio" id="RealtyServe" value="RealtyServe" <?php echo ((isset($data->Source) && @$data->Type == 'RealtyServe')) ? 'checked="checked"' : ''; ?>>
                            <label for="RealtyServe"><?php echo label('msg_lbl_realtyserve'); ?></label>
                            <input name="Source" type="radio" id="AP" value="AP" <?php echo ((isset($data->Source) && @$data->Type == 'AP')) ? 'checked="checked"' : ''; ?>>
                            <label for="AP"><?php echo label('msg_lbl_ap'); ?></label>
                            <input name="Source" type="radio" id="PK" value="PK" <?php echo ((isset($data->Source) && @$data->Type == 'PK')) ? 'checked="checked"' : ''; ?>>
                            <label for="PK"><?php echo label('msg_lbl_pk'); ?></label>
                            <input name="Source" type="radio" id="RG" value="RG" <?php echo ((isset($data->Source) && @$data->Type == 'RG')) ? 'checked="checked"' : ''; ?>>
                            <label for="RG"><?php echo label('msg_lbl_rg'); ?></label>
                            <input name="Source" type="radio" id="NP" value="NP" <?php echo ((isset($data->Source) && @$data->Type == 'NP')) ? 'checked="checked"' : ''; ?>>
                            <label for="NP"><?php echo label('msg_lbl_np'); ?></label>
                            <input name="Source" type="radio" id="PD" value="PD" <?php echo ((isset($data->Source) && @$data->Type == 'PD')) ? 'checked="checked"' : ''; ?>>
                            <label for="PD"><?php echo label('msg_lbl_pd'); ?></label>
                            <input name="Source" type="radio" id="SL" value="SL" <?php echo ((isset($data->Source) && @$data->Type == 'SL')) ? 'checked="checked"' : ''; ?>>
                            <label for="SL"><?php echo label('msg_lbl_sl'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_passcode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password" maxlength="5" class="NumberOnly empty_validation_class" autocomplete="off" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?><span style="color:red;">*</span></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?php echo @$employee; ?>
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