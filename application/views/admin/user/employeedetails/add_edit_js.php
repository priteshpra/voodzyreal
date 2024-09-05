<script>
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
        var password_error;
        var error = checkValidations();

        var field_ids = ['RoleID'];
        var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error == 'yes') {

            alertify.error("<?php echo label('required_field'); ?>");
            return false;

        } else {
            if (submitflag == 0) {
                return false;
            }

            var UserID = parseInt($("#UserID").val());

            if (UserID < 0) {
                var password = $('#Password').val();
                var flag = isPassword(password);
                if (flag == 1) {
                    alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit'); ?>");
                    return false;
                }
            }
            var pasc = $("#PassCode").val();
            if (pasc.length != 5) {
                $('#PassCode').addClass('invalid');
                alertify.error("<?php echo label('enter_5_digit_passcode'); ?>");
                return false;
            }

            submitflag = 0;
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>admin/user/employeedetails/email_exists",
                data: {
                    email: $("#Email").val(),
                    contact_no: $("#MobileNo").val(),
                    id: $("#UserID").val(),
                },
                success: function(response) {
                    submitflag = 1;
                    if (response != 1) {
                        alertify.error(response);
                        return false;
                    } else {
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('form').submit();
                    }
                }
            });

        }
        return false;
    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>