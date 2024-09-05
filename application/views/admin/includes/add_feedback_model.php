<!-- Modal Structure -->
<div class="admin-table-view-pop-up">
  <div id="reasonModal" class="modal">
    <div class="modal-footer gridhead1 bgglobal">
      <h4 id="addfeedbackmodel_title">Add Feedback</h4>
      <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
    </div>
    <div class="modal-content">
      <form id="AddFeedbackData">
        <label for="ProjectID"><?php echo label('msg_lbl_project') ?></label>
        <input id="ProjectID" name="ProjectID" type="text" class="empty_validation_class" maxlength="100" />
        <label name="FeedbackDate" class="">Feedback Date</label>
        <input type="text" name="FeedbackDate" id="FeedbackDate" value="<?php echo date("d-m-Y"); ?>" class="datepickerval empty_validation_class">
        <br>
        <label for="Remarks" style="font-size: 20px; color: #2e4053;"><?php echo label('msg_lbl_remarks') ?></label>
        <textarea name="Remarks" id="Remarks" maxlength="500" class="materialize-textarea"><?= @$visitor->Remarks ?></textarea>

        <?php foreach ($reason_array as $data) { ?>
          <input name="Feedback" class="Feedback" type="radio" id="<?php echo $data->FeedbackID; ?>" value="<?php echo $data->FeedbackID; ?>" checked="checked">
          <label for="<?php echo $data->FeedbackID; ?>" style="color:#000;"><?php echo $data->Feedback; ?></label>
          <br />
        <?php } ?>
        <div class="row">
          <div class="input-field col s6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_reminderdate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <input type="text" name="ReminderDate" id="ReminderDate" data-mask="__-__-____">
            <label name="ReminderDate"><?php echo label('msg_lbl_reminderdateonly') ?></label>
          </div>
          <div class="input-field col s6">
            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_remindertime'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
            <label class="timeplabel" for="ReminderTime"><?php echo label('msg_lbl_remindertime'); ?></label>
            <input id="ReminderTime" name="ReminderTime" data-mask="__:__" type="text">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-content">
      <button class="btn waves-effect waves-light" type="button" id="button_submitfeedback" name="button_submitfeedback"><?php echo label('msg_lbl_submit'); ?>
      </button>
    </div>
  </div>
</div>

<script>
  Array.prototype.forEach.call(document.body.querySelectorAll("*[data-mask]"),applyDataMask);

  function applyDataMask(field) {
    var mask = field.dataset.mask.split('');

    // For now, this just strips everything that's not a number
    function stripMask(maskedData) {
      function isDigit(char) {
        return /\d/.test(char);
      }
      return maskedData.split('').filter(isDigit);
    }

    // Replace `_` characters with characters from `data`
    function applyMask(data) {
      return mask.map(function(char) {
        if (char != '_') return char;
        if (data.length == 0) return char;
        return data.shift();
      }).join('')
    }

    function reapplyMask(data) {
      return applyMask(stripMask(data));
    }

    function changed() {
      var oldStart = field.selectionStart;
      var oldEnd = field.selectionEnd;

      field.value = reapplyMask(field.value);

      field.selectionStart = oldStart;
      field.selectionEnd = oldEnd;
    }

    field.addEventListener('click', changed)
    field.addEventListener('keyup', changed)
  }
</script>