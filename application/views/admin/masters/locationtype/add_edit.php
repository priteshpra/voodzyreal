<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/locationtype');?>"><strong><?php echo label('msg_lbl_title_locationtype')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/locationtype/<?php echo $page_name; ?>">
				 <input id="cuid" name="cuid" value="<?php echo isset($locationtype->LocationTypeID)?$locationtype->LocationTypeID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_locationtypename');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LocationTypeName" name="LocationTypeName" type="text" class="empty_validation_class" value="<?php echo @$locationtype->LocationTypeName; ?>"  maxlength="50" />
                            <label for="LocationTypeName"><?php echo label('msg_lbl_locationtypename')?></label>
                        </div>
                        
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($locationtype->Status) && @$locationtype->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status')?></label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit')?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo base_url('admin/masters/locationtype'); ?>" class="right close-button"><?php echo label('msg_lbl_cancel')?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>