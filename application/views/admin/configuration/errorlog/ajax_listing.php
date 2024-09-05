<?php foreach ($error_logs as $error_log) { ?>
	<tr id="row_<?php echo $error_log->ErrorLogID; ?>">                                      
		
		<td align='center'><?php echo $error_log->MethodName; ?></td>  
		<td align='center'><?php echo $error_log->ErrorMessage; ?></td>
		<td align='center'><?php echo $error_log->ErrorDate; ?></td>

	</tr>
<?php }
?>