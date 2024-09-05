<div class="section">
    <div class="container">
        <div class="card-panel card-panel-box">
            <h4 class="header"><a href="<?php echo $this->config->item('base_url'); ?>admin/user/employeedetails"><strong><?php echo label('msg_lbl_title_employeedetails'); ?></strong></a></h4>
            <div class="row">
                <form class="col s12" name="add_form" id="add_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/employeedetails/<?php echo $page_name; ?>">
                    <input type="hidden" name="UserID" id="UserID" value="<?php echo isset($employee->UserID) ? $employee->UserID : 0; ?>">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" maxLength="50" class="empty_validation_class LetterOnly" value="<?php echo isset($employee->FirstName) ? @$employee->FirstName : '' ?>" />
                            <label for="FirstName"><?php echo label('msg_lbl_first_name'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>

                            <input id="LastName" name="LastName" type="text" maxLength="50" class="empty_validation_class LetterOnly" value="<?php echo isset($employee->LastName) ? @$employee->LastName : '' ?>" />
                            <label for="LastName"><?php echo label('msg_lbl_last_name'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?php if (!isset($employee->UserID)) { ?>
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailId'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <?php } ?>
                            <input name="Email" id="Email" type="email" maxLength="250" value="<?php echo @$employee->EmailID; ?>" />
                            <label for="Email"><?php echo label('msg_lbl_emailid'); ?></label>
                        </div>
                        <?php if (!isset($employee->UserID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_password'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>

                                <input id="Password" name="Password" type="password" maxlength="32" class="empty_validation_class" value="<?php echo isset($employee->Password) ? @$employee->Password : '' ?>">
                                <label for="Password"><?php echo label('msg_lbl_password'); ?></label>
                            </div>
                        <?php } ?>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>

                            <input name="Address" id="Address" type="text" maxLength="250" class="empty_validation_class" value="<?php echo isset($employee->Address) ? @$employee->Address : ''; ?>" />
                            <label for="Address"><?php echo label('msg_lbl_address'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_mobileno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input name="MobileNo" id="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo isset($employee->MobileNo) ? @$employee->MobileNo : ''; ?>" maxLength="13" />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_passcode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>

                            <input name="PassCode" id="PassCode" type="text" class="empty_validation_class NumberOnly" value="<?php echo isset($employee->PassCode) ? @$employee->PassCode : $PassCode; ?>" autocomplete="off" maxLength="5" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?></label>

                        </div>
                        <?php
                        if (($this->UserRoleID == -2 || $this->UserRoleID == -1) && @$employee->UserID != $this->session->userdata['UserID']) {
                        ?>
                            <div class="input-field col s12 m6" id="RoleDiv">
                                <?= $roles; ?>
                            </div>
                        <?php } ?>
                        <?php
                        if ($this->UserRoleID == -2) {
                        ?>
                            <div class="input-field col s12 m6">
                                <input type="checkbox" class="" name="IsAdmin" id="IsAdmin" <?php
                                                                                            if (isset($employee->IsAdmin) && @$employee->IsAdmin == INACTIVE) {
                                                                                                echo "";
                                                                                            } else {
                                                                                                echo "checked='checked'";
                                                                                            }
                                                                                            ?>>
                                <label for="IsAdmin"><?php echo label('msg_lbl_isadmin'); ?></label>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($employee->Status) && @$employee->Status == INACTIVE) {
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
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/user/employeedetails" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>