<?php 
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->RefundID; ?>">
		<td><?php echo $data->RefundDate;?></td>
		<td><?php echo $data->PaymentMode; ?></td>
		<td><?php echo ($data->is_price == 1 )?SalaryComma($data->RefundAmount):"-"; ?></td>
		<td><?php echo ($data->is_price == 1 )?SalaryComma($data->GSTAmount):"-"; ?></td>
		<td><?php echo ($data->PaymentMode == "Cheque")?$data->ChequeNo:$data->IFCCode; ?></td>
		<td><?php echo $data->AccountNo; ?></td>
		<td><?php echo $data->BankName; ?></td>
		<td><?php echo $data->BranchName; ?></td>
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
		<td class="action center">
			<?php 
			if(@$this->cur_module->is_edit == 1 && $IsDealClosed == 0){
			?>
			<a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/user/refund/edit/<?php echo $data->RefundID; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0">
                </i>
            </a>
			&nbsp;&nbsp;
			<?php } ?>
			<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-id="<?php echo $data->RefundID; ?>">
				<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
			</a>
			
		</td>      
	</tr>
<?php }
  }

?>  