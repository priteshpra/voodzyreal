<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
        onSet: function( arg ){
        if ( 'select' in arg ){ //prevent closing on selecting month/year
            this.close();
        }
      }
    })
    $('.timep').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        autoclose: true,
        twelvehour: false
    });
    $('.timep').on('change', function() {
        $('.timeplabel').addClass('active');
    });
    $('#ReminderDate').change(function(){
        $('#ReminderTime').val('');
    });
    $('#ReminderTime').change(function(){
        var dt = new Date();
        var ct = dt.getDate() + "-" + (dt.getMonth()+1) + "-" + (dt.getFullYear());
        dtm = dt.getHours()+':'+dt.getMinutes();
        rtime = $('#ReminderTime').val();
        rdate = $('#ReminderDate').val();
        if(rdate <= ct){
            if(rtime < dtm){
                alertify.error("<?php echo label('future_time'); ?>");
                $('#ReminderTime').val('');
                return false;
            }
        }
    });
    // This is for the active textbox
    $(document).ready(function () {
          setTimeout(function(){ $('#Amount').focus(); }, 1100);
          <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>  
      })
               
    window.submitflag = 1;
    $('#button_submit').on('click', function (){  
        var error = checkValidations();	    

        if(error === 'yes'){
				alertify.error("<?php echo label('required_field');?>");
				return false;
        }else{
            if(submitflag == 0){
                return false;
            }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "common/CheckPassCode",
                data:{
                        PassCode:$("#PassCode").val(),
                    },
                success:function(data)
                {
                    submitflag = 1;
                    var obj = JSON.parse(data);
                    if(obj.Result == 'Success'){
                            submitflag = 0;
                            $('#button_submit').addClass('hide');
                            $('#button_submit_loading').removeClass('hide');
                            alertify.success("<?php echo label('please_wait');?>");
                            $('form').submit();
                    }else{
                        alertify.error(obj.Message);
                        if(obj.Logout == 1){
                            setTimeout(function(){
                                window.location = "<?php site_url('logout');?>";
                            });
                        }
                    }
                },
                error:function(data)
                {
                    alertify.error("<?php echo label('Something_went_wrong_contact_to_admin');?>");
                }
            })
        }
        return false;
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