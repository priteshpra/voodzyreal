<label for="genderId" class="active"><?php echo label('msg_lbl_gender');?></label>

<select id="genderId" name="genderId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Gender</option>
        <?php
    }
    foreach ($all_genders as $key => $value) {
        if ($value->genderId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->genderId; ?>' <?php echo $sel; ?> > <?php echo $value->gender; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>