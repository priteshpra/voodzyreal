<label for="CategoryID" class="active">Select a Category</label>
<select id="CategoryID" name="CategoryID" class="select2_class" style="width:100%;display: none;" onchange="ChangeVendor(); ChangeGoods();">
    <?php
    if ($CategoryID === 0) {
        ?>
        <option value="" selected="selected">Select a Category</option>
        <?php
    }
    foreach ($all_data as $key => $value) {

        if ($value->CategoryID == $CategoryID) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CategoryID; ?>' <?php echo $sel; ?> > <?php echo $value->CategoryName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>