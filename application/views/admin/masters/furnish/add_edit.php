<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/furnish') ?>"><strong><?php echo label('msg_lbl_title_furnish') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/furnish/' . $page_name) ?>">
            <input id="FurnishID" name="FurnishID" value="<?php echo isset($data->FurnishID) ? $data->FurnishID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="FurnishName" name="FurnishName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Title; ?>" maxlength="100" />
                    <label for="AreaName"><?php echo label('msg_lbl_furnish') ?><span style="color:red;">*</span></label>
                </div>
                <!-- <div class="input-field col s12 m6">
                    <?php echo @$State; ?>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$City; ?>
                </div> -->
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/furnish') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>