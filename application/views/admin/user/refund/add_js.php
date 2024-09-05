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
                            $.ajax({
                                type:"post",
                                url: base_url + "admin/user/refund/getReamainingPayment/"+$("#CustomerPropertyID").val()+"/"+$("#RefundID").val(),
                                data:{
                                    },
                              success:function(data)
                                {
                                    submitflag = 1;
                                    var obj = JSON.parse(data);
                                    var tmpamount = ($("#RefundAmount").val()=="")?'0':$("#RefundAmount").val();
                                    var tmpgstamount = ($("#GSTAmount").val()=="")?'0':$("#GSTAmount").val()
                                    var pamount = ConverttoNumber(tmpamount);
                                    var GSTAmount = ConverttoNumber(tmpgstamount);
                                    if(pamount <= obj.RemainingAmount &&  GSTAmount <= obj.RemainingGSTAmount){
                                        $('#button_submit').addClass('hide');
                                        $('#button_submit_loading').removeClass('hide');
                                        alertify.success("<?php echo label('please_wait');?>");
                                        $('form').submit();
                                    }else{
                                        alert('else');
                                        if(pamount <= obj.RemainingAmount){
                                            $("#RefundAmount").addClass("invalid");
                                        }else{
                                            $("#GSTAmount").addClass("invalid");
                                        }
                                            alertify.error("<?php echo label('refundamount_greater_than_reamining');?>");
                                            return false;
                                    }           
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
    function LoadMileStoneBasedProperty(){
    }
    $('input[name=PaymentMode]').on('change',function(){
        if($(this).val() == 'Cheque'){
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').removeClass('hide');
            $('#ChequeNo').addClass('empty_validation_class');
            $('#ChequeNo').val('');
        }
        else{
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
            $('#UTR').val('');
        }
    });
    $('input[name=AmountType]').on('change',function(){
        if($(this).val() == 0){
            $('#PaymentAmountDiv').removeClass('hide');
            $('#GSTAmountDiv').removeClass('hide');
            $('#RefundAmount').addClass('empty_validation_class');
            $('#GSTAmount').addClass('empty_validation_class');
        }else if($(this).val() == 1){
            $('#PaymentAmountDiv').removeClass('hide');
            $('#GSTAmountDiv').addClass('hide');
            $('#RefundAmount').addClass('empty_validation_class');
            $('#GSTAmount').removeClass('empty_validation_class');
            $('#GSTAmount').val('');
        }else{
            $('#PaymentAmountDiv').addClass('hide');
            $('#GSTAmountDiv').removeClass('hide');
            $('#RefundAmount').removeClass('empty_validation_class');
            $('#GSTAmount').addClass('empty_validation_class');
            $('#RefundAmount').val('');
        }
    });
    // $("#RefundAmount").each(function () {
    //     var thisJ = $(this);
    //     var max = thisJ.attr("max") * 1;
    //     var min = thisJ.attr("min") * 1;
    //     var intOnly = String(thisJ.attr("intOnly")).toLowerCase() == "true";
    //         var test = function (str) {
    //         return str == "" || /* (!intOnly && str == ".") || */ ($.isNumeric(str) && str * 1 <= max && str * 1 >= min && (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
    //         // commented out code would allow entries like ".7"
    //     };
    //         thisJ.keydown(function () {
    //             var str = thisJ.val();
    //             if (test(str)) 
    //                 thisJ.data("dwnval", str);
    //         });
    //         thisJ.keyup(function () {
    //             var str = thisJ.val();
    //             if (!test(str)) 
    //                 thisJ.val(thisJ.data("dwnval"));
    //         });
    //     });
    // $("#Percentage").each(function () {
    //     var thisJ = $(this);
    //     var max = thisJ.attr("max") * 1;
    //     var min = thisJ.attr("min") * 1;
    //     var intOnly = String(thisJ.attr("intOnly")).toLowerCase() == "true";
    //         var test = function (str) {
    //         return str == "" || /* (!intOnly && str == ".") || */ ($.isNumeric(str) && str * 1 <= max && str * 1 >= min && (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
    //         // commented out code would allow entries like ".7"
    //     };
    //         thisJ.keydown(function () {
    //             var str = thisJ.val();
    //             if (test(str)) 
    //                 thisJ.data("dwnval", str);
    //         });
    //         thisJ.keyup(function () {
    //             var str = thisJ.val();
    //             if (!test(str)) 
    //                 thisJ.val((thisJ.data("dwnval")));
    //         });
    //     });

    $(document).on("keyup" ,"#Percentage",function (event){
        var per = $(this).val();
        var amount = $("#RemainingPayment").val();
        var paymam = Math.round((amount*per)/100);
        $("#RefundAmount").val(paymam);
        if(!$("#PaymentAmountlbl").hasClass("active")){
            $("#PaymentAmountlbl").addClass("active")
        }
    });
    $(document).on("keyup" ,"#RefundAmount",function (event){
        var paymam = $(this).val();
        var amount = $("#RemainingPayment").val();
        // var per = parseInt((paymam*100)/amount);
        var per = Math.round((paymam*100)/amount);
        $("#Percentage").val(per);
        if(!$("#Percentagelbl").hasClass("active")){
            $("#Percentagelbl").addClass("active")
        }
    });
</script>