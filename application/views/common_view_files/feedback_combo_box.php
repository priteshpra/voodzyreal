<label for="FeedbackID" class="active">Select a Feedback</label>
<select id="FeedbackID" name="FeedbackID" class="select2_class" style="width:100%;display: none;">
    <?php
    if ($FeedbackID === 0) {
        ?>
        <option value="" selected="selected">Select a Feedback</option>
        <?php
    }
    foreach ($all_data as $key => $value) {

        if ($value->FeedbackID == $FeedbackID) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->Feedback; ?>' <?php echo $sel; ?> > <?php echo $value->Feedback; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('#FeedbackID').select2();
    });
</script>