<?php 
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
	<tr id="row_<?php echo $data->CustomerPaymentID; ?>">
		<td><?php echo $data->PropertyNo; ?></td>
		<td><?php echo $data->MileStone; ?></td>
		<td><?php echo ($data->PaymentDate !="")?GetDateInFormat($data->PaymentDate):''; ?></td>
		<td><?php echo $data->PaymentMode; ?></td>
		<td>
        <?php 
        if($data->AmountType == 0){
            echo "Including GST Amount";
        }else if($data->AmountType == 1){
            echo "Expluding GST Amount";
        }else{
            echo "Only GST Amount";
        }
        ?>
        </td>
		<td><?php echo ($data->is_price == 1 )?SalaryComma($data->PaymentAmount):"-"; ?></td>
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
		// }
		?>
		<td class="status action center">
			<i title="Inactive" class="<?php echo ($IsCancelled==0)?'':' disabled-edit';?> btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->CustomerPaymentID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $data->CustomerPaymentID; ?>"></i>
			<i title="Active"  class="<?php echo ($IsCancelled==0)?'':' disabled-edit';?> btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->CustomerPaymentID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
		</td>
		<td class="action center">
			<?php if(@$this->cur_module->is_edit == 1){?> 
			<a class="btn-floating waves-effect waves-light blue m-r-5 <?php echo ($IsCancelled==0)?'':' disabled-edit';?>" href="<?php echo ($IsCancelled==0)?site_url('admin/user/payment/edit/'.$CustomerPropertyID."/".$data->CustomerPaymentID):'javascript:void(0)'; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"></i>
			</a>
			&nbsp;&nbsp;
			<?php } ?>
			<a class="info modal-trigger btn-floating waves-effect waves-light black" href="javascript:void(0);" data-id="<?php echo $data->CustomerPaymentID; ?>">
				<i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
			</a>
			
		</td>      
	</tr>
<?php }
  }

?>  