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
            if(($("#PaymentAmount").val()=="" || $("#PaymentAmount").val()==0) && ($("#GSTAmount").val()=="" || $("#GSTAmount").val()==0)){
                alertify.error("Please Enter Amount");
                return false;
            }
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
                                url: base_url + "admin/user/payment/getReamainingPayment/"+$("#CustomerPropertyID").val()+"/"+$("#CustomerPaymentID").val(),
                                data:{
                                    },
                              success:function(data)
                                {
                                    submitflag = 1;
                                    var obj = JSON.parse(data);
                                    var tmpamount = ($("#PaymentAmount").val()=="")?'0':$("#PaymentAmount").val();
                                    var tmpgstamount = ($("#GSTAmount").val()=="")?'0':$("#GSTAmount").val()
                                    var pamount = ConverttoNumber(tmpamount);
                                    var GSTAmount = ConverttoNumber(tmpgstamount);
                                    if(pamount <= obj.RemainingAmount &&  GSTAmount <= obj.RemainingGSTAmount){
                                        var tm =  confirm('Do you want to add reminder ?');
                                        if(tm){
                                            $("#reminderflag").val("1");
                                        }else{
                                            $("#reminderflag").val("0");
                                        }
                                        $('#button_submit').addClass('hide');
                                        $('#button_submit_loading').removeClass('hide');
                                        alertify.success("<?php echo label('please_wait');?>");
                                        $('form').submit();
                                    }
                                    else if(obj.data.IsHold == 1 && obj.data.Amount == 0)
                                    {
                                        alertify.error("<?php echo label('property_on_hold_you_canot_make_payment');?>");
                                            return false;
                                    }
                                    else{
                                        /*if(pamount <= obj.RemainingAmount){
                                            $("#PaymentAmount").addClass("invalid");
                                        }else{
                                            $("#GSTAmount").addClass("invalid");
                                        }
                                        alertify.error("<?php echo label('paymentamount_greater_than_reamining');?>");
                                        return false;*/
                                        var tm =  confirm('Do you want to add reminder ?');
                                        if(tm){
                                            $("#reminderflag").val("1");
                                        }else{
                                            $("#reminderflag").val("0");
                                        }
                                        $('#button_submit').addClass('hide');
                                        $('#button_submit_loading').removeClass('hide');
                                        alertify.success("<?php echo label('please_wait');?>");
                                        $('form').submit();
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
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        }
        else if($(this).val() == 'Online')
        {
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
            $('#UTR').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        }
         else if($(this).val() == 'Cash')
        {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#TypeBankName').addClass('hide');
            $('#TypeBranchName').addClass('hide');
            $('#TypeAccountNo').addClass('hide');

            $('#ChequeNo').removeClass('empty_validation_class');
            $('#BankName').removeClass('empty_validation_class');
            $('#BranchName').removeClass('empty_validation_class');
        }
    });

    $('input[name=AmountType]').on('change',function(){
        if($(this).val() == 0){
            $('#PaymentAmountDiv').removeClass('hide');
            $('#GSTAmountDiv').removeClass('hide');
            $('#PaymentAmount').addClass('empty_validation_class');
            $('#GSTAmount').addClass('empty_validation_class');

            $('#Cash').prop( "disabled", false );
            $('#Cheque').prop( "disabled", false );
            $('#Online').prop( "disabled", false );

            $('#Cheque').prop( "checked", true );

            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
            
        }else if($(this).val() == 1){
            $('#PaymentAmountDiv').removeClass('hide');
            $('#GSTAmountDiv').addClass('hide');
            $('#PaymentAmount').addClass('empty_validation_class');
            $('#GSTAmount').removeClass('empty_validation_class');
            $('#GSTAmount').val('');

            $('#Cash').prop( "disabled",true);
            $('#Cheque').prop( "disabled", false );
            $('#Online').prop( "disabled", false );

            $("#Cash").prop("checked", false);
            $('#Cheque').prop( "checked", true );

            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');

        }else{
            $('#PaymentAmountDiv').addClass('hide');
            $('#GSTAmountDiv').removeClass('hide');
            $('#PaymentAmount').removeClass('empty_validation_class');
            $('#GSTAmount').addClass('empty_validation_class');
            $('#PaymentAmount').val('');

            $('#ChequeNo').removeClass('empty_validation_class');
            $('#BankName').removeClass('empty_validation_class');
            $('#BranchName').removeClass('empty_validation_class');

            $('#Cash').prop( "disabled", false );
            $('#Cheque').prop( "disabled",true);
            $('#Online').prop( "disabled",true);
            
            $('#Cash').prop( "checked", true );
            $('#Cheque').prop( "checked", false );

            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#TypeBankName').addClass('hide');
            $('#TypeBranchName').addClass('hide');
            $('#TypeAccountNo').addClass('hide');
        }
    });
    $(document).on("keyup" ,"#Percentage",function (event){
        var per = $(this).val();
        var amount = $("#RemainingPayment").val();
        var paymam = Math.round((amount*per)/100);
        $("#PaymentAmount").val(paymam);
        if(!$("#PaymentAmountlbl").hasClass("active")){
            $("#PaymentAmountlbl").addClass("active")
        }
    });
    $(document).on("keyup" ,"#PaymentAmount",function (event){
        var paymam = $(this).val();
        var amount = $("#RemainingPayment").val();
        var per = Math.round((paymam*100)/amount);
        $("#Percentage").val(per);
        if(!$("#Percentagelbl").hasClass("active")){
            $("#Percentagelbl").addClass("active")
        }
    });

    $(document).ready(function () {
        var Type=$('input[name=PaymentMode]:checked').val();
        if(Type == 'Cheque'){
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').removeClass('hide');
            $('#ChequeNo').addClass('empty_validation_class');
            $('#ChequeNo').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        }
        else if(Type == 'Online')
        {
            $('#OnlineDiv').removeClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#ChequeNo').removeClass('empty_validation_class');
            $('#IFCCode').val('');
            $('#UTR').val('');
            $('#TypeBankName').removeClass('hide');
            $('#TypeBranchName').removeClass('hide');
            $('#TypeAccountNo').removeClass('hide');
        }
         else if(Type == 'Cash')
        {
            $('#OnlineDiv').addClass('hide');
            $('#ChequeDiv').addClass('hide');
            $('#TypeBankName').addClass('hide');
            $('#TypeBranchName').addClass('hide');
            $('#TypeAccountNo').addClass('hide');

            $('#ChequeNo').removeClass('empty_validation_class');
            $('#BankName').removeClass('empty_validation_class');
            $('#BranchName').removeClass('empty_validation_class');
        }
    });
</script>