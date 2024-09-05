<?php 
	foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->VisitorReminderID; ?>">
    	<td><?php echo $data->Message; ?></td>
        <td><?php echo @$data->ReminderDate; ?></td>
        <td><?php echo $data->PastDate; ?></td>
    </tr>
<?php } ?>   