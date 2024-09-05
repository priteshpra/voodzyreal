<script>
    window.medicationclone = 0;

    $(document).on("click", "#medicationcloneclick", function() {
        medicationclone++
        $.ajax({
            type: "post",
            datatype: "html",
            url: base_url + "admin/user/sites/ajax_medicationclone/" + medicationclone,
            data: {},
            success: function(data) {
                $("#medication_main").append(data);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    });

    $(document).on("click", ".remove_diagnosis,.remove_medication,.remove_report", function() {
        $(this).parents(".diagnosis_medication_panel_box").remove();
    });

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
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

    $('.timep').on('change', function() {
        $('.timeplabel').addClass('active');
    });
    $('#ReminderDate').change(function() {
        $('#ReminderTime').val('');
    });

    $('#ReminderTime').change(function() {
        var dt = new Date();
        var ct = dt.getDate() + "-" + (dt.getMonth() + 1) + "-" + (dt.getFullYear());
        dtm = dt.getHours() + ':' + dt.getMinutes();
        rtime = $('#ReminderTime').val();
        rdate = $('#ReminderDate').val();
        /*if(rdate <= ct){
            if(rtime < dtm){
                alertify.error("<?php echo label('future_time'); ?>");
                $('#ReminderTime').val('');
                return false;
            }
        }*/
    });
    // This is for the active textbox
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    });

    window.submitflag = 1;
    $('#button_submit').on('click', function() {
        var error_combo = checkComboBox(['ProjectID', 'EmployeeID']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes') {
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
                    submitflag = 1;
                    var obj = JSON.parse(data);
                    if (obj.Result == 'Success') {
                        submitflag = 0;
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
                    alertify.error("<?php echo label('Something_went_wrong_contact_to_admin'); ?>");
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
</script>