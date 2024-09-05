<script>

    window.current_page_size = 10;
    window.total_page = 1;
        
    function ajax_listing(current_page_size, total_page) {
        var UserID=$('#UserID').val();
        $.ajax({
            type: "post",
            url: base_url + "admin/user/vendor/ajax_inwardlisting/" + current_page_size + "/" + total_page,
            data: {
                UserID:UserID
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.listing);
                $('#table_paging_div').html(obj.pagination);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    //---------pagiing and search----------//     
    $(document).ready(function () {
        ajax_listing(current_page_size,total_page);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp,page);
    })

    $(".TableBody").on('click', '.info', function(){ 

        var id = $(this).attr('data-id');
        var table_name = "ss_goodsreceivednote";
        var field_name = "GoodsReceivedNoteID";

        $.ajax({
            type: "post",
            url: base_url + "admin/inward/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    window.GoodsReceivedNoteID=0;
    window.image='';
    $(".TableBody").on('click', '.delete', function(){ 
        GoodsReceivedNoteID = $(this).attr('data-id');
        $('#deleteModal').openModal();    
    });

    $("#deleteModal").on('click', '#submit_delete', function(){
        $.ajax({
            type:"post",
            url: base_url + "admin/inward/deleteinvoiceimg",
            data:{
                GoodsReceivedNoteID : GoodsReceivedNoteID,
                image:image
            },
            success:function(data)
            {
                $('#deleteModal').closeModal();
                common_ajax(current_page_size,total_page);
            },
            error:function(data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    });        
    
</script>
