<label for="CustomerPropertyID" class="active"><?php echo label('msg_lbl_property');?></label>

<select id="CustomerPropertyID" <?php if($Selected != 0) echo " disabled "; ?> name="CustomerPropertyID" class="select2_class" onchange="LoadMileStoneBasedProperty();" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Property</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->PropertyID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CustomerPropertyID; ?>' <?php echo $sel; ?> > <?php echo $value->PropertyNo; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>