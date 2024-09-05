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
    window.FromDate = "<?php echo date('01-m-Y'); ?>";
    window.EndDate = "<?php echo date('d-m-Y'); ?>";

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/feedback/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                FromDate: FromDate,
                EndDate: EndDate
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
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })


    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })

</script>