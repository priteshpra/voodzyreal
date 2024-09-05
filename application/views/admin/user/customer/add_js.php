<script>

    // This is for the active textbox
    $(document).ready(function () {
          setTimeout(function(){ $('#FirstName').focus(); }, 1100);
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
        var mob = $('#MobileNo').val();
        var count = (mob.match(/0/g) || []).length;
        if(error === 'yes'){
				alertify.error("<?php echo label('required_field');?>");
				return false;
        }else{
            if(submitflag == 0){
              return false;
            }
            var EmailID = $('#EmailID').val();
            // var EmailID = $('#EmailID').val();
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
                            $.ajax({
                                type:"post",
                                url: base_url + "admin/user/customer/EmailMobExist/",
                                data:{
                                        EmailID:$("#EmailID").val(),
                                        MobileNo:$("#MobileNo").val(),
                                        CustomerID:$("#CustomerID").val(),
                                    },
                                success:function(data)
                                {
                                    var obj = JSON.parse(data);
                                    
                                    if(obj.Result == "Success"){
                                        $('#button_submit').addClass('hide');
                                        $('#button_submit_loading').removeClass('hide');
                                        alertify.success("<?php echo label('please_wait');?>");
                                        $('form').submit();
                                    }else{
                                        alertify.error(obj.Message);     
                                    }
                                    return false;
                                },
                                error:function(data)
                                {
                                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                                }
                            })
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

</script>