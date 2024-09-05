<?php //echo pr($notificationmessages);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/notificationmessages"><strong><?php echo label('msg_lbl_title_notificationmessages')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/notificationmessages/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="Action" class="active"><?php echo label('msg_lbl_notificationaction')?></label>
							<select id="Action" name="Action" class="select2_class" style="width:100%;display:none">
								<option value="" selected="selected">Select Action</option>
								<option value='AddBooking' <?php if(@$notificationmessages->Action == 'AddBooking'){echo 'selected';}?>> AddBooking </option>
								<option value='ChangeBookingStatus' <?php if(@$notificationmessages->Action == 'ChangeBookingStatus'){echo 'selected';}?>> ChangeBookingStatus </option>
								<option value='RescheduleBooking' <?php if(@$notificationmessages->Action == 'RescheduleBooking'){echo 'selected';}?>> RescheduleBooking </option>
								  
							</select>
                        </div>
                         <div class="input-field col s6">
							<label for="Role" class="active"><?php echo label('msg_lbl_role')?></label>
							<select id="Role" name="Role" class="select2_class" style="width:100%;display:none">
								<option value="" selected="selected">Select Role</option>
								<option value='Admin' <?php if(@$notificationmessages->Role == 'Admin'){echo 'selected';}?>> Admin </option>
								<option value='Attendee' <?php if(@$notificationmessages->Role == 'Attendee'){echo 'selected';}?>> Attendee </option>
								<option value='Employee' <?php if(@$notificationmessages->Role == 'Employee'){echo 'selected';}?>> Employee </option>
								<option value='Customer' <?php if(@$notificationmessages->Role == 'Customer'){echo 'selected';}?>> Customer </option>
								  
							</select>
						 </div>
						 <div class="input-field col s12">
							<textarea name="message" id="message" class="materialize-textarea empty_validation_class"  maxlength="1000"><?php echo @$notificationmessages->message; ?></textarea>
                            <label for="Message">Message</label>
						</div>
						<div class="input-field col s12 m12">
						<?php if(@$notificationmessages->NotificationKeys != ''){ 
						echo $notificationmessages->NotificationKeys;	
						} ?>
						</div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($notificationmessages->Status) && @$notificationmessages->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/notificationmessages" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

