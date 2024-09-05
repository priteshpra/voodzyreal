<script type="text/javascript">
    window.current_page_size = 10;
    window.total_page = 1;
    window.FirmName = '';
    window.Status = '-1';
    var arr = [];
    var MobileNo = [];
    var BusinessName=[];

    /*$(document).on('click','.export-excel',function(){
        $("#ExportForm").submit();
    });*/

    $(document).ready(function () {
        $(document).on('click','.MyCheckBox', function() { 
        if($(".MyCheckBox:checked").length==0) 
        {   
            $('.Compose').css('display','none');
        } 
        else 
        {
           $('.Compose').css('display','block');
        }
        });
    });


    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/ChanelPartner/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                FirmName:FirmName,
                Status:Status,
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
        $("#model_title").html("<?php echo label('msg_lbl_chanel_partners');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {
        FirmName =  $('#FirmName').val();  
        Status = $('input[name="Status_search"]:checked').val();
        common_ajax(current_page_size,total_page);
    })


    $('#country_table_body').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp,page);
    })


    var field_name = ["CountryName"]; 
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
            url: base_url + "admin/masters/ChanelPartner/changeStatus",
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

    $("#country_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "sssm_chanelpartner";
        var field_name = "ChanelPartnerID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/ChanelPartner/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    $(document).ready(function () {
    window.i=0;
    window.j=0;
    window.k=0;
    $(document).on('click','.Compose', function() {    
        $('.MyCheckBox:checked').each(function () {
           arr[i++] = $(this).val();
           MobileNo[j++] = ($(this).attr('data-id'));
           BusinessName[k++] = ($(this).attr('data-businessName'))
        });
    });
});

    $('.SMSFormSubmit').on('click', function () {
        Message=$('#SMS_Message').val(); 
        if(Message=='')
        {
            alertify.error('<?php echo label('msg_lbl_enter_message');?>');
             $("#Message").focus();
        }
        else
        {
            $.ajax({
                type: "post",
                datatype:"JSON",
                url: base_url + "admin/masters/ChanelPartner/SMSSend/",
                data: 
                {
                    BusinessName:BusinessName,
                    MobileNo:MobileNo,
                    Message:Message
                },success: function (data)
                {
                    alertify.error('<?php echo label('msg_lbl_msg_sent_success');?>');
                    location.reload();
                },error: function (data){
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                }
            })
        }
    })

</script>