<?php //echo $page_name.$employment->CandidateID;exit;
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/opportunity/details/' . $OpportunityID . "#reminder"); ?>"><strong><?php echo label('msg_lbl_title_opportunityreminder') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/opportunity/<?php echo $page_name; ?>">
                    <input id="OpportunityID" name="OpportunityID" value="<?php echo $OpportunityID; ?>" type="hidden" />
                    <input type="hidden" name="PreviousURL" id="PreviousURL" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                    <div class="row">
                        <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_message'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Message" id="Message" maxlength="500" class="empty_validation_class materialize-textarea"><?= @$data->Message ?></textarea>
                            <label for="Message"><?php echo label('msg_lbl_message') ?></label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_reminderdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="ReminderDate" id="ReminderDate" value="<?php echo isset($data->ReminderDate) ? GetDateTimeInFormat(@$data->ReminderDate, DATABASE_DATE_TIME_FORMAT, DATE_FORMAT) : ""; ?>" class="datepickerval empty_validation_class">
                            <label name="ReminderDate" class=""><?php echo label('msg_lbl_reminderdateonly') ?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_remindertime'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <label class="timeplabel" for="ReminderTime"><?php echo label('msg_lbl_remindertime'); ?></label>
                            <input id="ReminderTime" name="ReminderTime" class="timep empty_validation_class" value="<?php echo isset($data->ReminderDate) ? GetDateTimeInFormat(@$data->ReminderDate, DATABASE_DATE_TIME_FORMAT, "H:i") : ""; ?>" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_pastdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="PastDate" id="PastDate" value="<?php echo isset($data->PastDate) ? GetDateTimeInFormat(@$data->PastDate, DATABASE_DATE_TIME_FORMAT, DATE_FORMAT) : date('d-m-Y'); ?>" class="datepickervalall empty_validation_class">
                            <label name="PastDate" class=""><?php echo label('msg_lbl_pastdate') ?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_pasttime'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="input_endtime" name="PastTime" class="timeppast empty_validation_class" value="<?php echo isset($data->PastDate) ? GetDateTimeInFormat(@$data->PastDate, DATABASE_DATE_TIME_FORMAT, "H:i") : date('H:i'); ?>" type="text">
                            <label class="timeplabel" for="PastTime"><?php echo label('msg_lbl_pasttime'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('Enter Authorise PassCode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" autocomplete="off" type="password" maxlength="5" class="NumberOnly empty_validation_class" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo base_url('admin/opportunity/details/' . $OpportunityID); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>