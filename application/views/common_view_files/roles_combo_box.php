<label for="RoleID" class="active"><?php echo label('msg_lbl_Role');?></label>
<select id="RoleID" name="RoleID" class="select2_class" style="width:100%;display: none;">
    <?php /*
    if ($selected_role_id === 0) {
        ?>
        <option value="" selected="selected" disabled><?php echo label('msg_lbl_Select_Role');?></option>

        <?php
    }*/ ?>
    <option value="-1" selected="selected">Admin</option>
    <?php
    foreach ($all_roles as $key => $value) {
        if ($value->RoleID === $selected_role_id) {
            $selected = "selected=selected";
        } else {
            $selected = "";
        }
        ?>
        <option id="" value="<?php echo $value->RoleID; ?>" <?php echo $selected; ?>><?php echo trim($value->RoleName); ?>
        </option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>