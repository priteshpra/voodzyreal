<script>

    $(document).ready(function () {
          setTimeout(function(){ $('#MileStone').focus(); }, 1100);
          <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>  
      })
               
    
    $('#button_submit').on('click', function (){  
        var error = checkValidations();	    
        if(error === 'yes'){
				alertify.error("<?php echo label('required_field');?>");
				return false;
        }else{
            $.ajax({
                type: "post",
                url: base_url + "admin/project/milestone/CheckDuplicateDouble/",
                data: {
                    table_name:'sssm_projectmilestone',
                    field_name:'ProjectID',
                    data_value:$('#ProjectID').val(),
                    field_name1:'InstalmentNo',
                    data_value1:$('#InstalmentNo').val(),
                    ufield:'ProjectMileStoneID',
                    ID:$('#ProjectMileStoneID').val(),
                    },
                success: function (data)
                {
                    var obj = JSON.parse(data);
                    if(obj.result == "Success"){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                    }else{
                        alertify.error('<?php echo label('instalmentno_already_exist');?>');
                        return false;
                    }
                },
                error: function (data)
                {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                }
            })
            
        }
        return false;
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });

</script>