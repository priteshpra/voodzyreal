<?php
if (!empty($data_array)) {
	foreach ($data_array as $data) { ?>
		<tr id="row_<?php echo $data->PropertyImageTitleID; ?>">
			<td><?php echo $data->Title; ?></td>
			<?php
			if ($data->Status == ACTIVE) {
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
			<td class="status action center">
				<i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->PropertyImageTitleID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
				<i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->PropertyImageTitleID; ?>"></i>
				<i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->PropertyImageTitleID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
			</td>
			<td class="action center">
				<?php
				if (@$this->cur_module->is_edit == 1) {
				?>
					<a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/project/imagetitle/edit/<?php echo $ProjectID . "/" . $data->PropertyImageTitleID; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i></a>
				<?php } ?>
				<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-id="<?php echo $data->PropertyImageTitleID; ?>">
					<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
				</a>
			</td>
		</tr>
<?php }
}

?>