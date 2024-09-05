<div class="container">
    <h4 class="header m-t-0">
        <a href="<?php echo site_url('admin/masters/uom') ?>"><strong><?php echo label('msg_lbl_dsrreport')?></strong>
        </a>
    </h4>        
    <div class="card-panel col s12">
        <p style="text-align:center;font-size: 20px;color: grey;">
            Note: Data will be submit once you click the submit button.
            Once call has been started you can not modify unless call has been ended.
        </p>
        <form class="col s12" id="AddForm" method="post" action="<?php echo site_url('admin/masters/uom/'.$page_name) ?>">
            <div class="row">
                <div class="input-field radio_input_field_add_edit col s12 m3">
                    <label><?php echo label('msg_lbl_type');?></label><br/>
                    <input name="Type" class="Type" type="radio" id="Visitor" value="Visitor" checked="checked">
                    <label for="Visitor"><?php echo label('msg_lbl_visitor')?></label>
                    <input name="Type" class="Type" type="radio" id="Opportunity" value="Opportunity">
                    <label for="Opportunity"><?php echo label('msg_lbl_opportunity');?></label>
                </div><br>
                <div class="input-field col s12 m3">
                    <input id="MobileNo" name="MobileNo" type="text" class="NumberOnly" value="<?php echo @$data->MobileNo; ?>" maxlength="10" />
                    <label for="MobileNo"><?php echo label('msg_lbl_mobileno')?></label>
                </div>
                <div class="input-field col s12 m3">
                    <button class="btn waves-effect waves-light" id="button_mobilenosubmit" name="button_mobilenosubmit" type="button">Check Mobile No</button>
                </div>
                <div class="clearfix"></div>
                <div class="hide card-panel" id="MobileNoData">
                    <div class="row m-b-0">
                        <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                                <option value="10"  selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo label('msg_lbl_select');?></th>
                                <th><?php echo label('msg_lbl_name');?></th>
                                <th><?php echo label('msg_lbl_emailid');?></th>
                                <th><?php echo label('msg_lbl_mobileno');?></th>
                                <th><?php echo label('msg_lbl_lateststatus');?></th>
                                <th><?php echo label('msg_lbl_lastfollwupdate');?></th>
                                <th><?php echo label('msg_lbl_nextfollowupdate');?></th>
                                <th class="actions center"><?php echo label('msg_lbl_feedback');?></th>
                            </tr>
                        </thead>
                        <tbody class="TableBody"></tbody> 
                    </table>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$feedback_modal_popup; ?>
                <div class="clearfix"></div><br>
                <div class="input-field col s12 m3 hide" id="ProjectData">
                    <?php echo @$projects; ?>
                </div>
                <div class="clearfix"></div><br>
                <div class="hide" id="SitesData">
                    <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                  <th class="width_300"><?php echo label('msg_lbl_select')?></th>
                                  <th class="width_300"><?php echo label('msg_lbl_project')?></th>
                                  <th class="width_300"><?php echo label('msg_lbl_employeename')?></th>
                                  <th class="width_300"><?php echo label('msg_lbl_requirement')?></th>
                                  <th class="width_130"><?php echo label('msg_lbl_budget')?></th>
                                  <th class="width_130"><?php echo label('msg_lbl_visitsource')?></th>
                                  <th class="width_130"><?php echo label('msg_lbl_remarks')?></th>
                                  <th class="width_130"><?php echo label('msg_lbl_chanel_partners')?></th>
                            </tr>
                        </thead>
                        <tbody class="SitesTableBody">
                        </tbody> 
                    </table>
                </div>
                <div class="clearfix"></div>    
                <div class="input-field col s12 m2 hide StartCall">
                    <button class="btn waves-effect waves-light" id="button_startcall" name="button_startcall" type="button" style="
                                    background-color: #08520a !important;color: #fff !important;" >
                        Start Call
                    </button>
                </div>
                <div class="input-field col s12 m3 hide LabelStartCallDateTime">
                    <label name="StartCallDateTime" id="StartCallDateTime" style="font-size:30px;margin-left: -100px;margin-top: -14px;"></label>
                </div>
               <div class="input-field col s12 m2 hide EndCall">
                    <button class="btn waves-effect waves-light" id="button_endcall" name="button_endcall" type="button" style="
                            background-color: #d60909 !important;color: #fff !important;" >
                        End Call
                    </button>
                </div>
                <div class="input-field col s12 m3 hide LabelEndCallDateTime">
                    <label name="EndCallDateTime" id="EndCallDateTime"  style="font-size:30px;margin-left: -100px;margin-top: -14px;"></label>
                </div>
                <div class="FeedbackData hide">
                    <div class="input-field col s12 m12">
                        <label for="Feedback"><?php echo label('msg_lbl_feedback')?></label><br>
                        <?php foreach ($reason_array as $data) { ?>
                          <input name="Feedback" class="Feedback" type="radio" id="Feedback_<?php echo $data->FeedbackID; ?>" value="<?php echo $data->FeedbackID; ?>" checked="checked">
                          <label for="Feedback_<?php echo $data->FeedbackID; ?>" style="color:#000;"><?php echo $data->Feedback; ?></label>
                          <br/>   
                        <?php } ?>   
                    </div>
                    <div class="input-field col s12 m4">
                        <label for="Remarks"><?php echo label('msg_lbl_remarks')?></label>
                        <textarea name="Remarks" id="Remarks" maxlength="500" class="materialize-textarea"><?=@$visitor->Remarks?></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="input-field col s12 m6">
                    <input type="checkbox" class=""  name="Status" id="Status"   
                    <?php
                    if (isset($data->Status) && @$data->Status == INACTIVE) {
                        echo "";
                    } else {
                        echo "checked='checked'";
                    }
                    ?>>
                    <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                </div>
                <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" id="button_submit" name="button_submit" type="button"><?php echo label('msg_lbl_submit');?></button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo site_url('admin/report/dSRReport') ?>" class="close-button right">Cancel</a>
                </div>
            </div>
        </form>
    </div>  
</div>
