<label for="GoodsID" class="active">Goods</label>
<select id="GoodsID" name="GoodsID" class="select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
        ?>
        <option value="" selected="selected">Select Goods</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if(isset($all_data[0]->Message)){
            continue;
        }
        if ($value->GoodsID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->GoodsID; ?>' <?php echo $sel; ?> > <?php echo $value->GoodsName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        <?php 
        echo "$('#GoodsID').select2();";
        ?>
    });
</script>