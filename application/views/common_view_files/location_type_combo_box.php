<label for="LocationTypeID" class="active"><?php echo label('msg_lbl_location');?></label>
<?php //pr($all_locationtype); echo $Selected;exit();?>
<select id="LocationTypeID" name="LocationTypeID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_location_select');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->LocationTypeID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->LocationTypeID; ?>' <?php echo $sel; ?> > <?php echo $value->LocationTypeName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>