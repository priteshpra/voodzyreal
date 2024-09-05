<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }

    window.current_page_size = 10;
    window.total_page = 1;
    window.ActivitylogName = '';
    window.StartDate = "<?php echo date('01-m-Y'); ?>";
    window.EndDate = "<?php echo date('d-m-Y'); ?>";
    window.UserID = -1;

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/activitylog/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ActivitylogName: $('#ActivitylogName').val(),
                StartDate: StartDate,
                EndDate: EndDate,
                UserID: UserID
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
        common_ajax(current_page_size, total_page);
    })

    $('#button_submit').on('click', function() {
        var temp = $('#select-dropdown').val();
        StartDate = $('#StartDate').val();
        EndDate = $('#EndDate').val();
        UserID = $('#UserID').val();
        common_ajax(temp, total_page);

    })

    $('#select-dropdown').on('change', function() {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $(document).on('click', '#table_paging_div a.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })
    //---------/end pagiing and search----------//     
</script>