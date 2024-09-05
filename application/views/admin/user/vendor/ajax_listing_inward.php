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
        <td><?php echo $data->VendorName; ?></td>
        <td><?php echo $data->ChallanDate; ?></td>
        <td><?php echo $data->ChallanNo; ?></td>
        <td><?php echo $data->Title; ?></td>
        <td>
            <?php
                echo str_replace(",","</br>",$data->Item);
            ?>
        </td>
        <td><?php echo $data->TotalPrice; ?></td>
        <td class="action center action-box-th width_150"> 
            <!-- <?php if(@$this->cur_module->is_edit == 1){?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/masters/goods/edit/'.$data->GoodsReceivedNoteID); ?>">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?> -->
            <a class="modal-trigger btn-floating waves-effect waves-light blue" href="<?php echo site_url('admin/inward/changeinvoiceimg/'.$data->GoodsReceivedNoteID); ?>">
                <i title="Add Invoice Image" class="mdi-image-add-to-photos"></i>
            </a>
            <?php if (!empty(@$data->InvoiceImageURL)) { ?>
                <a href="javascript:void(0);" data-target="modal1" class="delete modal-trigger btn-floating waves-effect waves-light red" data-id="<?php echo $data->GoodsReceivedNoteID; ?>">
                    <i title="Delete Invoice Image" class="mdi-action-delete"></i>
                </a>
                
                <a class="btn-floating waves-effect waves-light grey darken-1 m-r-5" href="<?php echo $path2; ?>" download>
                    <i title="Download" class="<?php echo DOWNLOAD_ICON_CLASS; ?>"></i>
                </a>
            <?php } ?>
        </td>                                  
    </tr>
<?php } ?>   