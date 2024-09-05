<?php
if (!empty($data_array)) {
	foreach ($data_array as $data) { ?>
		<tr id="row_<?php echo $data->CustomerPropertyVideoID; ?>">
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
			if (@$this->cur_module->is_status == 1 && $IsCancelled == 0) {
				$status = CHANGE_STATUS;
			}
			?>
			<td class="action center">
				<a class="btn-floating waves-effect waves-light black m-r-5" href="<?php echo $data->DocumentUrl; ?>" target="_blank">
					<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
				</a>
				<a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $data->DocumentUrl; ?>" download>
					<i title="Download" class="<?php echo DOWNLOAD_ICON_CLASS; ?>"></i>
				</a>
			</td>
		</tr>
<?php }
}

?>