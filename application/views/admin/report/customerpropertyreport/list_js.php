<script>
window.PageSize = 10;
window.CurrentPage = 1;
window.FilterType = "<?php echo $FilterType;?>";
window.ReportType = "<?php echo $ReportType;?>";
window.CustomStartDate = "";
window.CustomEndDate = "";
window.datatab = "Verified";
window.ProjectID = -1;

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

$(document).on("change","input[type='radio']",function(){
    FilterType = $(this).val();
    if(FilterType == "Other"){
        $("#"+ReportType+ " .CustomDateFilter").removeClass("hide");
        return ;
    }else{
        $("#"+ReportType+ " .CustomDateFilter").addClass("hide");
    }
	ajax_listing(PageSize,CurrentPage);
});
$(document).on("click",".button_submit",function(){
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
    ajax_listing(PageSize,CurrentPage); 
});
function ajax_listing(PageSize, CurrentPage){

    var tmp = "( " + ReportType + " - " + FilterType + " )";
    if(ReportType == "Followup"){
        tmp = "( Visitor Follow up - " + FilterType + " )";
    }
    var label= "( " + datatab  + " )";
    $("#reportlabel").html(label);
    $.ajax({
            type: "post",
            url: base_url + "admin/report/CustomerProperty/ajax_listing/"+PageSize+"/"+ CurrentPage,
            data: {
                FilterType:FilterType,
                ReportType:ReportType,
                CustomStartDate:CustomStartDate,
                CustomEndDate:CustomEndDate,
                ProjectID: ProjectID,
                },
            success: function (data){
                var obj = JSON.parse(data);
                $('#' + ReportType + ' #table_body').html(obj.a);
                $('#' + ReportType + ' #table_paging_div').html(obj.b);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
}
$('.tabs .tabclick').on('click', function () {
        datatab = $(this).attr("data-tab");
        var myid = $(this).attr("href");
        ReportType = myid.replace('#','');
        FilterType = $("#"+ReportType+" input[type=radio]:checked").val();
        CustomStartDate = $("#"+ReportType+" #CustomStartDate").val();
        CustomEndDate = $("#"+ReportType+" #CustomEndDate").val();
        PageSize = $("#" + ReportType + " #select-dropdown").val();
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