<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/user/vendor"><strong><?php echo label('msg_lbl_title_vendor')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/vendor/<?php echo $page_name; ?>">
                    <input id="VendorID" name="VendorID" value="<?php echo @$vendor->VendorID; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$vendor->FirstName; ?>"  maxlength="250" />
                            <label for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="LetterOnly empty_validation_class" value="<?php echo @$vendor->LastName; ?>"  maxlength="250" />
                            <label for="LastName"><?php echo label('msg_lbl_lastname')?></label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_emailid');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EmailID" name="EmailID" type="text" class="" value="<?php echo @$vendor->EmailID; ?>"  maxlength="250" />
                            <label for="EmailID"><?php echo label('msg_lbl_emailid')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_mobileno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="NumberOnly" value="<?php echo @$vendor->MobileNo; ?>"  maxlength="250" />
                            <label for="MobileNo"><?php echo label('msg_lbl_mobileno')?></label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_firmname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="BusinessName" name="BusinessName" type="text" class="empty_validation_class" value="<?php echo @$vendor->BusinessName; ?>"  maxlength="250" />
                            <label for="BusinessName"><?php echo label('msg_lbl_vendor_businessname')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_pancard');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PanNo" name="PanNo" type="text" class="" value="<?php echo @$vendor->PANNo; ?>"  maxlength="250" />
                            <label for="PanNo"><?php echo label('msg_lbl_pancard')?></label>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_gstno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="GstNo" name="GstNo" type="text" class="" value="<?php echo @$vendor->GSTNo; ?>"  maxlength="250" />
                            <label for="GstNo"><?php echo label('msg_lbl_gstno')?></label>
                        </div>
                        <div class="input-field col s6">
                            <?php echo @$category;?>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($vendor->Status) && @$vendor->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/user/vendor" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>