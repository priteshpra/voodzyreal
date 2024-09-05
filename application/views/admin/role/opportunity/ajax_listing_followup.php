<?php 
    foreach ($data_araay as $data) {  ?>

        <tr id="row_<?php echo $data->OpportunityReminderID; ?>">
            <td><?=$data->Message; ?></td>
            <td><?=$data->ReminderDate; ?></td>
            <td><?=$data->PastDate;?></td>
            <?php
            if ($data->Status == ACTIVE) {
                $inactive_icon_status = "hide";
                $active_icon_status = "";
            } else {
                $inactive_icon_status = "";
                $active_icon_status = "hide";
            }
            if(@$this->reminder_module->is_status == 1){
                $status = CHANGE_STATUS;
            }
            ?>
            <td class="status action center status-box-th">
                <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->OpportunityReminderID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
                <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->OpportunityReminderID; ?>"></i>
                <i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->OpportunityReminderID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            </td>
            <td class="action center"> 
                <?php 
                if(@$this->reminder_module->is_edit == 1){
                ?>
                    <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/opportunity/editreminder/'.$OpportunityID . "/" . $data->OpportunityReminderID); ?>">
                        <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                        </i>
                    </a>
                <?php } ?>
                <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->OpportunityReminderID; ?>">
                    <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
                </a>
            </td>
                     
        </tr>
    <?php }
    ?>