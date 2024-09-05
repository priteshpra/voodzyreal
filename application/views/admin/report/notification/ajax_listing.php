<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->OpportunityID; ?>">
        <td><?php echo $data->Type; ?></td>
        <td><?php echo $data->dt; ?></td>
        <td><?php echo $data->name; ?></td>
        <td><?php echo $data->email; ?></td>
        <td><?php echo $data->mobile; ?></td>
        <td class="action center action-box-th">
            <a href="<?php echo $this->config->item('base_url'); ?>admin/opportunity/assign/<?php echo $data->OpportunityID; ?>" class="btn-floating waves-effect waves-light brown" data-id="<?php echo $data->OpportunityID; ?>">
                <i title="Assign Lead" class="mdi-action-launch"></i>
            </a>
        </td>
    </tr>
<?php } ?>