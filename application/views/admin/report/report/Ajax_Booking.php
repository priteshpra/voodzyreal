<?php
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerID; ?>">
		<td><a class="txt-underline bold" href="<?php echo site_url('admin/user/customer/details/'.$data->CustomerID);?>"><?php echo $data->FirstName . " ".$data->LastName; ?></a></td>
		<td><?php echo $data->EmailID; ?></td>
		<td><?php echo $data->MobileNo; ?></td>
		<td><?php echo $data->Address; ?></td>
	</tr>
<?php }
  }
?>  