<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->ResponseID; ?>">
        
		<td><?php echo $data->EmployeeFirstName . " " . $data->EmployeeLastName; ?></td>
        <td><?php echo $data->Response; ?></td>
        <td><?php echo $data->CreatedDate; ?></td>
    </tr>
<?php } ?>   