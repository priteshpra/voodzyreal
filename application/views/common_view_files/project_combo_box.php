<label for="ProjectID" class="active"><?php echo label('msg_lbl_project');?></label>
<select id="ProjectID" name="ProjectID" class="select2_class" <?php if($disabled == 1) echo " disabled ";?> onchange="LoadPropertyBasedProject(); ">
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected">Select Project</option>
        <?php
    }
    if(!empty($all_data))
    foreach ($all_data as $key => $value) {
        if ($value->ProjectID == $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        if($Selected != $value->ProjectID && $OnlyOne == 1 ){
            continue;
        }
        ?>
        <option value='<?php echo $value->ProjectID; ?>' <?php echo @$sel; ?> data-type="<?php echo $value->ProjectType; ?>"> <?php echo @$value->Title; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
            $('select').material_select();
    });
</script>