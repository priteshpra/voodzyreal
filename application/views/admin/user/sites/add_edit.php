<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/user/visitor/details/' . $VisitorID . "#sites"); ?>"><strong><?php echo label('msg_lbl_title_visitorsites') . ' - ' . @$visit->FirstName . ' ' . @$visit->LastName; ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/sites/<?php echo $page_name; ?>">
                    <input id="VisitorID" name="VisitorID" value="<?php echo $VisitorID; ?>" type="hidden" />
                    <div class="card-panel diagnosis_medication_panel">

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <?php echo @$Leads; ?>
                            </div>
                            <div class="input-field col s6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_entrydate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input type="text" name="EntryDate" id="EntryDate" value="<?php
                                                                                            if (isset($visitor->VisitorID)) {
                                                                                                echo isset($visitor->EntryDate) ? @$visitor->EntryDate : "";
                                                                                            } else
                                                                                                echo date("d-m-Y"); ?>" class="empty_validation_class" readonly>
                                <label name="EntryDate" class=""><?php echo label('msg_lbl_entrydate') ?></label>
                            </div>
                        </div>
                        <h4 class="header2 m-0">Sites
                            <?php if (!isset($visitor->VisitorSitesID)) { ?>
                                <div class="right add_remove_box">
                                    <a id="medicationcloneclick" class="btn-floating waves-effect waves-light green"><i class="mdi-content-add"></i></a>
                                </div>
                            <?php } ?>
                        </h4>
                        <div id="medication_main" class="row">
                            <div class="diagnosis_medication_panel_box medicationAddList">
                                <div class="diagnosis_medication_left_panel">
                                    <div class="input-field col s12 m6">
                                        <input id="SiteName" name="SiteName[]" type="text" class="empty_validation_class" maxlength="100" value="<?= @$visitor->SiteName ?>" />
                                        <label for="SiteName">Site Name</label>
                                    </div>
                                </div>
                                <div class="input-field col s12 m6">
                                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_remarks'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                    <textarea name="Remarks[]" id="Remarks" maxlength="500" class="materialize-textarea empty_validation_class"><?= @$visitor->Remarks ?></textarea>
                                    <label for="Remarks"><?php echo label('msg_lbl_remarks') ?></label>
                                </div>
                                <?php if (!isset($visitor->VisitorSitesID)) { ?>
                                    <div class="right add_remove_box">
                                        <a class="remove_medication btn-floating waves-effect waves-light red"><i class="mdi-content-remove "></i></a>
                                    </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_finance'); ?></label><br />
                            <input name="Finance" type="radio" id="SelfFunded" value="SelfFunded" checked="checked" <?php echo ((isset($visitor->Finance) && @$visitor->Finance == 'SelfFunded')) ? 'checked="checked"' : ''; ?>>
                            <label for="SelfFunded"><?php echo label('msg_lbl_selffunded') ?></label>
                            <input name="Finance" type="radio" id="Loan" value="Loan" <?php echo ((isset($visitor->Finance) && @$visitor->Finance == 'Loan')) ? 'checked="checked"' : ''; ?>>
                            <label for="Loan"><?php echo label('msg_lbl_loan'); ?></label>
                        </div>
                        <div class="input-field radio_input_field_add_edit col s12 m6">
                            <label><?php echo label('msg_lbl_purposebuying'); ?></label><br />
                            <input name="buyingPurpose" type="radio" id="Investment" value="Investment" checked="checked" <?php echo ((isset($visitor->PurposeofBuying) && @$visitor->PurposeofBuying == 'Investment')) ? 'checked="checked"' : ''; ?>>
                            <label for="Investment"><?php echo label('msg_lbl_investment') ?></label>
                            <input name="buyingPurpose" type="radio" id="PersonalUse" value="PersonalUse" <?php echo ((isset($visitor->PurposeofBuying) && @$visitor->PurposeofBuying == 'PersonalUse')) ? 'checked="checked"' : ''; ?>>
                            <label for="PersonalUse"><?php echo label('msg_lbl_personaluse'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_inquiry'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="InquiryDate" id="InquiryDate" value="<?php
                                                                                            if (isset($visitor->VisitorID)) {
                                                                                                echo @$visitor->InquiryDate;
                                                                                            } else
                                                                                                echo date("d-m-Y");  ?>" class="datepicker empty_validation_class">
                            <label name="InquiryDate" class=""><?php echo label('msg_lbl_inquiry') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_timetocall'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="TimeToCall" name="TimeToCall" type="text" maxlength="30" class="timep" value="<?php echo @$visitor->PreferedTimeToCall; ?>" />
                            <label for="TimeToCall"><?php echo label('msg_lbl_timetocall'); ?></label>
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
                    <!-- <?php if (!isset($visitor->VisitorSitesID)) { ?>
                        <div class="row">
                            <div class="input-field col s6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_reminderdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input type="text" name="ReminderDate" id="ReminderDate" value="<?php
                                                                                                $date = date('d-m-Y');
                                                                                                echo date('d-m-Y', strtotime($date . ' + 5 days')); ?>" class="datepickerval empty_validation_class">
                                <label name="ReminderDate" class=""><?php echo label('msg_lbl_reminderdateonly') ?></label>
                            </div>
                            <div class="input-field col s6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_remindertime'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <label class="timeplabel" for="ReminderTime"><?php echo label('msg_lbl_remindertime'); ?></label>
                                <input id="ReminderTime" name="ReminderTime" class="timep empty_validation_class" value="11:00" type="text">
                            </div>
                        </div>
                    <?php } ?> -->
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
                            <a href="<?php echo base_url('admin/user/visitor/details/' . $VisitorID); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>