<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#GroupName').focus(); }, 1100);
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
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
             var id = $('#gid').val();
             var GroupName = $('#GroupName').val();
            if(submitflag == 0){
                return false;
            }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/group/checkDuplicate",
                data:{id:id,GroupName:GroupName},
                success:function(data)
                {
                    submitflag = 1;
                    if(data == 0)
                    {
                        
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                        
                    }
                    else
                    {
                        alertify.error("<?php echo label('group_already_exists');?>");
                        return false;
                    }           
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
    function LoadStatesBasedCountry(){
        
    }
</script>