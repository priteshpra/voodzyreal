<label for="PageID" class="active"><?php echo label('msg_lbl_pagename');?></label>

<select id="PageID" name="PageID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Page</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->PageID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->PageID; ?>' <?php echo $sel; ?> > <?php echo $value->PageName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>