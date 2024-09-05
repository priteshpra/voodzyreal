<script>
    window.PageSize = 10;
    window.CurrentPage = 1;
    window.FilterType = "<?php echo $FilterType; ?>";
    window.ReportType = "<?php echo $ReportType; ?>";
    window.CustomStartDate = '';
    window.CustomEndDate = '';

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })

    $(document).ready(function() {
        <?php
        if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        } ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
        ajax_listing(PageSize, CurrentPage);


        $('body').on('click', ".addfeedback", function() {
            //$("#FeedbackModal").modal('open');             
            $('#reasonModal').openModal();
        });

        /* $('body').on('click',".feedbackinfo",function(){
            //$("#FeedbackModal").modal('open');             
            $('#FeedbackModal1').openModal();
             var VisitorID = $(this).attr('data-id');
            var VisitorName = $(this).attr('data-name');
            
            $.ajax({
                type: "post",
                url: base_url + "admin/userfeedback/getRecordInfo",
                data: {VisitorID:VisitorID},
                success: function (data)
                { 
                    $("#feedbackmodel_title").html(VisitorName);
                    $("#feedback_body1").html(data);                    
                   
                }
            })

        });*/

    });

    $("#Followup #table_body").on('click', '.status_change', function() {
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

    $(document).on("change", "input[type='radio']", function() {
        FilterType = $(this).val();
        if (FilterType == "Daily" || FilterType == "Weekly" || FilterType == "Monthly" || FilterType == "Yearly" || FilterType == "Other") {
            if (FilterType == "Other") {
                $("#" + ReportType + " .CustomDateFilter").removeClass("hide");
                return;
            } else {
                $("#" + ReportType + " .CustomDateFilter").addClass("hide");
            }
            ajax_listing(PageSize, CurrentPage);
        }
    });

    $(document).on("click", ".button_submit", function() {
        var error = checkValidations("#" + ReportType);
        if (error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        CustomStartDate = $("#" + ReportType + " #CustomStartDate").val();
        CustomEndDate = $("#" + ReportType + " #CustomEndDate").val();
        var StartArray = CustomStartDate.split('-');
        var EndArray = CustomEndDate.split('-');
        var startdate = new Date(StartArray[2], StartArray[1], StartArray[0], 0, 0, 0, 0);
        var enddate = new Date(EndArray[2], EndArray[1], EndArray[0], 0, 0, 0, 0);
        if (startdate > enddate) {
            alertify.error('Start Date must be greater than End Date');
            return false;
        }
        ajax_listing(PageSize, CurrentPage);
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
                FilterType: FilterType,
                ReportType: ReportType,
                CustomStartDate: CustomStartDate,
                CustomEndDate: CustomEndDate,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#' + ReportType + ' #table_body').html(obj.a);
                $('#' + ReportType + ' #table_paging_div').html(obj.b);
            },
            error: function(data) {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }
    $('.tabs .tabclick').on('click', function() {
        var myid = $(this).attr("href");
        ReportType = myid.replace('#', '');
        FilterType = $("#" + ReportType + " input[type=radio]:checked").val();
        CustomStartDate = $("#" + ReportType + " #CustomStartDate").val();
        CustomEndDate = $("#" + ReportType + " #CustomEndDate").val();
        PageSize = $("#" + ReportType + " #select-dropdown").val();
        ajax_listing(PageSize, CurrentPage);
    });
    $(document).on("click", ".export-excel", function() {
        if (FilterType == "Other") {
            var error = checkValidations("#" + ReportType);
            if (error === 'yes') {
                alertify.error("<?php echo label('required_field'); ?>");
                return false;
            }
            CustomStartDate = $("#" + ReportType + " #CustomStartDate").val();
            CustomEndDate = $("#" + ReportType + " #CustomEndDate").val();
            var StartArray = CustomStartDate.split('-');
            var EndArray = CustomEndDate.split('-');
            var startdate = new Date(StartArray[2], StartArray[1], StartArray[0], 0, 0, 0, 0);
            var enddate = new Date(EndArray[2], EndArray[1], EndArray[0], 0, 0, 0, 0);
            if (startdate > enddate) {
                alertify.error('Start Date must be greater than End Date');
                return false;
            }
        }
        $("#dashboardfrm #ReportType").val(ReportType);
        $("#dashboardfrm #FilterType").val(FilterType);
        CustomStartDate = $("#" + ReportType + " #CustomStartDate").val();
        CustomEndDate = $("#" + ReportType + " #CustomEndDate").val();
        $("#dashboardfrm #CustomStartDate").val(CustomStartDate);
        $("#dashboardfrm #CustomEndDate").val(CustomEndDate);
        $("#dashboardfrm").submit();
    });
    $('.table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

    $('.select-dropdown').on('change', function() {
        PageSize = $(this).val();
        ajax_listing(PageSize, CurrentPage);
    })

    $('body').on('click', '.feedbackinfo', function() {
        var VisitorID = $(this).attr('data-id');
        var OpportunityID = $(this).attr('data-leadid');
        var VisitorName = $(this).attr('data-name');
        var Type = $(this).attr('data-type');

        if (Type == 'Visitor') {
            OpportunityID = 0;
        } else {
            VisitorID = 0;
        }

        $.ajax({
            type: "post",
            url: base_url + "admin/userfeedback/getRecordInfo",
            data: {
                VisitorID: VisitorID,
                OpportunityID: OpportunityID
            },
            success: function(data) {
                /*  $("#feedbackmodel_title").html(VisitorName);
                  $("#feedback_body").html(data);  */
                $('#FeedbackModal1.modal').openModal();
                $("#feedbackmodel1_title").html(VisitorName);
                $("#feedback_body1").html(data);

            }
        })
    });


    window.VisitorID = 0;

    $('#' + ReportType + ' #table_body').on('click', '.addfeedback', function() {
        $("#AddFeedbackData")[0].reset();
        $('#reasonModal').openModal();
        $('#ProjectID').val($(this).attr('data-project'));
        console.log($(this).attr('data-project'));
        VisitorID = $(this).attr('data-id');
    })

    $('#button_submitfeedback').on('click', function() {

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
                    $('#reasonModal').closeModal();
                    alertify.success('Feedback added Successfully.');
                }
            })
        }

    });

    function LoadPropertyBasedProject() {}
</script>