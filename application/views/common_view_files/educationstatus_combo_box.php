<label for="EducationStatusID" class="active"><?php echo label('msg_lbl_educationstatus');?></label>

<select id="EducationStatusID" name="EducationStatusID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Education Status</option>
        <?php
    }
    foreach ($all_member as $key => $value) {
        if ($value->EducationStatusID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->EducationStatusID; ?>' <?php echo $sel; ?> > <?php echo $value->EducationStatus;?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>