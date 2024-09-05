<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->GoodsReceivedNoteID; ?>">
        <?php 
            if(@$data->ChallanPhotoURL != null && (file_exists(BASEPATH.'../'.INWARD_UPLOAD_PATH.@$data->ChallanPhotoURL))){
                $path1 = site_url(INWARD_UPLOAD_PATH.$data->ChallanPhotoURL);
            }else{
                $path1 = $path = site_url(DEFAULT_IMAGE);
            }

            if(@$data->InvoiceImageURL != null && (file_exists(BASEPATH.'../'.INVOICE_UPLOAD_PATH.@$data->InvoiceImageURL))){
                $path2 = site_url(INVOICE_UPLOAD_PATH.$data->InvoiceImageURL);
            }else{
                $path2 = $path = site_url(DEFAULT_IMAGE);
            }
        ?>
        <td>
            <a class="image-popup-vertical-fit" href="<?php echo $path1;?>" >
                <img src="<?php echo $path1;?>" width="100" height="75">
            </a>
        </td>
        <td>
            <a class="image-popup-vertical-fit" href="<?php echo $path2;?>" >
                <img src="<?php echo $path2;?>" width="100" height="75">
            </a>
        </td>
        <td align="center">
            <a class="txt-underline bold" href="<?php echo site_url("admin/inward/details/".$data->GoodsReceivedNoteID); ?>"><?php echo $data->VendorName;?></a>
        </td>
		<td><?php echo $data->ChallanDate; ?></td>
        <td><?php echo $data->ChallanNo; ?></td>
        <td><?php echo $data->Title; ?></td>
        <td>
            <?php
                echo str_replace(",","</br>",$data->Item);
            ?>
        </td>
        <td><?php echo $data->TotalPrice; ?></td>
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $data->GoodsReceivedNoteID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS . ' ' .@$status; ?> hide" data-icon-type="loading" data-id="<?php echo $data->GoodsReceivedNoteID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $data->GoodsReceivedNoteID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th width_200"> 
            
            <?php if(@$this->cur_module->is_edit == 1){?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/inward/edit/'.$data->GoodsReceivedNoteID); ?>">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>

			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $data->GoodsReceivedNoteID; ?>" id="ViewModal">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
            <a class="modal-trigger btn-floating waves-effect waves-light blue" href="<?php echo site_url('admin/inward/changeinvoiceimg/'.$data->GoodsReceivedNoteID); ?>">
                <i title="Add Invoice Image" class="mdi-image-add-to-photos"></i>
            </a>
            <?php if (!empty(@$data->InvoiceImageURL)) { ?>
                <a href="javascript:void(0);" class="delete btn-floating waves-effect waves-light red" data-id="<?php echo $data->GoodsReceivedNoteID; ?>">
                    <i title="Delete Invoice Image" class="mdi-action-delete"></i>
                </a>
                <a class="btn-floating waves-effect waves-light grey darken-1 m-r-5" href="<?php echo $path2; ?>" download>
                    <i title="Download" class="<?php echo DOWNLOAD_ICON_CLASS; ?>"></i>
                </a>
            <?php } ?>
        </td>                                                         
    </tr>
<?php } ?>