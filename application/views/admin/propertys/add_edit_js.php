<script>
    $(document).ready(function() {
        <?php if ($page_name == 'add') { ?>
            setTimeout(function() {
                $('.select2_class .select-dropdown').first().click();
            }, 1100);
        <?php
        } ?>
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })

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

    $('#button_submit').on('click', function() {
        var field_ids = ['EmployeeID'];
        var combo_box_error = checkComboBox(field_ids);

        var error = checkValidations();
        if (error === 'yes' || combo_box_error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            $('#button_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("<?php echo label('please_wait'); ?>");
            $('form').submit();

        }
    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>