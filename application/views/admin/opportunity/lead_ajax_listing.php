<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->LeadProcessID; ?>">
        <td><?php echo $data->Message; ?></td>
        <td><?php echo $data->ProcessTime; ?></td>
    </tr>
<?php } ?>