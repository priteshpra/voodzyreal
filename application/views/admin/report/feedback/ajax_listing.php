<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->Feedback; ?>">
        <td><?php echo $data->Feedback; ?></td>
        <td><?php echo $data->Phone; ?></td>
		<td><?php echo $data->Reference; ?></td>
        <td><?php echo $data->My99Acres; ?></td>
        <td><?php echo $data->Facebook; ?></td>
        <td><?php echo $data->MagicBreaks; ?></td>
        <td><?php echo $data->HomeOnline; ?></td>
        <td><?php echo $data->GoogleAds; ?></td>
    </tr>
<?php } ?>   