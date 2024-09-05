<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->VisitorID; ?>">
        <td>
            <?php
            if ($data->OpportunityID != 0) {
                echo "Opportunity (" . $data->OpportunityType . ')';
            } elseif ($data->IsCustomer == 1) {
                echo "Customer";
            } else {
                echo "data";
            }
            ?>
        </td>
        <td><a class="txt-underline bold" href="<?php echo site_url("admin/user/visitor/details/" . $data->VisitorID); ?>"><?php echo $data->FirstName . " " . $data->LastName; ?></a></td>
        <td><?php echo $data->EmployeeFirstName . " " . $data->EmployeeLastName; ?></td>
        <td><a href="mailto:<?php echo $data->EmailID; ?>"><?php echo $data->EmailID; ?></a> </td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->LeadType; ?></td>
        <td><?php echo $data->InquiryDate; ?></td>
        <td><?php echo $data->VisitorStatus; ?></td>
        <td><?php echo $data->RequirementValue; ?></td>
        <td><?php echo $data->SitesCount; ?></td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $data->VisitorID; ?>" data-leadid="<?php echo $data->OpportunityID; ?>" data-type="Visitor" data-name="<?php echo $data->FirstName . " " . $data->LastName; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light grey darken-2" data-id="<?php echo $data->VisitorID; ?>" data-leadid="<?php echo $data->OpportunityID; ?>" data-type="Lead" data-name="<?php echo $data->FirstName . " " . $data->LastName; ?>">
                <i title="View Lead Feedback" class="mdi-communication-textsms"></i>
            </a>
            &nbsp;&nbsp;
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $data->VisitorID; ?>" data-project="<?php echo $data->Project; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
        </td>
    </tr>
<?php } ?>