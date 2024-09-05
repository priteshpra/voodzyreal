<?php 
	foreach ($data_araay as $data) { ?>
    <tr class="gradeX">
    	<td>
            <?php if($Type == 'Visitor'){ ?>
        		<input name="SelectData" class="SelectData" type="radio" id="<?php echo $data->VisitorID; ?>" value="<?php echo $data->VisitorID; ?>">
        		<label for="<?php echo $data->VisitorID; ?>" style="color:#000;"></label>
            <?php } else {?>
                <input name="SelectData" class="SelectData" type="radio" id="<?php echo $data->OpportunityID; ?>" value="<?php echo $data->OpportunityID; ?>" data-type="<?php echo $data->Type; ?>">
                <label for="<?php echo $data->OpportunityID; ?>" style="color:#000;"></label> 
            <?php } ?>
    	</td>
    	<td>
            <?php if($Type == 'Visitor'){ ?>
                <?php echo $data->FirstName.' '.$data->LastName; ?>
            <?php } else {?>
                <?php echo $data->Name; ?>
            <?php } ?>
        </td>
    	<td><?php echo $data->EmailID; ?></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo @$data->ReminderMessage; ?></td>
        <td><?php echo @$data->ReminderPastDate; ?></td>
        <td><?php echo @$data->ReminderReminderDate; ?></td>
        <td class="action center action-box-th">
            <?php if($Type == 'Visitor'){ ?>
                <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->VisitorID; ?>" data-name="<?php echo $data->FirstName ." " . $data->LastName; ?>" data-type="<?php echo $Type; ?>">
                    <i title="View Feedback" class="mdi-communication-textsms"></i>
                </a>
            <?php } else {?>
                <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->OpportunityID; ?>" data-name="<?php echo $data->Name; ?>" data-type="<?php echo $Type; ?>">
                    <i title="View Feedback" class="mdi-communication-textsms"></i>
                </a>
            <?php } ?>
        </td>
    </tr>
<?php } ?>   