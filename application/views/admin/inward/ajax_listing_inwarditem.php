<?php foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->GoodsReceivedItemID; ?>">
        <td><?php echo $data->GoodsName; ?></td>
        <td><?php echo $data->Qty; ?></td>
        <td><?php echo $data->Rate; ?></td>
        <td><?php echo $data->FinalPrice; ?></td>
        <td><?php echo $data->UOMName; ?></td>
        <td class="action center action-box-th width_150"> 
            <?php if(@$this->cur_module->is_edit == 1){?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo site_url('admin/inward/itemedit/'.$data->GoodsReceivedItemID); ?>">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?> 
        </td>                                  
    </tr>
<?php } ?>   