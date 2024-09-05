<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/project/project/details/' . $ProjectID . '#gallery'); ?>"><strong>Gallery</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/project/gallery/add/<?php echo $ProjectID; ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="m-t-20">
                            <label class="imageview-label">Upload only .jpg and .png formats</label>
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="ImagePreivew" src='<?php echo site_url(DEFAULT_IMAGE); ?>'>
                                <a id="webviewcross" class="cross1" data-img="ImagePreivew" data-file="ImagePath" data-edit="EditImagePath"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="EditImagePath" name="EditImagePath" readonly />
                                <div class="btn">
                                    <span>File</span>
                                    <input accept="image/*" type="file" name="ImagePath" id="ImagePath" class="images" data-cross="webviewcross" data-img="ImagePreivew" data-edit="EditImagePath" />
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 rigth">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/project/project/details/<?php echo $ProjectID . "#gallery"; ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>