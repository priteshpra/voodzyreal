<label for="VisitorID" class="active"><?php echo label('msg_lbl_visitor');?></label>


<select id="VisitorID" name="VisitorID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Visitor</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->VisitorID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->VisitorID; ?>' <?php echo $sel; ?> > <?php echo $value->Name; ?></option>
      
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>