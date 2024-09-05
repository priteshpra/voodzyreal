<script type="text/javascript">

    window.current_page_size = 10;
    window.total_page = 1;
    window.Name = '';
    window.MobileNo = '';
    window.Project = '';
    window.Source='All';

    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/notification/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    Name: Name,
                    MobileNo:MobileNo,
                    Project: Project,
                    Source:Source
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
        Name =  $('#Name').val(); 
        MobileNo =  $('#MobileNo').val(); 
        Project =  $('#Project').val(); 
        Source =   $('input[name=Source]:checked').val();
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

    $("#table_body").on('click', '.AssignLead', function(){ 
        var OpportunityID = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/assignLead",
            data: {OpportunityID:OpportunityID},
            success: function (data)
            { 
                common_ajax(current_page_size,total_page);
            }
        })
    })
</script>
