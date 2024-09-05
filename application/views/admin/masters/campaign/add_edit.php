<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/campaign') ?>"><strong><?php echo label('msg_lbl_title_campaign') ?></strong>
        </a>
    </h4>
    <div class="card-panel col s12">
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/campaign/' . $page_name) ?>">
            <input id="CampaignID" name="CampaignID" value="<?php echo isset($data->CampaignID) ? $data->CampaignID : 0; ?>" type="hidden" />
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="Title" name="Title" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$data->Title; ?>" maxlength="100" />
                    <label for="Title"><?php echo label('msg_lbl_title') ?><span style="color:red;">*</span></label>
                </div>
                <div class="input-field col s12 m6">
                    <?php echo @$Employee; ?>
                </div>
                <div class="input-field col s12 m12">
                    <label><?php echo label('msg_lbl_source'); ?></label><br />
                    <input name="Source" type="radio" id="Phone" value="Phone" checked="checked" <?php echo ((isset($data->Source) && @$data->Source == 'Phone')) ? 'checked="checked"' : ''; ?>>
                    <label for="Phone"><?php echo label('msg_lbl_phone'); ?></label>
                    <input name="Source" type="radio" id="Reference" value="Reference" <?php echo ((isset($data->Source) && @$data->Source == 'Reference')) ? 'checked="checked"' : ''; ?>>
                    <label for="Reference"><?php echo label('msg_lbl_reference') ?></label>
                    <input name="Source" type="radio" id="Facebook" value="Facebook" <?php echo ((isset($data->Source) && @$data->Source == 'Facebook')) ? 'checked="checked"' : ''; ?>>
                    <label for="Facebook"><?php echo label('msg_lbl_facebook') ?></label>
                    <input name="Source" type="radio" id="99Acres" value="99Acres" <?php echo ((isset($data->Source) && @$data->Source == '99Acres')) ? 'checked="checked"' : ''; ?>>
                    <label for="99Acres"><?php echo label('msg_lbl_99acres'); ?></label>
                    <input name="Source" type="radio" id="MagicBreaks" value="MagicBreaks" <?php echo ((isset($data->Source) && @$data->Source == 'MagicBreaks')) ? 'checked="checked"' : ''; ?>>
                    <label for="MagicBreaks"><?php echo label('msg_lbl_magicbreaks'); ?></label>
                    <input name="Source" type="radio" id="Website" value="Website" <?php echo ((isset($data->Source) && @$data->Source == 'Website')) ? 'checked="checked"' : ''; ?>>
                    <label for="Website"><?php echo label('msg_lbl_website'); ?></label>
                    <input name="Source" type="radio" id="Hoardings" value="Hoardings" <?php echo ((isset($data->Source) && @$data->Source == 'Hoardings')) ? 'checked="checked"' : ''; ?>>
                    <label for="Hoardings"><?php echo label('msg_lbl_hoardings'); ?></label>
                    <input name="Source" type="radio" id="Newspapers" value="Newspapers" <?php echo ((isset($data->Source) && @$data->Source == 'Newspapers')) ? 'checked="checked"' : ''; ?>>
                    <label for="Newspapers"><?php echo label('msg_lbl_newspapers'); ?></label>
                    <input name="Source" type="radio" id="DigitalMarketing" value="DigitalMarketing" <?php echo ((isset($data->Source) && @$data->Source == 'DigitalMarketing')) ? 'checked="checked"' : ''; ?>>
                    <label for="DigitalMarketing"><?php echo label('msg_lbl_digitalmarketing'); ?></label>
                    <input name="Source" type="radio" id="PP" value="PP" <?php echo ((isset($data->Source) && @$data->Source == 'PP')) ? 'checked="checked"' : ''; ?>>
                    <label for="PP"><?php echo label('msg_lbl_pp'); ?></label>
                    <input name="Source" type="radio" id="MP" value="MP" <?php echo ((isset($data->Source) && @$data->Source == 'MP')) ? 'checked="checked"' : ''; ?>>
                    <label for="MP"><?php echo label('msg_lbl_mp'); ?></label>
                    <input name="Source" type="radio" id="HP" value="HP" <?php echo ((isset($data->Source) && @$data->Type == 'HP')) ? 'checked="checked"' : ''; ?>>
                    <label for="HP"><?php echo label('msg_lbl_hp'); ?></label>
                    <input name="Source" type="radio" id="BulkSMS" value="BulkSMS" <?php echo ((isset($data->Source) && @$data->Type == 'BulkSMS')) ? 'checked="checked"' : ''; ?>>
                    <label for="BulkSMS"><?php echo label('msg_lbl_bluksms'); ?></label>
                    <input name="Source" type="radio" id="RealtyServe" value="RealtyServe" <?php echo ((isset($data->Source) && @$data->Type == 'RealtyServe')) ? 'checked="checked"' : ''; ?>>
                    <label for="RealtyServe"><?php echo label('msg_lbl_realtyserve'); ?></label>
                    <input name="Source" type="radio" id="AP" value="AP" <?php echo ((isset($data->Source) && @$data->Type == 'AP')) ? 'checked="checked"' : ''; ?>>
                    <label for="AP"><?php echo label('msg_lbl_ap'); ?></label>
                    <input name="Source" type="radio" id="PK" value="PK" <?php echo ((isset($data->Source) && @$data->Type == 'PK')) ? 'checked="checked"' : ''; ?>>
                    <label for="PK"><?php echo label('msg_lbl_pk'); ?></label>
                    <input name="Source" type="radio" id="RG" value="RG" <?php echo ((isset($data->Source) && @$data->Type == 'RG')) ? 'checked="checked"' : ''; ?>>
                    <label for="RG"><?php echo label('msg_lbl_rg'); ?></label>
                    <input name="Source" type="radio" id="NP" value="NP" <?php echo ((isset($data->Source) && @$data->Type == 'NP')) ? 'checked="checked"' : ''; ?>>
                    <label for="NP"><?php echo label('msg_lbl_np'); ?></label>
                    <input name="Source" type="radio" id="PD" value="PD" <?php echo ((isset($data->Source) && @$data->Type == 'PD')) ? 'checked="checked"' : ''; ?>>
                    <label for="PD"><?php echo label('msg_lbl_pd'); ?></label>
                    <input name="Source" type="radio" id="SL" value="SL" <?php echo ((isset($data->Source) && @$data->Type == 'SL')) ? 'checked="checked"' : ''; ?>>
                    <label for="SL"><?php echo label('msg_lbl_sl'); ?></label>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class="" name="Status" id="Status" <?php
                                                                                if (isset($data->Status) && @$data->Status == INACTIVE) {
                                                                                    echo "";
                                                                                } else {
                                                                                    echo "checked='checked'";
                                                                                }
                                                                                ?>>
                    <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit'); ?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/masters/campaign') ?>" class="right close-button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>