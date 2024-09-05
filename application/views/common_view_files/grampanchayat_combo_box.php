<label for="grampanchayatId" class="active"><?php echo label('msg_lbl_grampanchayat');?></label>

<select id="grampanchayatId" name="grampanchayatId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_grampanchayat');?></option>
        <?php
    }
    foreach ($all_grampanchayat as $key => $value) {
        if ($value->grampanchayatId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->grampanchayatId; ?>' <?php echo $sel; ?> > <?php echo $value->gramPanchayat; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>