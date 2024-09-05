<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/project/project/details/' . $ProjectID . '#imagetitle'); ?>"><strong>Image Title</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/project/imagetitle/<?php echo $Page; ?>">
                    <div class="row">
                        <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID; ?>">
                        <input type="hidden" name="PropertyImageTitleID" id="PropertyImageTitleID" value="<?php echo isset($Property->PropertyImageTitleID) ? $Property->PropertyImageTitleID : 0; ?>">
                        <div class="input-field col s12 m6">
                            <input id="Title" name="Title" value="<?php echo @$Property->Title; ?>" type="text" maxlength="100" class="NumberLetter empty_validation_class" />
                            <label for="Title"><?php echo label('msg_lbl_title'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($Property->Status) && @$Property->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo site_url('admin/project/project/details/' . $ProjectID . '#property'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>