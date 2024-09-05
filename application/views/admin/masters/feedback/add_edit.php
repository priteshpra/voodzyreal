<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/feedback') ?>"><strong><?php echo label('msg_lbl_title_feedback')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/feedback/'.$page_name) ?>">
            <input id="FeedbackID" name="FeedbackID" value="<?php echo isset($data->FeedbackID)?$data->FeedbackID:0; ?>" type="hidden"  />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="Feedback" name="Feedback" type="text" class="empty_validation_class NumberLetter" value="<?php echo @$data->Feedback; ?>" maxlength="100" />
                    <label for="Feedback"><?php echo label('msg_lbl_feedback')?><span style="color:red;">*</span></label>
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
                    <a href="<?php echo site_url('admin/masters/feedback') ?>" class="close-button right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
