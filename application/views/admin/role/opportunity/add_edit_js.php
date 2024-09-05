<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
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
    
    $(document).ready(function () {
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
    })

    $('input[name=TypesofRequirement]').on('change', function() {
        var type = $(this).val();
        if (type == "Commercial") {
            $("#ResidencyDiv").addClass('hide');
            $("#CommercialDiv").removeClass('hide');
        } else {
            $("#ResidencyDiv").removeClass('hide');
            $("#CommercialDiv").addClass('hide');
        }
    })
    
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {   
        var error_combo = checkComboBox(['EmployeeID']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {   
            if(submitflag == 0){
                  return false;
            }
            var  req = 0;
           
            var EmailID = $('#EmailID').val();
            if(!isEmail(EmailID) && EmailID != ""){
                alertify.error("<?php echo label('valid_email');?>");
                return false;
            }
            var mob = $("#MobileNo").val();
            if(mob.length < 10 || mob.length > 13){
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('msg_lbl_please_enter_mobileNumber');?>");
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
                        $.ajax({
                            success:function(response)
                            {
                                $('#button_submit').addClass('hide');
                                $('#button_submit_loading').removeClass('hide');
                                alertify.success("<?php echo label('please_wait');?>");
                                $('form').submit();
                            }
                        });
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
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
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
    
    function LoadPropertyBasedProject(){
    }
</script>
