<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->OpportunityID; ?>">
        <td><?php echo $data->Type; ?></td>
        <td><?php echo $data->dt; ?></td>
		<td>
            <a class="txt-underline bold" href="<?php echo site_url("admin/opportunity/details/".$data->OpportunityID); ?>">
                <?php echo $data->name; ?>            
            </a>
        </td>
        <td><?php echo $data->email; ?></td>
        <td><?php echo $data->mobile; ?></td>
        <td><?php echo $data->ReminderMessage; ?></td>
        <td><?php echo $data->ReminderPastDate; ?></td>
        <td><?php echo $data->ReminderReminderDate; ?></td>

        <!-- <td><?php echo $data->project; ?></td>
        <td><?php echo $data->locality; ?></td>
        <td><?php echo $data->city; ?></td>
        <td>
            <?php 
                if ($data->IsVisitor>0) {
                    echo 'Visitor ('.$data->EmployeeName.')'; 
                }
                else{
                    echo 'Opportunity';
                }
                
            ?>
        </td>
        <td><?php echo $data->msg; ?></td>
        <td><?php echo $data->dt.' '.$data->time; ?></td>
        <td><?php echo $data->vdate.' '.$data->VTime; ?></td>
        <td><?php echo $data->subject; ?></td>
        <td><?php echo $data->tranType; ?></td>
        <td><?php echo $data->loginid; ?></td> -->
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->OpportunityID; ?>" data-name="<?php echo $data->name; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $data->OpportunityID; ?>" data-type="<?php echo $data->Type; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
            <?php if ($data->AssignStatus=='New') { ?>
                <a href="javascript:void(0);" class="AssignLead btn-floating waves-effect waves-light brown" data-id="<?php echo $data->OpportunityID; ?>">
                    <i title="Assign Lead" class="mdi-action-launch"></i>
                </a>
            <?php } ?> 
            <?php 
                if ($data->IsVisitor==0) { ?>
                    <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/opportunity/convertToVisitor/<?php echo $data->OpportunityID; ?>">
                        <i title="Convert To Customer" class="mdi-notification-sync">
                        </i>
                    </a>
            <?php } ?>   
        </td>
        <!-- <td class="action center">
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
            <a href="javascript:void(0)" data-id="" data-type="Mail" data-user="" class="reminderbtn btn-floating waves-effect waves-light orange accent-4">
              <i class="mdi-communication-email tooltipped" title="Send Mail"></i>
            </a>
            <a href="javascript:void(0)" data-id="" data-type="SMS" data-user="" class="reminderbtn btn-floating waves-effect waves-light indigo accent-6">
              <i class="mdi-communication-textsms tooltipped" title="Send SMS"></i>
            </a>
        </td> -->
    </tr>
<?php } ?>   