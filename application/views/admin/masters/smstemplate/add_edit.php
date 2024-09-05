<?php //pr($smstemplate);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/smstemplate"><strong><?php echo label('msg_lbl_title_smstemplate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/smstemplate/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_title');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Title" name="Title" type="text" class=" LetterOnly" value="<?php echo @$smstemplate->Title; ?>"  maxlength="250" />
                            <label for="Title"><?php echo label('msg_lbl_title')?></label>		
                        </div>
                         
						 <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_message');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<textarea name="message" id="message" class="materialize-textarea "><?php echo @$smstemplate->Message; ?></textarea>
                            <label for="Message">Message</label>
						</div>
						<div class="input-field col s12 m12">
						<?php if(@$smstemplate->SMSKeys != ''){ 
						echo $smstemplate->SMSKeys;	
						} ?>
						</div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($smstemplate->Status) && @$smstemplate->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/smstemplate" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

