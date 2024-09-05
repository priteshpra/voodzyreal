<?php
foreach ($data_array as $data) {  ?>
    <tr id="row_<?php echo $data->VisitorReminderID; ?>">
        <td><?= $data->EmployeeFirstName . ' ' . $data->EmployeeLastName; ?></td>
        <td>
            <a class="txt-underline bold" href="<?php echo site_url("admin/user/visitor/details/" . $data->VisitorID); ?>">
                <?= $data->FirstName . ' ' . $data->LastName; ?>
            </a>
        </td>
        <td><?= $data->MobileNo; ?></td>
        <td><?= $data->Message; ?></td>
        <td><?= $data->ReminderDate; ?></td>
        <td><?= $data->PastDate; ?></td>
        <?php
        if ($data->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        $status = CHANGE_STATUS;
        ?>
        <td class="status action center status-box-th">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->VisitorReminderID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->VisitorReminderID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->VisitorReminderID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->VisitorID; ?>" data-name="<?php echo $data->FirstName . " " . $data->LastName; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            &nbsp;&nbsp;
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $data->VisitorID; ?>" data-project="<?php echo $data->Project; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
        </td>
    </tr>
<?php } ?>