<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/inward') ?>"><strong><?php echo label('msg_lbl_title_inward')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/inward/'.$page_name) ?>" enctype="multipart/form-data">
            <div class="row">
                <input id="GoodsReceivedNoteID" name="GoodsReceivedNoteID" value="<?php echo isset($data->GoodsReceivedNoteID)?$data->GoodsReceivedNoteID:0; ?>" type="hidden"/>
                <?php 
                    if(@$data->InvoiceImageURL != null && (file_exists(BASEPATH.'../'.INVOICE_THUMB_UPLOAD_PATH.@$data->InvoiceImageURL))){
                        $path1 = site_url(INVOICE_UPLOAD_PATH.$data->InvoiceImageURL);
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
                            <input tabindex="999" class="file-path empty_validation_class" type="text" id="editProfilePicture" name = "editProfilePicture" value='<?php echo @$data->InvoiceImageURL;?>' readonly/>
                            <div class="btn">
                                <span>File</span>
                                <input  accept="image/*" type="file" name="userfile" id="userfile" class="images" data-cross="PhotoURLCross" data-img="PhotoURLPreview" data-edit="editProfilePicture" data-type="image"/>
                          </div>
                        </div>
                    </div>
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
