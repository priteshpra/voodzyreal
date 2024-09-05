<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.Status_search = '-1';

    function ajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/ajax_followup/" + current_page_size + "/" + total_page,
            data: {
                VisitorID: <?php echo $data->VisitorID ?>,
                Status_search: Status_search
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#reminder #table_body').html(obj.a);
                $('#reminder #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function process_ajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/leadajax_listing/" + current_page_size + "/" + total_page,
            data: {
                VisitorID: <?php echo $data->VisitorID ?>,
                Status: Status_search
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#Process #table_body').html(obj.listing);
                $('#Process #table_paging_div').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }


    function sitesajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/sites/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                VisitorID: <?php echo $data->VisitorID ?>,
                Status_search: Status_search
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#sites #table_body').html(obj.a);
                $('#sites #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function leadajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitorlead/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                VisitorID: <?php echo $data->VisitorID ?>,
                Status_search: Status_search
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#visitleads #table_body').html(obj.a);
                $('#visitleads #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function() {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_visitoreminder'); ?>");
        ajax_listing(current_page_size, total_page);
    })

    $('.tabs .tabclick').on('click', function() {
        var myid = $(this).attr("href");
        if (myid == "#sites") {
            current_page_size = $("#sites #PageSize").val();
            total_page = 1;
            sitesajax_listing(current_page_size, total_page);
        } else if (myid == "#reminder") {
            current_page_size = $("#reminder #PageSize").val();
            total_page = 1;
            ajax_listing(current_page_size, total_page);
        } else if (myid == "#visitleads") {
            current_page_size = $("#visitleads #PageSize").val();
            total_page = 1;
            leadajax_listing(current_page_size, total_page);
        } else if (myid == "#Process") {
            current_page_size = $("#Process #PageSize").val();
            total_page = 1;
            process_ajax_listing(current_page_size, total_page);
        }
    });

    $('#sites').on('click', '.pagination_buttons', function() {
        var total_page = $('#sites #PageSize').val();
        var page = $(this).attr('data-page-number');
        sitesajax_listing(total_page, page);
    });

    $('#sites').on('change', '.PageSize', function() {
        var total_page = $(this).val();
        sitesajax_listing(total_page, 1);
    });

    $('#Process').on('change', '.PageSize', function() {
        var total_page = $(this).val();
        process_ajax_listing(total_page, 1);
    });

    $('#visitleads').on('click', '.pagination_buttons', function() {
        var total_page = $('#visitleads #PageSize').val();
        var page = $(this).attr('data-page-number');
        leadajax_listing(total_page, page);
    });

    $('#Process').on('click', '.pagination_buttons', function() {
        var total_page = $('#Process #PageSize').val();
        var page = $(this).attr('data-page-number');
        process_ajax_listing(total_page, page);
    });

    $('#visitleads').on('change', '.PageSize', function() {
        var total_page = $(this).val();
        leadajax_listing(total_page, 1);
    });


    $('#reminder').on('click', '.pagination_buttons', function() {
        var total_page = $('#reminder #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_listing(total_page, page);
    });

    $('#Process').on('click', '.pagination_buttons', function() {
        var total_page = $('#Process #PageSize').val();
        var page = $(this).attr('data-page-number');
        leadajax_listing(total_page, page);
    });


    $('#reminder').on('change', '.PageSize', function() {
        var total_page = $(this).val();
        ajax_listing(total_page, 1);
    })

    $("#reminder #table_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/changeReminderStatus",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);

            }
        })
    })

    $("#sites #table_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/user/sites/changeStatus",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);

            }
        })
    })

    $("#visitleads #table_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitorlead/changeStatus",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);

            }
        })
    })

    $("#reminder #table_body").on('click', '.info', function() {
        var id = $(this).attr('data-id');
        var table_name = "sssm_visitorreminder";
        var field_name = "VisitorReminderID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/getRecordInfo",
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

    $("#sites #table_body").on('click', '.info', function() {
        var id = $(this).attr('data-id');
        var table_name = "ss_visitorsites";
        var field_name = "VisitorSitesID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#model_title").html("<?php echo label('msg_lbl_title_visitorsites'); ?>");
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#visitleads #table_body").on('click', '.info', function() {
        var id = $(this).attr('data-id');
        var table_name = "ss_visitlead";
        var field_name = "VisitLeadID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#model_title").html("Visit Leads");
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $("#reminder #table_body").on('click', '.Reminder_mail', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/sendReminder",
            data: {
                id: id
            },
            success: function(data) {
                alertify.success("Mail sent");
            },
            error: function(data) {
                console.log(data);
            }
        })
    })

    $("#reminder #table_body").on('click', '.Response_mail', function() {
        var id = $(this).attr('data-id');
        $('#vfid').val(id);
        $('#response_modal').openModal();
    });

    $(document).on('click', '.addresponse', function() {
        $("#response_title").html("Add Response");
        var id = $(this).attr('data-id');
        $("#ReminderID").val(id);
        $('.addresponsemodal').openModal();
    });

    $(document).on('click', '#response_button', function() {
        var id = $('#vfid').val();
        var message = $('#Response').val();
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/addResponse",
            data: {
                id: id,
                response: message
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.result == 'Success') {
                    alertify.success(obj.message);
                } else {
                    alertify.success(obj.message);
                }
                $('#response_modal .close').click()
            }
        })
    })

    $(document).on("click", ".changeFilter", function() {
        var filter_option = $(this).val();
        var mydiv = $(this).attr('data-div');
        if (filter_option == "Filter") {
            setTimeout(function() {
                $("#" + mydiv + " .search_action.card-panel input").first().focus();
                //$("#" + mydiv + ' .search_action #PageID').first().select2('open');
            }, 500);
            $("#" + mydiv + " .search_action").show();
            $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down")
            $("#" + mydiv + " #display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else {
            $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
            $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
            $('input[name="Status_search"][value="-1"]').prop("checked", true);
            $("#" + mydiv + " .search_action").hide();
            $("#" + mydiv + " button[type='button']").click();
            $("#" + mydiv + ' #display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#" + mydiv + " #display_action").addClass("mdi-hardware-keyboard-arrow-down");
        }
    });

    $(document).on("click", ".filtercls", function() {
        var mydiv = $(this).attr('data-div');
        if ($('#' + mydiv + ' #display_action').hasClass('mdi-hardware-keyboard-arrow-down')) {
            $("#" + mydiv + " input[value='Filter']").click();
        } else {
            $("#" + mydiv + " input[value='All']").click();
        }
    });

    $(document).on("click", ".clear-all", function() {
        var mydiv = $(this).attr('data-div');
        $("#" + mydiv + " .search_action").find("input[type=text],input[type=email],input[type=number],textarea").val("");
        $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
        $("#" + mydiv + " input[value='All']").click();
    });

    $('#followup_submit').on('click', function() {
        var current_page_size = $('#reminder #select-dropdown').val();
        ajax_listing(current_page_size, total_page);
    })

    $('#reminder #select-dropdown').on('change', function() {
        var total_page = $('#reminder #select-dropdown').val();
        ajax_listing(current_page_size, total_page);
    })

    $('#table_body').on('click', '#reminder .pagination_buttons', function() {
        var total_page = $('#reminder #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_listing(page, total_page);
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
        $("#button_submit_loading").removeClass('hide');
        $("#reminder_submit").addClass('hide');
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
            error: function(data) {
                console.log(data);
            }
        });
    });

    $(document).on('click', '#response_submit', function() {
        if ($("#Response").val() == "") {
            alertify.error('<?php echo label('enter_respose'); ?>')
            return false;
        }
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/addresponse",
            data: {
                ReminderID: $("#ReminderID").val(),
                Response: $("#Response").val(),
            },
            success: function(data) {
                if (data == 1) {
                    alertify.success("<?php echo label('response_added_successfully'); ?>");
                    $(".modal-close").click();
                    $("#Response").val('');
                    $("#button_submit_loading").addClass('hide');
                    $("#reminder_submit").removeClass('hide');
                    $(".txtcheck").remove();
                } else {
                    alertify.error("<?php echo label('please_try_again'); ?>");
                }
            },
        });

    });

    $(document).on('click', '.isidle', function() {
        var ostatus = $("#visidle").val();

        status = (ostatus == 1) ? 0 : 1;
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/visitoridle",
            data: {
                VisitorID: '<?Php echo $VisitorID; ?>',
                Idle: status,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.result == 'Success') {
                    alertify.success(obj.Message);
                    $("#visidle").val(status);
                    if (status == 0) {
                        $('.isidle').find('.tooltipped').removeClass('<?php echo VISITOR_IDLE; ?>');
                        $('.isidle').find('.tooltipped').addClass('<?php echo VISITOR_NOT_IDLE; ?>');
                        $('.isidle').find('.tooltipped').attr('data-tooltip', '<?php echo label("msg_idle"); ?>');
                    } else {
                        $('.isidle').find('.tooltipped').addClass('<?php echo VISITOR_IDLE; ?>');
                        $('.isidle').find('.tooltipped').removeClass('<?php echo VISITOR_NOT_IDLE; ?>');
                        $('.isidle').find('.tooltipped').attr('data-tooltip', '<?php echo label("msg_not_idle"); ?>');
                    }
                } else {
                    alertify.error(obj.Message);
                }
            },
        });

    });
</script>