<?php
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerPropertyDocumentID; ?>">
		<td><?php echo $data->PropertyNo; ?></td>
		<td><?php echo $data->Title; ?></td>
		<?php
		if ($data->Status == ACTIVE) {
			$inactive_icon_status = "hide";
			$active_icon_status = "";
		} else {
			$inactive_icon_status = "";
			$active_icon_status = "hide";
		}
		if(@$this->cur_module->is_status == 1 && $IsCancelled == 0){
			$status = CHANGE_STATUS;
		}
		?>
		<td class="status action center">
			<i title="Inactive" class="<?php echo ($IsCancelled==0)?'':' disabled-edit';?> btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->CustomerPropertyDocumentID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->CustomerPropertyDocumentID; ?>"></i>
			<i title="Active"  class="<?php echo ($IsCancelled==0)?'':' disabled-edit';?> btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->CustomerPropertyDocumentID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
		</td>
		<td class="action center">
			<?php if(@$this->cur_module->is_edit == 1){?>
			<a class="<?php echo ($IsCancelled==0)?' delete ':' disabled-edit';?> modal-trigger btn-floating waves-effect waves-light red" href="javascript:void(0);" data-id="<?php echo $data->CustomerPropertyDocumentID; ?>">
				<i title="View" class="<?php echo DELETE_ICON_CLASS; ?>"></i>
			</a>
			<?php } ?>
			<a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $data->DocumentUrl; ?>" download>
				<i title="Download" class="<?php echo DOWNLOAD_ICON_CLASS; ?>"></i>
			</a>
		</td>      
	</tr>
<?php }
  }

?>  