<script type="text/javascript">
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function(arg) {
            if ('select' in arg) { //prevent closing on selecting month/year
                this.close();
            }
        }
    })

    $(document).ready(function() {
        //setTimeout(function(){ $('.search_action .select2_class .select-dropdown').first().click(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        } elseif (isset($this->session->userdata['PostSuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['PostSuccess'] . " ')}, 2000);";
        }
        ?>
    })

    window.current_page_size = 10;
    window.total_page = 1;

    if (<?php echo $this->session->userdata['RoleID']; ?> == "-1" || <?php echo $this->session->userdata['RoleID']; ?> == "-2") {
        window.EmployeeID = "-1";
    } else {
        window.EmployeeID = '<?php echo $this->session->userdata['UserID']; ?>';
    }

    window.Name = '';
    window.EmailID = '';
    window.MobileNo = '';
    window.Profession = '';
    window.Requirement = '';
    window.DesignationID = '-1';
    window.Status = '-1';
    window.LeadType = "All";
    window.Source='All';

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/visitor/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                EmployeeID: EmployeeID,
                Name: Name,
                EmailID: EmailID,
                MobileNo: MobileNo,
                Profession: Profession,
                Requirement: Requirement,
                DesignationID: DesignationID,
                LeadType: LeadType,
                Source:Source
                //Status_search: Status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
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

    $('#button_submit').on('click', function() {

        if (<?php echo $this->session->userdata['RoleID']; ?> == "-1" || <?php echo $this->session->userdata['RoleID']; ?> == "-2") {
            EmployeeID = $('#UserID').val();
            if (EmployeeID == "Select Employee") {
                EmployeeID = -1;
            } else {
                EmployeeID = $('#UserID').val();
            }
        } else {
            EmployeeID = '<?php echo $this->session->userdata['UserID']; ?>';
        }

        Name = $('#Name').val();
        EmailID = $('#EmailID').val();
        MobileNo = $('#MobileNo').val();
        Profession = $('input[name=Profession]:checked').val();
        Requirement = $('input[name=Requirement]:checked').val();
        Source = $('input[name=Source]:checked').val();
        DesignationID = $('#DesignationID').val();
        LeadType = $('input[name=LeadType]:checked').val();

        console.log(LeadType);
        console.log(Requirement);
        console.log(Source);


        //alert(DesignationID);
        //Status = $('input[name="Status_search"]:checked').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#select-dropdown').on('change', function() {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
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

    $("#table_body").on('click', '.info', function() { //$(".info").on('click', function () {
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


    $("#table_body").on('click', '.feedbackinfo', function() {
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
            var ReminderDate = $('#reasonModal #ReminderDate').val();
            var ReminderTime = $('#reasonModal #ReminderTime').val();
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
                        Type: Type,
                        ReminderDate: ReminderDate,
                        ReminderTime: ReminderTime
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

    $("#import_submit").on('click', function() {
        if ($('#importmodal #userfile').val()) {
            $('#importmodal #importform').submit();
        } else {
            alertify.success('Please select file.');
        }
    });

    function LoadPropertyBasedProject() {}
</script>