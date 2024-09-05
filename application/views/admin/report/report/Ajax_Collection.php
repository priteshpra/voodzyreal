<?php 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerPaymentID; ?>">
		<td><?php echo $data->PropertyNo; ?></td>
		<td><?php echo $data->MileStone; ?></td>
		<td><?php echo $data->PaymentDate; ?></td>
		<td><?php echo $data->PaymentMode; ?></td>
		<td>
        <?php 
        if($data->AmountType == 0){
            echo "Including GST Amount";
        }else if($data->AmountType == 1){
            echo "Expluding GST Amount";
        }else{
            echo "Only GST Amount";
        }
        ?>
        </td>
		<td><?php echo SalaryComma($data->PaymentAmount); ?></td>
		<td><?php echo SalaryComma($data->GSTAmount); ?></td>
		<td><?php echo ($data->PaymentMode == "Cheque")?$data->ChequeNo:$data->IFCCode; ?></td>
		<td><?php echo $data->AccountNo; ?></td>
		<td><?php echo $data->BankName; ?></td>
		<td><?php echo $data->BranchName; ?></td>
	</tr>
<?php }
?>  