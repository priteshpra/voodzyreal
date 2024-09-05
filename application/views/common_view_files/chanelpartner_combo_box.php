<label for="ChanelPartnerID" class="active">Chanel Partner</label>
<select id="ChanelPartnerID" name="ChanelPartnerID" class="select2_class" style="width:100%;display: none;">
    <?php
    if ($ChanelPartnerID == 0) {
    ?>
        <option value="" selected="selected" disabled>Select Chanel Partner</option>
        <?php
    }
    if (!isset($all_data['0']->Message)) {
        foreach ($all_data as $key => $value) {
            if ($value->ChanelPartnerID == $ChanelPartnerID) {
                $sel = "selected=selected";
            } else {
                $sel = "";
            }
        ?>
            <option value='<?php echo @$value->ChanelPartnerID; ?>' <?php echo $sel; ?>> <?php echo @$value->FirmName . ' (' . @$value->FirstName . ' ' . @$value->LastName . ')'; ?></option>
    <?php
        }
    }
    ?>
</select>

<script>
    $(document).ready(function() {
        $('#ChanelPartnerID').select2();
    });
</script>