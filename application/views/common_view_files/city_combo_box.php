<label for="CityID" class="active"><?php echo label('msg_lbl_city');?></label>
<select id="CityID" name="CityID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select City</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->CityID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CityID; ?>' <?php echo $sel; ?> > <?php echo $value->CityName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>