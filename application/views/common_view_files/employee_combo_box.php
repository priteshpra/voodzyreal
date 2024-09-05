<label for="UserID" class="active"><?php echo label('msg_lbl_employee');?></label>

<select id="UserID" name="UserID" class="UserID" style="width:100%;display: none;">
    <?php
    if ($Selected === 0) {
        ?>
        <option value="Select Employee" selected="selected">Select Employee</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->UserID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->UserID; ?>' <?php echo $sel; ?> > <?php echo $value->FirstName .' '. $value->LastName; ?></option>
        <?php
    }
    ?>
</select>

<script>
    $(document).ready(function () {
        $('#UserID').select2();
    });
</script>  
