<?php	
if(!empty($customer_array)) {
foreach ($customer_array as $customer) {
    ?>
	<tr id="row_<?php echo $customer->CustomerID; ?>">
        <td align="center"><?php echo $customer->CustomerName; ?></td>
        <td align="center"><?php echo $customer->Email; ?></td>
        <td align="center"><?php echo $customer->Country; ?></td>
        <td align="center"><?php echo $customer->State; ?></td>
        <td align="center"><?php echo $customer->City; ?></td>
        <?php
        if ($customer->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
		<td class="status">
			<i title="Status" class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?>" data-icon-type="inactive" data-customer-id="<?php echo $customer->CustomerID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
			<i title="Status" class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-customer-id="<?php echo $customer->CustomerID; ?>"></i>
			<i title="Status" class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?>" data-icon-type="active" data-customer-id="<?php echo $customer->CustomerID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
			<span style="display:none;"><?php echo $customer->Status; ?></span> 
		</td>
		<td class="action">
			<a href="<?php echo $this->config->item('base_url'); ?>admin/admin/employeedetail/edit/<?php echo $customer->CustomerID; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            &nbsp;&nbsp;
           <a class="info modal-trigger" href="javascript:void(0);" data-customer-id="<?php echo $customer->CustomerID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>" style="color:black;"></i>
            </a>
            <?php //echo $view_modal_popup; ?>
        </td>      
    </tr>
<?php }
  } ?>  