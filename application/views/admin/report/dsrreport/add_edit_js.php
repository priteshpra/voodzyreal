<script>
    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function( arg ){
        if ( 'select' in arg ){ //prevent closing on selecting month/year
            this.close();
        }
      }
    })

    window.submitflag = 0;
    $(document).ready(function () {
        setTimeout(function(){ $('#MobileNo').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
        datacommon_ajax();
    })

    window.current_page_size = 10;
    window.total_page = 1;
    window.MobileNo='';
    window.ID=0;
    window.StartCallTime='';
    window.EndCallTime='';
    window.Type='Visitor';
    window.SitesID=0;
    window.AddType='Website';
    window.ProjectID=0;

    function datacommon_ajax() {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/dSRReport/dataajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    MobileNo: MobileNo,
                    Type:Type
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('.TableBody').html(obj.a);
                $('#table_paging_div').html(obj.b);
                $('#MobileNoData').removeClass('hide');
            },
            error: function (data)
            {
                console.log(data);
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    $('#select-dropdown').on('change', function () {
        current_page_size = $('#select-dropdown').val();
        datacommon_ajax(current_page_size,total_page);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        current_page_size = $('#select-dropdown').val();
        total_page = $(this).attr('data-page-number');
        datacommon_ajax(current_page_size,total_page);
    })

    function sitescommon_ajax() {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/dSRReport/sitesajax_listing",
            data: {
                    VisitorID: ID,
                    Status_search:1
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('.SitesTableBody').html(obj.a);
                $('#SitesData').removeClass('hide');
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }

    $('#button_mobilenosubmit').on('click', function (){
        Type = $('.Type:checked').val();
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            MobileNo = $('#MobileNo').val();
            datacommon_ajax();
        }
    });

    $('.Type').on('change', function (){
        Type = $('.Type:checked').val();
        datacommon_ajax();
    });

    $(".TableBody").on('change', '.SelectData', function(){ 

        ID = $(this).val();
        if (Type == 'Visitor') {
            AddType='Website';
            sitescommon_ajax();
        }
        else{
            AddType = ($(this).attr('data-type'));
            $('#ProjectData').removeClass('hide');
        }

    });

    $("#ProjectData").on('change', '#ProjectID', function(){ 
        ProjectID = $('#ProjectID').val();
        $('.StartCall').removeClass('hide');
    });


    $(".SitesTableBody").on('change', '.SitesData', function(){ 
        SitesID = $(this).val();
        ProjectID = $(this).attr('data-id');
        $('.StartCall').removeClass('hide');
    });

    $('#button_startcall').on('click', function (){

        $(".Type").attr('disabled', true);
        $(".SelectData").attr('disabled', true);

        var d = new Date($.now());
        StartCallTime=(d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());

        $('#StartCallDateTime').text(StartCallTime);
        $('.LabelStartCallDateTime').removeClass('hide');
        $(this).prop('disabled', true);
        $(this).css({"background-color": "#afafa7"});
        $('.EndCall').removeClass('hide');

    });   

    $('#button_endcall').on('click', function (){

        var d = new Date($.now());
        EndCallTime=(d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());

        $('#EndCallDateTime').text(EndCallTime);
        $('.LabelEndCallDateTime').removeClass('hide');
        $(this).prop('disabled', true);
        $(this).css({"background-color": "#afafa7"});
        $('.FeedbackData').removeClass('hide');

    });   

    $('#button_submit').on('click', function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 1){
                return false;
            }
            submitflag = 1;
            var FeedbackID = $('.Feedback:checked').val();
            var Remarks = $('#Remarks').val();

            if (ID==0) {
                alertify.error("<?php echo label('required_field'); ?>");
                return false;
            }

            if (StartCallTime=='') {
                alertify.error("<?php echo label('required_field'); ?>");
                return false;
            }

            if (EndCallTime=='') {
                alertify.error("<?php echo label('required_field'); ?>");
                return false;
            }

            $.ajax({
                type:"post",
                url: base_url + "admin/report/dSRReport/add",
                data:{
                    Type:Type,
                    EndCallTime:EndCallTime,
                    StartCallTime:StartCallTime,
                    FeedbackID:FeedbackID,
                    ID:ID,
                    Remarks:Remarks,
                    SitesID:SitesID,
                    AddType:AddType,
                    ProjectID:ProjectID
               },
              success:function(data)
                {
                    alertify.success("Data Added Succesfully.");   

                    if (Type == 'Visitor') {
                        var tm =  confirm('Do you want to add reminder ?');
                        if(tm){
                            window.location.href= "<?php echo site_url('admin/user/visitor/addreminder/');?>"+ID;
                        }else{
                            window.location.href= "<?php echo site_url('admin/report/dSRReport');?>";
                        }
                    }
                    else{
                        window.location.href= "<?php echo site_url('admin/report/dSRReport');?>";
                    }                    
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
        return false;
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });

    function LoadPropertyBasedProject(){
    }

    $(".TableBody").on('click', '.feedbackinfo', function(){ 
        var Type = $(this).attr('data-type');
        if (Type=='Visitor') {
            var VisitorID = $(this).attr('data-id');
            var OpportunityID = -1;
        }
        else{
            var OpportunityID= $(this).attr('data-id');
            var VisitorID = -1;
        }
        
        var Name = $(this).attr('data-name');
        
        $.ajax({
            type: "post",
            url: base_url + "admin/userfeedback/getRecordInfo",
            data: {VisitorID:VisitorID,OpportunityID:OpportunityID},
            success: function (data)
            { 
                $("#feedbackmodel_title").html(Name);
                $("#feedback_body").html(data);
                $('#FeedbackModal.modal').openModal();
            }
        })
    })

</script>