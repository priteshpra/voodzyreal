<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/project/project"><strong><?php echo label('msg_lbl_project');?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/project/project/<?php echo $page_name; ?>">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_project_title');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="Title" name="Title" value="<?php echo @$Project->Title; ?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                        <label for="Title"><?php echo label('msg_lbl_project_title');?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Location');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="Location" name="Location" value="<?php echo @$Project->Location; ?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                        <label for="Location"><?php echo label('msg_lbl_Location');?></label>
                      </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <?php echo $group;?>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_atspercentage');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="ATSPercentage" name="ATSPercentage" value="<?php echo @$Project->ATSPercentage; ?>" type="text"  maxlength="2" class="NumberOnly empty_validation_class" />
                            <label for="ATSPercentage"><?php echo label('msg_lbl_atspercentage');?></label>
                        </div>
                        <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_Description');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <textarea name="Description" id="Description" class="empty_validation_class materialize-textarea" maxlength="500"><?php echo @$Project->Description;?></textarea>
                            <label for="Description"><?php echo label('msg_lbl_Description');?></label>
                        </div>   
                        <?php 
                        if($this->UserRoleID == -2 || $this->UserRoleID == -1){?>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_project_prefix');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Prefix" name="Prefix" value="<?php echo @$Project->Prefix; ?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                        <label for="Prefix"><?php echo label('msg_lbl_project_prefix');?></label>
                        </div>   
                        <?php } ?>
                        <div class="col m6 s12 center m-t-20">
                            <span><label><?php echo label('msg_lbl_project_type');?> :</label></span> &nbsp;&nbsp;
                            <input name="ProjectType" type="radio" id="Residency" value="Residency" <?php if(@$Project->ProjectType == "Residency" || !@$Project->ProjectType) echo " checked='checked' " ;?>>
                            <label for="Residency"><?php echo label('msg_lbl_residency');?></label>
                            <input name="ProjectType" type="radio" id="Commercial" value="Commercial" <?php if(@$Project->ProjectType == "Commercial") echo " checked='checked' " ;?>>
                            <label for="Commercial"><?php echo label('msg_lbl_commercial');?></label>  &nbsp;&nbsp;
                        </div>  
                    </div>
                    <div>
                        <div class="col m6 s12 ">
                            <span><label><?php echo label('msg_lbl_type');?> :</label></span> &nbsp;&nbsp;
                            <input name="Type" type="radio" id="New" value="New" <?php if(@$Project->Type == "New" || !@$Project->Type) echo " checked='checked' " ;?>>
                            <label for="New"><?php echo label('msg_lbl_new');?></label>
                            <input name="Type" type="radio" id="InProgress" value="InProgress" <?php if(@$Project->Type == "InProgress") echo " checked='checked' " ;?>>
                            <label for="InProgress"><?php echo label('api_msg_inprogress');?></label>
                            <input name="Type" type="radio" id="Hold" value="Hold" <?php if(@$Project->Type == "Hold") echo " checked='checked' " ;?>>
                            <label for="Hold"><?php echo label('api_msg_hold');?></label>
                            <input name="Type" type="radio" id="Completed" value="Completed" <?php if(@$Project->Type == "Completed") echo " checked='checked' " ;?>>
                            <label for="Completed"><?php echo label('api_msg_completed');?></label>
                        </div>   
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($Project->Status) && @$Project->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/project/project" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>
