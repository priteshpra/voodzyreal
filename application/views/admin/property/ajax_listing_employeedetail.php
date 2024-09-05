<?php
if(!empty($employee_array)) { 
    foreach ($employee_array as $employee) { ?>
	<tr id="row_<?php echo $employee->EmployeeID; ?>">
        <?php 
		  if(@$employee->PictureURL != null && $employee->PictureURL != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).EMPLOYEE_UPLOAD_PATH.$employee->PictureURL))) { 
					$path = base_url() . EMPLOYEE_THUMB_UPLOAD_PATH . $employee->PictureURL;
				 }
				 else
				 {
					$path =  $this->config->item('admin_assets').'images/noimage.gif';
				}
			?> 
		<td align="center"><img alt="<?php echo $employee->PictureURL ?>" id="ImagePreivew" src='<?php echo @$path; ?>'  height='75' width='100'></td>
		<td align="center"><a href="<?php echo site_url("admin/employee/employeeinout/index/".$employee->EmployeeID); ?>"><?php echo $employee->FirstName .' ' .$employee->LastName;?></a></td>
		<td align="center"><?php echo $employee->Email; ?></td>
		<td align="center"><?php echo $employee->CellPhone; ?></td>
		<td align="center"><?php echo $employee->Gender; ?></td>
		<td align="center"><?php echo date('m-d-Y',strtotime($employee->DateOfJoin)); ?></td>
		<?php
		if ($employee->Status == ACTIVE) {
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
		<td class="status action center">
			<i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' ' . $inactive_icon_status; ?>" data-icon-type="inactive" data-employee-id="<?php echo $employee->EmployeeID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
			<i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-employee-id="<?php echo $employee->EmployeeID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect<?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-employee-id="<?php echo $employee->EmployeeID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
			 <span style="display:none;"><?php echo $employee->Status; ?></span> 
		</td>
		<td class="action center">
			<?php 
			if(@$this->cur_module->is_edit == 1){
			?>
			<a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/employee/employeedetail/edit/<?php echo $employee->EmployeeID; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i>
			&nbsp;&nbsp;
			<?php } ?>
			<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-employee-id="<?php echo $employee->EmployeeID; ?>">
				<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
			</a>
		</td>      
	</tr>
<?php }
  }

?>  