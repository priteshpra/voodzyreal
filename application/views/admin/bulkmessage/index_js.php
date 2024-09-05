<script type="text/javascript">
	$(document).on('click','#button_submit', function(){
		$('#sendMsgForm').submit();
	});
	$(document).ready(function(){
		<?php if(@$_GET['m']=='success'){?>
			alertify.success("<?php echo label('send_bulk_message_successfully'); ?>");
		<?php } ?>

		<?php if(@$_GET['m']=='err'){?>
			alertify.error("<?php echo label('send_bulk_message_fail'); ?>");
		<?php } ?>
	});

	function LoadPropertyBasedProject(){}
	$('#S_button_submit').on('click', function (){
		var combo_box_error = "no";
		var rec = $('#message_sapien input[name=Receiver]:checked').val()
        var error = checkValidations('#message_sapien');
		if(rec == "ProjectCustomer"){ 
			var field_ids = ['message_sapien #ProjectID'];
        	combo_box_error = checkComboBox(field_ids);	
		}
		if (error == 'yes' || combo_box_error == 'yes'){
			alertify.error("<?php echo label('required_field'); ?>");
            return false;
		}else{
			$('#sendMsgForm').submit();
		}
		return false;
	});
	$('#M_button_submit').on('click', function (){
		var combo_box_error = "no";
		var rec = $('#email_sapien input[name=Receiver]:checked').val()
        var error = checkValidations('#email_sapien');
		if(rec == "ProjectCustomer"){
			var field_ids = ['email_sapien #ProjectID'];
        	combo_box_error = checkComboBox(field_ids);	
		}
		if (error == 'yes' || combo_box_error == 'yes'){
			alertify.error("<?php echo label('required_field'); ?>");
            return false;
		}else{
			$('#sendMailForm').submit();
		}
		return false;
	});
	$('#message_sapien input[name=Receiver]').on('change',function(){
        if($(this).val() == 'ProjectCustomer'){
            $('#S_ProjectDiv').removeClass('hide');
			$('#S_CustomeMobile').addClass('hide');
        }else if($(this).val() == 'Custome'){
			$('#S_ProjectDiv').addClass('hide');
            $('#S_CustomeMobile').removeClass('hide');
        }else{
            $('#S_ProjectDiv').addClass('hide');
			$('#S_CustomeMobile').addClass('hide');
        }
    });
    $('#email_sapien input[name=Receiver]').on('change',function(){
        if($(this).val() == 'ProjectCustomer'){
            $('#M_ProjectDiv').removeClass('hide');
        }else{
            $('#M_ProjectDiv').addClass('hide');
        }
    });
</script>