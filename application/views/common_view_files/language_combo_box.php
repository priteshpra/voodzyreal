<label for="LanguageID" class="active"><?php echo label('msg_lbl_Language');?></label>

<select id="LanguageID" name="LanguageID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_Select_Language');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->LanguageID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->LanguageID; ?>' <?php echo $sel; ?> > <?php echo $value->Language; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>