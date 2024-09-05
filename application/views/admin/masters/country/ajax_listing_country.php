<?php foreach ($countries as $country) { ?>
    <tr class="gradeX" id="row_<?php echo $country->CountryID; ?>">
        <td align="center"><?php echo $country->CountryName; ?></td>
        <?php
        if ($country->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
        <td class="action center">
            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-country-id="<?php echo $country->CountryID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-country-id="<?php echo $country->CountryID; ?>"></i>
            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-country-id="<?php echo $country->CountryID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $country->Status; ?></span> 
        </td>
        <td class="action center">
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/country/edit/<?php echo $country->CountryID; ?>" style="cursor:pointer;" class="btn-floating waves-effect waves-light blue"><i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-country-id="<?php echo $country->CountryID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>                                  
    </tr>
<?php } ?>   