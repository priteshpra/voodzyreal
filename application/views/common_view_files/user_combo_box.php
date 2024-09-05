<label for="UserID" class="active"><?php echo label('msg_lbl_user');?></label>
<select id="UserID" name="UserID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_user');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->UserID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->UserID; ?>' <?php echo $sel; ?> > <?php echo $value->UserType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
    
</script>
