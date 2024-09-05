<?php //pr($visitor);
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/opportunity/"><strong><?php echo label('msg_lbl_opportunity') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/opportunity/<?php echo $page_name . '/' . @$ID; ?>">
                    <input id="OpportunityID" name="OpportunityID" value="<?php echo @$ID; ?>" type="hidden" />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <?php echo @$employee; ?>
                        </div>
                        <div class="input-field col s12 m6">
                            <textarea name="Remarks" id="Remarks" maxlength="500" class="materialize-textarea empty_validation_class"></textarea>
                            <label for="Remarks"><?php echo label('msg_lbl_remarks') ?></label>
                        </div>
                        <div>
                            <?php foreach ($reason_array as $data) { ?>
                                <input name="Reason" class="Reason" type="radio" id="<?php echo $data->ReasonID; ?>" value="<?php echo $data->ReasonID; ?>" checked="checked">
                                <label for="<?php echo $data->ReasonID; ?>" style="color:#000;"><?php echo $data->Reason; ?></label>
                                <br />
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($visitor->Status) && @$visitor->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/opportunity" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>