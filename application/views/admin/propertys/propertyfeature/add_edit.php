<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#features'); ?>"><strong>Key High-Lights</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/sales/keyhighlights/<?php echo $Page; ?>">
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <input type="hidden" name="PropertyFeaturesID" id="PropertyFeaturesID" value="<?php echo isset($MileStone->PropertyFeaturesID) ? $MileStone->PropertyFeaturesID : 0; ?>">
                            <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID; ?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_milestone'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_milestone'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <select name="FeaturesID" id="FeaturesID" class="empty_validation_class">
                                <?php if ($Features) {
                                    foreach ($Features as $key => $value) { ?>
                                        <option value="<?php echo $value->FeaturesID ?>" <?php echo (@$MileStone->FeaturesID == $value->FeaturesID) ? 'selected' : ''; ?>><?php echo $value->Title ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="MileStone">Features</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($MileStone->Status) && @$MileStone->Status == INACTIVE) {
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
                            <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#highlight'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>