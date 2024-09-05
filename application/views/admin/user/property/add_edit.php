<?php
if ($CustomerID == '-1' && $VisitorID != '' && !empty($VisitorDetail)) {
    $CustomerDetail->FirstName = $VisitorDetail->FirstName;
    $CustomerDetail->LastName = $VisitorDetail->LastName;
    $CustomerDetail->Address = $VisitorDetail->Address;
    $CustomerDetail->EmailID = $VisitorDetail->EmailID;
    $CustomerDetail->MobileNo = $VisitorDetail->MobileNo;
}
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php if ($CustomerID != '-1') {
                                echo site_url('admin/user/customer/details/' . $CustomerID . '#property');
                            } else {
                                echo '#';
                            } ?>"><strong>Customer Property</strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/user/property/<?php echo $Page; ?>">

                    <div class="row">
                        <input type="hidden" value="<?php echo isset($data->CustomerPropertyID) ? $data->CustomerPropertyID : 0; ?>" name="CustomerPropertyID" id="CustomerPropertyID">
                        <?php if (isset($data->ProjectID)) { ?>
                            <input type="hidden" value="<?php echo @$data->ProjectID; ?>" id="ProjectID" name="ProjectID">
                        <?php } ?>
                        <input type="hidden" value="0" name="paymentflag" id="paymentflag">
                        <div class="input-field col s6">
                            <?php echo $Leads; ?>
                        </div>
                        <div id="PropertyDiv" class="input-field col s6 hide">
                            <?php echo $Property; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primaryfirstname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerFirstName" name="CustomerFirstName" value="<?php echo (@$data->CustomerFirstName) ? @$data->CustomerFirstName : @$CustomerDetail->FirstName; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="CustomerFirstName"><?php echo label('msg_lbl_primaryfirstname'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primarylastname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerLastName" name="CustomerLastName" value="<?php echo (@$data->CustomerLastName) ? @$data->CustomerLastName : @$CustomerDetail->LastName; ?>" type="text" maxlength="100" class="LetterOnly empty_validation_class" />
                            <label for="CustomerLastName"><?php echo label('msg_lbl_primarylastname'); ?></label>
                        </div>
                    </div>
                    <div class="row hide">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_amount'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Amount" name="Amount" value="<?php echo isset($data->Amount) ? ($data->Amount) : ''; ?>" type="text" maxlength="9" class="NumberOnly" <?php echo (@$data->TotalNoOfPayment > 0) ? 'disabled' : ''; ?> />

                            <label for="Amount"><?php echo label('msg_lbl_amount'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_gstamount'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="GSTAmount" name="GSTAmount" value="<?php echo isset($data->GSTAmount) ? ($data->GSTAmount) : ''; ?>" type="text" maxlength="9" class="NumberOnly" <?php echo (@$data->TotalNoOfPayment > 0) ? 'disabled' : ''; ?> />
                            <label for="GSTAmount"><?php echo label('msg_lbl_gstamount'); ?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_purchasedate'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="PurchaseDate" id="PurchaseDate" value="<?php echo isset($data->PurchaseDate) ? GetDateInFormat($data->PurchaseDate) : date('d-m-Y'); ?>" class="datepickerval empty_validation_class">
                            <label name="PurchaseDate" class=""><?php echo label('msg_lbl_purchasedate') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primaryemailid'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerEmailID" name="CustomerEmailID" value="<?php echo (@$data->CustomerEmailID) ? @$data->CustomerEmailID :  @$CustomerDetail->EmailID; ?>" type="email" maxlength="250" class="" />
                            <label for="CustomerEmailID"><?php echo label('msg_lbl_primaryemailid'); ?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6 hide">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primarypanno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerPanNo" name="CustomerPanNo" value="<?php echo @$data->CustomerPanNo; ?>" type="text" maxlength="10" class="InputCapital NumberLetter FixedLength" fixedlength="10" />
                            <label for="CustomerPanNo"><?php echo label('msg_lbl_primarypanno'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primaryadhaarno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerAdhaarNo" name="CustomerAdhaarNo" value="<?php echo @$data->CustomerAdhaarNo; ?>" type="text" maxlength="16" class="NumberOnly CustomLength" min="12" max="16" />
                            <label for="CustomerAdhaarNo"><?php echo label('msg_lbl_primaryadhaarno'); ?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primarymobileno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerMobileNo" name="CustomerMobileNo" value="<?php echo (@$data->CustomerMobileNo) ? @$data->CustomerMobileNo : @$CustomerDetail->MobileNo; ?>" type="text" maxlength="15" class="MobileNo empty_validation_class" />
                            <label for="CustomerMobileNo"><?php echo label('msg_lbl_primarymobileno'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primarymobileno1'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerMobileNo1" name="CustomerMobileNo1" value="<?php echo (@$data->CustomerMobileNo1) ? @$data->CustomerMobileNo1 : @$CustomerDetail->MobileNo1; ?>" type="text" maxlength="15" class="MobileNo" />
                            <label for="CustomerMobileNo1"><?php echo label('msg_lbl_primarymobileno1'); ?></label>
                        </div>
                    </div>

                    <div class="row hide">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondfirstname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSFirstName" name="CustomerSFirstName" value="<?php echo @$data->CustomerSFirstName; ?>" type="text" maxlength="100" class="LetterOnly " />
                            <label for="CustomerSFirstName"><?php echo label('msg_lbl_secondfirstname'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondlastname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSLastName" name="CustomerSLastName" value="<?php echo @$data->CustomerSLastName; ?>" type="text" maxlength="100" class="LetterOnly " />
                            <label for="CustomerSLastName"><?php echo label('msg_lbl_secondlastname'); ?></label>
                        </div>
                    </div>

                    <div class="row hide">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondaddress'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSAddress" name="CustomerSAddress" value="<?php echo @$data->CustomerSAddress; ?>" type="text" maxlength="250" class="" />
                            <label for="CustomerSAddress"><?php echo label('msg_lbl_secondaddress'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondemailid'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSEmailID" name="CustomerSEmailID" value="<?php echo @$data->CustomerSEmailID; ?>" type="email" maxlength="250" class="" />
                            <label for="CustomerSEmailID"><?php echo label('msg_lbl_secondemailid'); ?></label>
                        </div>
                    </div>

                    <div class="row hide">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondpanno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSPanNo" name="CustomerSPanNo" value="<?php echo @$data->CustomerSPanNo; ?>" type="text" maxlength="10" class="InputCapital NumberLetter FixedLength" fixedlength="10" />
                            <label for="CustomerSPanNo"><?php echo label('msg_lbl_secondpanno'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondadhaarno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSAdhaarNo" name="CustomerSAdhaarNo" value="<?php echo @$data->CustomerSAdhaarNo; ?>" type="text" maxlength="16" class="NumberOnly CustomLength" min="12" max="16" />
                            <label for="CustomerSAdhaarNo"><?php echo label('msg_lbl_secondadhaarno'); ?></label>
                        </div>
                    </div>

                    <div class="row hide">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondmobileno'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSMobileNo" name="CustomerSMobileNo" value="<?php echo @$data->CustomerSMobileNo; ?>" type="text" maxlength="15" class="MobileNo " />
                            <label for="CustomerSMobileNo"><?php echo label('msg_lbl_secondmobileno'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_secondmobileno1'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerSMobileNo1" name="CustomerSMobileNo1" value="<?php echo @$data->CustomerSMobileNo1; ?>" type="text" maxlength="15" class="MobileNo " />
                            <label for="CustomerSMobileNo1"><?php echo label('msg_lbl_secondmobileno1'); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_primaryaddress'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CustomerAddress" name="CustomerAddress" value="<?php echo (@$data->CustomerAddress) ? @$data->CustomerAddress : @$CustomerDetail->Address; ?>" type="text" maxlength="250" class="empty_validation_class" />
                            <label for="CustomerAddress"><?php echo label('msg_lbl_primaryaddress'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('Enter Authorise PassCode'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PassCode" name="PassCode" type="password" maxlength="5" class="NumberOnly empty_validation_class" autocomplete="off" />
                            <label for="PassCode"><?php echo label('msg_lbl_passcode'); ?></label>
                        </div>
                        <div class="input-field col s12 m6 hide">
                            <?php echo @$ChannelPartner; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                        if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                            echo "";
                                                                                        } else {
                                                                                            echo "checked='checked'";
                                                                                        }
                                                                                        ?>>
                            <label for="Status">Status</label>
                        </div>
                        <div class="input-field col s3">
                            <input type="checkbox" class="" name="IsHold" id="IsHold" <?php
                                                                                        if (isset($data->IsHold) && @$data->IsHold == ACTIVE) {
                                                                                            echo "checked='checked'";
                                                                                        } else {
                                                                                            echo "";
                                                                                        }
                                                                                        ?>>
                            <label for="IsHold">IsHold</label>
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit">Submit</button>
                            <?php echo $loading_button; ?>
                            <a href="<?php if ($CustomerID != '-1') {
                                            echo site_url('admin/user/customer/details/' . $CustomerID . '#property');
                                        } else {
                                            echo site_url('admin/user/visitor/details/' . $VisitorID);
                                        } ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>