<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }
    //---------pagiing and search----------//     
    var current_page_size = 10;
    var total_page = 1;
    
    function common_ajax (current_page_size, total_page){
        $.ajax({
            type:"post",
            url: base_url + "admin/misscall/ajax_listing/" + current_page_size + "/" + total_page,
            data:{
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

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        total_page =  $(this).attr('data-page-number');
        common_ajax(current_page_size,total_page);
    })
    
</script>