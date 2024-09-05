<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#projectdetail'); ?>"><strong>Property</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/sales/details/<?php echo $Page; ?>">
                    <div class="row">
                        <input type="hidden" name="ProjectID" id="ProjectID" value="<?php echo $ProjectID; ?>">
                        <input type="hidden" name="ProjectDetailsID" id="ProjectDetailsID" value="<?php echo isset($Property->ProjectDetailsID) ? $Property->ProjectDetailsID : 0; ?>">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_propertyno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="TotalUnits" name="TotalUnits" value="<?php echo @$Property->TotalUnits; ?>" type="text" maxlength="100" class=" empty_validation_class" />
                            <label for="TotalUnits">Total Units</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="BuilderName" name="BuilderName" value="<?php echo @$Property->BuilderName; ?>" type="text" maxlength="100" class="empty_validation_class" />
                            <label for="BuilderName">Builder Name</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="PossessionYear" name="PossessionYear" value="<?php echo @$Property->PossessionYear; ?>" type="text" maxlength="4" class="empty_validation_class" />
                            <label for="PossessionYear">Possession Year</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="TotalFloors" name="TotalFloors" value="<?php echo @$Property->TotalFloors; ?>" type="text" maxlength="100" class="empty_validation_class" />
                            <label for="TotalFloors">Total Floors</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="Configuratoin" name="Configuratoin" value="<?php echo @$Property->Configuratoin; ?>" type="text" maxlength="100" class="empty_validation_class" />
                            <label for="Configuratoin">Configuratoin</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="ProjectType" name="ProjectType" value="<?php echo @$Property->ProjectType; ?>" type="text" maxlength="100" class="empty_validation_class" />
                            <label for="ProjectType">Project Type</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="BrocheureDownloadURL" name="BrocheureDownloadURL" value="<?php echo @$Property->BrocheureDownloadURL; ?>" type="text" maxlength="255" class="empty_validation_class" />
                            <label for="ProjectType">Brocheure Download URL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($Property->Status) && @$Property->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo site_url('admin/sales/property/details/' . $ProjectID . '#projectdetail'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>