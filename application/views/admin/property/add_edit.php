<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/employeedetails"><strong><?php echo label('msg_lbl_title_employeedetails')?></strong>
                </a>
            </h4>        
            <div class="row">
            <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/employeedetails/<?php echo $page_name; ?>">
                <div class="row">
                        <div class="input-field col s6">
                           <?=@$employee?>
                        </div>
                                                
                        <div class="input-field col s6">
                           <?=@$user?>
                        </div>
                </div>   
               
                 <div class="row">
                    <div class="input-field col s6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_LeaveStartDate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input type="text" name="LeaveStartDate" id="LeaveStartDate" value="<?php echo isset($employeedetails->LeaveStartDate) ? $employeedetails->LeaveStartDate : '' ?>" value="" class="datepicker ">
                        <label name="LeaveStartDate" class="">Leave Start Date</label>
                    </div>
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_LeaveEndDate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input type="text" name="LeaveEndDate" id="LeaveEndDate" value="<?php echo isset($employeedetails->LeaveEndDate) ? $employeedetails->LeaveEndDate : '' ?>" value="" class="datepicker ">
                        <label name="LeaveEndDate" class="">Leave End Date</label>
                    </div>
                 </div>
                 <div class="row">
                  <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_LeaveDays');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="LeaveDays" name="LeaveDays" value="<?php echo @$employeedetails->LeaveDays; ?>" type="text"  maxlength="100" class="NumberOnly empty_validation_class" />
                    <label for="LeaveDays"><?php echo label('msg_lbl_LeaveDays');?></label>
                  </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                   <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_LeaveReason');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <textarea name="LeaveReason" id="LeaveReason" class="materialize-textarea" maxlength="5000"><?php echo@$employeedetails->LeaveReason;?></textarea>
                            <label for="LeaveReason"><?php echo label('msg_lbl_LeaveReason');?></label>
                        </div>      
                </div>
                  <div class="row">
                    <div class="input-field col s4">
                        <br>
                        <label for="UserType"><?php echo label('msg_lbl_UserType');?></label>

                        <br>
                        <input name="UserType" type="radio" value="Employee" id="Employee" checked='checked'<?php
                            if (isset($employeedetails->UserType) && $employeedetails->UserType == "Attendee"){ echo "";}
                            else{ echo "checked='checked'";}?>/>
                        <label for="Employee">Employee</label>


                        <input name="UserType" type="radio" value="Attendee" id="Attendee" <?php
                            if (isset($employeedetails->UserType) && $employeedetails->UserType == "Attendee"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="Attendee">Attendee</label>
                    </div>
                    <div class="input-field col s4">
                        <br>
                        <label for="TypeOfLeave"><?php echo label('msg_lbl_TypeOfLeave');?></label>

                        <br>
                        <input name="TypeOfLeave" type="radio" value="PL" id="PL" checked='checked'<?php
                            if (isset($employeedetails->TypeOfLeave) && $employeedetails->TypeOfLeave == "PL"){ echo "";}
                            else{ echo "checked='checked'";}?>/>
                        <label for="PL">PL</label>


                        <input name="TypeOfLeave" type="radio" value="SL" id="SL" <?php
                            if (isset($employeedetails->TypeOfLeave) && $employeedetails->TypeOfLeave == "SL"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="SL">SL</label>

                        <input name="TypeOfLeave" type="radio" value="EL" id="EL" <?php
                            if (isset($employeedetails->TypeOfLeave) && $employeedetails->TypeOfLeave == "EL"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="EL">EL</label>
                    </div>

                    <div class="input-field col s4">
                        <br>
                        <label for="LeaveStatus"><?php echo label('msg_lbl_LeaveStatus');?></label>

                        <br>
                        <input name="LeaveStatus" type="radio" value="Pending" id="Pending" checked='checked'<?php
                            if (isset($employeedetails->LeaveStatus) && $employeedetails->LeaveStatus == "Pending"){ echo "";}
                            else{ echo "checked='checked'";}?>/>
                        <label for="Pending">Pending</label>


                        <input name="LeaveStatus" type="radio" value="Approved" id="Approved" <?php
                            if (isset($employeedetails->LeaveStatus) && $employeedetails->LeaveStatus == "Approved"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="Approved">Approved</label>

                        <input name="LeaveStatus" type="radio" value="Disapproved" id="Disapproved" <?php
                            if (isset($employeedetails->LeaveStatus) && $employeedetails->LeaveStatus == "Disapproved"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="Disapproved">Disapproved</label>
                    </div>

                </div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($employeedetails->Status) && @$employeedetails->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeedetails" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>