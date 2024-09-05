<label for="dischargestatusId" class="active"><?php echo label('msg_lbl_dischargeStatus');?></label>

<select id="dischargestatusId" name="dischargestatusId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Discharge Status</option>
        <?php
    }
    foreach ($all_dischargestatus as $key => $value) {
        if ($value->dischargestatusId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->dischargestatusId; ?>' <?php echo $sel; ?> > <?php echo $value->dischargeStatus; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>