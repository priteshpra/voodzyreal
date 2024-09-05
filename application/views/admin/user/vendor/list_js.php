<script type="text/javascript">
    window.current_page_size = 10;
    window.total_page = 1;
    window.Name = '';
    window.EmailID = '';
    window.Status = '-1';

    $(document).on('click','.export-excel',function(){
        $("#ExportForm").submit();
    });


    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/vendor/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                Name:Name,
                Status:Status,
                EmailID:EmailID
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#country_table_body').html(obj.a);
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
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_vendor');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {
        Name =  $('#Name').val();  
        EmailID=  $('#EmailID').val(); 
        Status = $('input[name="Status_search"]:checked').val();
        common_ajax(current_page_size,total_page);
    })

    $('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp,page);
    })


    var field_name = ["VendorID"]; 
   $("#country_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/user/vendor/changeStatus",
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

    $("#country_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ss_vendor";
        var field_name = "VendorID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/vendor/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    });

</script>