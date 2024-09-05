<label for="nipiagegroupId" class="active"><?php echo label('msg_lbl_nipiagegroups');?></label>

<select id="nipiagegroupId" name="nipiagegroupId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_nipiagegroup_select');?></option>
        <?php
    }
    foreach ($all_nipiagegroup as $key => $value) {
        if ($value->nipiagegroupId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->nipiagegroupId; ?>' <?php echo $sel; ?> > <?php echo $value->nipiageGroup; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>