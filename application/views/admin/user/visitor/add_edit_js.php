<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
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

    $(document).ready(function() {

$('#BirthDate').on('input', function () {
    var value = $(this).val();
    if ((value !== '') && (value.indexOf('.') === -1)) {
        $(this).val(Math.max(Math.min(value, 31), -31));
    }
});
$('#AnniversaryDate').on('input', function () {
    var value = $(this).val();
    if ((value !== '') && (value.indexOf('.') === -1)) {
        $(this).val(Math.max(Math.min(value, 31), -31));
    }
});
        setTimeout(function() {
            $('#FirstName').first().click();
        }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })

    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        var error_combo = checkComboBox(['EmployeeID']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
                return false;
            }
            var req = 0;

            var EmailID = $('#EmailID').val();
            if (!isEmail(EmailID) && EmailID != "") {
                alertify.error("<?php echo label('valid_email'); ?>");
                return false;
            }
            var mob = $("#MobileNo").val();
            if (mob.length < 10 || mob.length > 13) {
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('msg_lbl_please_enter_mobileNumber'); ?>");
                return false;
            }

            submitflag == 0;
            $.ajax({
                type: "post",
                url: base_url + "common/CheckPassCode",
                data: {
                    PassCode: $("#PassCode").val(),
                },
                success: function(data) {
                    submitflag = 1;
                    var obj = JSON.parse(data);
                    if (obj.Result == 'Success') {
                        submitflag = 0;
                        $.ajax({
                            // type:"post",
                            // url: "<?php echo base_url(); ?>admin/user/visitor/emailexist",
                            // data:{ 
                            //     EmailID:$("#EmailID").val(),
                            //     MobileNo:$("#MobileNo").val(),
                            //     ID:$("#VisitorID").val(),
                            // },
                            success: function(response) {

                                $('#button_submit').addClass('hide');
                                $('#button_submit_loading').removeClass('hide');
                                alertify.success("<?php echo label('please_wait'); ?>");
                                $('form').submit();

                                // submitflag = 1;
                                // if (response != 1){
                                //     alertify.error(response);
                                //     return false;
                                // }else{
                                //     $('#button_submit').addClass('hide');
                                //     $('#button_submit_loading').removeClass('hide');
                                //     alertify.success("<?php echo label('please_wait'); ?>");
                                //     $('form').submit();
                                // }  
                            }
                        });
                    } else {
                        alertify.error(obj.Message);
                        if (obj.Logout == 1) {
                            setTimeout(function() {
                                window.location = "<?php site_url('logout'); ?>";
                            });
                        }
                    }
                },
                error: function(data) {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                }
            })
        }
        return false;

    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
    $('input[name=VisitorCenter]').on('change', function() {
        if ($(this).val() == 'Premises') {
            $('#outdoordiv').addClass('hide');
            $('#OutDoorLocation').removeClass('empty_validation_class');
            $('#OutDoorLocation').val('');
        } else {
            $('#outdoordiv').removeClass('hide');
            $('#OutDoorLocation').addClass('empty_validation_class');
        }
    });

    function LoadPropertyBasedProject() {
        var val = $("#ProjectID").val();
        var type = $("#ProjectID option[value='" + val + "']").attr('data-type');
        if (type == "Commercial") {
            $("#ResidencyDiv").addClass('hide');
            $("#CommercialDiv").removeClass('hide');
        } else {
            $("#ResidencyDiv").removeClass('hide');
            $("#CommercialDiv").addClass('hide');
        }
    }
    $('#ProjectID').on('change', function() {});

    $('.VisitSource').on('change', function() {
        var selectedLanguage = new Array();
        $('input[name="VisitSource[]"]:checked').each(function() {
            selectedLanguage.push(this.value);
        });
        if (selectedLanguage.length > 0) {
            for (var i = 0; i < selectedLanguage.length; i++) {
                if (selectedLanguage[i] == "Chanel Partners") {
                    $("#Chanel_Partners").attr('checked', true);
                    $(".ChannelPartner").removeClass("hide");
                    $(".ChannelPartner").addClass("show");
                    $("#Reference").attr('checked', false);
                    $(".Reference").removeClass("show");
                    $(".Reference").addClass("hide");
                } else if (selectedLanguage[i] == "Reference") {
                    $("#Chanel_Partners").attr('checked', false);
                    $("#Reference").attr('checked', true);
                    $(".Reference").removeClass("hide");
                    $(".Reference").addClass("show");
                    $(".ChannelPartner").removeClass("show");
                    $(".ChannelPartner").addClass("hide");
                } else {
                    $("#Reference").attr('checked', false);
                    $("#Chanel_Partners").attr('checked', false);
                    $(".ChannelPartner").removeClass("show");
                    $(".ChannelPartner").addClass("hide");
                    $(".Reference").removeClass("show");
                    $(".Reference").addClass("hide");
                }
            }
        } else {
            $(".Reference").removeClass("show");
            $(".Reference").addClass("hide");
            $(".ChannelPartner").removeClass("show");
            $(".ChannelPartner").addClass("hide");
        }
    });

    $(document).ready(function() {
        var selectedLanguage = new Array();
        $('input[name="VisitSource[]"]:checked').each(function() {
            selectedLanguage.push(this.value);
        });
        for (var i = 0; i < selectedLanguage.length; i++) {
            if (selectedLanguage[i] == "Chanel Partners") {
                $("#Chanel_Partners").attr('checked', true);
                $(".ChannelPartner").removeClass("hide");
                $(".ChannelPartner").addClass("show");
                $("#Reference").attr('checked', false);
                $(".Reference").removeClass("show");
                $(".Reference").addClass("hide");
            } else if (selectedLanguage[i] == "Reference") {
                $("#Chanel_Partners").attr('checked', false);
                $("#Reference").attr('checked', true);
                $(".Reference").removeClass("hide");
                $(".Reference").addClass("show");
                $(".ChannelPartner").removeClass("show");
                $(".ChannelPartner").addClass("hide");
            } else {
                $("#Reference").attr('checked', false);
                $("#Chanel_Partners").attr('checked', false);
                $(".ChannelPartner").removeClass("show");
                $(".ChannelPartner").addClass("hide");
                $(".Reference").removeClass("show");
                $(".Reference").addClass("hide");
            }
        }
    });

    $('#ProjectID').on('change', function() {
        var ProjectType = $('option:selected', '#ProjectID').attr('data-type');
        if (ProjectType == 'Residency') {
            $("#House").prop("checked", true);
        } else if (ProjectType == 'Commercial') {
            $("#showroom").prop("checked", true);
        }
    });
</script>