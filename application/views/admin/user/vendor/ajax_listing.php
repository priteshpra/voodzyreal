<?php foreach ($vendor as $vendor) { ?>
    <tr class="gradeX" id="row_<?php echo $vendor->VendorID; ?>">
        <td align="center">
            <a class="txt-underline bold" href="<?php echo site_url("admin/user/vendor/details/".$vendor->VendorID.'/'.$vendor->UserID); ?>"><?php echo $vendor->VendorName;?></a>
        </td>
        <td align="center"><?php echo $vendor->EmailID; ?></td>
        <td align="center"><?php echo $vendor->MobileNo; ?></td>
        <td align="center"><?php echo $vendor->BusinessName; ?></td>
        <td align="center"><?php echo $vendor->CategoryName; ?></td>
        <td align="center"><?php echo $vendor->PANNo; ?></td>
        <td align="center"><?php echo $vendor->GSTNo; ?></td>
        <?php
        if ($vendor->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $vendor->VendorID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $vendor->VendorID; ?>"></i>
            <i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $vendor->VendorID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th"> 
            <?php if(@$this->cur_module->is_edit == 1){?>
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/user/vendor/edit/<?php echo $vendor->UserID; ?>" >
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" >
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $vendor->VendorID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                      
    </tr>
<?php } ?>   

