<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        max: new Date(),
    })
    // This is for the active textbox
    $(document).ready(function() {
        setTimeout(function() {
            $('#FirstName').focus();
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
        var field_ids = ['ProjectID'];
        var combo_box_error = checkComboBox(field_ids);

        var error = checkValidations();
        if (error === 'yes' || combo_box_error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
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
                    var obj = JSON.parse(data);
                    if (obj.Result == 'Success') {
                        $("#paymentflag").val("0");
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('form').submit();
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

    function LoadPropertyBasedProject() {
        if ($("#PropertyDiv").length != 0) {
            $.ajax({
                type: "POST",
                url: base_url + "common/GetProperty/0/" + $('#ProjectID').val(),
                data: {},
                success: function(result) {
                    $('#PropertyDiv').html(result);
                    $('#PropertyDiv').show();
                    $('#PropertyID').material_select();
                },
                error: function(result) {
                    console.log("error" + result);
                }
            });
        }
    }
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
    $(document).on("click", "#IsHold", function() {
        if ($(this).prop('checked')) {
            $("#Amount").val(0);
            $("#GSTAmount").val(0);
            $("#Amount").parent().find("label").addClass("active");
            $("#GSTAmount").parent().find("label").addClass("active");
        } else {
            $("#Amount").val('');
            $("#GSTAmount").val('');
        }
    })
</script>