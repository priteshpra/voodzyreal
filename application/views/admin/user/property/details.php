<?php //pr($Property);?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/customer/details/".$Property->CustomerID); ?>">Property Details</a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
<!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right candidate-details-box" id="company-details-box">
        <div class="card-panel">  
          <div class="col s12 m12 l12 clearfix">
            <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/user/property/details/".$Property->CustomerPropertyID); ?>"><?php echo $Property->PropertyNo;?></a></h5>
            <?php 
              ?>
            <div class="right">
              <?php 
                $ver = 0;
                if($Property->IsVerified == 1){
                    $path = VERIFIED; 
                }else{
                    $ver = 1;
                    $path = NOT_PERMISSION_NOT_VERIFIED;
                }
              ?>

              <a id="verifiedAtag" href="javascript:void(0);" class="<?php echo ($ver == 0 || $Property->IsCancelled == 1 || $Property->IsHold ==1 || $Property->Amount == 0)?'':'ChangeVST';?> icon_img" data-type='Verified'>
               <img class="verifiedcls img-responsive tooltipped" src="<?php echo site_url($path);?>" data-position="top" data-delay="50" data-tooltip="<?php echo ($Property->IsVerified == 1)?label("msg_verified"):label("msg_not_verified");?>">
              </a>
              <!-- <?php
                $amount = $Property->Amount;
                $per = $Property->ATSPercentage;
                $atsamt = ($amount*$per)/100; 
               
               echo "Amount=".$amount ; 
               echo "Per=".$per ;
               echo "Atsamt=".$atsamt ;
               echo "Hold=".$Property->IsHold; 
               echo "TotalPayment",$Property->TotalPayment;
               ?>  -->
              <?php 
              if($Property->IsATS == 1){
                $path = ATS_CLASS_ACTIVE;
                $ATS = 0;
              }else{
                $amount = $Property->Amount;
                $per = $Property->ATSPercentage;
                $atsamt = ($amount*$per)/100; 
                if($atsamt <= $Property->TotalPayment && $Property->IsHold ==0 && $Property->Amount != 0)
                {
                  $ATS = 1;
                  $path = ATS_CLASS_INACTIVE;
                }else{
                  $ATS = 0;
                  $path = NOT_ABLE_ATS_CLASS_INACTIVE;
                }
              }
              
              
              ?>
             <!--  <?php
                 
               echo "ATS=".$ATS ; 
               echo "isCAN=".$Property->IsCancelled ;
               //echo "Test=".$ATS == 0 || $Property->IsCancelled == 1;
               ?> -->
              <a id="ATSAtag" href="javascript:void(0);" class="<?php echo ($ATS == 0 || $Property->IsCancelled == 1 )?'':'ChangeVST';?> icon_img" data-type='ATS'>
                <img class="atscls img-responsive tooltipped" src="<?php echo site_url($path)?>" data-position="top" data-delay="50" data-tooltip="<?php echo label("msg_ats");?>" >
              </a>
              
              <?php 
              if($Property->IsSD == 1){
                $path = SD_CLASS_ACTIVE;
                $SD = 0;
              }else{
                if($Property->RemainingPayment == 0 && $Property->IsHold ==0 && $Property->RemainingGSTPayment == 0 && $Property->Amount != 0){
                  $path = SD_CLASS_INACTIVE;
                  $SD = 1;
                }else {
                  $path = NOT_ABLE_SD_CLASS_INACTIVE;
                  $SD = 0;
                }
              }
              ?>
              <a id="SDAtag" href="javascript:void(0);" class="<?php echo ($SD == 0 || $Property->IsCancelled == 1 )?'':'ChangeVST';?> icon_img" data-type='SD'>
                <img class="sdcls img-responsive tooltipped" src="<?php echo site_url($path)?>" data-position="top" data-delay="50" data-tooltip="<?php echo label("msg_sd");?>">
              </a>
            </div>
          </div>
          <div class="row m-t-20">
            <div class="row">
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                  <?php 
                  if(@$this->process_module->is_view == 1){
                  ?>
                    <li class="tab"><a class="tabclick active" href="#process" title="Process">Process</a></li>
                  <?php 
                  }if(@$this->payment_module->is_view == 1){
                  ?>
                    <li class="tab"><a class="tabclick" href="#payment" title="Payment">Payment</a></li>
                  <?php 
                  }if(@$this->document_module->is_view == 1){
                  ?>
                    <li class="tab"><a class="tabclick" href="#document" title="Document">Document</a></li>
                  <?php 
                  }if(@$this->reminder_module->is_view == 1){
                  ?>
                    <li class="tab"><a class="tabclick" href="#reminder" title="Reminder">Reminder</a></li>
                  <?php 
                  }if(@$this->refund_module->is_view == 1 && $Property->IsCancelled == 1){
                  ?>
                    <li class="tab"><a class="tabclick" href="#refund" title="Refund">Refund</a></li>
                  <?php 
                  }
                  ?>
                  </ul>
                </div>
              </div>
              <?php 
              if(@$this->process_module->is_view == 1){
              ?>
              <!-- Customer Process Start -->
              <div id="process" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_200"><?php echo label('msg_lbl_employeename')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_processdate')?></th>
                              <th class="width_500"><?php echo label('msg_lbl_description')?></th>
                          </tr>
                        </thead>
                          <tbody id="table_body">
                          </tbody> 
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Customer Process End -->
              <?php 
              }if(@$this->payment_module->is_view == 1){
              ?>
              <!-- Customer Payment Start -->
              <div id="payment" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>

                          <?php 
                          if($Property->IsCancelled == 0){
                          ?>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a class="OpenMileStone modal-trigger btn-floating waves-effect waves-light indigo " href="javascript:void(0);">
                              <i class="mdi-image-wb-sunny tooltipped" data-position="top" data-delay="50" data-tooltip="MileStone"></i>
                            </a>
                            &nbsp;&nbsp;
                            <?php 
                            if(@$this->payment_module->is_insert == 1){
                            ?>
                            <a href="<?php echo site_url("admin/user/payment/add/".$CustomerPropertyID);?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                            <?php } ?>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_150"><?php echo label('msg_lbl_propertyno')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_description')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_paymentdate')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_paymentmode')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_amounttype')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_paymentamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_gstamount')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_chequeorifccode')?></th>
                              <th class="width_200"><?php echo label('msg_lbl_accountno')?></th>
                              <th class="width_180"><?php echo label('msg_lbl_bankname')?></th>
                              <th class="width_150"><?php echo label('msg_lbl_bankbranch')?></th>
                              <th class="center"><?php echo label('msg_lbl_status')?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                          <tbody id="table_body">
                          </tbody> 
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Customer Payment End -->
              <?php 
              }if(@$this->document_module->is_view == 1){
              ?>
              <!-- Customer Document Start -->
              <div id="document" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <?php 
                          if($Property->IsCancelled == 0 && @$this->document_module->is_insert == 1){
                            ?>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/user/document/add/".$CustomerPropertyID);?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th class="width_200"><?php echo label('msg_lbl_propertyno')?></th>
                                <th class="width_300"><?php echo label('msg_lbl_title')?></th>
                                <th class="width_180 center"><?php echo label('msg_lbl_status')?></th>
                                <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                      </div>
                    </div>
                    <div id="table_paging_div"></div>
                  </div> 
                </div>
              </div>
              <!-- Customer Document End -->
              <?php 
              }if(@$this->reminder_module->is_view == 1){
              ?>
              <!-- Customer Reminder Start -->
              <div id="reminder" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <?php 
                          if($Property->IsCancelled == 0 && @$this->reminder_module->is_insert == 1){
                            ?>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/user/reminder/add/".$CustomerPropertyID);?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th class="width_300"><?php echo label('msg_lbl_message')?></th>
                                <th class="width_150"><?php echo label('msg_lbl_amount')?></th>
                                <th class="width_180"><?php echo label('msg_lbl_reminderdate')?></th>
                                <th class="width_150 center"><?php echo label('msg_lbl_status')?></th>
                                <th class="width_100 center"><?php echo label('msg_lbl_action');?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                      </div>
                    </div>
                    <div id="table_paging_div"></div>
                  </div> 
                </div>
              </div>
              <!-- Customer Reminder End -->
              <?php 
              }if(@$this->refund_module->is_view == 1 && $Property->IsCancelled == 1){
              ?>
               <!-- Refund Start -->
              <div id="refund" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                          <?php 
                          if(@$this->refund_module->is_insert == 1 && $CancelProperty->IsDealClosed == 0){
                            ?>
                            <div id="AddData">
                              <a href="<?php echo site_url("admin/user/refund/add/".$CustomerPropertyID);?>" class="btn-floating right waves-effect waves-light green accent-6">
                                <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                              </a>
                            </div>
                          <?php 
                          }
                           if($CancelProperty->IsDealClosed == 1){
                              $icon = ISCLOSED_INACTIVE_ICON_CLASS;
                              $Title = "Payment Closed";
                              $cls = "";
                           }else{
                              $icon = ISCLOSED_ACTIVE_ICON_CLASS;
                              $cls = "closedbtn";
                              $Title = "Payment Open";
                           }
                           ?>
                            <a id="ChangeClosed" href="javascript:void(0)" style="margin-right: 10px;" data-id="<?php echo $CustomerPropertyID;?>" class="<?php echo $cls;?> btn-floating waves-effect waves-light indigo accent-6">
                              <i class="<?php echo $icon;?> tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $Title;?>"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th class="width_200"><?php echo label('msg_lbl_refunddate');?></th>
                                <th class="width_200"><?php echo label('msg_lbl_paymentmode');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_paymentamount');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_gstamount');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_chequeorifccode');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_accountno');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_bankname');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_bankbranch');?></th>
                                <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                      </div>
                    </div>
                    <div id="table_paging_div"></div>
                  </div> 
                </div>
              </div>
              <!-- Refund End -->             
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $view_modal_popup; ?>
<!-- Reminder Send Modal Start -->
<div class="admin-table-view-pop-up">
  <div id="reminderpopup" class="modal reminderpopup">
      <div class="modal-footer gridhead1 bgglobal">      
        <h4 id="reminder_title"></h4>
          <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
      </div>
      <div class="modal-content">  
          <form id="reminderform" enctype="multipart/form-data">
                <input type="hidden" id="method" name="method" value="addReminderAction">
                <input type="hidden" id="ID" name="ID">
                <input type="hidden" id="ActionType" name="ActionType">
                <input type="hidden" id="UserID" name="UserID" value="<?php echo @$this->session->userdata['UserID'];?>">
                <input type="hidden" id="ActionUser" name="ActionUser">
                <input type="hidden" id="UserType"  name="UserType" value="Admin Web">
                <div id="Subjectdiv" class="input-field col s6">
                    <input type="text" name="Subject" id="Subject" maxlength="50" value="" >
                    <label for="Subject"><?php echo label('msg_lbl_subject');?></label>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                      <textarea name="Message" id="Message" class="materialize-textarea" maxlength="200"></textarea>
                      <label for="Message"><?php echo label('msg_lbl_message');?></label>
                    </div>      
                </div>
                <div class="m-t-20" id="attenchmentdiv">
                    <label class="imageview-label">Upload Doc,Image or Pdf File</label>
                    <div class="row">
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path empty_validation_class" id="editImageURL" name="editImageURL" value="" readonly="" type="text">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="ImageData" id="ImageData" class="file document"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix input-field col s6">
                  <button class="btn waves-effect waves-light right" type="button" id="reminder_submit" name="reminder_submit">Submit</button>
                  <?php echo $loading_button; ?>
                  <span class="modal-close right close-button">Cancel</span>
                </div>   
          </form >
      </div>
  </div>
