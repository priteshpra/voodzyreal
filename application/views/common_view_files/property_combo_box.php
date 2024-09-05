<label for="PropertyID" class="active"><?php echo label('msg_lbl_property');?></label>

<select id="PropertyID" <?php if($Selected != 0) { echo " disabled ";} ?> name="PropertyID" class="select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
        ?>
        <option value="" selected="selected">Select Property</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if(isset($all_data[0]->Message)){
            continue;
        }
        if ($value->PropertyID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->PropertyID; ?>' <?php echo $sel; ?> > <?php echo $value->PropertyNo; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        <?php 
        if($Select2 == 0){
            echo "$('select').material_select();";
        }else{
            echo "$('#PropertyID').select2();";
        }
        ?>
    });
</script>