<?php 
	foreach ($data_araay as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->OpportunityReminderID; ?>">
    	<td><?php echo $data->Type; ?></td>
    	<td><?php echo $data->name; ?></td>
        <td><?php echo @$data->mobile; ?></td>
        <td><?php echo $data->email; ?></td>
        <td><?php echo $data->Message; ?></td>
        <td><?php echo $data->ReminderDate; ?></td>
        <td><?php echo $data->PastDate; ?></td>
        <td><?php echo $data->ReminderMessage; ?></td>
        <td><?php echo $data->ReminderPastDate; ?></td>
        <td><?php echo $data->ReminderReminderDate; ?></td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->OpportunityID; ?>" data-name="<?php echo $data->name; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $data->OpportunityID; ?>" data-type="<?php echo $data->Type; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
        </td>
    </tr>
<?php } ?>   