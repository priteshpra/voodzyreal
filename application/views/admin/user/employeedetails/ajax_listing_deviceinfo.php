<?php //print_r($deviceinfo);die();
    foreach ($deviceinfo as $deviceinfo) {  ?>

        <tr id="row_<?php echo $deviceinfo->DeviceID; ?>">
            <td align="center"><?=$deviceinfo->DeviceName; ?></td>
            <td align="center"><?=$deviceinfo->DeviceOS; ?></td>
            <td align="center"><?=$deviceinfo->OSVersion; ?></td>
            <td align="center"><?=$deviceinfo->DeviceTokenID; ?></td>
            <td align="center"><?=$deviceinfo->DeviceType; ?></td>
            
            
            <td class="action center action-box-th"> 
                <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $deviceinfo->DeviceID; ?>">
                    <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
                </a>
            </td>           
        </tr>
    <?php }
    ?>