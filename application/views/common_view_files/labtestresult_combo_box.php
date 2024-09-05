<label for="labtestresultId" class="active"><?php echo label('msg_lbl_labtestResult');?></label>

<select id="labtestresultId" name="labtestresultId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Labtest Result</option>
        <?php
    }
    foreach ($all_labtestresult as $key => $value) {
        if ($value->labtestresultId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->labtestresultId; ?>' <?php echo $sel; ?> > <?php echo $value->labtestResult; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>