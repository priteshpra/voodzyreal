<label for="SitesID" class="active">Sites</label>
<select id="SitesID" name="SitesID" class="select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
    ?>
        <option value="" selected="selected">Select Sites</option>
    <?php
    }
    foreach ($all_data as $key => $value) {
        if (isset($all_data[0]->Message)) {
            continue;
        }
        if ($value->VisitorSitesID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
    ?>
        <option value='<?php echo $value->VisitorSitesID; ?>' <?php echo $sel; ?>> <?php echo $value->SiteName; ?></option>
    <?php
    }
    ?>
</select>
<script>
    $(document).ready(function() {
        <?php
        echo "$('#SitesID').select2();";
        ?>
    });
</script>