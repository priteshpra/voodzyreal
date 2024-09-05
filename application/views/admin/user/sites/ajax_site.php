<div id="medication_clone_<?php echo $ID; ?>" class="diagnosis_medication_panel_box medicationAddList">
    <div class="diagnosis_medication_left_panel">
        <div class="input-field col s12 m6">
            <input id="SiteName" name="SiteName[]" type="text" class="empty_validation_class" maxlength="100" />
            <label for="SiteName">Site Name</label>
        </div>
        <div class="input-field col s12 m6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_remarks'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <textarea name="Remarks[]" id="Remarks" maxlength="500" class="materialize-textarea empty_validation_class"><?= @$visitor->Remarks ?></textarea>
            <label for="Remarks"><?php echo label('msg_lbl_remarks') ?></label>
        </div>

        <div class="right add_remove_box">
            <a class="remove_medication btn-floating waves-effect waves-light red"><i class="mdi-content-remove "></i></a>
        </div>
        <div class="clearfix"></div>
    </div>