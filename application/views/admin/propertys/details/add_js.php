<script>
    // This is for the active textbox
    $(document).ready(function() {
        setTimeout(function() {
            $('#PropertyNo').focus();
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
        var error = checkValidations();
        var field_ids = ['GroupID'];
        var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error == 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
                return false;
            }
            submitflag == 0;
            $.ajax({
                type: "post",
                url: base_url + "admin/project/property/checkDuplicate",
                data: {
                    ProjectID: $("#ProjectID").val(),
                    PropertyNo: $("#PropertyNo").val(),
                    PropertyID: $("#PropertyID").val()
                },
                success: function(data) {
                    submitflag = 1
                    if (data == 0) {

                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('form').submit();
                    } else {

                        alertify.error(data);
                        return false;
                    }
                }
            });
        }
    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>