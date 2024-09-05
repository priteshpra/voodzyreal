<script type="text/javascript">
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })

    $(document).on('click', '.export-excel', function() {
        $("#ExportForm").submit();
    })

    $(document).ready(function() {
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    })

    window.current_page_size = 10;
    window.total_page = 1;
    window.Name = '';
    window.MobileNo = '';
    window.Project = '';
    window.Source = 'All';
    window.FeedbackID = '';
    window.FromDate = "<?php echo date('01-m-Y'); ?>";
    window.EndDate = "<?php echo date('d-m-Y'); ?>";
    window.FilterType = "<?php echo $FilterType; ?>";
    window.EmployeeID = '-1';

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/visitorlost/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                Name: Name,
                MobileNo: MobileNo,
                Project: Project,
                Source: Source,
                FeedbackID: FeedbackID,
                FromDate: FromDate,
                EndDate: EndDate,
                FilterType: FilterType,
                EmployeeID: EmployeeID
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('.TableBody').html(obj.listing);
                $('#table_paging_div').html(obj.pagination);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function() {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_visitor'); ?>");
        common_ajax(current_page_size, total_page);
    })

    $('#select-dropdown').on('change', function() {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#button_submit').on('click', function() {
        Name = $('#Name').val();
        MobileNo = $('#MobileNo').val();
        Project = $('#Project').val();
        Source = $('input[name=Source]:checked').val();
        FeedbackID = $('#FeedbackID').val();
        FromDate = $('#FromDate').val();
        EndDate = $('#EndDate').val();
        EmployeeID = $('#UserID').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })


    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })

    $(".TableBody").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');

        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/changeStatus",
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

    $(".TableBody").on('click', '.info', function() { //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "sssm_visitor";
        var field_name = "VisitorID";
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
                $('#modal1.modal').openModal();
            }
        })
    })


    $(".TableBody").on('click', '.feedbackinfo', function() {
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

    $(".TableBody").on('click', '.addfeedback', function() {
        $("#AddFeedbackData")[0].reset();
        $('#reasonModal').openModal();
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
                        common_ajax(10, 1);
                        $('#reasonModal').closeModal();
                        alertify.success('Feedback added Successfully.');
                    }
                })
            }
        }
    });
</script>