<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/uom') ?>"><strong><?php echo label('msg_lbl_title_uom')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/uom/'.$page_name) ?>">
            <input id="UOMID" name="UOMID" value="<?php echo isset($data->UOMID)?$data->UOMID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_uom');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="UOMName" name="UOMName" type="text" class="empty_validation_class NumberLetter" value="<?php echo @$data->UOMName; ?>" maxlength="100" />
                    <label for="UOMName"><?php echo label('msg_lbl_uom')?></label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class=""  name="Status" id="Status"   
                    <?php
                    if (isset($data->Status) && @$data->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>>
                    <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/uom') ?>" class="close-button right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
