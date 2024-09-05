<script type="text/javascript">

    $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        onSet: function( arg ){
        if ( 'select' in arg ){ //prevent closing on selecting month/year
            this.close();
        }
      }
    })

   $(document).ready(function () {
        //setTimeout(function(){ $('.search_action .select2_class .select-dropdown').first().click(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; 
        } elseif(isset($this->session->userdata['PostSuccess'])){
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['PostSuccess'] . " ')}, 2000);"; 
         }
        ?>   
    })

    window.current_page_size = 10;
    window.total_page = 1;

    if (<?php echo $this->session->userdata['RoleID'];?> =="-1" || <?php echo $this->session->userdata['RoleID'];?>=="-2") 
    {
        window.EmployeeID = "-1";
    }
    else
    {
        window.EmployeeID = '<?php echo $this->session->userdata['UserID'];?>';
    }

    window.Name = '';
    window.EmailID = '';
    window.MobileNo = ''; 
    window.Profession = '';
    window.Requirement = '';
    window.DesignationID = '-1';  
    window.Status = '-1';
    window.LeadType="All";
    
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/report/designation/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    EmployeeID: EmployeeID,
                    Name: Name,
                    EmailID: EmailID,
                    MobileNo: MobileNo,
                    Profession: Profession,
                    Requirement: Requirement,
                    DesignationID: DesignationID,
                    LeadType:LeadType
                    //Status_search: Status
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
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
		$("#model_title").html("<?php echo label('msg_lbl_visitor');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {

        if (<?php echo $this->session->userdata['RoleID'];?> =="-1" || <?php echo $this->session->userdata['RoleID'];?>=="-2") 
        {
            EmployeeID =  $('#UserID').val();
            if (EmployeeID == "Select Employee") {
                EmployeeID=-1;
            }
            else{
                EmployeeID =  $('#UserID').val();
            }
        }
        else
        {
            EmployeeID = '<?php echo $this->session->userdata['UserID'];?>';
        }
        
       Name =  $('#Name').val();
       EmailID =  $('#EmailID').val(); 
       MobileNo =  $('#MobileNo').val();
       Profession =  $('input[name=Profession]:checked').val();
       Requirement =  $('input[name=Requirement]:checked').val();
       DesignationID =  $('#DesignationID').val();
       LeadType =  $('input[name=LeadType]:checked').val();

       //alert(DesignationID);
        //Status = $('input[name="Status_search"]:checked').val();
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

</script>