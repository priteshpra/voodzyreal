<?php //print_r($employeeinouttime);die();
foreach ($employeeinouttime as $employeeinouttime) { ?>
    <tr class="gradeX" id="row_<?php echo $employeeinouttime->EmployeeInOutID; ?>">
		<td align="center"><?php echo $employeeinouttime->FirstName . ' ' . $employeeinouttime->LastName; ?></td>
        <td align="center"><?php echo Date('m-d-Y',strtotime($employeeinouttime->InOutDate)); ?></td>
        <td align="center"><?php echo $employeeinouttime->InTime; ?></td>
        <td align="center"><?php echo $employeeinouttime->OutTime; ?></td>

	   <?php
        if ($employeeinouttime->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if(@$this->cur_module->is_status == 1){
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th">
        <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' ' . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $employeeinouttime->EmployeeInOutID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
        <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $employeeinouttime->EmployeeInOutID; ?>"></i>
        <i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $employeeinouttime->EmployeeInOutID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $employeeinouttime->Status; ?></span> 
        </td>
		<td class="action center action-box-th"> 
        
        <?php if(@$this->cur_module->is_edit == 1){?>

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeeinouttime/edit/<?php echo $employeeinouttime->EmployeeInOutID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $employeeinouttime->EmployeeInOutID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   