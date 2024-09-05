<script type="text/javascript">
   $(document).ready(function () {
        
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
    window.current_page_size = 10;
    window.total_page = 1;
    window.VendorName = '';
    window.ChallanNo = -1;
    window.ChallanDate='0000-00-00';
    
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/inward/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                VendorName:VendorName,
                ChallanNo:ChallanNo,
                ChallanDate:ChallanDate
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('.TableBody').html(obj.listing);
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
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_title_inward');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {
        VendorName =  $('#VendorName').val();  
        ChallanNo=  $('#ChallanNo').val(); 
        ChallanDate=  $('#ChallanDate').val(); 
        if (ChallanDate=='') 
        {
            ChallanDate='0000-00-00';
        }
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

   $(".TableBody").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 

        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/inward/changeStatus",
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
                $('#modal1').openModal();
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