<script type="text/javascript">
    /* Global variables from footer.php : 
     - active_status_icon_class
     - inactive_status_icon_class
     - loading_status_icon_class
     - base_url
     */
    function export_excel() {

        $('form').submit();
    }
    window.YearName = '';
	window.YearDuration = '';
    window.Status = '-1';
    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/year/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    YearName: YearName,
					YearDuration : YearDuration,					
                    Status_search:Status
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#year_table_body').html(obj.a);

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
        common_ajax(current_page_size,total_page);
    })

    $('#button_year_submit').on('click', function () {
        YearName = $('#YearName').val();
		YearDuration = $('#YearDuration').val();
        Status = $('input[name="Status_search"]:checked').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);

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


 var field_name = ["YearName"]; 
   $("#year_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-year-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-year-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/masters/year/changeStatus",
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

    $("#year_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-year-id');
        var table_name = "ssse_years";
        var field_name = "id";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/year/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

     function loadyearBasedStates()
     {}
</script>