<label for="UOMID" class="active">UOM</label>   
<select id="UOMID"  name="UOMID" class="select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
        ?>
        <option value="" selected="selected">Select UOM</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if(isset($all_data[0]->Message)){
            continue;
        }
        if ($value->UOMID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->UOMID; ?>' <?php echo $sel; ?> > <?php echo $value->UOMName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        <?php 
            echo "$('#UOMID').select2();";
        ?>
    });
</script>
