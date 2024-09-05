<div class="section">
    <div class="container">
    <div class="card-panel col s12">        
        <h4 class="header m-t-0">
            <a href="<?php echo base_url() ?>admin/configuration/config"><strong><?php echo label('msg_lbl_title_config')?></strong>
            </a>
        </h4>   
        <div class="card-panel col s12">        
            <div class="row">
                <form class="col s12" id="configForm" method="post" type="submit" action="<?php echo $this->config->item('base_url'); ?>admin/configuration/config/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s6 hide">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_crashemail');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class" id="CrashEmail" name="CrashEmail" type="email" value="<?php echo @$config->CrashEmail; ?>" maxlength="50"  />
                            <label for="CrashEmail" class="active"><?php echo label('msg_lbl_crashemail')?></label>
                        </div>
                         <div class="input-field col s6">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_supportemail');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class" id="SupportEmail" name="SupportEmail" type="email"  value="<?php echo @$config->SupportEmail; ?>" maxlength="50" />
                            <label for="SupportEmail" class="active"><?php echo label('msg_lbl_supportemail')?></label>
						 </div>
                        <div class="input-field col s12 m6">
                            <label  class="active">Select TimeZone</label>        
                             <select id="TimeZone" name="TimeZone" class="select2_class" style="width:100%;display:none">
                                <option value="" selected="">Select TimeZone</option>
                                <option value='00:00' <?php if(@$config->TimeZone == '+00:00'){echo 'selected';}?>> +00:00 </option>
                                <option value='05:30' <?php if(@$config->TimeZone == '+05:30'){echo 'selected';}?>> +05:30 </option>
                                 
                            </select>
                        </div>
                    </div>
					<div class="row hide">
						
						<div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionandroid');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input class="empty_validation_class AmountOnly" id="AppVersionAndroid" name="AppVersionAndroid" type="text" value="<?php echo @$config->AppVersionAndroid; ?>" maxlength="4"  />
                            <label for="AppVersionAndroid" class="active"><?php echo label('msg_lbl_appversionandroid')?></label>
                        </div>
						
						<div class="input-field col s12 m12">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_appversionios');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							 <input class="empty_validation_class AmountOnly" id="AppVersionIOS" name="AppVersionIOS" type="text" value="<?php echo @$config->AppVersionIOS; ?>" maxlength="4"  />
                            <label for="AppVersionIOS" class="active"><?php echo label('msg_lbl_appversionios')?></label>
                        </div>
					</div>
                    <div class="row">
                       <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit')?>

                            </button>
                            <?php echo $loading_button; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>