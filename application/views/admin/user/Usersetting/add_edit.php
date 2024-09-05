<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/Usersetting"><strong>Usersetting </strong></a>
            </h4>
            <form class="col s12" id="edit_societymember_form" method="post" enctype="multipart/form-data" action="<?php echo $this->config->item('base_url'); ?>admin/user/Usersetting/<?php echo $page_name; ?>">        
                <div class="row">
                    <div class="input-field col s4">  
                        <label class="active">Type</label>
                        <input name="UserType" <?php
                        if (@$usersetting->UserType == 'Member') {
                            echo 'checked';
                        }
                        ?> type="radio" id="Member" value="Member" checked="checked"/>
                        <label for="Member">Member</label> 
                        <input name="UserType" <?php
                        if (@$usersetting->UserType == 'Vendor') {
                            echo 'checked';
                        }
                        ?> type="radio" id="Vendor" value="Vendor" />
                        <label for="Vendor">Vendor</label>

                        <input name="UserType" <?php
                        if (@$usersetting->UserType == 'Admin') {
                            echo 'checked';
                        }
                        ?> type="radio" id="Admin" value="Admin" />
                        <label for="Admin">Admin</label>

                    </div> 
                    <div id="member" class="input-field col s8"<?php
                    if (@$usersetting->UserType) {
                        if (@$usersetting->UserType != 'Member') {
                            echo " style='display:none' ";
                        }
                    }
                    ?>>
                             <?php
                             if (isset($member)) {
                                 echo $member;
                             }
                             ?>
                    </div>
                    <div id="vendor1" class="input-field col s8" <?php
                    if (@$usersetting->UserType) {
                        if (@$usersetting->UserType == 'Member') {
                            echo " style='display:none' ";
                        } else if (@$usersetting->UserType == 'Admin') {
                            echo " style='display:none' ";
                        }
                    }
                    else {
                        echo " style='display:none'";
                    }
                    ?>>
                             <?php
                             if (isset($vendor)) {
                                 echo $vendor;
                             }
                             ?>
                    </div>
                    <div class="input-field col s8" id="Admin1" <?php
                    if (@$usersetting->UserType) {
                        if (@$usersetting->UserType == 'Member') {
                            echo " style='display:none' ";
                        } else if (@$usersetting->UserType == 'Vendor') {
                            echo " style='display:none' ";
                        }
                    } else {
                        echo " style='display:none'";
                    }
                    ?>>
                             <?php
                             if (isset($Admin)) {
                                 echo $Admin;
                             }
                             ?>

                    </div> 
                </div>

                <div class="row">    
                    <div class="input-field col s2">
                        <div class="input-field col s12">
                            <label class="grey-text text-darken-4">Visitor Direct Allowed?</label>
                        </div>
                        <div class="clearfix" style="padding-top:20px;"></div>
                        <div class="input-field col s12 switch chart-revenue-switch right">
                            <label class="cyan-text text-darken-4">
                                Yes
                                <input type="checkbox" name="VisitorDirectAllowed" tabindex="3"<?php
                                if (isset($usersetting->VisitorDirectAllowed) && $usersetting->VisitorDirectAllowed == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?> >
                                <span class="lever"></span> No
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <div class="input-field col s12">
                            <label class="grey-text text-darken-4">PushNotification?</label>
                        </div>
                        <div class="clearfix" style="padding-top:20px;"></div>
                        <div class="input-field col s12 switch chart-revenue-switch right">
                            <label class="cyan-text text-darken-4">
                                Yes
                                <input type="checkbox" name="PushNotification" tabindex="3"<?php
                                if (isset($usersetting->PushNotification) && $usersetting->PushNotification == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?> >
                                <span class="lever"></span> No
                            </label>
                        </div>
                    </div>               
                    <div class="input-field col s2">
                        <div class="input-field col s12">
                            <label class="grey-text text-darken-4">ComplaintNotification?</label>
                        </div>
                        <div class="clearfix" style="padding-top:20px;"></div>
                        <div class="input-field col s12 switch chart-revenue-switch right">
                            <label class="cyan-text text-darken-4">
                                Yes
                                <input type="checkbox" name="ComplaintNotification" tabindex="3"<?php
                                if (isset($usersetting->ComplaintNotification) && $usersetting->ComplaintNotification == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?> >
                                <span class="lever"></span> No
                            </label>
                        </div>
                    </div>           
                    <div class="input-field col s2">
                        <div class="input-field col s12">
                            <label class="grey-text text-darken-4">TicketNotification?</label>
                        </div>
                        <div class="clearfix" style="padding-top:20px;"></div>
                        <div class="input-field col s12 switch chart-revenue-switch right">
                            <label class="cyan-text text-darken-4">
                                Yes
                                <input type="checkbox" name="TicketNotification" tabindex="3"<?php
                                if (isset($usersetting->TicketNotification) && $usersetting->TicketNotification == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?> >
                                <span class="lever"></span> No
                            </label>
                        </div>
                    </div>            
                <div class="input-field col s2">
                        <div class="input-field col s12">
                            <label class="grey-text text-darken-4">MaintenanceDueNotification?</label>
                        </div>
                        <div class="clearfix" style="padding-top:20px;"></div>
                        <div class="input-field col s12 switch chart-revenue-switch right">
                            <label class="cyan-text text-darken-4">
                                Yes
                                <input type="checkbox" name="MaintananceDueNotication" tabindex="3"<?php
                                if (isset($usersetting->MaintananceDueNotication) && $usersetting->MaintananceDueNotication == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?> >
                                <span class="lever"></span> No
                            </label>
                        </div>
                    </div>             
                </div>

                <div class="row">

                    <div class="input-field col s6">  
                    <br>   
                        <input  tabindex="2" type="checkbox" class="" name="Status" id="Status" <?php
                        if (isset($usersetting->Status) && $usersetting->Status == INACTIVE) {
                            echo "";
                        } else {
                            echo "checked='checked'";
                        }
                        ?> tabindex="2" />
                        <label for="Status">Status</label>
                    </div>                   
                </div> 
        <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light right" type="submit" id="button_Usersetting_submit" name="button_Usersetting_submit" tabindex="8">Submit
                </button>
                <?php echo $loading_button; ?>
                <a href="<?php echo $this->config->item('base_url'); ?>admin/user/Usersetting" class="right close-button">Close</a>
            </div>
        </div>
        </form>
    </div>
</div>
</div>