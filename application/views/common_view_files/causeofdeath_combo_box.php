<label for="<?php echo $ID;?>" class="active"><?php echo label('msg_lbl_causeofdeath');?></label>
<select id="<?php echo $ID;?>" name="<?php echo $ID;?>" class="select2_class" style="width:100%;display: none;" >

    <?php ;
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_causeofdeath');?></option>
    
        <?php

    }
    else{ ?>
        <option value="">Select <?php echo label('msg_lbl_causeofdeath');?></option>
    <?php }
    foreach ($all_data as $key => $value) {
        if ($value->CauseOfDeathID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CauseOfDeathID; ?>' <?php echo $sel; ?> > <?php echo $value->CauseofDeath; ?></option>
        <?php
    }
    ?>
</select>