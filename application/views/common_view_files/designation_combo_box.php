<label for="DesignationID" class="active"><?php echo label('msg_lbl_designation');?></label>

<select id="DesignationID" name="DesignationID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0 || $Selected === "0") {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_designation');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->DesignationID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->DesignationID; ?>' <?php echo $sel; ?> > <?php echo $value->Designation; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('#DesignationID').select2();
    });
</script>