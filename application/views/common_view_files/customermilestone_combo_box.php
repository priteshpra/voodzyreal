<label for="CustomerMileStoneID" class="active"><?php echo label('msg_lbl_milestone');?></label>
<select id="CustomerMileStoneID" <?php if($Selected != 0) { echo " disabled ";} ?> name="CustomerMileStoneID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select MileStone</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->CustomerMileStoneID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CustomerMileStoneID; ?>' <?php echo $sel; ?> > <?php echo $value->InstalmentNo . "." . $value->MileStone; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>