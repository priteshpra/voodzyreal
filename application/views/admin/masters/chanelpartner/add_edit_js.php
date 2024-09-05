<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#CountryName').focus(); }, 1100);
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
        var ID = $('#cid').val();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
         else
        {
            if(submitflag == 0){
              return false;
            }
            submitflag == 0;
            $.ajax({
                success:function(data)
                {
                    $('form').submit();       
                }
            });


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