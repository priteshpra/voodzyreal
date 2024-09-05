<select id="ProjectIDByRoleID" name="ProjectIDByRoleID" class="select2_class" onchange="ChangeProjectRole(); ">
<i class="mdi-navigation-arrow-drop-down right"></i>
    <?php
    $sel  = "";
    if ($ProjectID == -1) {
        $sel = "selected=selected";
    }
        ?>
        <option value="" <?php echo $sel;?>>All</option>
        <?php
        foreach ($all_data as $key => $value) {
        if ($value->ProjectID == $ProjectID) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->ProjectID; ?>' <?php echo $sel; ?> > <?php echo $value->Title; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>
