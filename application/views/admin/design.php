<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="#"><strong>Design Mode</strong></a>
            </h4>
            <form class="col s12" id="edit_album_form" method="post">
                <div class="row">            
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter Name, Maximum length is 50"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="Name" name="Name" type="text"  maxlength="50" class="empty_validation_class" tabindex="1"/>
                        <label for="Name">Name</label>
                    </div>
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter User Name, Maximum length is 50"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                        <input id="UserName" name="UserName" type="text"  maxlength="50" class="empty_validation_class" tabindex="1"/>
                        <label for="UserName">User Name</label>
                    </div>
                    <div class="input-field col s12">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter Address, Maximum length is 500"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a
                        >                     
                        <textarea name="Content" id="Content"  class="materialize-textarea empty_validation_class" maxlength="500"></textarea>
                        <label for="Content">Content</label>
                    </div>  
                    <div class="input-field col s4">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter BirthdayDate."><i class="mdi-action-info"></i></a>                     
                        <input type="text" name="BirthdayDate" id="BirthdayDate" value="" tabindex="2" value="" class="datepicker empty_validation_class">
                        <label for="BirthdayDate">Birthday Date</label>
                    </div> 
                    <div class="input-field col s4">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="Please enter InTime."><i class="mdi-action-info"></i></a>                     
                         <label class="grey-text text-darken-4 active" for="InTime">InTime</label>
                         <input id="InTime" name="InTime" class="input_starttime timepicker empty_validation_class" value="" type="text"  tabindex="1">
                    </div>   
                    <div class="input-field col s4">
                        <label class="grey-text text-darken-4 active" for="OutTime">OutTime</label>
                         <input id="OutTime" name="OutTime" class="input_endtime timepicker empty_validation_class" value="" type="text"  tabindex="2">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">     
                        <input  tabindex="2" type="checkbox" class="" name="Status" id="Status" <?php
                        if (isset($album->Status) && $album->Status == INACTIVE) {
                            echo "";
                        } else {
                            echo "checked='checked'";
                        }
                        ?> tabindex="2" />
                        <label for="Status">Status</label>
                    </div>                   
                    <div class="input-field col s6">
                        <button class="btn waves-effect waves-light right" type="submit" id="button_album_submit" name="button_album_submit" tabindex="3">Submit
                        </button>
                        <a tabindex="4" href="<?php echo $this->config->item('base_url'); ?>admin/masters/album" class="right close-button">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
