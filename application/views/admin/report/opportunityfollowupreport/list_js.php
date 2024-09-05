<script>

$('.datepickerval').pickadate({
    format: 'dd-mm-yyyy',
    onSet: function( arg ){
    if ( 'select' in arg ){ //prevent closing on selecting month/year
        this.close();
    }
  }
})

window.PageSize = 10;
window.CurrentPage = 1;
window.EmployeeID = '<?php echo($data['0']->UserID); ?>';
window.FollowUpDate = '<?php echo date("d-m-Y"); ?>';
window.ReportType = '<?php echo($data['0']->FirstName.' '.$data['0']->LastName); ?>';

$(document).ready(function () {
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
    ajax_listing(PageSize,CurrentPage);
});

$(document).on("change","#FollowUpDate",function(){
    FollowUpDate = $(this).val();
    ajax_listing(PageSize,CurrentPage); 
});

$(document).on("click",".export-excel",function(){
    $('form').submit();
});


function ajax_listing(PageSize, CurrentPage){

    var tmp = " - " + ReportType ;

    $("#reportlabel").html(tmp);
    
    $.ajax({
        type: "post",
        url: base_url + "admin/report/opportunityFollowUpReport/ajax_listing/"+PageSize+"/"+ CurrentPage,
        data: {
            EmployeeID:EmployeeID,
            FollowUpDate:FollowUpDate
            },
        success: function (data){
            var obj = JSON.parse(data);
            $(' #table_body').html(obj.a);
            $(' #table_paging_div').html(obj.b);
        },error: function (data){
            console.log(data);
            alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
        }
    })
}

$('.tabs .tabclick').on('click', function () {
    ReportType = $(this).attr("title");
    EmployeeID = $(this).attr("data-id");
    FollowUpDate = $("#FollowUpDate").val();
    PageSize = $("#Visitor #select-dropdown").val();
    $("#EmployeeID").val(EmployeeID);
    ajax_listing(PageSize, CurrentPage);
});

$(document).on("click",".export-excel",function(){
    if(FilterType == "Other"){
        var error = checkValidations("#"+ReportType);
        if(error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        CustomStartDate = $("#"+ReportType+" #CustomStartDate").val();
        CustomEndDate = $("#"+ReportType+" #CustomEndDate").val();
        var StartArray = CustomStartDate.split('-');
        var EndArray = CustomEndDate.split('-');
        var startdate = new Date(StartArray[2],StartArray[1],StartArray[0],0,0,0,0);
        var enddate = new Date(EndArray[2],EndArray[1],EndArray[0],0,0,0,0);
        if(startdate > enddate){
            alertify.error('Start Date must be greater than End Date');
            return false;
        }
    }
    $("#dashboardfrm #ReportType").val(ReportType);
    $("#dashboardfrm #FilterType").val(FilterType);
    CustomStartDate = $("#"+ReportType+" #CustomStartDate").val();
    CustomEndDate = $("#"+ReportType+" #CustomEndDate").val();
    $("#dashboardfrm #CustomStartDate").val(CustomStartDate);
    $("#dashboardfrm #CustomEndDate").val(CustomEndDate);
    $("#dashboardfrm").submit();
});

$('.table_paging_div').on('click', '.pagination_buttons', function () {
        var page = $(this).attr('data-page-number');
        ajax_listing(PageSize, page);
    })

$('.select-dropdown').on('change', function () {
        PageSize = $(this).val();
        ajax_listing(PageSize,CurrentPage);
    })

    $("#table_body").on('click', '.feedbackinfo', function(){ 
        var OpportunityID = $(this).attr('data-id');
        var VisitorName = $(this).attr('data-name');
        
        $.ajax({
            type: "post",
            url: base_url + "admin/userfeedback/getRecordInfo",
            data: {OpportunityID:OpportunityID},
            success: function (data)
            { 
                $("#feedbackmodel_title").html(VisitorName);
                $("#feedback_body").html(data);
                $('#FeedbackModal.modal').openModal();
            }
        })
    })

    window.OpportunityID=0;
    window.Type='';
    window.submitflag = 1;

    $("#table_body").on('click', '.addfeedback', function(){ 
        $("#AddFeedbackData")[0].reset();
        $('#reasonModal').openModal();
        OpportunityID = $(this).attr('data-id');
        Type = $(this).attr('data-type');
    })

    $('#button_submitfeedback').on('click', function () {
        var FeedbackID = $('#reasonModal .Feedback:checked').val();
        var Remarks = $('#reasonModal #Remarks').val();
        var FeedbackDate = $('#reasonModal #FeedbackDate').val();

        var field_ids = ['ProjectID'];
        var combo_box_error = checkComboBox(field_ids);
        var error = checkValidations();     
        if(error === 'yes' || combo_box_error === 'yes'){
                alertify.error("<?php echo label('required_field');?>");
                return false;
        }else{
            if(submitflag == 0){
                  return false;
            }
            submitflag == 0;
            var ProjectID = $('#ProjectID').val();  
            if (OpportunityID>0) {
                $.ajax({
                    type: "post",
                    url: base_url + "admin/userfeedback/addFeedback",
                    data: {FeedbackID: FeedbackID, OpportunityID: OpportunityID,Remarks:Remarks,Type:Type,ProjectID:ProjectID,FeedbackDate:FeedbackDate},
                    success: function (data){ 
                        var tm =  confirm('Do you want to add reminder ?');
                        if(tm){
                            location.replace("<?php echo site_url("admin/opportunity/addreminder/");?>"+OpportunityID);
                        }else{
                            ajax_listing(10,1);
                            $('#reasonModal').closeModal();
                            alertify.success('Feedback added Successfully.');
                        }
                    }
                })    
            }    
        }
    })

</script>