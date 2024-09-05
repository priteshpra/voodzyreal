<script>

    // This is for the active textbox
    $(document).ready(function () {
          setTimeout(function(){ $('#PropertyNo').focus(); }, 1100);
          <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>  
      })
               
    
$("input.images[type='file']").on("change" ,function (event){
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
        alertify.error("Upload only .jpeg, .png, .jpg formats");
        $(this).val('');
        $('.cross1').addClass('hide');
        $("#editImageURL").val('');
        var path ="<?php echo $this->config->item('admin_assets').'images/noimage.gif';?>";
        $("#ImagePreivew").attr("src",path);
        $('.cross1').addClass('hide');
        return false;
    }else{
        $('.cross1').removeClass('hide');
        readURL(this,'ImagePreivew');
    }
  }
  });
$(".cross1").click(function() {
    var path ="<?php echo $this->config->item('admin_assets').'images/noimage.gif';?>";
    $("#editImageURL").val('');
    $("#userfile").val('');
    $("#ImagePreivew").attr("src",path);
    $('.cross1').addClass('hide');
  });

    $('#button_employee_submit').on('click', function ()
    {  
        var password_error;
        var error = checkValidations();	    
        var field_ids = ['UserlevelId'];
	    var combo_box_error = checkComboBox(field_ids);
       
        
        if(error === 'yes' || combo_box_error =='yes')
        {
           /* var mob = $('#MobileNo').val();
			//var count = (mob.match(/0/g) || []).length;
			//alert(count);return false;
			if(mob != ''){
				if(mob.length < 10 || mob.length > 10){
					$('#MobileNo').addClass('invalid');
					alertify.error("<?php echo label('valid_mobileno');?>");
					return false;
				}
				if(count == 10){
					$('#MobileNo').addClass('invalid');
					alertify.error("<?php echo label('valid_mobileno');?>");
					return false;
				}
			}*/
			//else{
				alertify.error("<?php echo label('required_field');?>");
				return false;
			//}
        }
        else
        {
          var password = $('#Password').val();
            

            if($("#Password").val() != undefined){

                var digitcount = password.replace(/[^0-9]/g,"").length;
                var alphacount = password.replace(/[^a-zA-Z]/g,"").length;
                var specialcount = (password.match(/[@#$%^&*~`()_+\-=\[\]{};':"\\|,.<>\/?]/g) || []).length;
                if(password.length < 8 || password.length > 32){
                    alertify.error("<?php echo label('password_8_32_long');?>");
                    return false;
                }
				
                if(digitcount == 0 || alphacount == 0 || specialcount == 0){
                    alertify.error("<?php echo label('min_1_char_spc_digit');?>");
                    return false;
                }
				
            }
             var mob = $("#MobileNo").val();
              var count = (mob.match(/0/g) || []).length;
            if(mob.length < 10 || mob.length > 10){
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('valid_mobileno');?>");
                return false;
            }
            if(count == 10){
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('valid_mobileno');?>");
                return false;
            }
            var pmob = $("#PhoneNo").val();
           var pcount = (pmob.match(/0/g) || []).length;
        
        if(pmob != ''){
            if(pmob.length < 10 || pmob.length > 10){
                    $('#PhoneNo').addClass('invalid');
                    alertify.error("<?php echo label('valid_mobileno');?>");
                    return false;
                }
        if(pcount == 10){
                $('#PhoneNo').addClass('invalid');
                alertify.error("<?php echo label('valid_mobileno');?>");
                return false;
            }
        }
			if(!$("#Email").attr('readonly')){
            $.ajax({
                        type:"post",
                        url: "<?php echo base_url();?>admin/masters/attendee/emailexist",
                        data:{ email:$("#Email").val(),contact_no:$("#MobileNo").val(),user_type:'Employee'},
                        success:function(response)
                        {
                            if (response != 'false') 
                            {
                                alertify.error(response);
                                return false;
                            }
                            else 
                            {
                                $('#button_employee_submit').addClass('hide');
                                $('#button_submit_loading').removeClass('hide');
                                alertify.success("<?php echo label('please_wait');?>");
                                $('form').submit();
                            }  
                        }
                    });
			}
			else{
				$('#button_employee_submit').addClass('hide');
				$('#button_submit_loading').removeClass('hide');
				alertify.success("<?php echo label('please_wait');?>");
				$('form').submit();
			}
            return false;
        }	
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_employee_submit").click();
            return false;
        }
    });

</script>