<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#Message').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
		if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
        	$('#button_submit').addClass('hide');
			$('#button_submit_loading').removeClass('hide');
			alertify.success("<?php echo label('please_wait');?>");
			$('form').submit();
        }
		return false;
    });
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>