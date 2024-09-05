<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/sales/property"><strong><?php echo label('msg_lbl_propertys'); ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/sales/property/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_propertys_title'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="DisplayName" name="DisplayName" value="<?php echo @$Project->DisplayName; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="Title">Display Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PropertyPurpose" name="PropertyPurpose" value="<?php echo @$Project->PropertyPurpose; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="Location">Property purpose</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_propertys_title'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="SuperBuiltupArea" name="SuperBuiltupArea" value="<?php echo @$Project->SuperBuiltupArea; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Title">Super Builtup Area</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CarpetArea" name="CarpetArea" value="<?php echo @$Project->CarpetArea; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Carpet Area</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_propertys_title'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Amount" name="Amount" value="<?php echo @$Project->Amount; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Title">Amount</label>
                        </div>
                        <!-- <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AmountType" name="AmountType" value="<?php echo @$Project->AmountType; ?>" type="text" maxlength="100" class=" empty_validation_class" />

                            <label for="Location">Amount Type</label>
                        </div> -->
                        <div class="col m6 s12 center m-t-20">
                            <span><label>Amount Type :</label></span> &nbsp;&nbsp;
                            <input name="AmountType" type="radio" id="Monthly" value="Monthly" <?php if (@$Project->AmountType == "Monthly" || !@$Project->AmountType) echo " checked='checked' "; ?>>
                            <label for="Monthly">Monthly</label>
                            <input name="AmountType" type="radio" id="OneTime" value="OneTime" <?php if (@$Project->AmountType == "OneTime") echo " checked='checked' "; ?>>
                            <label for="OneTime">OneTime</label> &nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="col m6 s12 center m-t-20">
                            <span><label><?php echo label('msg_lbl_project_type'); ?> :</label></span> &nbsp;&nbsp;
                            <input name="ProjectType" type="radio" id="Residency" value="Residency" <?php if (@$Project->ProjectType == "Residency" || !@$Project->ProjectType) echo " checked='checked' "; ?>>
                            <label for="Residency"><?php echo label('msg_lbl_residency'); ?></label>
                            <input name="ProjectType" type="radio" id="Commercial" value="Commercial" <?php if (@$Project->ProjectType == "Commercial") echo " checked='checked' "; ?>>
                            <label for="Commercial"><?php echo label('msg_lbl_commercial'); ?></label> &nbsp;&nbsp;
                            <input name="ProjectType" type="radio" id="Industry" value="Industry" <?php if (@$Project->ProjectType == "Industry") echo " checked='checked' "; ?>>
                            <label for="Industry"><?php echo label('msg_lbl_industry'); ?></label> &nbsp;&nbsp;
                            <input name="ProjectType" type="radio" id="Agriculture" value="Agriculture" <?php if (@$Project->ProjectType == "Agriculture") echo " checked='checked' "; ?>>
                            <label for="Agriculture"><?php echo label('msg_lbl_agriculture'); ?></label> &nbsp;&nbsp;
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="OwenerFirstName" name="OwenerFirstName" value="<?php echo @$Project->OwenerFirstName; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Owener First Name</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="OwenerLastName" name="OwenerLastName" value="<?php echo @$Project->OwenerLastName; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Owener Last Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AboutProperty" name="AboutProperty" value="<?php echo @$Project->AboutProperty; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">About Property</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CompanyName" name="CompanyName" value="<?php echo @$Project->CompanyName; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Company Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Location" name="Location" value="<?php echo @$Project->Location; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Location</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Apartment" name="Apartment" value="<?php echo @$Project->Apartment; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Apartment</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="StreetAddress" name="StreetAddress" value="<?php echo @$Project->StreetAddress; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Street Address</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Landmark" name="Landmark" value="<?php echo @$Project->Landmark; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Landmark</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CityName" name="CityName" value="<?php echo @$Project->CityName; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">City Name</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Pincode" name="Pincode" value="<?php echo @$Project->Pincode; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Pincode</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PropertyPDFURL" name="PropertyPDFURL" value="<?php echo @$Project->PropertyPDFURL; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="Location">Property PDF URL</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AvailableDate" name="AvailableDate" value="<?php echo @$Project->AvailableDate; ?>" type="text" maxlength="100" class="datepicker empty_validation_class" />
                            <label for="Location">Available Date</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PostedDate" name="PostedDate" value="<?php echo @$Project->PostedDate; ?>" type="text" maxlength="100" class="datepicker empty_validation_class" />
                            <label for="Location">Posted Date</label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($Project->Status) && @$Project->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/sales/property" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>