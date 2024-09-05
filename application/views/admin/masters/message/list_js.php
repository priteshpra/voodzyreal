<script type="text/javascript">
    /* Global variables from footer.php : 
     - active_status_icon_class
     - inactive_status_icon_class
     - loading_status_icon_class
     - base_url
     */
  
    window.MessageKey = '';
    window.Message = '';
    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/message/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    MessageKey:MessageKey,  
                    Message:Message,
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#message_table_body').html(obj.a);

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

    $('#button_message_submit').on('click', function () {
        MessageKey =  $('#MessageKey').val();
        Message =  $('#Message').val();
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


 
    $("#message_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-message-id');
        var table_name = "ssmd_messages";
        var field_name = "MessageID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/message/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

  
     function loadmessageBasedStates()
     {}
</script>