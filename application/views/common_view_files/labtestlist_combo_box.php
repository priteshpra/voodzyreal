<label for="labtestlistId" class="active"><?php echo label('msg_lbl_labtestlist');?></label>

<select id="labtestlistId" name="labtestlistId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Labtest List</option>
        <?php
    }
    foreach ($all_labtestlist as $key => $value) {
        if ($value->labtestlistId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->labtestlistId; ?>' <?php echo $sel; ?> > <?php echo $value->labtestList; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>