<label for="MigrationTypeID" class="active"><?php echo label('msg_lbl_MigrationTypeID');?></label>

<select id="MigrationTypeID" name="MigrationTypeID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Coppert Type</option>
        <?php
    }
    foreach ($all_migrationtype as $key => $value) {
        if ($value->MigrationTypeID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->MigrationTypeID; ?>' <?php echo $sel; ?> > <?php echo $value->MigrationType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>