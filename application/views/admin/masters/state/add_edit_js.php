<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#StateName').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var field_ids = ['CountryID'];
        var combo_box_error = checkComboBox(field_ids);
		if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            var id = $('#cuid').val();
			var StateName = $('#StateName').val();
			 if(submitflag == 0){
				return false;
			}
			submitflag = 0;
			$.ajax({
				type:"post",
				url: base_url + "admin/masters/state/checkDuplicate",
				data:{
					table_name:'sssm_state',
					field_name:'StateName',
					data_value:StateName,
					ufield:'StateID',
					ID:id,
					},
				success:function(data)
				{
					submitflag = 1;
					var obj = JSON.parse(data);

					if(obj.result == 'Success'){
						$('#button_submit').addClass('hide');
						$('#button_submit_loading').removeClass('hide');
						alertify.success("<?php echo label('please_wait');?>");
						$('form').submit();
						
					}else{
						alertify.error("<?php echo label('state_already_exists');?>");
						return false;
					}           
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
    function LoadStatesBasedCountry(){
        
    }
</script>