<?php foreach ($Usersetting_array as $Usersetting) { ?>
    <tr class="gradeX" id="row_<?php echo $Usersetting->UserSettingID; ?>">

        <td align="center"><?php echo $Usersetting->UserType; ?></td>
        <td align="center"><?php if($Usersetting->VisitorDirectAllowed=="1"){echo "Yes";}else{echo "No";}?></td>
        <td align="center"><?php if($Usersetting->PushNotification=="1"){echo "Yes";}else{echo "No";} ?></td>
        <td align="center"><?php if($Usersetting->ComplaintNotification=="1"){echo "Yes";}else{echo "No";} ?></td>
        <td align="center"><?php if($Usersetting->TicketNotification=="1"){echo "Yes";}else{echo "No";} ?></td>
        <td align="center"><?php if($Usersetting->MaintananceDueNotication=="1"){echo "Yes";}else{echo "No";} ?></td>
        <?php
        if ($Usersetting->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>

        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-Usersetting-id="<?php echo $Usersetting->UserSettingID;; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-Usersetting-id="<?php echo $Usersetting->UserSettingID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-Usersetting-id="<?php echo $Usersetting->UserSettingID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $Usersetting->Status; ?></span> 
        </td>

        <td class="center action">

            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/user/Usersetting/edit/<?php echo $Usersetting->UserSettingID; ?>" style="cursor:pointer;">
                <i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0">
                </i>
            </a>
            &nbsp;&nbsp;

            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger"data-Usersetting-id="<?php echo $Usersetting->UserSettingID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="color:black;"></i>
            </a>
            <?php // echo $view_modal_popup; ?>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   