<script>

    // This is for the active textbox
    $(document).ready(function () {
          setTimeout(function(){ $('#Title').focus(); }, 1100);
          <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>  
      })
               
    
    $('#button_submit').on('click', function (){  
        var error = checkValidations();	    
        if(error === 'yes'){
				alertify.error("<?php echo label('required_field');?>");
				return false;
        }else{
            if($(""))
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
    function LoadMileStoneBasedProperty(){
        if($("#MileStoneDiv").length != 0){
            $.ajax({
                type: "POST",
                url: base_url + "common/GetMileStoneByProperty/0/"+$('#CustomerPropertyID').val(),
                data: {},
                success: function (result){
                    $('#MileStoneDiv').html(result);
                    $('#MileStoneDiv').show();
                    $('#CustomerMileStoneID').material_select();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }
    $('input[name=PaymentMode]').on('change',function(){
        if($(this).val() == 'Cheque'){
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').removeClass('hide');
            $('#IFCCode').removeClass('empty_validation_class');
            $('#ChequeNo').addClass('empty_validation_class');
            $('#ChequeNo').val('');
        }
        else{
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#IFCCode').addClass('empty_validation_class');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
        }
    });

</script>