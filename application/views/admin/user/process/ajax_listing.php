<?php
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerPropertyID; ?>">
		<td><?php echo @$data->EmployeeFirstName . " ".@$data->EmployeeLastName; ?></td>
		<td><?php echo $data->ProcessDate; ?></td>
		<td><?php echo $data->Discription; ?></td>
	</tr>
<?php }
  }

?>  