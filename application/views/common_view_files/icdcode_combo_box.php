<label for="ICDCodeID" class="active"><?php echo label('msg_lbl_icdcode');?></label>

<select id="ICDCodeID" name="ICDCodeID" <?php if($disableflag == 1) echo" disabled ";?>  class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select ICDCode</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->ICDCodeID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->ICDCodeID; ?>' <?php echo $sel; ?> > <?php echo $value->ICDCode; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>