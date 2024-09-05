<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }
    //---------pagiing and search----------//     
   var current_page_size = 10;
    var total_page = 1;
    window.FirstName = '';
    window.Email = '';
    window.Status = '-1';
    function common_ajax (current_page_size, total_page){
        $.ajax({
            type:"post",
            url: base_url + "admin/project/project/ajax_listing/" + current_page_size + "/" + total_page,
            data:{
                    FirstName:FirstName,
                    Email:Email,
                    Status_search:Status
                },
            success:function(data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                
                $('#table_paging_div').html(obj.b);
            },
            error:function(data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () { 
        $('#data-table-simple_info').hide();
		$("#model_title").html("<?php echo label('msg_lbl_project');?>");
        common_ajax(10,1);
    })

    $('#button_submit').on('click', function () { 
        FirstName = $('#Title_search').val(),
        Email = $('#Email').val(),
        Status = $('input[name="Status_search"]:checked').val()
        common_ajax(current_page_size,1);

    })

    $('#select-dropdown').on('change', function () {
        current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,1);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        total_page =  $(this).attr('data-page-number');
        common_ajax(current_page_size,total_page);
    })
    
    $("#table_body").on('click', '.status_change', function(){
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
            url: base_url + "admin/project/project/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                    if((current_status === 'inactive' && obj.result == "success") || (obj.result == "error" && current_status === 'active')){
                        $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                        $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    }else{
                        $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                        $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                        $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    }                               
                    alertify.success(obj.message);        
            }
        })
    })
    $("#table_body").on('click', '.info', function(){
        var id = $(this).attr('data-id');        
        var table_name = "sssm_project";
        var field_name = "ProjectID";
        $.ajax({
            type:"post",
            url: base_url + "admin/project/project/getRecordInfo",
            data:{id:id,table_name:table_name,field_name:field_name},            
            success:function(data)
            {                
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
</script>