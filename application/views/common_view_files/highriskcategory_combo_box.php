<label for="highriskcategoryId" class="active"><?php echo label('msg_lbl_title_highriskcategory');?></label>

<select id="highriskcategoryId" name="highriskcategoryId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Blogpost</option>
        <?php
    }
    foreach ($all as $key => $value) {
        if ($value->highriskcategoryId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->highriskcategoryId; ?>' <?php echo $sel; ?> > <?php echo $value->highriskcategory; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>