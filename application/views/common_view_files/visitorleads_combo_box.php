<label for="ProjectID" class="active">Project</label>
<select id="ProjectID" name="ProjectID" class="select2_class">
    
    <?php
    foreach ($all_data as $key => $value) {
        if (isset($all_data[0]->Message)) {
            continue;
        }
        if ($value->ProjectID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
    ?>
        <option value='<?php echo $value->project; ?>' <?php echo $sel; ?>> <?php echo $value->project; ?></option>
    <?php
    }
    ?>
</select>
<script>
    $(document).ready(function() {
        <?php
        echo "$('#ProjectID').select2();";
        ?>
    });
</script>