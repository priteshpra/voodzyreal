<label for="diagnosistypeId" class="active"><?php echo label('msg_lbl_diagnosistype');?></label>

<select id="diagnosistypeId" name="diagnosistypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Diagnosis Type</option>
        <?php
    }
    foreach ($all_diagnosistype as $key => $value) {
        if ($value->diagnosistypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->diagnosistypeId; ?>' <?php echo $sel; ?> > <?php echo $value->diagnosisType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>