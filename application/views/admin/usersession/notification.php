<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('notificationsetting'); ?>"><strong>Notification Setting</strong></a>
            </h4>
            <form class="col s12" method="post" action="<?php echo site_url('notificationsetting'); ?>">
              <div class="row">
                <div class="switch col s3 m3 ">
                  Is Push : 
                  <label>
                    Off
                    <input type="checkbox" name="IsPush" id="IsPush" <?php if($data->IsPush==1) echo " checked ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
                <div class="switch col s3 m3">
                  Visitor Reminder : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="VisitorReminder" id="VisitorReminder" <?php if($data->VisitorReminder==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
                <div class="switch col s3 m3">
                  Customer : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="Customer" id="Customer" <?php if($data->Customer==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
                <div class="switch col s3 m3">
                  Customer Reminder : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="CustomerReminder" id="CustomerReminder" <?php if($data->CustomerReminder==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
              </div>
                <div class="clearfix"></div>
              <div class="row">
                <div class="switch col s3 m3">
                  Customer Property : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="CustomerProperty" id="CustomerProperty" <?php if($data->CustomerProperty==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
                <div class="switch col s3 m3">
                  Customer Payment : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="Payment" id="Payment" <?php if($data->Payment==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
                <div class="switch col s3 m3">
                  Customer Document : 
                  <label>
                    Off
                    <input class="chkcls" type="checkbox" name="Document" id="Document" <?php if($data->Document==1) echo " checked ";?> <?php if($data->IsPush==0) echo " disabled ";?>>
                    <span class="lever"></span> On
                  </label>
                </div>
              </div>
              <div class="row">
                  <div class="input-field col s12 m12">
                    <button class="btn waves-effect waves-light right district" type="submit" id="submit_button" name="submit_button" ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>