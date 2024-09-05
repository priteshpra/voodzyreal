<select id="<?php echo @$DynamicID; ?>"  name="<?php echo @$DynamicID; ?>" class="<?php echo @$DynamicID; ?>_select2_class">
    <?php
    if ($Selected === 0 || isset($all_data[0]->Message)) {
        ?>
        <option value="00" selected="selected">Select Month</option>
        <?php
        }
        ?>
        <option value='1' <?php if ($Selected==1) echo 'selected=selected'; ?> >January</option>
        <option value='2' <?php if ($Selected==2) echo 'selected=selected'; ?> >February</option>
        <option value='3' <?php if ($Selected==3) echo 'selected=selected'; ?> >March</option>
        <option value='4' <?php if ($Selected==4) echo 'selected=selected'; ?> >April</option>
        <option value='5' <?php if ($Selected==5) echo 'selected=selected'; ?> >May</option>
        <option value='6' <?php if ($Selected==6) echo 'selected=selected'; ?> >June</option>
        <option value='7' <?php if ($Selected==7) echo 'selected=selected'; ?> >July</option>
        <option value='8' <?php if ($Selected==8) echo 'selected=selected'; ?> >August</option>
        <option value='9' <?php if ($Selected==9) echo 'selected=selected'; ?> >September</option>
        <option value='10' <?php if ($Selected==10) echo 'selected=selected'; ?> >October</option>
        <option value='11' <?php if ($Selected==11) echo 'selected=selected'; ?> >November</option>
        <option value='12' <?php if ($Selected==12) echo 'selected=selected'; ?> >December</option>
</select>
<script>
    $(document).ready(function () {
        <?php 
            echo "$('#".@$DynamicID."').select2();";
        ?>
    });
</script>
