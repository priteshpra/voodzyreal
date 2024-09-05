<?php foreach ($visitorsites as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->VisitorSitesID; ?>">
        <td><?php echo $data->ProjectID; ?></td>
        <td><?php echo $data->SiteName; ?></td>
		<td><?php echo $data->Remarks; ?></td>
		<td><?php echo $data->Finance; ?></td>
		<td><?php echo $data->PurposeofBuying; ?></td>
		<td><?php echo $data->PreferedTimeToCall; ?></td>
		<td><?php echo $data->InquiryDate; ?></td>
        <td><?php echo $data->EntryDate; ?></td>
		<td><?php echo $data->LeadType; ?></td>
		<?php
        if ($data->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->VisitorSitesID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' .@$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->VisitorSitesID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->VisitorSitesID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th"> 
            <?php 
            if(@$this->cur_module->is_edit == 1 ){
            ?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/user/sites/edit/'.$data->VisitorSitesID); ?>">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->VisitorSitesID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   