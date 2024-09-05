<label for="VendorID" class="active">Vendor</label>
<select id="VendorID" name="VendorID" class="select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
        ?>
        <option value="" selected="selected">Select Vendor</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if(isset($all_data[0]->Message)){
            continue;
        }
        if ($value->VendorID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->VendorID; ?>' <?php echo $sel; ?> > <?php echo $value->VendorName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        <?php 
        echo "$('#VendorID').select2();";
        ?>
    });
</script>