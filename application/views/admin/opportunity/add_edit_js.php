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
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })

    $('#Area').on('change', function() {
        var Area = $('#Area').val();
        if (Area == "Others") {
            $('.AreaValue').removeClass('hide');
        } else {
            $('.AreaValue').addClass('hide');
        }
    });

    $('input[name=TypesofRequirement]').on('change', function() {
        var type = $(this).val();

        $('.requirement').attr('checked', false);
        $('.SpecificationData').addClass('hide');
        $('.Specification').attr('checked', false);

        if (type == "Commercial") {
            $(".ResidencyDiv").addClass('hide');
            $(".CommercialDiv").removeClass('hide');
            $(".IndustryDiv").addClass('hide');
            $(".AgricultureDiv").addClass('hide');
        } else if (type == "Industry") {
            $(".IndustryDiv").removeClass('hide');
            $(".CommercialDiv").addClass('hide');
            $(".ResidencyDiv").addClass('hide');
            $(".AgricultureDiv").addClass('hide');
        } else if (type == "Residency") {
            $(".CommercialDiv").addClass('hide');
            $(".IndustryDiv").addClass('hide');
            $(".AgricultureDiv").addClass('hide');
            $(".ResidencyDiv").removeClass('hide');
        } else {
            $(".ResidencyDiv").addClass('hide');
            $(".CommercialDiv").addClass('hide');
            $(".IndustryDiv").addClass('hide');
            $(".AgricultureDiv").removeClass('hide');
        }
    });

    $(document).ready(function() {
        var checkboxes_value = [];
        $('.requirement').each(function() {
            if (this.checked) {
                var type = $(this).val();
                type = type.replace(/ /g, '');
                if ($(this).is(":checked")) {
                    $('#My_' + type).removeClass('hide');
                } else {
                    $('#My_' + type).addClass('hide');
                }
            }
        });

    });

    $('.requirement').on('change', function() {
        var type = $(this).val();
        type = type.replace(/ /g, '');

        if ($(this).is(":checked")) {
            $('#My_' + type).removeClass('hide');
        } else {
            $('#My_' + type).addClass('hide');
        }
    })

    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        
        var error = checkValidations();
        var error_combo = checkComboBox(['EmployeeID','Area']);
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
                            success: function(response) {
                                $('#button_submit').addClass('hide');
                                $('#button_submit_loading').removeClass('hide');
                                alertify.success("<?php echo label('please_wait'); ?>");
                                $('form').submit();
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

    function LoadPropertyBasedProject() {}
</script>