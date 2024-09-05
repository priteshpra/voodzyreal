<?php //pr($visitor);
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/user/visitor/"><strong><?php echo label('msg_lbl_title_visitor') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/visitor/<?php echo $page_name; ?>">
                    <input id="OpportunityID" name="OpportunityID" value="<?php echo @$visitor->OpportunityID; ?>" type="hidden" />
                    <input id="VisitorID" name="VisitorID" value="<?php echo @$visitor->VisitorID; ?>" type="hidden" />
                    <div class="row">
                        <?php if (@$visitor->VisitorID != 0) {  ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_firstname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$visitor->FirstName; ?>" maxlength="100" />
                                <label for="FirstName"><?php echo label('msg_lbl_firstname') ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_lastname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$visitor->LastName; ?>" maxlength="100" />
                                <label for="LastName"><?php echo label('msg_lbl_lastname') ?><span style="color:red;">*</span></label>
                            </div>
                        <?php } else {
                            $Name  = @$visitor->Name;
                            $Name = explode(" ", $Name);
                        ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_firstname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$Name['0']; ?>" maxlength="100" />
                                <label for="FirstName"><?php echo label('msg_lbl_firstname') ?><span style="color:red;">*</span></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_lastname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$Name['1']; ?>" maxlength="100" />
                                <label for="LastName"><?php echo label('msg_lbl_lastname') ?><span style="color:red;">*</span></label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input id="SecondName" name="SecondName" type="text" class="LetterOnly" value="<?php echo @$visitor->SecondName; ?>" maxlength="100" />
                            <label for="SecondName"><?php echo label('msg_lbl_secondname') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="SecondMobileNo" name="SecondMobileNo" type="text" class="NumberOnly" value="<?php echo @$visitor->SecondMobileNo; ?>" maxlength="100" />
                            <label for="SecondMobileNo"><?php echo label('msg_lbl_secondmobileno') ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailId'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" type="email" class="" value="<?php echo @$visitor->EmailID; ?>" maxlength="250" />
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
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_companyname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CompanyName" name="CompanyName" type="text" class="LetterOnly" value="<?php echo @$visitor->CompanyName; ?>" maxlength="100" />
                            <label for="CompanyName"><?php echo label('msg_lbl_companyname') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?= @$designation; ?>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_visitorstatus'); ?></label><br />
                            <input name="VisitorStatus" type="radio" id="InProgress" value="InProgress" checked="checked" <?php echo ((isset($visitor->VisitorStatus) && @$visitor->VisitorStatus == 'InProgress')) ? 'checked="checked"' : ''; ?>>
                            <label for="InProgress"><?php echo label('msg_lbl_inprogress') ?></label>
                            <input name="VisitorStatus" type="radio" id="Lost" value="Lost" <?php echo ((isset($visitor->VisitorStatus) && @$visitor->VisitorStatus == 'Lost')) ? 'checked="checked"' : ''; ?>>
                            <label for="Lost"><?php echo label('msg_lbl_lost'); ?></label>
                            <input name="VisitorStatus" type="radio" id="Converted" value="Converted" <?php echo ((isset($visitor->VisitorStatus) && @$visitor->VisitorStatus == 'Converted')) ? 'checked="checked"' : ''; ?>>
                            <label for="Converted"><?php echo label('msg_lbl_converted'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea"><?= @$visitor->Address ?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                        </div>
                    </div>
                    <div class="row">.
                        <div class="input-field col s12 m1">
                            <input type="text" name="BirthDate" id="BirthDate" value="<?php echo @$visitor->BirthDate; ?>" class="NumberOnly" maxlength="2" max="12">
                            <label name="BirthDate" class=""><?php echo label('msg_lbl_birthdate') ?></label>
                        </div>
                        <div class="input-field col s12 m1">
                            <?php echo @$BirthMonth; ?>
                        </div>
                        <div class="input-field col s12 m4">
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="text" name="AnniversaryDate" id="AnniversaryDate" value="<?php echo @$visitor->AnniversaryDate; ?>" class="NumberOnly" maxlength="2" max="12">
                            <label name="AnniversaryDate" class=""><?php echo label('msg_lbl_anniversarydate') ?></label>
                        </div>
                        <div class="input-field col s12 m1">
                            <?php echo @$AnniversaryMonth; ?>
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
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/user/visitor" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>