<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }
    //---------pagiing and search----------//     
    var current_page_size = 10;
    var total_page = 1;
    var CustomerPropertyID = '<?php echo $ID;?>';

    function common_ajax (current_page_size, total_page){
        $.ajax({
            type:"post",
            url: base_url + "admin/user/refund/ajax_listing/" + current_page_size + "/" + total_page,
            data:{
                CustomerPropertyID : CustomerPropertyID,
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
		$("#model_title").html("<?php echo label('msg_lbl_refund');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () { 
        common_ajax(current_page_size,1);

    })

    $('#select-dropdown').on('change', function () {
        current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,1);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        page =  $(this).attr('data-page-number');
        common_ajax(current_page_size,page);
    })
    
    $("#table_body").on('click', '.info', function(){
        var id = $(this).attr('data-id');        
        var table_name = "sssm_refund";
        var field_name = "RefundID";
        $.ajax({
            type:"post",
            url: base_url + "admin/user/refund/getRecordInfo",
            data:{id:id,table_name:table_name,field_name:field_name},            
            success:function(data)
            {                
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
    $(document).on("click",".closedbtn",function(){
        var tm =  confirm('Do you want to closed payment ?');
        if(!tm){
            return false;
        }


        var id = $(this).attr("data-id");
        $.ajax({
            type:"post",
            url: base_url + "admin/user/refund/ChangeRefund/"+id,
            data:{},
            success:function(data){

                if(data.trim()==1){
                    $("#AddData").remove();
                    $("#ChangeClosed").removeClass("closedbtn");
                    $("#ChangeClosed i").removeClass("<?php echo ISCLOSED_ACTIVE_ICON_CLASS;?>").addClass("<?php echo ISCLOSED_INACTIVE_ICON_CLASS;?>");
                    alertify.success("<?php echo label('refund_process_closed');?>");
                }else{
                    alertify.error("<?php echo label('please_try_again');?>");
                }
            }
        })
    })
</script>