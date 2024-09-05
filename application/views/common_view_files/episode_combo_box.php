<label for="episodeId" class="active"><?php echo label('msg_lbl_episode');?></label>

<select id="episodeId" name="episodeId" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Episode</option>
        <?php
    }
    foreach ($all_episode as $key => $value) {
        if ($value->episodeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->episodeId; ?>' <?php echo $sel; ?> > <?php echo $value->episode; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>