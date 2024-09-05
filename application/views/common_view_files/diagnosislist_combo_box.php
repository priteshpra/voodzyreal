<label for="diagnosislistId" class="active"><?php echo label('msg_lbl_diagnosisList');?></label>

<select id="diagnosislistId" name="diagnosislistId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Diagnosis List</option>
        <?php
    }
    foreach ($all_diagnosislist as $key => $value) {
        if ($value->diagnosislistId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->diagnosislistId; ?>' <?php echo $sel; ?> > <?php echo $value->diagnosisList; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>