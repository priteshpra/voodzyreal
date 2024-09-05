<script>

 window.current_page_size = 10;
    window.total_page = 1;
    window.DeviceName = '';
    window.DeviceOS = '';
    window.OSVersion = '';
    window.UserID = '-1';
    window.Status_search = '-1';
    $('#basic_details_button').on('click',function(){

        var error = checkValidations();
        if(error === 'yes')
        {
           alertify.error("<?php echo label('required_field');?>");
                return false;
        }
        else
        {
            var mob = $("#MobileNo").val();
            var count = (mob.match(/0/g) || []).length;
            if(mob.length < 10 || mob.length > 13){
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('msg_lbl_please_enter_mobileNumber');?>");
                return false;
            }
            if(count == 13){
                $('#MobileNo').addClass('invalid');
                alertify.error("<?php echo label('msg_lbl_please_enter_mobileNumber');?>");
                return false;
            }
            $.ajax({
                type: "post",
                url: base_url + "admin/user/employeedetails/editBasicDetails",
                data: $('#editbasicForm').serialize(),
                success: function (data)
                {
                    alertify.success("Basic details updated");    
                    return false;
                },
                error: function (data)
                {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                }
            })
        }
    });

   
    function deviceinfo (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/employeedetails/ajax_deviceinfo/" + current_page_size + "/" + total_page+"/<?php echo $ID;?>",
            data: {
                    UserID:<?php echo $details->UserID?>,
                    DeviceName:DeviceName,
                    DeviceOS: DeviceOS,
                    OSVersion:OSVersion,
                    Status_search:Status_search
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#deviceinfo_table_body').html(obj.a);

                $('#deviceinfo_table_paging_div').html(obj.b);
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
        $("#model_title").html("<?php echo label('msg_lbl_company');?>");
        
    })
    $(document).on('click','.deviceinfo',function(){
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_deviceinfo');?>");
        deviceinfo(current_page_size,total_page);
    });
    
    $("#deviceinfo_table_body").on('click', '.status_change', function()
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
            url: base_url + "admin/user/employeedetails/changeDeviceInfoStatus",
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

    $("#deviceinfo_table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "sssm_deviceinfo";
        var field_name = "DeviceID";
        $.ajax({
            type: "post",
            url: base_url + "admin/user/employeedetails/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })

    $(document).on("click","#change_password_button",function(){
        var newp = $('#new_password').val();
        var confirm = $("#confirm_password").val();
        var error = checkValidations("#change_password");
        if(error === 'yes')
        {
           alertify.error("<?php echo label('required_field');?>");
                return false;
            
        }
        else
        {
            if(newp != confirm){
                alertify.error("<?php echo label('password_conf_not_macth');?>");    
                return false;
            }
            var flag = isPassword($('#new_password').val());
            if(flag == 1){
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                return false;
            }
         $.ajax({
                type:"post",
                url: "<?php echo base_url();?>admin/user/employeedetails/changepassword",
                data:{ new_password:newp,UserID:<?php echo $details->UserID;?>,confirm_password:confirm},
                success:function(data){
                    var response = JSON.parse(data);
                    if(response.Status == "Success"){
                        alertify.success("<?php echo label('password_change_success')?>");
                        $('#new_password').val('');
                        $('#confirm_password').val('');
                    }else{  
                        alertify.error(response.Message);
                    }
                }

            });
        return false;
        }
    });

    $(document).on("click","#submit_button_not",function(){
        
        $.ajax({
            type:"post",
            url: "<?php echo base_url();?>admin/user/employeedetails/SetNotification/<?php echo $ID;?>",
            data:$("#notform").serialize(),
            success:function(data){
                var response = JSON.parse(data);
                if(response.result == "Success"){
                    alertify.success(response.Message);
                }else{  
                    alertify.error(response.Message);
                }
            }
        });
        return false;
    });
    

    $(document).on("click",".changeFilter",function(){
            var filter_option = $(this).val();
            var mydiv = $(this).attr('data-div');
            if(filter_option == "Filter"){ 
                setTimeout(function(){
                    $("#" + mydiv + " .search_action.card-panel input").first().focus();
                    //$("#" + mydiv + ' .search_action #PageID').first().select2('open');
                }, 500);
                $("#" + mydiv + " .search_action").show();
                $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
            }else{
                $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
                $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
                $('input[name="Status_search"][value="-1"]').prop("checked", true);
                $("#" + mydiv + " .search_action").hide();
                $("#" + mydiv + " button[type='button']").click();
                $("#" + mydiv + ' #display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
            }     
        });
    $(document).on("click",".filtercls",function(){
        var mydiv = $(this).attr('data-div');
        if($('#' + mydiv + ' #display_action').hasClass('mdi-hardware-keyboard-arrow-down')){
            $("#" + mydiv + " input[value='Filter']").click();
        }else{
            $("#" + mydiv + " input[value='All']").click();
        }
    });
    $(document).on("click",".clear-all",function(){
        var mydiv = $(this).attr('data-div');
        $("#" + mydiv + " .search_action").find("input[type=text],input[type=email],input[type=number],textarea").val("");
        $("#" + mydiv + " .search_action").find("select").val('').trigger('change');
        $("#" + mydiv + " input[value='All']").click();
    });
    $('#deviceinfo_submit').on('click', function () {
        DeviceName = $('#DeviceName').val();
        DeviceOS = $('#DeviceOS').val();
        OSVersion = $('#OSVersion').val();
        var current_page_size = $('#deviceinfo #select-dropdown').val();
        deviceinfo(current_page_size, total_page);
    })
    $('#deviceinfo #select-dropdown').on('change', function () {
        var total_page = $('#deviceinfo #select-dropdown').val();
        applied_jobs(current_page_size,total_page);
    })
    $('#deviceinfo_table_body').on('click', '#deviceinfo .pagination_buttons', function(){
        var total_page = $('#deviceinfo #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        applied_jobs(page,total_page);
    })
    $('#IsPush').change(function() {
    if($(this).is(':checked')){
        $("input.chkcls").attr('disabled',false);
    }else{
        $("input.chkcls").prop("checked",false);
        $("input.chkcls").attr('disabled',true);
    }
});
        
$(document).on("click","#change_passcode_button",function(){
        var newp = $('#new_passcode').val();
        var confirm = $("#confirm_passcode").val();
        var error = checkValidations("#change_passcode");
        if(error === 'yes')
        {
           alertify.error("<?php echo label('required_field');?>");
                return false;
            
        }
        else
        {
            if(newp != confirm){
                alertify.error("<?php echo label('passcode_conf_not_macth');?>");    
                return false;
            }
            $.ajax({
                type:"post",
                url: "<?php echo base_url();?>admin/user/employeedetails/changepasscode",
                data:{ new_passcode:newp,UserID:<?php echo $details->UserID;?>,confirm_passcode:confirm},
                success:function(data){
                    var response = JSON.parse(data);
                    if(response.Status == "Success"){
                        alertify.success("<?php echo label('passcode_change_success')?>");
                        $('#new_passcode').val('');
                        $('#confirm_passcode').val('');
                    }else{  
                        alertify.error(response.Message);
                    }
                }

            });
        return false;
        }
    });

</script>
