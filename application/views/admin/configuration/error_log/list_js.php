<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }
    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax(current_page_size, total_page)
    {
        $(".ScrollStyleDiv1").hide();
        $('#data-table-simple_info').hide();
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + 10 + "/" + 1,
            data: {
                MethodName: $('#MethodName').val(),
                ActivityDate: $('#ActivityDate').val(),
                //Status_search:$('#Status_search').val()
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })

    }
    $(document).ready(function () {
        common_ajax(current_page_size, total_page);
    })

    $('#button_errorlog_submit').on('click', function () {
        //window.location = base_url + "admin/masters/city/index/" + $('#select-dropdown').val() + "/" + 1;
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })

    $('#select-dropdown').on('change', function () {
        //alert($('#select-dropdown').val());
        //window.location = base_url + "admin/masters/city/index/" + $('#select-dropdown').val() + "/" + 1;
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + $('#select-dropdown').val() + "/" + 1,
            data: {
                MethodName_search: $('#MethodName_search').val(),
                //Status_search:$('#Status_search').val()
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                //alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var page = $(this).attr('data-page-number');
        //alert($('#per_page_value').val());
        //alert(page);
        //window.location = base_url + "admin/masters/city/index/" + $('#current_page_size').val() + "/" + page;
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + $('#per_page_value').val() + "/" + page,
            data: {
                MethodName_search: $('#MethodName_search').val(),
                //Status_search:$('#Status_search').val()},
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    })
//---------/end pagiing and search----------//     
    var field_name = ["MethodName", "ErrorDate"];
    $("#errorlog_table_body").on('click', '.status_change', function () {
        //$(".status_change").on('click', function(){

        var tr_id = $(this).attr('data-error-log-id');
        var current_status = $(this).attr('data-icon-type');
        //console.log(current_status);
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');


        var id = $(this).attr('data-error-log-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/changeStatus",
            data: {id: id, status: status},
            success: function (data)
            {
                if (current_status === 'inactive')
                {
                    alertify.success('<?php echo SUCCESS_INACTIVE_MESSEGE; ?>');


                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else
                {
                    alertify.success('<?php echo SUCCESS_INACTIVE_MESSEGE; ?>');

                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
            }
        })
    })
    /* Start Advance Search Function */
    function changeFilter(filter_option = ""){

        if (filter_option == "Filter")
        {
            //$(".ScrollStyle").show();
            $(".ScrollStyleDiv1").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else {

            $("#MethodName_search").val('');
            //$("#Status_search").val('');
            $('input[name="Status_search"][value="-1"]').prop("checked", true);
            //$(".ScrollStyle").hide();
            $(".ScrollStyleDiv1").hide();
            $(".search_action").hide();
            $("#button_errorlog_submit").trigger("click");
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
        } else
        {
            $("#Filter").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");
        }

        //$(".ScrollStyle").toggle();
        $(".ScrollStyleDiv1").toggle();
        $(".search_action").toggle();
    }
    /* End Advance Search Function */
</script>