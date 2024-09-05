<script>
$(document).ready(function () {
    <?php
    if (isset($this->session->userdata['posterror'])) {
      echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }
    ?>
  });
    // Start : Submit Category validation -- Shaili Shah -- //
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

   function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57)){      
             if (charCode == 32) { 
                evt.preventDefault();   
             }
             if (charCode == 48){
               evt.preventDefault(); 
             }
            return false;
          }else{
        return true;
      }
    }


/*Function For Buutoon click event */

    $('#button_Usersetting_submit').on('click', function ()
    {
        //var error = checkValidations();
        
        if (error === 'yes')
        {
            alertify.error("<?php echo SUCCESS_REQUIRED_MESSEGE; ?>");
            return false;
        }
        else
        {
            $('#button_Usersetting_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("Please wait....");
            $('form').submit();
        }
    });
    //End
  $("input[name='UserType']").click(function(){
   var radio_click = $(this).val();
   //alert(radio_click);
   if ( radio_click == "Vendor" ) {

      $("#member").hide();
      $("#vendor1").show();
      $("#Admin1").hide();

   }

   else if ( radio_click == "Member" ) {

      $("#member").show();
      $("#vendor1").hide();
      $("#Admin1").hide();
   }
   else if ( radio_click == "Admin" ) {

      $("#member").hide();
      $("#vendor1").hide();
      $("#Admin1").show();
   }
  });
</script>