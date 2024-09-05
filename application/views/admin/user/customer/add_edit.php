<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/user/customer"><strong>Customer</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/customer/<?php echo $Page; ?>">
                    <div class="row">
                        <input type="hidden" name="CustomerID" id="CustomerID" value="<?php echo isset($Customer->CustomerID)?$Customer->CustomerID:0;?>" >
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" value="<?php echo @$Customer->FirstName; ?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="FirstName"><?php echo label('msg_lbl_firstname');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" value="<?php echo @$Customer->LastName; ?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="LastName"><?php echo label('msg_lbl_lastname');?></label>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_emailId');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" value="<?php echo @$Customer->EmailID; ?>" type="<?php echo isset($Customer->EmailID)?"text":"email";?>"  maxlength="200" class="" />
                            <label for="EmailID"><?php echo label('msg_lbl_emailid');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_address');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Address" name="Address" value="<?php echo @$Customer->Address; ?>" type="text"  maxlength="500" class="empty_validation_class" />
                            <label for="Address"><?php echo label('msg_lbl_address');?></label>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6">
                            <?php if(!@$Customer->CustomerID){?>
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a><?php }?>
                            <input id="MobileNo" name="MobileNo" value="<?php echo @$Customer->MobileNo; ?>" type="text"  maxlength="13" class="MobileNo empty_validation_class" />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo1" name="MobileNo1" value="<?php echo @$Customer->MobileNo1; ?>" type="text"  maxlength="13" class="MobileNo" />
                            <label for="MobileNo1"><?php echo label('msg_lbl_mobileno1');?></label>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('Enter Authorise PassCode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password"  autocomplete="off" maxlength="5" class="NumberOnly empty_validation_class"/>
                            <label for="PassCode"><?php echo label('msg_lbl_passcode');?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($Customer->Status) && @$Customer->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/user/customer" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>