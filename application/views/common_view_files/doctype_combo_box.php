<label for="doctypeId" class="active"><?php echo label('msg_lbl_title_doctype');?></label>

<select id="doctypeId" name="doctypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_title_doctype');?></option>
        <?php
    }
    foreach ($all_doctype as $key => $value) {
        if ($value->doctypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->doctypeId; ?>' <?php echo $sel; ?> > <?php echo $value->docType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>