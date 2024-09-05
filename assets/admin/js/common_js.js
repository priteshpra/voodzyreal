 /**
 * Purpose : For checking the validations like Empty field validation , Email validation , Mobile phone validation.
 **
 */
window.prevemailid = "";
function readURL(input,id = 'ImagePreivew1') {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('.input_starttime').clockpicker({
    placement: 'bottom',
    align: 'left',
    twelvehour: true
});
$('.input_endtime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: true,
    twelvehour: false
});
function checkValidations(pre_id = ''){
    var is_error = 'no';
    $(pre_id + ' .empty_validation_class').each(function (){
        if($(this).attr('type') == "checkbox"){
          var name = $(this).attr('name');
          var len = $("input[name='" + name + "']:checked").length;
          if(len == 0){
              is_error = 'yes'; 
              if(!$(this).parent().hasClass('invalid_chk')){
                $(this).parent().addClass('invalid_chk');
              }
          }else{
            $(this).parent().removeClass('invalid_chk');
          }
        }else{
          if ($.trim($(this).val()).length == 0) {
              $(this).addClass("invalid");
              is_error = 'yes';
          } else {
              $(this).removeClass("invalid");
          }

        }
    });
    $(pre_id + ' .MobileNo').each(function (){
        if($(this).val() != ""){
          if($(this).val().length < 10){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .FixedLength').each(function (){
        if($(this).val() != ""){
          var flength = $(this).attr('fixedlength');
          if($(this).val().length != flength){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .CustomLength').each(function (){
      if($(this).val() != ""){
          var min = $(this).attr('min');
          var max = $(this).attr('max');
          var len = $(this).val().length;
          if(len < min || max < len){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
      }else{
        if(!$(this).hasClass('empty_validation_class')){
          $(this).removeClass("invalid");
        }
      }
    });

    $(pre_id + ' :input[type="email"]').each(function (){
        if($(this).val() != ""){
          var email = isEmail($(this).val());
          if(!email){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    return is_error;
}

    /**
     * Purpose : combo box check empty validation.
     * 
     * Developer : Nilay
     */
function checkComboBox(field_ids = []){
    var is_error = 'no';
    var field_ids_array_length = field_ids.length;
    for (var i = 0; i < field_ids_array_length; i++) {
        if($('#' + field_ids[i]).length > 0) {
          var field_value = $('#' + field_ids[i]).val();
          if (field_value === ""){
              $("#" + field_ids[i]).parent().find("input").addClass("invalid");
              is_error = 'yes';
          }else{
              $("#" + field_ids[i]).parent().find("input").removeClass("invalid");
          }
        }
    }
    return is_error;
}

/*
Developer Name :Nilay
used for email validation on keypress 
*/
$(":input[type='email']").on("keypress" ,function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    } 
    if ((charCode < 48 && charCode > 32) || (charCode < 64 && charCode > 57) || (charCode < 97 && charCode > 90) || (charCode < 127 && charCode > 122)){      
      if(charCode == 46 || charCode == 95){
          if(charCode == 46 && prevemailid == 46){
            return false;
          }
          prevemailid = charCode;
          return true
      }
      event.preventDefault(); 
      return false;
    }else{
      if(charCode == 64 && $(this).val().indexOf('@') > -1){
          return false;
      }
    prevemailid = charCode;
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take only letters
  */
  $(document).on("keypress" ,".LetterOnly",function (event){
  var charCode = event.which;
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      } 
      if ((charCode < 65 && charCode > 32) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
          event.preventDefault(); 
          return false;
      }else{
      return true;
      }
  });
  /*
  Developer Name :Nilay
  used : take only Numbers
  */
  $(document).on("keypress" ,".NumberOnly",function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      }
      if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
      } 
        if (charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
      
    return true;
  }
  });
    /*
  Developer Name :Nilay
  used : To Upper Case
  */
  $(document).on("keypress" ,".ToUpper",function (event){
    var val = $(this).val();
    var upp = val.toUpperCase();
    $(this).val(upp);
  });
  /*
  Developer Name :Nilay
  used : take Numbers,Letter
  */
  $(document).on("keypress" ,".NumberLetter",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      }
    if (charCode < 48 || (charCode > 57 && charCode < 65) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
        if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
        }      
        event.preventDefault(); 
        return false;
    }else{
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take year Format
  */
  $(document).on("keypress" ,".YearOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
      if(charCode == 0 || charCode == 8 || charCode == 13){
        return true
      }
      if(charCode === 45 && $(this).val().indexOf('-') == -1){
        return true;
      }
        return false;
    }else{
      return true;
    }
});

  /*
  Developer Name :Nilay
  used : take Numbers and dot(.)
  */
  $(document).on("keypress" ,".AmountOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
        if(charCode == 46 && $(this).val().indexOf('.') > -1){
        return false;
      }
    return true;
  }
  });

// Start Advance Search Functions 
    function changeFilter(filter_option =""){
        
          if(filter_option == "Filter")
          { 
        setTimeout(function(){$(".search_action.card-panel input").first().focus();
        }, 500);
            $(".ScrollStyle").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
          } 
        else{
            $(".search_action").find("input[type=text], textarea").not(".select-wrapper input").val("");
            $(".search_action").find("select").val('').material_select();
            $('.search_action input[type="radio"][value="-1"],.search_action input[type="radio"][value="All"]').prop("checked", true);
            $(".ScrollStyle").hide();
            $(".search_action").hide();
            $("button[type='button']").click();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
        }         
    }
    function clearAllFilter(){
          $(".search_action").find("input[type=text],input[type=email],input[type=number],textarea").not(".select-wrapper input").val("");
          $(".search_action").find("select").val('').material_select();
          $("#All").prop("checked", true);
          $("input[name=Profession]").prop("checked", false);
          $("input[name=Requirement]").prop("checked", false);
          $("input[name=ActionType]").prop("checked", false);
          $("#All").prop("checked", true);
          changeFilter('All');
    }
    function field_display(){
        var display_class = ($('#display_action').attr('class'));
         if($('#display_action').hasClass('mdi-hardware-keyboard-arrow-down')){
            setTimeout(function(){
              $(".search_action.card-panel input").first().focus();
            }, 500);
            $("#Filter").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
        }else{
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
            clearAllFilter();
            return;
        }
        $(".ScrollStyle").toggle();
        $(".search_action").toggle();
    }
// End Advance Search Functions
// Start Image upload Chnages 
$("input.images[type='file']").on("change" ,function (event){
  var cross = $(this).attr('data-cross');
  var img = $(this).attr('data-img');
  var edit = $(this).attr('data-edit');
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
        alertify.error("Upload only .jpeg, .png, .jpg formats");
        $(this).val('');
        $('#'+cross).addClass('hide');
        $('#'+edit).val('');
        var path = base_url+"assets/admin/img/noimage.gif";
        $('#'+img).attr("src",path);
        return false;
    }else{
        $('#'+cross).removeClass('hide');
        readURL(this,img);
    }
  }
});
$("input.file.document").on("change" ,function (event){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['png','jpg','jpeg','pdf','doc','docx']) == -1) {
      alertify.error("Upload only .jpeg, .png, .jpg, .pdf, .doc, .docx formats");
      $(this).val('');
      $("#editImageURL").val('');
      return false;
    }
});
$(".cross1").click(function() {
  var img = $(this).attr('data-img');
  var file = $(this).attr('data-file');
  var edit = $(this).attr('data-edit');

  var path = base_url+"assets/admin/img/noimage.gif";
  $('#'+file).val('');
  $('#'+edit).val('');
  $('#'+img).attr("src",path);
  $(this).addClass('hide');
  });
  $(".cross2").click(function() {
  var img = $(this).attr('data-img');
  var file = $(this).attr('data-file');
  var edit = $(this).attr('data-edit');

  var path = base_url+"assets/admin/img/noimage.gif";
  $('#'+file).val('');
  $('#'+edit).val('');
  $('#'+img).attr("src",path);
  $(this).addClass('hide');
  });
