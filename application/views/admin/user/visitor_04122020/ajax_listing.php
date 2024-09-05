<?php foreach ($visitor as $visitor) { ?>
    <tr class="gradeX" id="row_<?php echo $visitor->VisitorID; ?>">
        <td>
            <?php
            if ($visitor->OpportunityID != 0) {
                echo "Opportunity (" . $visitor->OpportunityType . ')';
            } elseif ($visitor->IsCustomer == 1) {
                echo "Customer";
            } else {
                echo "Visitor";
            }
            ?>
        </td>
        <td><a class="txt-underline bold" href="<?php echo site_url("admin/user/visitor/details/" . $visitor->VisitorID); ?>"><?php echo $visitor->FirstName . " " . $visitor->LastName; ?></a></td>
        <td><?php echo $visitor->EmployeeFirstName . " " . $visitor->EmployeeLastName; ?></td>
        <td><a href="mailto:<?php echo $visitor->EmailID; ?>"><?php echo $visitor->EmailID; ?></a> </td>
        <td><?php echo $visitor->MobileNo; ?></td>
        <td><?php echo $visitor->LeadType; ?></td>
        <td><?php echo $visitor->InquiryDate; ?></td>
        <td><?php echo $visitor->VisitorStatus; ?></td>
        <!-- <td><?php echo $visitor->Address; ?></td>
        <td><?php echo $visitor->CompanyName; ?></td>
        <td><?php echo $visitor->Designation; ?></td> -->
        <td><?php echo $visitor->SitesCount; ?></td>
        <!-- <td><?php echo $visitor->Requirenment; ?></td> -->
        <!-- <td><?php echo $visitor->SecondName; ?></td>
        <td><?php echo $visitor->SecondMobileNo; ?></td> -->
        <?php
        if ($visitor->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if (@$this->cur_module->is_status == 1) {
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th hide">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $visitor->VisitorID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $visitor->VisitorID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $visitor->VisitorID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light brown" data-id="<?php echo $visitor->VisitorID; ?>" data-leadid="<?php echo $visitor->OpportunityID; ?>" data-type="Visitor" data-name="<?php echo $visitor->FirstName . " " . $visitor->LastName; ?>">
                <i title="View Feedback" class="mdi-communication-textsms"></i>
            </a>
            <a href="javascript:void(0);" data-target="FeedbackModal" class="feedbackinfo modal-trigger btn-floating waves-effect waves-light grey darken-2" data-id="<?php echo $visitor->VisitorID; ?>" data-leadid="<?php echo $visitor->OpportunityID; ?>" data-type="Lead" data-name="<?php echo $visitor->FirstName . " " . $visitor->LastName; ?>">
                <i title="View Lead Feedback" class="mdi-communication-textsms"></i>
            </a>
            &nbsp;&nbsp;
            <a href="javascript:void(0);" class="addfeedback modal-trigger btn-floating waves-effect waves-light teal darken-1" data-id="<?php echo $visitor->VisitorID; ?>" data-project="<?php echo $visitor->Project; ?>">
                <i title="Add Feedback" class="mdi-maps-rate-review"></i>
            </a>
        </td>
        <td class="action center action-box-th">

            <?php if (@$this->cur_module->is_edit == 1) { ?>

                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/user/visitor/edit/<?php echo $visitor->VisitorID; ?>" style="cursor:pointer;">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $visitor->VisitorID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
    </tr>
<?php } ?>