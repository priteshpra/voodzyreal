<script>

    window.current_page_size = 10;
    window.total_page = 1;
    $(document).ready(function(){
        ajax_process(current_page_size,total_page);
        ajax_payment(current_page_size,total_page);
        ajax_document(current_page_size,total_page);
        ajax_reminder(current_page_size,total_page);
        ajax_refund(current_page_size,total_page);
    })
    function ajax_process(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/user/process/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerPropertyID : '<?php echo $CustomerPropertyID;?>',
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#process #table_body').html(obj.a);
                $('#process #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    function ajax_payment(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/payment/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerPropertyID : '<?php echo $CustomerPropertyID;?>',
                IsCancelled:'<?php echo $Property->IsCancelled;?>',
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#payment #table_body').html(obj.a);
                $('#payment #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    function ajax_document(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/document/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerPropertyID : '<?php echo $CustomerPropertyID;?>',
                IsCancelled:'<?php echo $Property->IsCancelled;?>',
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#document #table_body').html(obj.a);
                $('#document #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    function ajax_reminder(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/reminder/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerPropertyID : '<?php echo $CustomerPropertyID;?>',
                IsCancelled:'<?php echo $Property->IsCancelled;?>',
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#reminder #table_body').html(obj.a);
                $('#reminder #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    function ajax_refund(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/user/refund/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                CustomerPropertyID : '<?php echo $CustomerPropertyID;?>',
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#refund #table_body').html(obj.a);
                $('#refund #table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
   
    $('.tabs .tabclick').on('click', function () {
        var myid = $(this).attr("href");
        if(myid == "#document"){
            current_page_size = $("#document #select-dropdown").val();
            total_page = 1;
            ajax_document(current_page_size,total_page);
        }else if(myid == "#payment"){
            current_page_size = $("#payment #select-dropdown").val();
            total_page = 1;
            ajax_payment(current_page_size,total_page);
        }else if(myid == "#process"){
            current_page_size = $("#process #select-dropdown").val();
            total_page = 1;
            ajax_process(current_page_size,total_page);
        }else if(myid == "#reminder"){
            current_page_size = $("#reminder #select-dropdown").val();
            total_page = 1;
            ajax_reminder(current_page_size,total_page);
        }else if(myid == "#refund"){
            current_page_size = $("#refund #select-dropdown").val();
            total_page = 1;
            ajax_refund(current_page_size,total_page);
        }

    });
    $('#document').on('click', '.pagination_buttons', function(){
        var total_page = $('#document #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_document(total_page,page);
    });
    $('#payment').on('click', '.pagination_buttons', function(){
        var total_page = $('#payment #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_payment(total_page,page);
    });
    $('#process').on('click', '.pagination_buttons', function(){
        var total_page = $('#process #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_process(total_page,page);
    });
    $('#reminder').on('click', '.pagination_buttons', function(){
        var total_page = $('#reminder #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_reminder(total_page,page);
    });
    $('#refund').on('click', '.pagination_buttons', function(){
        var total_page = $('#refund #select-dropdown').val();
        var page = $(this).attr('data-page-number');
        ajax_refund(total_page,page);
    });
    
    $('#document #select-dropdown').on('change', function () {
        var page = $('#document #select-dropdown').val();
        ajax_document(page,total_page);
    })
    $('#payment #select-dropdown').on('change', function () {
        var page = $('#payment #select-dropdown').val();
        ajax_payment(page,total_page);
    })
    $('#process #select-dropdown').on('change', function () {
        var page = $('#process #select-dropdown').val();
        ajax_process(page,total_page);
    })
    $('#reminder #select-dropdown').on('change', function () {
        var page = $('#reminder #select-dropdown').val();
        ajax_reminder(page,total_page);
    })
    $('#refund #select-dropdown').on('change', function () {
        var page = $('#refund #select-dropdown').val();
        ajax_refund(page,total_page);
    })

    $("#payment #table_body").on('click', '.status_change', function(){
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        $('#payment #row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#payment #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#payment #row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type:"post",
            url: base_url + "admin/user/payment/changeStatus",
            data:{id:id,status:status,table_name:"sssm_customerpayment",field_name:"CustomerPaymentID"},
            success:function(data){
                var obj = JSON.parse(data);
                if(current_status == 'inactive'){
                    $('#payment #row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#payment #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#payment #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }else{
                    $('#payment #row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#payment #row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#payment #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
            }
        })
    })
    $("#document #table_body").on('click', '.status_change', function(){
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        $('#document #row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#document #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#document #row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type:"post",
            url: base_url + "admin/user/document/changeStatus",
            data:{id:id,status:status},
            success:function(data){
                var obj = JSON.parse(data);
                if(current_status === 'inactive'){
                    $('#document #row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#document #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#document #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }else{
                    $('#document #row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#document #row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#document #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
            }
        })
    }) 
    $("#reminder #table_body").on('click', '.status_change', function(){
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        $('#reminder #row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#reminder #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#reminder #row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type:"post",
            url: base_url + "admin/user/reminder/changeStatus",
            data:{id:id,status:status},
            success:function(data){
                var obj = JSON.parse(data);
                if(current_status === 'inactive'){
                    $('#reminder #row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#reminder #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#reminder #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }else{
                    $('#reminder #row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#reminder #row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#reminder #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
            }
        })
    })    
    $("#document #table_body").on('click', '.delete', function(){
        $("#model_title").html("Customer Document");
        var id = $(this).attr('data-id');
        $.ajax({
            type:"post",
            url: base_url + "admin/user/document/delete",
            data:{id:id},
            success:function(data){
                ajax_document(current_page_size,total_page);
            }
        })
    })    
    
    $("#payment #table_body").on('click', '.info', function(){
        $("#model_title").html("Customer Payment");
        var id = $(this).attr('data-id');
        var table_name = "sssm_customerpayment";
        var field_name = "CustomerPaymentID";
        $.ajax({
            type:"post",
            url: base_url + "admin/user/payment/getRecordInfo",
            data:{id:id,table_name:table_name,field_name:field_name},            
            success:function(data)
            {                
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })
    $("#reminder #table_body").on('click', '.info', function(){
        $("#model_title").html("Customer Reminder");
        var id = $(this).attr('data-id');
        var table_name = "sssm_customerreminder";
        var field_name = "CustomerReminderID";
        $.ajax({
            type:"post",
            url: base_url + "admin/user/reminder/getRecordInfo",
            data:{id:id,table_name:table_name,field_name:field_name},            
            success:function(data)
            {                
                $("#record_info").html(data);
                $('#modal1').openModal();
            }
        })
    })   
    $(document).on('click','.reminderbtn',function(){
        var type= $(this).attr('data-type');
        var user= $(this).attr('data-user');
        var id= $(this).attr('data-id');
        $("#ActionType").val(type);
        $("#ID").val(id);
        $("#ActionUser").val(user);
        if(type=="SMS"){
            $("#Subjectdiv").addClass('hide');
            $("#attenchmentdiv").addClass('hide');
            $("#reminder_title").html("Send SMS");
        }else{
            $("#Subjectdiv").removeClass('hide');
            $("#attenchmentdiv").removeClass('hide');
            $("#reminder_title").html("Send Mail");
        }
        $('.reminderpopup').openModal();
    });
    $(document).on('click','#reminder_submit',function(){
        if($("#ActionType").val() == "SMS"){
            if($("#Message").val() == ""){
                $("#Message").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_message');?>');
                return false;
            }else{
                $("#Message").removeClass("invalid");
            }
        }else{
            if($("#Subject").val() == ""){
                $("#Subject").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_subject');?>');
                return false;
            }else{
                $("#Subject").removeClass("invalid");
            }
            if($("#Message").val() == ""){
                $("#Message").addClass("invalid");
                alertify.error('<?php echo label('enter_valid_message');?>');
                return false;
            }else{
                $("#Message").removeClass("invalid");
            }

        }
        var jdata = '{"method":"addReminderAction","body":{"ID":"' + $("#ID").val() +'","ActionType":"'+$("#ActionType").val()+'","Message":"'+$("#Message").val()+'", "Subject":"'+$("#Subject").val()+'","UserID":"<?php echo @$this->session->userdata['UserID'];?>","ActionUser":"'+$("#ActionUser").val()+'","UserType":"Admin Web"}}';
        $("#button_submit_loading").removeClass('hide');
        $("#reminder_submit").addClass('hide');
        var form = $('form#reminderform')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
                $.ajax({
                    type:"post",
                    url: base_url + "api/service",
                    data:formData,
                    dataType: "json",
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.addReminderAction.Error == 200){
                            alertify.success(data.addReminderAction.Message);
                        }else{
                            alertify.error(data.addReminderAction.Message);
                        }
                        $(".modal-close").click();
                        $("#Subject").val('');
                        $("#Message").val('');
                        $("#ImageData").val('');
                        $("#editImageURL").val('');
                        $("#button_submit_loading").addClass('hide');
                        $("#reminder_submit").removeClass('hide');
                    },
                });
    });
    
    $(document).on('click','.addresponse',function(){
        $("#response_title").html("Add Response");
        var id = $(this).attr('data-id');
        $("#ReminderID").val(id);
        $('.addresponsemodal').openModal();
    });
    $(document).on('click','#response_submit',function(){
        if($("#Response").val() == ""){
            alertify.error('<?php echo label('enter_respose');?>')
            return false;
        }
        $.ajax({
                type:"post",
                url: base_url + "admin/user/reminder/addresponse",
                data:{
                    ReminderID:$("#ReminderID").val(),
                    Response:$("#Response").val(),
                },
                success:function(data)
                {
                    if(data == 1){
                        alertify.success("<?php echo label('response_added_successfully');?>");
                        $(".modal-close").click();
                        $("#Response").val('');
                        $("#button_submit_loading").addClass('hide');
                        $("#reminder_submit").removeClass('hide');
                        $(".txtcheck").remove();
                    }else{
                        alertify.error("<?php echo label('please_try_again');?>");
                    }
                },
            });

    });
    $(document).on('click','.OpenMileStone',function(){
        $('.view_milestone').openModal();
    });
    $(document).on('click','.ChangeVST',function(){
        var type =$(this).attr('data-type');
        var id = '<?php echo $CustomerPropertyID;?>';
        var Passcode = $('#Passcode').val();
        if(type == "Verified"){
            <?php 
            if(@$this->cur_module->is_verify != 1){
                echo "alertify.error('". label('you_do_not_have_access_for_this_action')."');return false;";
            }
            ?>
        }else if(type == "ATS"){
            <?php 
            if(@$this->cur_module->is_ats != 1){
                echo "alertify.error('". label('you_do_not_have_access_for_this_action')."');return false;";
            }
            ?>
        }else{
            <?php 
            if(@$this->cur_module->is_sd != 1){
                echo "alertify.error('". label('you_do_not_have_access_for_this_action')."');return false;";
            }
            ?>
        }
        if(Passcode==''){
            $('#add_passcode_popup').openModal();
                $('#Passcode').focus();
                if(type == "Verified"){
                    $('#add_passcode_popup .submit-dynamic-btn').html('<input onclick="$(\'#verifiedAtag\').click();" type="submit" class="btn" value="Submit"/>');
                }else if(type == "ATS"){
                    $('#add_passcode_popup .submit-dynamic-btn').html('<input onclick="$(\'#ATSAtag\').click();" type="submit" class="btn" value="Submit"/>');
                }else{
                    $('#add_passcode_popup .submit-dynamic-btn').html('<input onclick="$(\'#SDAtag\').click();" type="submit" class="btn" value="Submit"/>');
                }
            
            return false;
        }
        
        $.ajax({
                type:"post",
                url: base_url + "admin/user/property/ChangeVST",
                data:{
                    ID:id,
                    Type:type,
                    PassCode:Passcode
                },
                success:function(data)
                {
                    if(data == 1){
                        if(type == "Verified"){
                            alertify.success('<?php echo label('customer_property_verified');?>');
                            $('.verifiedcls').attr("src","<?php echo site_url(VERIFIED);?>");
                            $('#verifiedAtag').removeClass('ChangeVST');
                        }else if(type == "ATS"){
                            $('.atscls').attr("src","<?php echo site_url(ATS_CLASS_ACTIVE);?>");
                            $('#ATSAtag').removeClass('ChangeVST');
                        }else{
                            alertify.success('<?php echo label('customer_property_saledeed');?>');
                            $('.sdcls').attr("src","<?php echo site_url(SD_CLASS_ACTIVE);?>");
                            $('#SDAtag').removeClass('ChangeVST');
                        }
                    }else{
                        alert(id);
                        alert(type);
                        alert(Passcode);
                        alertify.error(data);
                    }
                    $('#Passcode').val('');
                    $(".modal-close").click();
                },
            });
            $('#Passcode').val('');
            $(".modal-close").click();
    });
    
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
                    ajax_refund(current_page_size,total_page);
                }else{
                    alertify.error("<?php echo label('please_try_again');?>");
                }
            }
        })
    })
</script>