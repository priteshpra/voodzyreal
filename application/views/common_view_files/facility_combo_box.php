<label for="FacilityID" class="active"><?php echo label('msg_lbl_facility');?></label>

<select id="FacilityID" name="FacilityID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Facility</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->FacilityID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->FacilityID; ?>' <?php echo $sel; ?> > <?php echo $value->FacilityName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>