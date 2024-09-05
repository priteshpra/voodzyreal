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

    if (<?php echo $this->session->userdata['RoleID']; ?> == "-1") {
        window.EmployeeID = "-1";
    } else {
        window.EmployeeID = '<?php echo $this->session->userdata['UserID']; ?>';
    }

    window.current_page_size = 10;
    window.total_page = 1;
    window.Name = '';
    window.MobileNo = '';
    window.Project = '';
    window.Source = 'All';
    window.FeedbackID = '';
    window.FromDate = "<?php echo date('01-m-Y'); ?>";
    window.EndDate = "<?php echo date('d-m-Y'); ?>";

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/opportunity/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                Name: Name,
                MobileNo: MobileNo,
                Project: Project,
                Source: Source,
                FeedbackID: FeedbackID,
                FromDate: FromDate,
                EndDate: EndDate,
                EmployeeID:EmployeeID
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
        $("#model_title").html("<?php echo label('msg_lbl_opportunity'); ?>");
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

        if (<?php echo $this->session->userdata['RoleID']; ?> == "-1") {
            EmployeeID = $('#UserID').val();
            if (EmployeeID == "Select Employee") {
                EmployeeID = -1;
            } else {
                EmployeeID = $('#UserID').val();
            }
        } else {
            EmployeeID = '<?php echo $this->session->userdata['UserID']; ?>';
        }
        
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })


    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })

    $(".TableBody").on('click', '.feedbackinfo', function() {
        var OpportunityID = $(this).attr('data-id');
        var VisitorName = $(this).attr('data-name');

        $.ajax({
            type: "post",
            url: base_url + "admin/userfeedback/getRecordInfo",
            data: {
                OpportunityID: OpportunityID
            },
            success: function(data) {
                $("#feedbackmodel_title").html(VisitorName);
                $("#feedback_body").html(data);
                $('#FeedbackModal.modal').openModal();
            }
        })
    })

    window.OpportunityID = 0;
    window.Type = '';
    window.submitflag = 1;

    $(".TableBody").on('click', '.addfeedback', function() {
        $("#AddFeedbackData")[0].reset();
        $('#reasonModal').openModal();
        OpportunityID = $(this).attr('data-id');
        Type = $(this).attr('data-type');
    })

    $('#button_submitfeedback').on('click', function() {
        var FeedbackID = $('#reasonModal .Feedback:checked').val();
        var Remarks = $('#reasonModal #Remarks').val();
        var FeedbackDate = $('#reasonModal #FeedbackDate').val();

        var field_ids = ['ProjectID'];
        var combo_box_error = checkComboBox(field_ids);
        var error = checkValidations();
        if (error === 'yes' || combo_box_error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            if (submitflag == 0) {
                return false;
            }
            submitflag == 0;
            var ProjectID = $('#ProjectID').val();
            if (OpportunityID > 0) {
                $.ajax({
                    type: "post",
                    url: base_url + "admin/userfeedback/addFeedback",
                    data: {
                        FeedbackID: FeedbackID,
                        OpportunityID: OpportunityID,
                        Remarks: Remarks,
                        Type: Type,
                        ProjectID: ProjectID,
                        FeedbackDate: FeedbackDate
                    },
                    success: function(data) {
                        var tm = confirm('Do you want to add reminder ?');
                        if (tm) {
                            location.replace("<?php echo site_url("admin/opportunity/addreminder/"); ?>" + OpportunityID);
                        } else {
                            common_ajax(10, 1);
                            $('#reasonModal').closeModal();
                            alertify.success('Feedback added Successfully.');
                        }
                    }
                })
            }
        }
    })

    function LoadPropertyBasedProject() {}

    $(".TableBody").on('click', '.AssignLead', function() {
        var OpportunityID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/assignLead",
            data: {
                OpportunityID: OpportunityID
            },
            success: function(data) {
                alertify.success('Lead Assign Successfully.');
                common_ajax(current_page_size, total_page);
            }
        })
    })
</script>