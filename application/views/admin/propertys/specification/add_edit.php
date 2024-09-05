<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#milestone'); ?>"><strong>Specification</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/sales/specification/<?php echo $Page; ?>">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="hidden" name="PropertyspecificationID" id="PropertyspecificationID" value="<?php echo isset($MileStone->PropertyspecificationID) ? $MileStone->PropertyspecificationID : 0; ?>">
                            <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID; ?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_milestone'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MileStone" name="MileStone" value="<?php echo @$MileStone->MileStone; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="MileStone">FloorNumber</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col m6 col s12 m6">
                            <input type="checkbox" class="" name="GatedCommunity" id="GatedCommunity" <?php
                                                                                                        if (isset($MileStone->GatedCommunity) && @$MileStone->GatedCommunity == INACTIVE) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo "checked='checked'";
                                                                                                        }
                                                                                                        ?>>
                            <label for="GatedCommunity">Gated Community</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 col s12 m6">
                            <input type="checkbox" class="" name="PetFriendly" id="PetFriendly" <?php
                                                                                                if (isset($MileStone->PetFriendly) && @$MileStone->PetFriendly == INACTIVE) {
                                                                                                    echo "";
                                                                                                } else {
                                                                                                    echo "checked='checked'";
                                                                                                }
                                                                                                ?>>
                            <label for="PetFriendly">Pet Friendly</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 col s12 m6">
                            <input type="checkbox" class="" name="PowerBackup" id="PowerBackup" <?php
                                                                                                if (isset($MileStone->PowerBackup) && @$MileStone->PowerBackup == INACTIVE) {
                                                                                                    echo "";
                                                                                                } else {
                                                                                                    echo "checked='checked'";
                                                                                                }
                                                                                                ?>>
                            <label for="PowerBackup">Power Backup</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 col s12 m6">
                            <input type="checkbox" class="" name="CornerProperty" id="CornerProperty" <?php
                                                                                                        if (isset($MileStone->CornerProperty) && @$MileStone->CornerProperty == INACTIVE) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo "checked='checked'";
                                                                                                        }
                                                                                                        ?>>
                            <label for="CornerProperty">Corner Property</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Facing" name="Facing" value="<?php echo @$MileStone->Facing; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="Facing">Facing</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="RentAgreementDuration" name="RentAgreementDuration" value="<?php echo @$MileStone->RentAgreementDuration; ?>" type="text" maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="RentAgreementDuration">Rent Agreement Duration</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PropertyConfiguration" name="PropertyConfiguration" value="<?php echo @$MileStone->PropertyConfiguration; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="PropertyConfiguration">Property Configuration</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PropertyAge" name="PropertyAge" value="<?php echo @$MileStone->PropertyAge; ?>" type="text" maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="PropertyAge">Property Age</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Flooring" name="Flooring" value="<?php echo @$MileStone->Flooring; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="Flooring">Flooring</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Parking" name="Parking" value="<?php echo @$MileStone->Parking; ?>" type="text" maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="Parking">Parking</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="NoticePeriod" name="NoticePeriod" value="<?php echo @$MileStone->NoticePeriod; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="NoticePeriod">Notice Period</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="SecurityDeposit" name="SecurityDeposit" value="<?php echo @$MileStone->SecurityDeposit; ?>" type="text" maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="SecurityDeposit">Security Deposit</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MaintananceFees" name="MaintananceFees" value="<?php echo @$MileStone->MaintananceFees; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="MaintananceFees">Maintanance Fees</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LockInperiod" name="LockInperiod" value="<?php echo @$MileStone->LockInperiod; ?>" type="text" maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="LockInperiod">Lock In period</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LeaseAppreciationPerYear" name="LeaseAppreciationPerYear" value="<?php echo @$MileStone->LeaseAppreciationPerYear; ?>" type="text" maxlength="2" class=" empty_validation_class" />
                            <label for="LeaseAppreciationPerYear">Lease Appreciation Per Year</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($MileStone->Status) && @$MileStone->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#milestone'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>