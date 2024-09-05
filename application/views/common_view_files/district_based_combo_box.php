<label for="DistrictID" class="active"><?php echo label('msg_lbl_district');?></label>

<select id="DistrictID" name="DistrictID" class="select2_class" onChange="LoadTalukaBasedDistrict();" style="width:100%;display: none;" >
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected">Select District</option>
        <?php
    }
    else{ ?>
        <option value="">Select District</option>
    <?php }

    foreach ($all_data as $key => $value) {
        if ($value->DistrictID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value="<?php echo $value->DistrictID; ?>" <?php echo $sel; ?> > <?php echo $value->DistrictName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>