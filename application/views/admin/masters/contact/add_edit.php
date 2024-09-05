<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/contact') ?>"><strong><?php echo label('msg_lbl_title_contact') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/contact/' . $page_name) ?>">
            <input id="ContactID" name="ContactID" value="<?php echo isset($data->ContactID) ? $data->ContactID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="Name" name="Name" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Name; ?>" maxlength="100" />
                    <label for="Name"><?php echo label('msg_lbl_name') ?><span style="color:red;">*</span></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$data->MobileNo; ?>" maxlength="15" />
                    <label for="MobileNo"><?php echo label('msg_lbl_mobileno') ?><span style="color:red;">*</span></label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="EmailID" name="EmailID" type="email" class=" " value="<?php echo @$data->EmailID; ?>" maxlength="150" />
                    <label for="EmailID"><?php echo label('msg_lbl_emailid') ?></label>
                </div>
                <div class="input-field radio_input_field_add_edit col s12 m6">
                    <label><?php echo label('msg_lbl_type'); ?></label><br />
                    <input name="Type" type="radio" id="User" value="User" checked="checked" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'User')) ? 'checked="checked"' : ''; ?>>
                    <label for="User"><?php echo label('msg_lbl_user') ?></label>
                    <input name="Type" type="radio" id="Investor" value="Investor" <?php echo ((isset($visitor->Type) && @$visitor->Type == 'Investor')) ? 'checked="checked"' : ''; ?>>
                    <label for="Investor"><?php echo label('msg_lbl_investor'); ?></label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/contact') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>