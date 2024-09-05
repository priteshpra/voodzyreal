<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/inward') ?>"><strong><?php echo label('msg_lbl_title_inward')?></strong>
        </a>
    </h4>   
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/inward/'.$page_name) ?>" enctype="multipart/form-data">
            <input id="GoodsReceivedNoteID" name="GoodsReceivedNoteID" value="<?php echo isset($data->GoodsReceivedNoteID)?$data->GoodsReceivedNoteID:0; ?>" type="hidden"/>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="ChallanNo" name="ChallanNo" type="text" class="empty_validation_class" value="<?php echo @$data->ChallanNo; ?>" maxlength="100" />
                    <label for="ChallanNo"><?php echo label('msg_lbl_inward_challanno')?></label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="ChallanDate" id="ChallanDate" class="datepicker empty_validation_class" value="<?php echo @$data->ChallanDate; ?>">
                    <label name="ChallanDate"><?php echo label('msg_lbl_challenDate');?></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$CategoryName; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$projects;?>
                </div>
                <div id="VendorDiv" class="input-field col s12 m6">
                    <?php echo @$Vendor;?> 
                </div>
                <div class="input-field col s12 m6">
                    <input id="TotalPrice" type="text" class="empty_validation_class" name="TotalPrice" value="<?php echo @$data->TotalPrice; ?>"> 
                    <label for="TotalPrice"><?php echo label('msg_lbl_inward_totalprice');?></label>
                </div>
                <?php 
                    if(@$data->ChallanPhotoURL != null && (file_exists(BASEPATH.'../'.INWARD_UPLOAD_PATH.@$data->ChallanPhotoURL))){
                        $path1 = site_url(INWARD_UPLOAD_PATH.$data->ChallanPhotoURL);
                    }else{
                        $path1 = $path = site_url(DEFAULT_IMAGE);
                    }
                ?>
                <div class="m-t-20 col s12 m12">
                    <label class="imageview-label"><?php echo label('msg_lbl_image');?></label>
                    <div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="PhotoURLPreview" src='<?php echo $path1; ?>'>
                            <a id="PhotoURLCross" class="cross1 hide" data-img="PhotoURLPreview" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path " type="text" id="editProfilePicture" name = "editProfilePicture" value='<?php echo @$data->ChallanPhotoURL;?>' readonly/>
                            <div class="btn">
                                <span>File</span>
                                <input  accept="image/*" type="file" name="userfile" id="userfile" class="images" data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture" data-type="image"/>
                          </div>
                        </div>
                    </div>
                </div> 
                <div class="clearfix"></div>
                <?php if(empty(@$data->GoodsReceivedNoteID)) {?>
                    <div class="card-panel">
                        <h4 class="header2 m-0">Item            
                            <div class="right">
                                <!-- <a id="itemcloneclick" class="btn-floating waves-effect waves-light green"><i class="mdi-content-add"></i></a> -->
                            </div>
                        </h4>
                        <div id="item_main" class="row">
                            <div id="item_clone_1" class="item_panel_box">
                                <div class="">
                                    <div class="input-field col s12 m6">
                                        <input id="Qty" type="text" class="empty_validation_class" name="Qty"> 
                                        <label for="Qty"><?php echo label('msg_lbl_inward_qty');?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="Rate" type="text" class="empty_validation_class" name="Rate"> 
                                        <label for="Rate"><?php echo label('msg_lbl_inward_rate');?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="FinalPrice" type="text" class="empty_validation_class" name="FinalPrice"> 
                                        <label for="FinalPrice"><?php echo label('msg_lbl_inward_finalprice');?></label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <?php echo @$UOM; ?>
                                    </div>
                                    <div class="input-field col s12 m6" id="GoodsDiv">
                                        <?php echo @$Goods; ?>
                                    </div>
                                </div>
                                <!-- <div class="right add_remove_box">
                                    <a class="remove_item btn-floating waves-effect waves-light red"><i class="mdi-content-remove "></i></a>
                                </div> -->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php }?>
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
