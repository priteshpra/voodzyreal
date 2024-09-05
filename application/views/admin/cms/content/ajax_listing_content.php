<?php
foreach ($content as $content) {
    ?>
    <tr id="row_<?php echo $content->CMSID; ?>">
        <td align="center"><?php echo $content->PageName; ?></td>  
        <?php
        if ($content->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
        <td class="center action">
            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-content-id="<?php echo $content->CMSID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-content-id="<?php echo $content->CMSID; ?>"></i>
            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-content-id="<?php echo $content->CMSID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $content->Status; ?></span> 
        </td>
        <td class="center action">
            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/masters/content/edit/<?php echo $content->CMSID; ?>" style="cursor:pointer;"><i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" ></i>                                        
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-content-id="<?php echo $content->CMSID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" ></i>
            </a>
        </td>      
    </tr>
<?php }
?>
