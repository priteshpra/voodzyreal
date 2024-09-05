<label for="imncilistId" class="active"><?php echo label('msg_lbl_imnciList');?></label>

<select id="imncilistId" name="imncilistId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Imnci List</option>
        <?php
    }
    foreach ($all_imncilist as $key => $value) {
        if ($value->imncilistId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->imncilistId; ?>' <?php echo $sel; ?> > <?php echo $value->imnciList; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>