
<label for="GroupID" class="active"><?php echo label('msg_lbl_group');?></label>

<select id="GroupID" name="GroupID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Group</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->GroupID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->GroupID; ?>' <?php echo $sel; ?> > <?php echo $value->GroupName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>