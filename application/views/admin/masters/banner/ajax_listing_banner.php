<?php foreach ($banner_array as $banner) { ?>
    <tr class="gradeX" id="row_<?php echo $banner->BannerID; ?>">

        <td align="center"><?php echo $banner->BannerTitle; ?></td>

        <?php
        if ($banner->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
        <td>
            <?php echo $banner->SubTitle; ?>
        </td>
        <td><?php echo $banner->Sequence; ?></td>

        <td >
            <?php
            if (isset($banner->ImageURL) && $banner->ImageURL != "" && (file_exists(str_replace('/system', '', BASEPATH) . BANNER_UPLOAD_PATH . $banner->ImageURL))) {
                $path = site_url(BANNER_UPLOAD_PATH . $banner->ImageURL);
            } else {
                $path = site_url(DEFAULT_IMAGE);
            }
            ?> 
            <img class="materialboxed" src='<?php echo $path; ?>'  height='75' width='100'>

        </td>                                



        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-banner-id="<?php echo $banner->BannerID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-banner-id="<?php echo $banner->BannerID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-banner-id="<?php echo $banner->BannerID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $banner->Status; ?></span> 
        </td>


        <td class="center action">

            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/masters/banner/edit/<?php echo $banner->BannerID; ?>" style="cursor:pointer;">
                <i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-banner-id="<?php echo $banner->BannerID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   
<script>
    $(document).ready(function () {
        $('.materialboxed').materialbox();
    });
</script>