<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID . '#document'); ?>"><strong>Customer Document</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/document/<?php echo $Page;?>" enctype="multipart/form-data">

                    <div class="row">
                        <div class="input-field col s12 m12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_title');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Title" name="Title" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="Title"><?php echo label('msg_lbl_title');?></label>
                        </div>
                    </div>
                    <div class="m-t-20">
                        <label class="imageview-label">Upload Doc,Image or Pdf File</label>
                        <div class="file-field input-fieldcol col s12 m12 m-t-10">
                            <input tabindex="999" class="file-path empty_validation_class" id="editImageURL" name="editImageURL" value="" readonly="" type="text">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="ImagePath" id="ImagePath" class="file document"/>
                            </div>
                        </div>
                    </div>

                    <div class="row m-b-0">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($data->Status) && @$data->Status == INACTIVE) {
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
                            <a  href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID. '#document'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>