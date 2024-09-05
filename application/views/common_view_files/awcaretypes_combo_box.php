<label for="awcareatypeId" class="active"><?php echo label('msg_lbl_awcareatypes');?></label>

<select id="awcareatypeId" name="awcareatypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_awcareatypes');?></option>
        <?php
    }
    foreach ($all_awcaretypes as $key => $value) {
        if ($value->awcareatypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->awcareatypeId; ?>' <?php echo $sel; ?> > <?php echo $value->awcareaType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>