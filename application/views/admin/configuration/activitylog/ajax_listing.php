<?php
	foreach ($customer_activity_logs as $customer_activity_log) {
		$date_arr = explode(' ',$customer_activity_log->CreatedDate);
		?>
		<tr id="row_<?php echo $customer_activity_log->CustomerActivityID; ?>">                                      
		
			<td align="center"><?php echo $customer_activity_log->MethodName; ?></td>  
			<td align="center"><?php echo $customer_activity_log->ActivityDescription; ?></td>
			<td align="center"><?php echo $date_arr[0].'&nbsp;&nbsp;'.$date_arr[1]; ?></td>
			
		</tr>
<?php }
?>  
