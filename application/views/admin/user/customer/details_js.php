<script>
    window.submitflag = 1;
    window.current_page_size = 10;
    window.total_page = 1;
    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
        ajax_property(current_page_size, total_page);
    })

    function ajax_property(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/user/property/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerID: '<?php echo $CustomerID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#property #table_body').html(obj.a);
                $('#property #table_paging_div').html(obj.b);
            },
            error: function(data) {
                // console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_process(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/user/customer/processajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerID: '<?php echo $CustomerID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#process #table_body').html(obj.a);
                $('#process #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    $('.tabs .tabclick').on('click', function() {
        var myid = $(this).attr("href");
        if (myid == "#property") {
            current_page_size = $("#property #select-dropdown").val();
            total_page = 1;
            ajax_property(current_page_size, total_page);
        } else if (myid == "#process") {
            current_page_size = $("#process #select-dropdown").val();
            total_page = 1;
            ajax_process(current_page_size, total_page);
        }
    });
    
    $('#select-dropdown').on('change', function() {
        current_page_size = $('#select-dropdown').val();
        ajax_property(current_page_size, 1);
    })

    $('#property').on('click', '.pagination_buttons', function() {
        current_page_size = $('#property #select-dropdown').val();
        total_page = $(this).attr('data-page-number');
        ajax_property(current_page_size, total_page);
    });

    $('#process').on('click', '.pagination_buttons', function(){
        var total_page = $('#process #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_process(total_page,page);
    });

    $('#process #select-dropdown').on('change', function () {
        var page = $('#process #select-dropdown').val();
        ajax_process(page,total_page);
    })

    $("#property #table_body ").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#property #row_' + tr_id).find('.status .' + active_status_icon_class).addClass('hide');
        $('#property #row_' + tr_id).find('.status .' + inactive_status_icon_class).addClass('hide');
        $('#property #row_' + tr_id).find('.status .' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type: "post",
            url: base_url + "admin/user/property/changeStatus",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#property #row_' + tr_id).find('.status .' + active_status_icon_class).removeClass('hide');
                    $('#property #row_' + tr_id).find('.status .' + inactive_status_icon_class).addClass('hide');
                    $('#property #row_' + tr_id).find('.status .' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#property #row_' + tr_id).find('.status .' + active_status_icon_class).addClass('hide');
                    $('#property #row_' + tr_id).find('.status .' + inactive_status_icon_class).removeClass('hide');
                    $('#property #row_' + tr_id).find('.status .' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);
            }
        })
    })

    $("#property #table_body").on('click', '.info', function() {
        $("#model_title").html("Customer Property");
        var id = $(this).attr('data-id');
        var table_name = "sssm_customerproperty";
        var field_name = "CustomerPropertyID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/property/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })
    $(document).on('click', '.reminderbtn', function() {
        var type = $(this).attr('data-type');
        var user = $(this).attr('data-user');
        var id = $(this).attr('data-id');
        $("#ActionType").val(type);
        $("#ID").val(id);
        $("#ActionUser").val(user);
        if (type == "SMS") {
            $("#Subjectdiv").addClass('hide');
            $("#attenchmentdiv").addClass('hide');
            $("#reminder_title").html("Send SMS");
        } else {
            $("#Subjectdiv").removeClass('hide');
            $("#attenchmentdiv").removeClass('hide');
            $("#reminder_title").html("Send Mail");
        }
        $('.reminderpopup').openModal();
    });
    $(document).on('click', '#reminder_submit', function() {
        if ($("#ActionType").val() == "SMS") {
            if ($("#Message").val() == "") {
                $("#Message").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_message'); ?>');
                return false;
            } else {
                $("#Message").removeClass("invalid");
            }
        } else {
            if ($("#Subject").val() == "") {
                $("#Subject").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_subject'); ?>');
                return false;
            } else {
                $("#Subject").removeClass("invalid");
            }
            if ($("#Message").val() == "") {
                $("#Message").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_message'); ?>');
                return false;
            } else {
                $("#Message").removeClass("invalid");
            }

        }
        //var jdata = '{"method":"addReminderAction","body":{"ID":"' + $("#ID").val() +'","ActionType":"'+$("#ActionType").val()+'","Message":"'+$("#Message").val()+'", "Subject":"'+$("#Subject").val()+'","UserID":"<?php echo @$this->session->userdata['UserID']; ?>","ActionUser":"'+$("#ActionUser").val()+'","UserType":"Admin Web"}}';
        $("#button_submit_loading").removeClass('hide');
        $("#reminder_submit").addClass('hide');
        //var formData = new FormData($('#reminderform'));
        // var formData = new FormData();
        // formData.append('ImageData', $('#ImageData')[0].files[0]);
        // formData.append('ID', $("#ID").val());
        // formData.append('ActionType', $("#ActionType").val());
        // formData.append('Message', $("#Message").val());
        // formData.append('Subject', $("#Subject").val());
        // formData.append('UserID', $("#UserID").val());
        // formData.append('ActionUser', $("#ActionUser").val());
        // formData.append('UserType', $("#UserType").val());
        var form = $('form#reminderform')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);

        $.ajax({
            type: "post",
            url: base_url + "api/service",
            data: formData,
            dataType: "json",
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.addReminderAction.Error == 200) {
                    alertify.success(data.addReminderAction.Message);
                } else {
                    alertify.error(data.addReminderAction.Message);
                }
                $(".modal-close").click();
                $("#Subject").val('');
                $("#Message").val('');
                $("#ImageData").val('');
                $("#editImageURL").val('');
                $("#button_submit_loading").addClass('hide');
                $("#reminder_submit").removeClass('hide');
            },
        });
    });
    $(document).on('click', '#cancel_submit', function() {
        var error = checkValidations('#CancelPropertyModal');
        if (error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        if (submitflag == 0) {
            return false;
        }
        submitflag == 0;

        if ($("#IsCancelFee").prop("checked")) {
            var IsCancelFee = 1;
        } else {
            var IsCancelFee = 0;
        }

        $.ajax({
            type: "post",
            url: base_url + "admin/user/property/CancelProperty",
            data: {
                CustomerPropertyID: $("#CustomerPropertyID").val(),
                IsCancelFee: IsCancelFee,
                Reason: $("#Reason").val(),
                CancelFeeAmount: $("#CancelFeeAmount").val(),
                RefundAmount: $("#RefundAmount").val(),
                RefundGSTAmount: $("#RefundGSTAmount").val(),
            },
            success: function(data) {
                submitflag = 1;
                if (data == 1) {
                    $(".modal-close").click();
                    $("#TotalAmount").html('');
                    $("#PayedAmount").html('');
                    $("#TotalGST").html('');
                    $("#PayedGST").html('');
                    $("#Reason").val();
                    $("#IsCancelFee").prop("checked", true);
                    $("#CancelFeeAmount").val('');
                    alertify.success("<?php echo label('property_cancelled_successfully.'); ?>");
                    current_page_size = $("#property #select-dropdown").val();
                    total_page = 1;
                    ajax_property(current_page_size, total_page);
                } else {
                    alertify.error("<?php echo label('please_try_again'); ?>");
                }
            },
        });

    });
    window.Locaion = 25000;
    $(document).on('click', '.CancelProperty', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            // datatype:"JSON",
            url: base_url + "admin/user/property/GetPropertyByID/" + id,
            data: {},
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.data.hasOwnProperty('CustomerPropertyID')) {
                    $("#CustomerPropertyID").val(obj.data.CustomerPropertyID);
                    $("#TotalAmount").html(obj.data.Amount);
                    $("#PayedAmount").html(obj.data.TotalPayment);
                    $("#TotalGST").html(obj.data.GSTAmount);
                    $("#PayedGST").html(obj.data.TotalGSTPayment);
                    $("#TotalPayedAmount").val(obj.data.TotalRemTotalPayment);
                    $("#TotalPayedGSTAmount").val(obj.data.TotalGSTPayment);
                    $("#RefundAmount").val(obj.data.TotalRemTotalPayment);
                    $("#RefundGSTAmount").val(obj.data.TotalRemGSTAmount);


                    $("#RefundAmount").parent().find("label").addClass('active');
                    $("#RefundGSTAmount").parent().find("label").addClass('active');
                    $('#CancelPropertyModal').openModal();
                    var maxvalue = parseInt(obj.data.TotalRemTotalPayment) + parseInt(obj.data.TotalRemGSTAmount);

                    $("#FrmCancelProperty #CancelFeeAmount").attr('max', maxvalue);
                    $("#FrmCancelProperty #RefundAmount").attr('max', obj.data.TotalRemTotalPayment);
                    $("#FrmCancelProperty #RefundGSTAmount").attr('max', obj.data.TotalRemGSTAmount);
                } else {
                    alertify.error('Customer property not found');
                }

            },
        });

    });
    $(document).on("change", "#IsCancelFee", function() {
        if ($(this).prop("checked")) {
            $("#cancelfeediv").removeClass("hide");
            $("#CancelFeeAmount").addClass("empty_validation_class");
        } else {
            $("#cancelfeediv").addClass("hide");
            $("#CancelFeeAmount").removeClass("empty_validation_class");
            $("#CancelFeeAmount").val('');
        }
    })
    $(document).on("keyup", "#RefundGSTAmount,#RefundAmount", function() {
        var TotalAmount = $("#RefundAmount").val();
        var TotalRemGSTAmount = $("#RefundGSTAmount").val();
        var maxvalue = parseInt(TotalAmount) + parseInt(TotalRemGSTAmount);
        $("#FrmCancelProperty #CancelFeeAmount").attr('max', maxvalue);
        if (maxvalue < $("#FrmCancelProperty #CancelFeeAmount").val()) {
            $("#FrmCancelProperty #CancelFeeAmount").val(0);
        }
    })
    $(document).on("keyup", "#CancelFeeAmount", function() {
        var cancelfees = ($(this).val());
        if (cancelfees == '') {
            cancelfees = 0;
        } else {
            cancelfees = parseInt(cancelfees);
        }
        console.log(cancelfees);
        var TotalAmount = parseInt($("#TotalPayedAmount").val());
        var val = TotalAmount - cancelfees;
        $("#RefundAmount").val(val);
        $("#FrmCancelProperty #RefundAmount").attr('max', val);
    })
</script>