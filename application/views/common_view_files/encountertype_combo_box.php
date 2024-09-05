<label for="encountertypeId" class="active"><?php echo label('msg_lbl_encountertype');?></label>

<select id="encountertypeId" name="encountertypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Encounter Type</option>
        <?php
    }
    foreach ($all_encountertype as $key => $value) {
        if ($value->encountertypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->encountertypeId; ?>' <?php echo $sel; ?> > <?php echo $value->encounterType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>