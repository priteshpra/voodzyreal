<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/bulkmessage'); ?>"><strong><?php echo label('msg_lbl_bulkmessage') ?></strong>
                </a>
            </h4>
            <div class="row m-b-0">
                <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1">
                        <li class="tab col s2"><a class="active" href="#message_sapien">SMS</a>
                        </li>
                        <li class="tab col s2"><a class="" href="#email_sapien">Email</a>
                        </li>
                    </ul>
                </div>
                <div class="col s12">
                    <div class="row m-b-0">
                        <div id="message_sapien" class="col s12">
                            <div class="row m-b-0">
                                <form class="col s12" id="sendMsgForm" method="post" action="<?php echo base_url('admin/bulkmessage') ?>">
                                    <input type="hidden" name="Type" value="SMS" />
                                    <div class="row m-b-0">
                                        <div class="input-field col s12 m12">
                                            <input name="Receiver" type="radio" id="S_AllCustomer" value="AllCustomer" checked="checked">
                                            <label for="S_AllCustomer"><?php echo label('msg_lbl_allcustomer') ?></label>

                                            <input name="Receiver" type="radio" id="S_AllVisitor" value="AllVisitor">
                                            <label for="S_AllVisitor"><?php echo label('msg_lbl_allvisitor') ?></label>

                                            <input name="Receiver" type="radio" id="S_ProjectCustomer" value="ProjectCustomer">
                                            <label for="S_ProjectCustomer"><?php echo label('msg_lbl_projectcustomer') ?></label>

                                            <input name="Receiver" type="radio" id="S_Phone" value="Phone">
                                            <label for="S_Phone"><?php echo label('msg_lbl_phone'); ?></label>

                                            <input name="Receiver" type="radio" id="S_Reference" value="Reference">
                                            <label for="S_Reference"><?php echo label('msg_lbl_reference') ?></label>

                                            <input name="Receiver" type="radio" id="S_Facebook" value="Facebook">
                                            <label for="S_Facebook"><?php echo label('msg_lbl_facebook') ?></label>

                                            <input name="Receiver" type="radio" id="S_99Acres" value="99Acres">
                                            <label for="S_99Acres"><?php echo label('msg_lbl_99acres'); ?></label>

                                            <input name="Receiver" type="radio" id="S_MagicBreaks" value="MagicBreaks">
                                            <label for="S_MagicBreaks"><?php echo label('msg_lbl_magicbreaks'); ?></label>

                                            <input name="Receiver" type="radio" id="S_Website" value="Website">
                                            <label for="S_Website"><?php echo label('msg_lbl_website'); ?></label>

                                            <input name="Receiver" type="radio" id="S_Hoardings" value="Hoardings">
                                            <label for="S_Hoardings"><?php echo label('msg_lbl_hoardings'); ?></label>

                                            <input name="Receiver" type="radio" id="S_GujaratNewspapers" value="GujaratNewspapers">
                                            <label for="S_GujaratNewspapers"><?php echo label('msg_lbl_gujaratnewspapers'); ?></label>

                                            <input name="Receiver" type="radio" id="S_DigitalMarketing" value="DigitalMarketing">
                                            <label for="S_DigitalMarketing"><?php echo label('msg_lbl_digitalmarketing'); ?></label>

                                            <input name="Receiver" type="radio" id="S_DivyaBhaskar" value="DivyaBhaskar">
                                            <label for="S_DivyaBhaskar"><?php echo label('msg_lbl_divyabhaskar'); ?></label>

                                            <input name="Receiver" type="radio" id="S_AhmedabadProperty" value="AhmedabadProperty">
                                            <label for="S_AhmedabadProperty"><?php echo label('msg_lbl_ahmedabadproperty'); ?></label>

                                            <input name="Receiver" type="radio" id="S_Sandeshnewspaper" value="Sandeshnewspaper">
                                            <label for="S_Sandeshnewspaper"><?php echo label('msg_lbl_sandeshnewspapers'); ?></label>

                                            <input name="Receiver" type="radio" id="S_Custome" value="Custome">
                                            <label for="S_Custome">Custome</label>
                                        </div>
                                        <div id="S_ProjectDiv" class="input-field col s12 hide">
                                            <?php echo $Project; ?>
                                        </div>
                                        <div id="S_CustomeMobile" class="input-field col s12 hide">
                                            <input id="S_MobileNo" name="S_MobileNo" type="text" class="S_MobileNo"/>
                                            <label for="S_MobileNo"><?php echo label('msg_lbl_mobileno') ?></label>
                                        </div>
                                        <div class="input-field col s12 m12 m-t-30">
                                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_message'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                            <textarea name="Message" id="S_Message" maxlength="800" class="materialize-textarea empty_validation_class"></textarea>
                                            <label for="S_Message"><?php echo label('msg_lbl_message') ?></label>
                                        </div>
                                    </div>

                                    <div class="row m-b-0">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right" type="button" id="S_button_submit" name="S_button_submit"><?php echo label('msg_lbl_submit') ?>
                                            </button>
                                            <?php echo $loading_button; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="email_sapien" class="col s12">
                            <div class="row m-b-0">
                                <form class="col s12" id="sendMailForm" method="post" action="<?php echo base_url('admin/bulkmessage') ?>">
                                    <input type="hidden" name="Type" value="Mail" />
                                    <div class="row m-b-0">
                                        <div class="input-field col s12 m12">
                                            <input name="Receiver" type="radio" id="M_AllCustomer" value="AllCustomer" checked="checked">
                                            <label for="M_AllCustomer"><?php echo label('msg_lbl_allcustomer') ?></label>

                                            <input name="Receiver" type="radio" id="M_AllVisitor" value="AllVisitor">
                                            <label for="M_AllVisitor"><?php echo label('msg_lbl_allvisitor') ?></label>

                                            <input name="Receiver" type="radio" id="M_ProjectCustomer" value="ProjectCustomer">
                                            <label for="M_ProjectCustomer"><?php echo label('msg_lbl_projectcustomer') ?></label>

                                            <input name="Receiver" type="radio" id="M_Phone" value="Phone">
                                            <label for="M_Phone"><?php echo label('msg_lbl_phone'); ?></label>

                                            <input name="Receiver" type="radio" id="M_Reference" value="Reference">
                                            <label for="M_Reference"><?php echo label('msg_lbl_reference') ?></label>

                                            <input name="Receiver" type="radio" id="M_Facebook" value="Facebook">
                                            <label for="M_Facebook"><?php echo label('msg_lbl_facebook') ?></label>

                                            <input name="Receiver" type="radio" id="M_99Acres" value="99Acres">
                                            <label for="M_99Acres"><?php echo label('msg_lbl_99acres'); ?></label>

                                            <input name="Receiver" type="radio" id="M_MagicBreaks" value="MagicBreaks">
                                            <label for="M_MagicBreaks"><?php echo label('msg_lbl_magicbreaks'); ?></label>

                                            <input name="Receiver" type="radio" id="M_Website" value="Website">
                                            <label for="M_Website"><?php echo label('msg_lbl_website'); ?></label>

                                            <input name="Receiver" type="radio" id="M_Hoardings" value="Hoardings">
                                            <label for="M_Hoardings"><?php echo label('msg_lbl_hoardings'); ?></label>

                                            <input name="Receiver" type="radio" id="M_GujaratNewspapers" value="GujaratNewspapers">
                                            <label for="M_GujaratNewspapers"><?php echo label('msg_lbl_gujaratnewspapers'); ?></label>

                                            <input name="Receiver" type="radio" id="M_DigitalMarketing" value="DigitalMarketing">
                                            <label for="M_DigitalMarketing"><?php echo label('msg_lbl_digitalmarketing'); ?></label>

                                            <input name="Receiver" type="radio" id="M_DivyaBhaskar" value="DivyaBhaskar">
                                            <label for="M_DivyaBhaskar"><?php echo label('msg_lbl_divyabhaskar'); ?></label>

                                            <input name="Receiver" type="radio" id="M_AhmedabadProperty" value="AhmedabadProperty">
                                            <label for="M_AhmedabadProperty"><?php echo label('msg_lbl_ahmedabadproperty'); ?></label>

                                            <input name="Receiver" type="radio" id="M_Sandeshnewspaper" value="Sandeshnewspaper">
                                            <label for="M_Sandeshnewspaper"><?php echo label('msg_lbl_sandeshnewspapers'); ?></label>
                                        </div>
                                        <div id="M_ProjectDiv" class="input-field col s12 hide">
                                            <?php echo $Project; ?>
                                        </div>
                                        <div class="input-field col s12 m-t-30">
                                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_title'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                            <input id="Subject" name="Subject" type="text" class="empty_validation_class" maxlength="250" />
                                            <label for="Subject"><?php echo label('msg_lbl_subject') ?></label>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_message'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                            <textarea name="Message" id="M_Message" maxlength="800" class="materialize-textarea empty_validation_class"></textarea>
                                            <label for="M_Message"><?php echo label('msg_lbl_message') ?></label>
                                        </div>
                                    </div>
                                    <div class="row m-b-0">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right" type="button" id="M_button_submit" name="button_submit"><?php echo label('msg_lbl_submit') ?>

                                            </button>
                                            <?php echo $loading_button; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>