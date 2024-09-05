<?php
if (!empty($data_array)) {
	foreach ($data_array as $data) { ?>
		<tr id="row_<?php echo $data->CustomerReminderID; ?>">
			<td>
				<?php
				if (@$this->cur_module->is_response == 1) {
				?>
					<a class="txt-underline bold" href="<?php echo site_url("admin/user/response/index/" . $data->CustomerPropertyID . "/" . $data->CustomerReminderID); ?>">
					<?php }
				echo $data->Message;
				if (@$this->cur_module->is_response == 1) { ?></a><?php } ?></td>
			<td><?php echo SalaryComma($data->Amount); ?></td>
			<td><?php echo $data->ReminderDate; ?></td>
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
			<td class="status action center">
				<i title="Inactive" class="<?php echo ($IsCancelled == 0) ? '' : ' disabled-edit'; ?> btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->CustomerReminderID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
				<i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->CustomerReminderID; ?>"></i>
				<i title="Active" class="<?php echo ($IsCancelled == 0) ? '' : ' disabled-edit'; ?> btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->CustomerReminderID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
			</td>
			<td class="action center">
				<a class="<?php echo ($IsCancelled == 0) ? '' : ' disabled-edit'; ?> btn-floating waves-effect waves-light blue m-r-5" href="<?php echo ($IsCancelled == 0) ? site_url('admin/user/reminder/edit/' . $CustomerPropertyID . "/" . $data->CustomerReminderID) : 'javascript:void(0)'; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i>
				</a>
				<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-id="<?php echo $data->CustomerReminderID; ?>">
					<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
				</a>
				<?php
				if ($IsCancelled == 0) {
				?>
					<?php
					if (@$this->cur_module->is_sms == 1) {
					?>
						<a href="javascript:void(0)" data-id="<?php echo $data->CustomerReminderID; ?>" data-type="Mail" data-user="CustomerReminder" class="reminderbtn btn-floating waves-effect waves-light orange accent-4">
							<i class="mdi-communication-email tooltipped" title="Send Mail"></i>
						</a>
					<?php
					}
					if (@$this->cur_module->is_mail == 1) {
					?>
						<a href="javascript:void(0)" data-id="<?php echo $data->CustomerReminderID; ?>" data-type="SMS" data-user="CustomerReminder" class="reminderbtn btn-floating waves-effect waves-light indigo accent-6">
							<i class="mdi-communication-textsms tooltipped" title="Send SMS"></i>
						</a>
					<?php
					}
					if (@$this->cur_module->is_response == 1) {
					?>
						<a href="javascript:void(0)" data-id="<?php echo $data->CustomerReminderID; ?>" class="addresponse btn-floating waves-effect waves-light teal darken-2">
							<i class="mdi-content-reply tooltipped" title="Add Response"></i>
						</a>

				<?php
					}
				}
				?>
			</td>
		</tr>
<?php }
}

?>