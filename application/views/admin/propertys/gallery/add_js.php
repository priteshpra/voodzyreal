<script>

    
    $('#button_submit').on('click', function (){  
        var error = checkValidations();	    
        if(error === 'yes'){
				alertify.error("<?php echo label('required_field');?>");
				return false;
        }else{
            $('#button_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("<?php echo label('please_wait');?>");
            $('form').submit();
        }
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });

</script>