<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID."#refund"); ?>"><strong>Refund</strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo site_url('admin/user/refund/'.$Page); ?>">

                    <div class="row">
                        <div class="input-field col s3">
                            Total Basic Amount : <i class="fa fa-inr"></i> <?php echo SalaryComma($CancelProperty->RefundAmount);?>
                        </div>
                        <div class="input-field col s4">
                            Remaining Basic Refund : <i class="fa fa-inr"></i> <?php echo SalaryComma($CancelProperty->RemainingPayment);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            Total GST Amount : <i class="fa fa-inr"></i> <?php echo SalaryComma($CancelProperty->RefundGSTAmount);?>
                        </div>
                        <div class="input-field col s4">
                            Remaining GST Refund : <i class="fa fa-inr"></i> <?php echo SalaryComma($CancelProperty->RemainingGSTPayment);?>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" id="CustomerPropertyID" name="CustomerPropertyID" value="<?php echo $CustomerPropertyID;?>"> 
                        <input type="hidden" id="RefundID" name="RefundID" value="<?php echo isset($data->RefundID)?$data->RefundID:0;?>"> 
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_paymentdate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="RefundDate" id="RefundDate" value="<?php echo isset($data->RefundDate)? GetDateInFormat($data->RefundDate):"";?>" value="" class="datepickerval empty_validation_class">
                            <label name="RefundDate" class=""><?php echo label('msg_lbl_refunddate')?></label>
                        </div>
                        <div class="input-field col s6">
                            <label ><?php echo label('msg_lbl_amounttype');?></label>
                            <br>
                            <input name="AmountType" type="radio" value="0" id="IncludingGST" <?php if(!isset($data->AmountType) || @$data->AmountType == 0) echo " checked='checked' ";?>/>
                            <label for="IncludingGST">Including GST Amount</label>
                            <input name="AmountType" type="radio" value="1" id="ExcludingGST"  <?php if(@$data->AmountType == 1) echo " checked='checked' ";?>/>
                            <label for="ExcludingGST">Excluding GST Amount</label>
                            <input name="AmountType" type="radio" value="2" id="OnlyGST"  <?php if(@$data->AmountType == 2) echo " checked='checked' ";?>/>
                            <label for="OnlyGST">Only GST Amount</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6 <?php if(@$data->AmountType == 2) echo ' hide ';?>" id="PaymentAmountDiv">
                            <input type="hidden" value="<?Php echo $CancelProperty->RemainingPayment;?>" id="RemainingPayment" >
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_refundamount');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="RefundAmount" name="RefundAmount" value="<?php echo isset($data->RefundAmount)?($data->RefundAmount):'';?>" type="text"  maxlength="9" class="MaxNumber maxmin empty_validation_class AmountOnly" min="0" max="<?php echo isset($data->RefundAmount)?($CancelProperty->RemainingPayment+$data->RefundAmount):$CancelProperty->RemainingPayment;?>" intOnly="true"/>
                            <label id="PaymentAmountlbl" for="RefundAmount"><?php echo label('msg_lbl_refundamount');?></label>
                        </div>
                        <div class="input-field col s12 m6 <?php if(@$data->AmountType == 1) echo ' hide ';?>" id="GSTAmountDiv">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_gstamount');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="GSTAmount" name="GSTAmount" value="<?php echo @$data->GSTAmount;?>" type="text" class="MaxNumber maxmin empty_validation_class AmountOnly" maxlength="9" min="0" max="<?php echo isset($data->GSTAmount)?($CancelProperty->RemainingGSTPayment+$data->GSTAmount):$CancelProperty->RemainingGSTPayment;;?>" />
                            <label for="GSTAmount"><?php echo label('msg_lbl_gstamount');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_accountno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="AccountNo" name="AccountNo" value="<?php echo @$data->AccountNo;?>" type="text"  maxlength="16" class="NumberOnly CustomLength" min="11" max="16" />
                            <label for="AccountNo"><?php echo label('msg_lbl_accountno');?></label>
                        </div>
                        <div class="clearfix"></div>

                        
                        <div class="input-field col s6">
                            <label for="PaymentMode">Payment Mode</label>
                            <br>
                            <input name="PaymentMode" type="radio" value="Cheque" id="Cheque" <?php if(!isset($data->PaymentMode) || @$data->PaymentMode == "Cheque") echo " checked='checked' ";?>/>
                            <label for="Cheque">Cheque</label>
                            <input name="PaymentMode" type="radio" value="Online" id="Online"  <?php if(@$data->PaymentMode == "Online") echo " checked='checked' ";?>/>
                            <label for="Online">Online</label>
                        </div>
                        <div id="ChequeDiv" class="input-field col s12 m6 <?php if(@$data->PaymentMode == "Online") echo " hide ";?>" >
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_chequeno');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="ChequeNo" name="ChequeNo" value="<?php echo @$data->ChequeNo;?>" type="text"  maxlength="10" class="NumberOnly <?php if(!isset($data->PaymentMode) || @$data->PaymentMode == "ChequeNo") echo " empty_validation_class ";?> CustomLength" min="6" max="10" />
                            <label for="ChequeNo"><?php echo label('msg_lbl_chequeno');?></label>
                        </div>
                        <div id="OnlineDiv" class="<?php if(!isset($data->PaymentMode) || @$data->PaymentMode == "Cheque" ) echo " hide ";?>">
                            <div class="input-field col s12 m6 ">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_ifccode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="IFCCode" name="IFCCode" value="<?php echo @$data->IFCCode;?>" type="text"  maxlength="15" class="NumberLetter CustomLength" min="11" max="15"/>
                                <label for="IFCCode"><?php echo label('msg_lbl_ifccode');?></label>
                            </div>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_utr');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="UTR" name="UTR" value="<?php echo @$data->UTR;?>" type="text"  maxlength="24" class="NumberLetter CustomLength InputCapital" min="12" max="24" />
                                <label for="UTR"><?php echo label('msg_lbl_utr');?></label>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_bankname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="BankName" name="BankName" value="<?php echo @$data->BankName;?>" type="text"  maxlength="250" class="LetterOnly empty_validation_class" />
                            <label for="BankName"><?php echo label('msg_lbl_bankname');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_branchname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="BranchName" name="BranchName" value="<?php echo @$data->BranchName;?>" type="text"  maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="BranchName"><?php echo label('msg_lbl_branchname');?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('Enter Authorise PassCode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password"  maxlength="5" class="NumberOnly empty_validation_class " autocomplete="off"/>
                            <label for="PassCode"><?php echo label('msg_lbl_passcode');?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($data->Status) && @$data->Status == INACTIVE) {
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
                            <a  href="<?php echo site_url('admin/user/property/details/'.$CustomerPropertyID."#refund"); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>