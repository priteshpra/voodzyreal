<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/ChanelPartner"><strong><?php echo label('msg_lbl_chanel_partners')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/chanelPartner/<?php echo $page_name; ?>">
                    <input id="cid" name="cid" value="<?php echo @$chanel->ChanelPartnerID; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_firmname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirmName" name="FirmName" type="text" class="empty_validation_class" value="<?php echo @$chanel->FirmName; ?>"  maxlength="250" />
                            <label for="FirmName"><?php echo label('msg_lbl_firmname')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$chanel->FirstName; ?>"  maxlength="250" />
                            <label for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$chanel->LastName; ?>"  maxlength="250" />
                            <label for="LastName"><?php echo label('msg_lbl_lastname')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_emailid');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" type="text" class="" value="<?php echo @$chanel->EmailID; ?>"  maxlength="250" />
                            <label for="EmailID"><?php echo label('msg_lbl_emailid')?></label>
                        </div>
                    </div>    
                    <!-- <?php if(!isset($chanel->EmailID))
                    {?>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="Password" name="Password" type="password" class="empty_validation_class" value=""  maxlength="32" />
                                <label for="Password"><?php echo label('msg_lbl_password')?></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_confirmpassword');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="ConfirmPassword" name="ConfirmPassword" type="password" class="empty_validation_class" value=""  maxlength="32" />
                                <label for="ConfirmPassword"><?php echo label('msg_lbl_confirm_password')?></label>
                            </div>
                        </div>
                    <?php }?>  -->  
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="NumberOnly" value="<?php echo @$chanel->MobileNo; ?>"  maxlength="250" />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_pancard');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PanNo" name="PanNo" type="text" class="" value="<?php echo @$chanel->PanCard; ?>"  maxlength="250" />
                            <label for="PanNo"><?php echo label('msg_lbl_pancard')?></label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_aadharcard');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AadharNo" name="AadharNo" type="text" class="" value="<?php echo @$chanel->AadharCard; ?>"  maxlength="250" />
                            <label for="AadharNo"><?php echo label('msg_lbl_aadharcard')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_gstno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="GstNo" name="GstNo" type="text" class="" value="<?php echo @$chanel->GSTNumber; ?>"  maxlength="250" />
                            <label for="GstNo"><?php echo label('msg_lbl_gstno')?></label>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_bankname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="BankName" name="BankName" value="<?php echo @$chanel->BankName;?>" type="text"  maxlength="250" class="LetterOnly" />
                            <label for="BankName"><?php echo label('msg_lbl_bankname');?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_bankaccount');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AccountNo" name="AccountNo" type="text" class="" value="<?php echo @$chanel->BankAccount; ?>"  maxlength="250" />
                            <label for="AccountNo"><?php echo label('msg_lbl_bankaccount')?></label>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_ifccode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="IFCCode" name="IFCCode" value="<?php echo @$chanel->IFCCode;?>" type="text"  maxlength="15" class="NumberLetter CustomLength"/>
                            <label for="IFCCode"><?php echo label('msg_lbl_ifccode');?></label>
                        </div>
                        <div class="input-field col s12 m6 ">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_reracode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="ReraCode" name="ReraCode" value="<?php echo @$chanel->ReraCode;?>" type="text"   class=""/>
                            <label for="ReraCode"><?php echo label('msg_lbl_reracode');?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($chanel->Status) && @$chanel->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>
                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/ChanelPartner" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>