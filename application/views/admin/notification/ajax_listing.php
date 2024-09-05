<?php foreach ($notification as $notification) { 
    $notification->Detail = json_decode($notification->Detail);
    // pr($notification->Detail);
    $clickevent = "";
    if(!empty($notification->Detail))
    if($notification->ActionType == 'ATSPayment' || $notification->ActionType == 'AddCustomerPayment' || $notification->ActionType == 'SDPayment' || $notification->ActionType == 'AddCustomerDocument' || $notification->ActionType == 'CustomerReminder') {

        if($notification->ActionType == 'AddCustomerDocument'){
            $tab = '#document';
        }elseif($notification->ActionType == 'CustomerReminder'){
            $tab = '#reminder';
        }else{
            $tab = '#payment';
        }

        $clickevent = "window.location='".base_url()."admin/user/property/details/".$notification->Detail->CustomerPropertyID.$tab."'";
    }elseif($notification->ActionType == 'AddCustomerProperty'){
        $clickevent = "window.location='".base_url()."admin/user/customer/details/".$notification->Detail->CustomerID."#property'";
    }elseif($notification->ActionType == 'AddCustomer'){
        $clickevent = "window.location='".base_url()."admin/user/customer/details/".$notification->Detail->CustomerID."'";
    }elseif($notification->ActionType == 'VisitorReminder'){
        $clickevent = "window.location='".base_url()."admin/user/visitor/details/".$notification->Detail->VisitorID."#reminder'";
    }elseif($notification->ActionType == 'Visitor'){
        $clickevent = "window.location='".base_url()."admin/user/visitor/details/".$notification->Detail->VisitorID."'";
    }
    ?>
    <tr onclick="<?php echo $clickevent; ?>" class="gradeX" id="row_<?php echo $notification->NotificationID; ?>">
		<td align="center"><?php echo $notification->Title; ?></td>
        <td align="center"><?php echo date('d-m-Y H:i',strtotime($notification->CreatedDate)); ?></td>
        <td align="center"><?php echo ucfirst($notification->Description); ?></td>

		<?php /*
        if ($notification->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $notification->NotificationID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $notification->NotificationID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $notification->NotificationID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th"> 
        
        <?php if(@$this->cur_module->is_edit == 1){?>

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/notification/edit/<?php echo $notification->NotificationID; ?>" >
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" >
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $notification->NotificationID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td><?php */ ?>                                                                                                                                                                            
    </tr>
<?php } ?>   