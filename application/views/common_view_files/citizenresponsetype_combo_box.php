<label for="citizenresponsetypeId" class="active"><?php echo label('msg_lbl_citizenresponsetype');?></label>

<select id="citizenresponsetypeId" name="citizenresponsetypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_citizenresponsetype');?></option>
        <?php
    }
    foreach ($all_citizenresponsetype as $key => $value) {
        if ($value->citizenresponsetypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->citizenresponsetypeId; ?>' <?php echo $sel; ?> > <?php echo $value->citizenresponsetype; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>