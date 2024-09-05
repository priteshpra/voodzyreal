<script>
$(document).ready(function () {
          setTimeout(function(){ $('#FirstName').focus(); }, 1100);
          <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
            ?>     
            <?php if (isset($this->session->userdata['postsuccess'])) {
             echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
            ?>  
      })
function successalertify() {
       //  alertify.success("Record has been saved successfully.");
       alertify.success("<?php echo label('please_wait');?>");
     }
     
    function capitalize(textboxid, str) {
      // string with alteast one character
      //alert('hi');
      if (str && str.length >= 1)
      {       
          var firstChar = str.charAt(0);
          var remainingStr = str.slice(1);
          str = firstChar.toUpperCase() + remainingStr;
      }
      document.getElementById(textboxid).value = str;
  }
    $('#button_employee_submit').on('click', function ()
    {  
     var field_ids = ['UserlevelId'];
	var combo_box_error = checkComboBox(field_ids);
    var error = checkValidations();  
        
        if(error === 'yes' || combo_box_error =='yes')
        {
            
            alertify.error("<?php echo label('required_field');?>");
              return false;
           
        }
        else
        {
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
            else{
                $('#button_employee_submit').addClass('hide');
               $('#button_submit_loading').removeClass('hide');
               alertify.success("<?php echo label('please_wait');?>");
               $('form').submit();
             }
        }	     
    });
    
    function loadCountryBasedStates()
    {
        var country = $('#CountryID').val();

        $.ajax({
            type: "POST",
            url: "<?php echo $this->config->item('base_url'); ?>admin/masters/city/getStates",
            data: "country_id=" + $('#CountryID').val(),
            success: function (result)
            {
                $('#state_combo_box').html(result);
                $('#state_combo_box').show();
                $('#StateID').select2();
            },
            error: function (result)
            {
                console.log("error" + result);
            }
        });
    }
    
    function loadStateBasedCities()
    {
        var state = $('#StateID').val();

        $.ajax({
            type: "POST",
            url: "<?php echo $this->config->item('base_url'); ?>admin/masters/city/getCities",
            data: "state_id=" + $('#StateID').val(),
            success: function (result)
            {
                $('#city_combo_box').html(result);
                $('#city_combo_box').show();
                $('#CityID').select2();
            },
            error: function (result)
            {
                console.log("error" + result);
            }
        });
    }
$("input.images[type='file']").on("change" ,function (event){
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    alert(ext);
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
     $(document).keypress(function (e) {
            if (e.which == 13) {
                $("#button_employee_submit").click();
                return false;
            }
        });


</script>