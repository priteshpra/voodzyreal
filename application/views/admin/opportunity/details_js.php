<script>

    window.current_page_size = 10;
    window.total_page = 1;
    window.Status_search = '-1';
    
    function ajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/ajax_followup/" + current_page_size + "/" + total_page,
            data: {
                    OpportunityID:<?php echo $data->OpportunityID?>,
                    Status_search:Status_search
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#reminder #table_body').html(obj.a);
                $('#reminder #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

     function process_ajax_listing(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/leadajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    OpportunityID:<?php echo $data->OpportunityID?>,
                    Status:Status_search
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#Process #table_body').html(obj.listing);
                $('#Process #table_paging_div').html(obj.pagination);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function () {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_opportunityreminder');?>");
        ajax_listing(current_page_size,total_page);
    })

    $('.tabs .tabclick').on('click', function () {
        var myid = $(this).attr("href");
        if(myid == "#reminder"){
            current_page_size = $("#reminder #PageSize").val();
            total_page = 1;
            ajax_listing(current_page_size,total_page);
        }         
        else if(myid == "#Process"){
            current_page_size = $("#Process #PageSize").val();
            total_page = 1;
            process_ajax_listing(current_page_size,total_page);
        }
    });


    $('#reminder').on('click', '.pagination_buttons', function(){
        var total_page = $('#reminder #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_listing(total_page,page);
    });

    $('#reminder').on('change','.PageSize', function () {
        var total_page = $(this).val();
        ajax_listing(total_page,1);
    })
    
    $("#reminder #table_body").on('click', '.status_change', function(){
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/opportunity/changeReminderStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                alertify.success(obj.message);
            }
        })
    })

    $("#reminder #table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ss_opportunityreminder";
        var field_name = "OpportunityReminderID";
        $.ajax({
            type: "post",
            url: base_url + "admin/opportunity/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $('#reminder #select-dropdown').on('change', function () {
        var total_page = $('#reminder #select-dropdown').val();
        ajax_listing(current_page_size,total_page);
    })

    $('#table_body').on('click', '#reminder .pagination_buttons', function(){
        var total_page = $('#reminder #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_listing(page,total_page);
    })


    // Process js.

     $('#Process').on('click', '.pagination_buttons', function(){
        var total_page = $('#Process #PageSize').val();
        var page = $(this).attr('data-page-number');
        process_ajax_listing(total_page,page);
    });

    $('#Process').on('change','.PageSize', function () {
        var total_page = $(this).val();
        process_ajax_listing(total_page,1);
    })

    $('#Process #select-dropdown').on('change', function () {
        var total_page = $('#Process #select-dropdown').val();
        process_ajax_listing(current_page_size,total_page);
    })

    $('#Process').on('click', '#Process .pagination_buttons', function(){
        var total_page = $('#Process #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        process_ajax_listing(page,total_page);
    })

</script>
