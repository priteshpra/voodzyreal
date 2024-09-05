<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/inward') ?>"><strong><?php echo label('msg_lbl_title_inward')?></strong>
        </a>
    </h4>   
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/inward/'.$page_name) ?>" enctype="multipart/form-data">
            <input id="GoodsReceivedItemID" name="GoodsReceivedItemID" value="<?php echo isset($data->GoodsReceivedItemID)?$data->GoodsReceivedItemID:0; ?>" type="hidden"/>
            <input id="GoodsReceivedNoteID" name="GoodsReceivedNoteID" value="<?php echo isset($data->GoodsReceivedNoteID)?$data->GoodsReceivedNoteID:0; ?>" type="hidden"/>
            <div class="row">
                <div id="item_main" class="row">
                    <div id="item_clone_1" class="item_panel_box">
                        <div class="">
                            <div class="input-field col s12 m6">
                                <input id="Qty" type="text" class="empty_validation_class" name="Qty" value="<?php echo @$data->Qty; ?>"> 
                                <label for="Qty"><?php echo label('msg_lbl_inward_qty');?></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="Rate" type="text" class="empty_validation_class" name="Rate" value="<?php echo @$data->Rate; ?>"> 
                                <label for="Rate"><?php echo label('msg_lbl_inward_rate');?></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="FinalPrice" type="text" class="empty_validation_class" name="FinalPrice" value="<?php echo @$data->FinalPrice; ?>"> 
                                <label for="FinalPrice"><?php echo label('msg_lbl_inward_finalprice');?></label>
                            </div>
                            <div class="input-field col s12 m6" id="GoodsDiv">
                                <?php echo @$Goods; ?>
                            </div>
                            <div class="input-field col s12 m6">
                                <?php echo @$UOM; ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
                    <a href="<?php echo site_url('admin/inward') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
