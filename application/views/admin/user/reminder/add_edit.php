<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID . '#reminder'); ?>"><strong>Customer Reminder</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/reminder/<?php echo $Page;?>">
                    
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_amount');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Amount" name="Amount" value="<?php echo isset($data->Amount)?($data->Amount):'';?>" type="text"  maxlength="12" class="NumberOnly empty_validation_class" />
                            <label for="Amount"><?php echo label('msg_lbl_amount');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_message');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Message" name="Message" value="<?php echo @$data->Message;?>" type="text" maxlength="200" class="empty_validation_class" />
                            <label for="Message"><?php echo label('msg_lbl_message');?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_reminderdate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="ReminderDate" id="ReminderDate" value="<?php echo isset($data->ReminderDate)? GetDateTimeInFormat(@$data->ReminderDate,DATABASE_DATE_TIME_FORMAT,DATE_FORMAT):"";?>" class="datepickerval empty_validation_class">
                            <label name="ReminderDate" class=""><?php echo label('msg_lbl_reminderdateonly')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_remindertime');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                             <label class="timeplabel" for="ReminderTime"><?php echo label('msg_lbl_remindertime');?></label>
                             <input id="ReminderTime" name="ReminderTime" class="timep empty_validation_class" value="<?php echo isset($data->ReminderDate)? GetDateTimeInFormat(@$data->ReminderDate,DATABASE_DATE_TIME_FORMAT,"H:i"):"";?>" type="text">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('Enter Authorise PassCode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password"  maxlength="5" class="NumberOnly empty_validation_class" autocomplete="off" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode');?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($data->Status) && @$data->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit</button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID. '#reminder'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>