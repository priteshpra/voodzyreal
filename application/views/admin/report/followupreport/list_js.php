<script>
window.PageSize = 10;
window.CurrentPage = 1;
window.EmployeeID = '<?php echo($data['0']->UserID); ?>';
window.FromDate = "<?php echo date('01-m-Y'); ?>";
window.EndDate = "<?php echo date('d-m-Y'); ?>";
window.ReportType = '<?php echo($data['0']->FirstName.' '.$data['0']->LastName); ?>';

$(document).ready(function () {
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
    $('.tab').removeAttr('style');
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
        url: base_url + "admin/report/followUpReport/ajax_listing/"+PageSize+"/"+ CurrentPage,
        data: {
            EmployeeID:EmployeeID,
            FromDate:FromDate,
            EndDate:EndDate
            },
        success: function (data){
            var obj = JSON.parse(data);
            $(' #table_body').html(obj.a);
            $(' #table_paging_div').html(obj.b);
        },error: function (data){
            alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
        }
    })
}

$(document).on('change', '#FromDate', function () {
    FromDate = $('#FromDate').val();
    ajax_listing(PageSize, CurrentPage);
});

$(document).on('change', '#EndDate', function () {
    EndDate = $('#EndDate').val();
    ajax_listing(PageSize, CurrentPage);
});

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

</script>