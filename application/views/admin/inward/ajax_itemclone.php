<div id="item_clone_<?php echo $ID;?>" class="item_panel_box">
    <div class="">
        <div class="input-field col s12 m6">
        	<input id="Qty<?php echo $ID;?>" type="text" class="empty_validation_class NumberOnly" name="Qty[]"> 
            <label for="Qty<?php echo $ID;?>"><?php echo label('msg_lbl_inward_qty');?></label>
        </div>
        <div class="input-field col s12 m6">
            <input id="Rate<?php echo $ID;?>" type="text" class="empty_validation_class NumberOnly" name="Rate[]"> 
            <label for="Rate<?php echo $ID;?>"><?php echo label('msg_lbl_inward_rate');?></label>
        </div>
        <div class="input-field col s12 m6">
            <?php echo @$UOM; ?>
        </div>
        <div class="input-field col s12 m6" id="GoodsDiv">
            <?php echo @$Goods; ?>
        </div>
    </div>
    <div class="right add_remove_box">
        <a class="remove_item btn-floating waves-effect waves-light red"><i class="mdi-content-remove "></i></a>
    </div>
    <div class="clearfix"></div>
</div>