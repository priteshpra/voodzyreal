<label for="blogpostId" class="active"><?php echo label('msg_lbl_blogpost');?></label>

<select id="blogpostId" name="blogpostId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Blogpost</option>
        <?php
    }
    foreach ($all_blogpost as $key => $value) {
        if ($value->blogpostId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->blogpostId; ?>' <?php echo $sel; ?> > <?php echo $value->title; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>