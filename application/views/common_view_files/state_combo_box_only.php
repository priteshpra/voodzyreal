<label for="StateID" class="active">State</label>
<select id="StateID" name="StateID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select State  </option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->StateID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->StateID; ?>' <?php echo $sel; ?> > <?php echo $value->StateName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>