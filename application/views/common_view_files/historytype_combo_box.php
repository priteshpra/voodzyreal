<label for="historytypeId" class="active"><?php echo label('msg_lbl_historytype');?></label>

<select id="historytypeId" name="historytypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_historytype');?></option>
        <?php
    }
    foreach ($all_historytype as $key => $value) {
        if ($value->historytypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->historytypeId; ?>' <?php echo $sel; ?> > <?php echo $value->historyType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>