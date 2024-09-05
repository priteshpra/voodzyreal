<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/project/project/details/'.$ProjectID. '#milestone'); ?>"><strong>MileStone</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/project/milestone/<?php echo $Page;?>">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <input type="hidden" name="ProjectMileStoneID" id="ProjectMileStoneID" value="<?php echo isset($MileStone->ProjectMileStoneID)?$MileStone->ProjectMileStoneID:0;?>" >
                        <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID;?>" >
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_milestone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="MileStone" name="MileStone" value="<?php echo @$MileStone->MileStone;?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                        <label for="MileStone"><?php echo label('msg_lbl_milestone');?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_instalmentno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="InstalmentNo" name="InstalmentNo" value="<?php echo @$MileStone->InstalmentNo;?>" type="text"  maxlength="2" class="NumberOnly empty_validation_class" />
                        <label for="InstalmentNo"><?php echo label('msg_lbl_instalmentno');?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_percentage');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Percentage" name="Percentage" value="<?php echo @$MileStone->Percentage;?>" type="text"  maxlength="2" class="NumberOnly empty_validation_class" />
                        <label for="Percentage"><?php echo label('msg_lbl_percentage');?></label>
                      </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($MileStone->Status) && @$MileStone->Status == INACTIVE) {
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
                            <a  href="<?php echo site_url('admin/project/project/details/'.$ProjectID. '#milestone'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>