<label for="memberId" class="active"><?php echo label('msg_lbl_member');?></label>

<select id="memberId" name="memberId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select member</option>
        <?php
    }
    foreach ($all_member as $key => $value) {
        if ($value->memberId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->memberId; ?>' <?php echo $sel; ?> > <?php echo $value->firstName.' '.$value->lastName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>