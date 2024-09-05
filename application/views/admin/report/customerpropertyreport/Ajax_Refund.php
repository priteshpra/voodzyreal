<?php 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->RefundID; ?>">
		<td><?php echo $data->PropertyNo; ?></td>
		<td><?php echo $data->RefundDate; ?></td>
		<td><?php echo $data->PaymentMode; ?></td>
		<td><?php echo SalaryComma($data->RefundAmount); ?></td>
		<td><?php echo SalaryComma($data->GSTAmount); ?></td>
		<td><?php echo ($data->PaymentMode == "Cheque")?$data->ChequeNo:$data->IFCCode; ?></td>
		<td><?php echo $data->AccountNo; ?></td>
		<td><?php echo $data->BankName; ?></td>
		<td><?php echo $data->BranchName; ?></td>
	</tr>
<?php }
?>  