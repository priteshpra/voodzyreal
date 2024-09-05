<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.ProjectID = -1;
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/document/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    ProjectID: ProjectID
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () {
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {
        ProjectID =  $('#ProjectID').val();  
        current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,total_page);

    })

    $('#select-dropdown').on('change', function () {
        current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,total_page);

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        current_page_size = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(current_page_size,page);
    })
</script>