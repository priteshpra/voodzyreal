<?php foreach ($chanelpartner as $chanelpartner) { ?>
    <tr class="gradeX" id="row_<?php echo $chanelpartner->ChanelPartnerID; ?>">
        <td style="position: relative; padding: 10px;">
            <div class="input-field printSticker_checkbox" style="margin: 0;position: absolute;left: 10px;top: 0;z-index: 1;">
                <input name="printSticker-status MyCheckBox" class="MyCheckBox" type="checkbox" id="<?php echo $chanelpartner->ChanelPartnerID; ?>" data-id="<?php echo $chanelpartner->MobileNo; ?>" data-businessName="<?php echo $chanelpartner->FirmName; ?>" value="<?php echo $chanelpartner->EmailID; ?>" > 
                <label for="<?php echo $chanelpartner->ChanelPartnerID; ?>"></label>
            </div>
        </td>
        <td align="center"><?php echo $chanelpartner->FirmName; ?></td>
        <td align="center"><?php echo $chanelpartner->FirstName." ".$chanelpartner->LastName; ?></td>
        <td align="center"><?php echo $chanelpartner->EmailID; ?></td>
        <td align="center"><?php echo $chanelpartner->MobileNo; ?></td>
        <td align="center"><?php echo $chanelpartner->PanCard; ?></td>
        <td align="center"><?php echo $chanelpartner->AadharCard; ?></td>
        <td align="center"><?php echo $chanelpartner->GSTNumber; ?></td>
        <td align="center"><?php echo $chanelpartner->BankAccount; ?></td>
        <td align="center"><?php echo $chanelpartner->BankName; ?></td>
        <td align="center"><?php echo $chanelpartner->IFCCode; ?></td>
        <td align="center"><?php echo $chanelpartner->ReraCode; ?></td>
        <?php
        if ($chanelpartner->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $chanelpartner->ChanelPartnerID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $chanelpartner->ChanelPartnerID; ?>"></i>
            <i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $chanelpartner->ChanelPartnerID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th"> 
        <?php if(@$this->cur_module->is_edit == 1){?>
            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/ChanelPartner/edit/<?php echo $chanelpartner->ChanelPartnerID; ?>" >
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" >
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $chanelpartner->ChanelPartnerID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                        </tr>
<?php } ?>   

