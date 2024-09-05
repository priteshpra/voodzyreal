<?php
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerPropertyID; ?>">
		<td>
			<!-- <a class="txt-underline bold" href="<?php echo site_url('admin/user/property/details/'.$data->CustomerPropertyID);?>"> -->
			<?php echo $data->PropertyID; ?>
			<!-- </a> -->
		</td>
		<td><?php echo $data->SerialNo; ?></td>
		<td><?php echo $data->CustomerFirstName . " ".$data->CustomerLastName; ?></td>
		<td><?php echo ($data->PurchaseDate !="")?$data->PurchaseDate:''; ?></td>
		<!-- <td><?php echo $data->ChannelPartner; ?></td> -->
		<?php
		if ($data->IsHold == ACTIVE) {
			$inactive_icon_status = "hide";
			$active_icon_status = "";
		} else {
			$inactive_icon_status = "";
			$active_icon_status = "hide"; 
		}
		?>
		<td class="action center">

			<i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . ' '  . $inactive_icon_status; ?>" ></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . ' ' . $active_icon_status; ?>" ></i>
		</td>
		<?php
		if ($data->Status == ACTIVE) {
			$inactive_icon_status = "hide";
			$active_icon_status = "";
		} else {
			$inactive_icon_status = "";
			$active_icon_status = "hide";
		}
		if(@$data->is_status == 1 && $data->IsCancelled==0){
			$status = CHANGE_STATUS;
		}
		?>
		<td class="status action center">
			<i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->CustomerPropertyID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->CustomerPropertyID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->CustomerPropertyID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
		</td>
		<td class="action center">
			
			<a class="btn-floating waves-effect waves-light blue m-r-5 <?php echo ($data->IsCancelled==0 )?'':' disabled-edit ';?>" href="<?php echo ($data->IsCancelled==0 )?site_url('admin/user/property/edit/'.$CustomerID."/".$data->CustomerPropertyID):"javascript:void(0)"; ?>" ><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i>
			</a>

			<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-id="<?php echo $data->CustomerPropertyID; ?>">
				<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
			</a>

			<a class="btn-floating waves-effect waves-light red m-r-5 <?php echo ($data->IsCancelled==0)?' CancelProperty ':' disabled-edit ';?>" href="javascript:void(0);" data-id="<?php echo $data->CustomerPropertyID; ?>"><i title="Cancel" class="mdi-content-clear"></i>
			</a>

			<?php if ($data->Amount == 0 && $this->UserRoleID == -2 || $this->UserRoleID == -1 && $data->IsHold == 1) { ?>
				<a class="btn-floating waves-effect waves-light teal m-r-5" href="<?php echo site_url('admin/user/property/available/'.$data->CustomerPropertyID); ?>" data-id="<?php echo $data->CustomerPropertyID; ?>"><i title="Available" class="mdi-action-done"></i>
				</a>
			<?php } ?>
			<?php if ($this->UserRoleID == -2 || $this->UserRoleID == -1) { ?>
				<a class="btn-floating waves-effect waves-light indigo m-r-5" href="<?php echo site_url('admin/user/property/delete/'.$data->CustomerPropertyID); ?>" data-id="<?php echo $data->CustomerPropertyID; ?>"><i title="Delete" class="<?php echo DELETE_ICON_CLASS; ?>"></i>
				</a>
			<?php } ?>
		</td>      
	</tr>
<?php }
  }
?>  