</div>
<!-- Reminder Send Modal End -->
<!-- Add Response Modal Start -->
<div class="admin-table-view-pop-up">
  <div id="addresponsemodal" class="modal addresponsemodal">
      <div class="modal-footer gridhead1 bgglobal">      
        <h4 id="response_title"></h4>
          <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
      </div>
      <div class="modal-content">  
          <form>
                <input type="hidden" id="ReminderID" value="0">
                <div class="row">
                    <div class="input-field col s12">
                      <textarea name="Response" id="Response" class="materialize-textarea" maxlength="200"></textarea>
                      <label for="Response"><?php echo label('msg_lbl_response');?></label>
                    </div>      
                </div>
                <div class="clearfix input-field col s6">
                  <button class="btn waves-effect waves-light right" type="button" id="response_submit" name="response_submit">Submit</button>
                  <?php echo $loading_button; ?>
                  <span class="modal-close right close-button">Cancel</span>
                </div>   
          </form >
      </div>
  </div>
</div>
<!-- Add Response Modal End -->
<!-- Add Response Modal Start -->
<div class="admin-table-view-pop-up">
  <div id="view_milestone" class="modal view_milestone">
      <div class="modal-footer gridhead1 bgglobal">      
        <h4>MileStone </h4>
          <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
      </div>
      <div class="modal-content">  
          <?php 
          foreach ($MileStone as $value) {
          ?>
            <div class="input-field col s12 m12 l12">
              <h5><?php echo "Instalment No " . @$value->InstalmentNo;?></h5>
              <p><?php echo @$value->Percentage."% @ ".@$value->MileStone;?></p>
            </div>
            <div class="clearfix"></div>
          <?php 
          }
          ?>
      </div>
  </div>
</div>
<!-- Add Response Modal End -->

<div class="admin-table-view-pop-up">
<div id="add_passcode_popup" class="modal add_passcode_popup">
      <div class="modal-footer gridhead1 bgglobal">      
          <h4>PassCode</h4>
          <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
      </div>
      <div class="modal-content">  
          <div class="input-field col s6 m3">
              <input type="text" name="Passcode" class="NumberOnly" id="Passcode" maxlength="5" value="" >
              <label for="Passcode">Passcode</label>
          </div>
        <div class="submit-dynamic-btn right" style="min-height:50px;">      
          <input type="submit" class="btn" value="Submit"/>
        </div>
      </div>

  </div>
  </div>