<label for="citizenparticipationtypeId" class="active"><?php echo label('msg_lbl_citizenparticipationtype');?></label>

<select id="citizenparticipationtypeId" name="citizenparticipationtypeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_citizenparticipationtype');?></option>
        <?php
    }
	
    foreach ($all_citizenparticipationtype as $key => $value) {
		if ($value->citizenparticipationtypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->citizenparticipationtypeId; ?>' <?php echo $sel; ?> > <?php echo $value->citizenparticipationType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>