// End 
function isEmail(Email){
    var re = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var flag = re.test(Email);
	  return flag;
}
function isPassword(Password){
  var digitcount = Password.replace(/[^0-9]/g,"").length;
  var alphacount = Password.replace(/[^a-zA-Z]/g,"").length;
  var specialcount = (Password.match(/[@#$%^&*~`()_+\-=\[\]{};':"\\|,.<>\/?]/g) || []).length;
  if(Password.length < 8){
    return 1;
  }
  if(Password.length > 32){
    return 1;
  }
  if(digitcount == 0 || alphacount == 0 || specialcount == 0){
    return 1;
  }
  return 0;
}

function isUrlValid(url) {
    var re = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
	var flag = re.test(url);
	return flag;
}

/*$("textarea").on("keyup" ,function (event){
  
  var max = $(this).attr('maxlength');
  var mylg = this.value.length;
  if(mylg == 0) {
    $(this).parent().find('p').html('');
    return true;
  }
  var ctxt = "You have used " + this.value.length + " of "+ max +" characters";
  var cnt = $(this).parent().find('p').length;
  if(cnt == 0){
    $(this).parent().append("<p class='txtcheck'></p>");
  }
  $(this).parent().find('p').html(ctxt);
});*/

/*
Developer Name :Nilay
used for mobile on keypress 
*/

$(".MobileNo").on("keypress" ,function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if(charCode == 43 ){
    var cnt = $(this).val().length;
      if(cnt == 0){
        return true;  
      }
    } 
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
     if (charCode == 32) { 
        event.preventDefault();   
     }
      return false;
    }else{
      return true;
    }
  });

/*
Developer Name :Gopi
Convert small Letter into Capital on keyup 
*/
$(document).on("keyup" ,".InputCapital",function (event){
   $(this).val($(this).val().toUpperCase());
});

/*
Developer Name :Gopi
Salary with Comma
*/
$(document).on("keyup" ,".SalaryComma",function (event){

var formatter = new Intl.NumberFormat('en-IN', {
  style: 'decimal',
  currency: 'INR',
  minimumFractionDigits: 0,
});
 var num = $(this).val();
if(num != ""){
  num = num.replace(/,/g, "");
  var d = formatter.format(num);
  $(this).val(d);
  
}
});
function ConverttoNumber(CNumber){
  var num = Number(CNumber.replace(/[^0-9\.-]+/g,""));
  return num;
}
