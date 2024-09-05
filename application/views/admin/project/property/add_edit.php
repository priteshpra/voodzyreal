<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/project/project/details/'.$ProjectID . '#property'); ?>"><strong>Property</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/project/property/<?php echo $Page;?>">
                    <div class="row">
                    <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID;?>" >
                    <input type="hidden" name="PropertyID" id="PropertyID" value="<?php echo isset($Property->PropertyID)?$Property->PropertyID:0;?>">
                      <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_propertyno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="PropertyNo" name="PropertyNo" value="<?php echo @$Property->PropertyNo;?>" type="text"  maxlength="100" class="NumberLetter empty_validation_class" />
                        <label for="PropertyNo"><?php echo label('msg_lbl_propertyno');?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="SaleableArea" name="SaleableArea" value="<?php echo @$Property->SaleableArea;?>" type="text"  maxlength="100" class="" />
                        <label for="SaleableArea"><?php echo label('msg_lbl_saleablearea');?></label>
                      </div>
                      <div class="input-field col s12 m6">
                        <input id="TarreceSaleableArea" name="TarreceSaleableArea" value="<?php echo @$Property->TarreceSaleableArea;?>" type="text"  maxlength="100" class="" />
                        <label for="TarreceSaleableArea"><?php echo label('msg_lbl_tarrecesaleablearea');?></label>
                      </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($Property->Status) && @$Property->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit</button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo site_url('admin/project/project/details/'.$ProjectID. '#property'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>