<label for="CoppertTypeID" class="active"><?php echo label('msg_lbl_copperttypeId');?></label>

<select id="CoppertTypeID" name="CoppertTypeID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Coppert Type</option>
        <?php
    }
    foreach ($all_copperttype as $key => $value) {
        if ($value->CoppertTypeID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CoppertTypeID; ?>' <?php echo $sel; ?> > <?php echo $value->CoppertType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>