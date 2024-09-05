<script type="text/javascript">

   $(document).ready(function () {
        //setTimeout(function(){ $('.search_action .select2_class .select-dropdown').first().click(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; 
        } elseif(isset($this->session->userdata['PostSuccess'])){
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['PostSuccess'] . " ')}, 2000);"; 
         }
        ?>   
    })
   
    function export_excel() {
        $('form').submit();
    }
    //---------pagiing and search----------//     
    var current_page_size = 10;
    var total_page = 1;
    window.Name = '';
    window.MobileNo = '';
    window.PropertyID = '-1';
    window.ProjectID = '-1';
    window.Status = '-1';
    function common_ajax (current_page_size, total_page){
        $.ajax({
            type:"post",
            url: base_url + "admin/user/customer/ajax_listing/" + current_page_size + "/" + total_page,
            data:{
                    Name:Name,
                    MobileNo:MobileNo,
                    Status:Status,
                    ProjectID:ProjectID,
                    PropertyID:PropertyID,
                },
            success:function(data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },
            error:function(data)
            {
                alertify.error("<?php echo label('Something_went_wrong_contact_to_admin');?>");
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () { 
        $('#data-table-simple_info').hide();
		$("#model_title").html("<?php echo label('msg_lbl_customer');?>");
        common_ajax(10,1);
    })

    $('#button_submit').on('click', function () { 
        Name = $('#Name').val(),
        MobileNo = $('#MobileNo').val(),
        PropertyID = $("#PropertyID").val();
        ProjectID = $("#ProjectID").val();
        Status = $('input[name="Status_search"]:checked').val()
        common_ajax(current_page_size,1);

    })

    function clearfixit(){
        LoadPropertyBasedProject();
    }

    $('#select-dropdown').on('change', function () {
        current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,1);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        total_page =  $(this).attr('data-page-number');
        common_ajax(current_page_size,total_page);
    })
    
    $("#table_body").on('click', '.status_change', function(){
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
            url: base_url + "admin/user/customer/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                    if((current_status === 'inactive' && obj.result == "success") || (obj.result == "error" && current_status === 'active')){
                        $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                        $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    }else{
                        $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                        $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                        $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    }                               
                    alertify.success(obj.message);        
            }
        })
    })

    $("#table_body").on('click', '.info', function(){
        var id = $(this).attr('data-id');        
        var table_name = "sssm_customer";
        var field_name = "CustomerID";
        $.ajax({
            type:"post",
            url: base_url + "admin/user/customer/getRecordInfo",
            data:{id:id,table_name:table_name,field_name:field_name},            
            success:function(data)
            {                
                $("#record_info").html(data);
                $('#modal1.modal').openModal();
            }
        })
    })

    $("#import_submit").on('click',function(){
        if($('#importmodal #userfile').val()){
            $('#importmodal #importform').submit();
        }else{
            alertify.success('Please select file.');
        }
    });

    function LoadPropertyBasedProject(){
        if($("#PropertyDiv").length != 0){
            var ProjectID = $('#ProjectIDByRoleID').val();
            if(ProjectID == "")
                    ProjectID = 0;
            $.ajax({
                type: "POST",
                url: base_url + "common/GetProperty/0/"+ProjectID+"/1/Purchase",
                data: {},
                success: function (result){
                    $('#PropertyDiv').html(result);
                    $('#PropertyDiv').show();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }

    function LoadProjectBasedProject(ID)
    {
        var OnlyOne = 1;
        if(ID == ''){
            OnlyOne =0;
            ID=0;
        }
        if($("#ProjectDiv").length != 0){
            $.ajax({
                type: "POST",
                url: base_url + "common/GetProject/"+ID+"/-1/<?php echo $this->UserRoleID;?>/0/"+OnlyOne,
                data: {},
                success: function (result){
                    $('#ProjectDiv').html(result);
                    $('#ProjectDiv').show();
                    setTimeout(function(){
                        LoadPropertyBasedProject();
                    },1000);           
                },error: function (result){
                    console.log("error" + result);
                }
            }); 
        }
    }
</script>
