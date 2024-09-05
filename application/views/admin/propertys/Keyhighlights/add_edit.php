<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#nearbyspaces'); ?>"><strong>Key High-Lights</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/sales/keyhighlights/<?php echo $Page; ?>">
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <input type="hidden" name="PropertyKeyHighlightsID" id="PropertyKeyHighlightsID" value="<?php echo isset($MileStone->PropertyKeyHighlightsID) ? $MileStone->PropertyKeyHighlightsID : 0; ?>">
                            <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID; ?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_milestone'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Title" name="Title" value="<?php echo @$MileStone->Title; ?>" type="text" maxlength="100" class="empty_validation_class" />
                            <label for="MileStone">Title</label>
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