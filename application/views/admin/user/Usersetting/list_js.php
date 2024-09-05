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

    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/Usersetting/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    UsersettingName: $('#UserType').val(),  
                    Status_search:$('input[name="Status_search"]:checked').val()
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#Usersetting_table_body').html(obj.a);

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

    $('#button_Usersetting_submit').on('click', function () {
       //alert('hiii');
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


 var field_ServentName = ["UserType"]; 
   $("#Usersetting_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-Usersetting-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-Usersetting-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/user/Usersetting/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
               // alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_ACTIVE_MESSEGE;?>');

                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_INACTIVE_MESSEGE;?>');

                }           
            }
        })
    })

    $("#Usersetting_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-Usersetting-id');
        var table_ServentName = "sssf_usersetting";
        var field_ServentName = "UserSettingId";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/Usersetting/getRecordInfo",
            data: {id: id, table_ServentName: table_ServentName, field_ServentName: field_ServentName},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    $('.delete_floating_icon').on('click', function () {
        var multiple_checkbox_id = new Array();
        $("input:checkbox[name=Status]:checked").each(function () {
            multiple_checkbox_id.push($(this).attr('data-Usersetting-id'));
        });
        var ids = multiple_checkbox_id.join();
        var table_ServentName = "sssf_usersetting";
        var field_ServentName = "UserSettingId";

        $.ajax({
            type: "post",
            url: base_url + "admin/user/Usersetting/multipleChangeStatus",
            data: {ids: ids, table_ServentName: table_ServentName, field_ServentName: field_ServentName},
            success: function (data)
            {
                for (i = 0; i < multiple_checkbox_id.length; i++)
                {
                    $('#row_' + multiple_checkbox_id[i]).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + multiple_checkbox_id[i]).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + multiple_checkbox_id[i]).find('.' + loading_status_icon_class).addClass('hide');
                }
            }
        })
    })


    function changeFilter(filter_option = ""){

        if (filter_option == "Filter")
        {
            $(".ScrollStyle").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down" )
            $("#display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
        }
        else {

            $("#UserType").val('');
            $("#select2-UsersettingID-container").text('select Usersetting');
            // $("#Status_search").val('');
            $('input[name="Status_search"][value="-1"]').prop("checked", true);
            $(".ScrollStyle").hide();
            $(".search_action").hide();
            $("#button_Usersetting_submit").trigger("click");
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");

        }
    }
    function clearAllFilter() {
        $("#All").prop("checked", true)
        changeFilter('All');
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");
    }
    function field_display() {
        var display_class = ($('#display_action').attr('class'));
        if (display_class == 'mdi-hardware-keyboard-arrow-down')
        {
            $("#Filter").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-up");
        }
        else
        {
            $("#All").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");
            changeFilter("All");
            return ;
        }

        $(".ScrollStyle").toggle();
        $(".search_action").toggle();
    }
     
</script>