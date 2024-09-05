<script>
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.ReportType = 'Followup';
    window.CustomStartDate = '';
    window.CustomEndDate = '';

    $(document).ready(function() {
        <?php
        if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        } ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
        ajax_dashboard($("input[name='FilterType']:checked").val());
        ajax_listing(PageSize, CurrentPage);
        leadajax_listing(PageSize, CurrentPage);
    });

    $(document).on("change", "input[type='radio']", function() {
        ajax_dashboard($(this).val());
        ajax_listing(PageSize, CurrentPage);
        leadajax_listing(PageSize, CurrentPage);
    });

    function ajax_dashboard(_FilterType) {
        $.ajax({
            type: "post",
            url: base_url + "admin/admindashboard/ajax_dashboard",
            data: {
                FilterType: _FilterType,
            },
            success: function(data) {
                $('#dashboard_listing').html(data);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    $(document).on("click", ".moreinfo", function() {
        var filter = $(this).attr('data-filter');
        var div = $(this).attr('data-type');
        $("#FilterType").val(filter);
        $("#FilterDiv").val(div);
        $("#dashboardfrm").submit();
    });

    function ajax_listing(PageSize, CurrentPage) {

        var tmp = "( " + ReportType + " - " + FilterType + " )";
        if (ReportType == "Followup") {
            tmp = "( Visitor Follow up - " + FilterType + " )";
        }
        $("#reportlabel").html(tmp);
        $.ajax({
            type: "post",
            url: base_url + "admin/report/report/ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                FilterType: ($("input[name='FilterType']:checked").val()),
                ReportType: ReportType,
                CustomStartDate: CustomStartDate,
                CustomEndDate: CustomEndDate,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function leadajax_listing(PageSize, CurrentPage) {

        var tmp = "( " + FilterType + " )";

        $("#reportlabel").html(tmp);
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/dash_ajax_listing/" + PageSize + "/" + CurrentPage,
            data: {
                FilterType: ($("input[name='FilterType']:checked").val()),
                ReportType: ReportType
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#leadtable_body').html(obj.a);
                $('#lead_table_paging_div').html(obj.b);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    $("#leadtable_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/changeReminderStatus",
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
                leadajax_listing(PageSize, CurrentPage);
            }
        })
    })

    $("#table_body").on('click', '.status_change', function() {
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
                ajax_listing(PageSize, CurrentPage);
            }
        })
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

    $('#lead_table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        leadajax_listing(PageSize, page);
    })


    $('.select-dropdown').on('change', function() {
        PageSize = $(this).val();
        ajax_listing(PageSize, CurrentPage);
        leadajax_listing(PageSize, CurrentPage);
    })

    $("#table_body").on('click', '.feedbackinfo', function() {
        var VisitorID = $(this).attr('data-id');
        var VisitorName = $(this).attr('data-name');

        $.ajax({
            type: "post",
            url: base_url + "admin/userfeedback/getRecordInfo",
            data: {
                VisitorID: VisitorID
            },
            success: function(data) {
                $("#feedbackmodel_title").html(VisitorName);
                $("#feedback_body").html(data);
                $('#FeedbackModal.modal').openModal();
            }
        })
    })

    window.VisitorID = 0;

    $("#table_body").on('click', '.addfeedback', function() {
        $("#AddFeedbackData")[0].reset();
        $('#reasonModal').openModal();
        $('#ProjectID').val($(this).attr('data-project'));
        VisitorID = $(this).attr('data-id');
    })

    $('#button_submitfeedback').on('click', function() {
        var error_combo = checkComboBox(['ProjectID']);
        var error = checkValidations();
        if (error === 'yes' || error_combo === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            var FeedbackID = $('#reasonModal .Feedback:checked').val();
            var Remarks = $('#reasonModal #Remarks').val();
            var ProjectID = $('#reasonModal #ProjectID').val();
            var FeedbackDate = $('#reasonModal #FeedbackDate').val();
            var Type = "Visitor";

            if (VisitorID > 0) {
                $.ajax({
                    type: "post",
                    url: base_url + "admin/userfeedback/addFeedback",
                    data: {
                        FeedbackID: FeedbackID,
                        VisitorID: VisitorID,
                        Remarks: Remarks,
                        ProjectID: ProjectID,
                        FeedbackDate: FeedbackDate,
                        Type: Type
                    },
                    success: function(data) {
                        ajax_listing(PageSize, CurrentPage);
                        $('#reasonModal').closeModal();
                        alertify.success('Feedback added Successfully.');
                    }
                })
            }
        }
    });
</script>