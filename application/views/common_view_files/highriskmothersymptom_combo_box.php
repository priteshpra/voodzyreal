<label for="highriskmothersymptomId" class="active"><?php echo label('msg_lbl_title_highriskmothersymptom');?></label>

<select id="highriskmothersymptomId" name="highriskmothersymptomId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Blogpost</option>
        <?php
    }
    foreach ($all_highriskmothersymptom as $key => $value) {
        if ($value->highriskmothersymptomId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->highriskmothersymptomId; ?>' <?php echo $sel; ?> > <?php echo $value->highriskmotherSymptom; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>