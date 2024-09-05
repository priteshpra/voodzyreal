<label for="departmentId" class="active"><?php echo label('msg_lbl_department');?></label>

<select id="departmentId" name="departmentId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Department</option>
        <?php
    }
    foreach ($all_department as $key => $value) {
        if ($value->departmentId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->departmentId; ?>' <?php echo $sel; ?> > <?php echo $value->department; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>