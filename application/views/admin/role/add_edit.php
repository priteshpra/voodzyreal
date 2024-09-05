<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header"><a href="<?php echo $this->config->item('base_url'); ?>admin/role"><strong>Roles</strong></a></h4>
            <form id="edit_rolemapping_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/role/<?php echo $page; ?>">
                <div class="row">
                    <input type="hidden" name="RoleID" id="RoleID" value="<?php echo @$RoleID;?>" />
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_rolename');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Name" name="Name" type="text"  maxlength="50" class="empty_validation_class LetterOnly" value="<?php echo @$role->RoleName?>"/>
                        <label for="Name"><?php echo label('msg_lbl_rolename');?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_roledescription');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="Description" name="Description" type="text"  maxlength="200" class="empty_validation_class LetterOnly" value="<?php echo @$role->Description?>"/>
                        <label for="Description"><?php echo label('msg_lbl_roledescription');?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light right" name="button_submit" id="button_submit" type="button">Submit
                                
                            </button>
                        <?php echo $loading_button; ?>
                        <a href="<?php echo $this->config->item('base_url'); ?>admin/role" class="right close-button">Cancel</a>
                    </div>
                </div>

                <div class="col s12 m4 l4 modules">
                     <?php /*
                    foreach ($modules as $k_0=>$m_0) { ?>
                    <?php if($k_0!='Both' && $k_0!='Mobile'){ ?>
                        <div class="project_level level_p_1 collection margin_20" data-project-id="1">
                        <?php echo $Project; ?>
                    <?php }elseif($k_0=='Both'){ ?>
                        <div class="project_level level_p_0 collection margin_20" data-project-id="0">
                            <input type="hidden" name="ProjectID" value="0">
                    <?php } ?>
                        <div class="role_type_label"><label class="rolelabel"><?php echo $k_0; ?></label></div>
                        
                        <?php
                        foreach ($m_0 as $value) { ?>
                            <div class="collection" id="<?php echo "main_div_" . $value['ModuleID']; ?>" >
                                <div class="container master-container margin_20">

                                    <input class="filled-in masters" id="<?php echo "m_" . $value['ModuleID']; ?>" data-id="<?php echo $value['ModuleID']; ?>" name="<?php echo 'mod['. $value['ModuleID'].'][is_view]'; ?>" type="checkbox">
                                    <label class="rolelabel" for="<?php echo "m_" . $value['ModuleID']; ?>"><?php echo $value['ModuleName']; ?></label>

                                    <div class="right">
                                        <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$value['ModuleID'] ; ?>" data-id="<?php echo $value['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $value['ModuleID'];?>" disabled>
                                        <label for="<?php echo "m_all_" .$value['ModuleID'] ; ?>">Check All</label>
                                    </div>  
                                </div>
                                <div class="margin_20" id="cm_<?php echo $value['ModuleID'];?>">
                                    <div class="row" id="<?php echo "div" . $value['ModuleID']; ?>">
                                        <div id="" class="col s10 right">
                                            <?php 
                                            $action_array = explode(',',$value['Actions']);
                                            if($action_array[0]!='' && is_array($action_array)){
                                            foreach ($action_array as $action_value) {
                                                if($action_value == "is_view"){
                                                    ?>
                                                    <div class="col s2">
                                                        <input disabled='true' <?php if(@$value[$action_value] == 1){echo " checked ";}?>  class="filled-in insert_actions all_actions" id="m_<?php echo $value['ModuleID'] . $action_value; ?>" type="checkbox"> 
                                                        <!-- name="<?php echo 'mod['. $value['ModuleID'].']['.$action_value.']'; ?>" -->
                                                        <label for="m_<?php echo $value['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_value));?></label>
                                                    </div>
                                                <?php
                                                continue;
                                                }
                                                ?>
                                                <div class="col s2">
                                                    <input <?php if(@$value[$action_value] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $value['ModuleID'].']['.$action_value.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $value['ModuleID'] . $action_value; ?>" type="checkbox">
                                                    <label for="m_<?php echo $value['ModuleID'] . $action_value; ?>"><?php echo ucfirst(str_replace('is_', '', $action_value));?></label>
                                                </div>    
                                            <?php
                                            } }
                                            ?>
                                        </div>
                                    </div>

                                    <div style="padding-top:10px"></div>

                                    <?php if(isset($value['ChildModule'])){ ?>
                                    <?php foreach ($value['ChildModule'] as $val2) { ?>
                                        <div class="row collection" id="<?php echo "main_div_" . $val2['ModuleID']; ?>" >
                                            <div class="container master-container margin_20">

                                                <input class="filled-in masters" id="<?php echo "m_" . $val2['ModuleID']; ?>" data-id="<?php echo $val2['ModuleID']; ?>" name="<?php echo 'mod['. $val2['ModuleID'].'][is_view]'; ?>" type="checkbox">
                                                <label class="rolelabel" for="<?php echo "m_" . $val2['ModuleID']; ?>"><?php echo $val2['ModuleName']; ?></label>

                                                <div class="right">
                                                    <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$val2['ModuleID'] ; ?>" data-id="<?php echo $val2['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val2['ModuleID'];?>" disabled>
                                                    <label for="<?php echo "m_all_" .$val2['ModuleID'] ; ?>">Check All</label>
                                                </div>  
                                            </div>
                                            <div class=" margin_20" id="cm_<?php echo $val2['ModuleID'];?>">
                                                <div class="row" id="<?php echo "div" . $val2['ModuleID']; ?>">
                                                    <div id="" class="col s10 right">
                                                        <?php 
                                                        $action_array = explode(',',$val2['Actions']);
                                                        if($action_array[0]!='' && is_array($action_array)){
                                                        foreach ($action_array as $action_val2) {
                                                            if($action_val2 == "is_view"){
                                                                ?>
                                                                <div class="col s2">
                                                                    <input disabled='true' <?php if(@$val2[$action_val2] == 1){echo " checked ";}?>  class="filled-in insert_actions all_actions" id="m_<?php echo $val2['ModuleID'] . $action_val2; ?>" type="checkbox">
                                                                    <!-- name="<?php echo 'mod['. $val2['ModuleID'].']['.$action_val2.']'; ?>" -->
                                                                    <label for="m_<?php echo $val2['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val2));?></label>
                                                                </div>
                                                            <?php
                                                            continue;
                                                            }
                                                            ?>
                                                            <div class="col s2">
                                                                <input <?php if(@$val2[$action_val2] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val2['ModuleID'].']['.$action_val2.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $val2['ModuleID'] . $action_val2; ?>" type="checkbox">
                                                                <label for="m_<?php echo $val2['ModuleID'] . $action_val2; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val2));?></label>
                                                            </div>    
                                                        <?php
                                                        } }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div style="padding-top:10px"></div>

                                                <?php if(isset($val2['ChildModule'])){ ?>
                                                <?php foreach ($val2['ChildModule'] as $val3) { ?>
                                                    <div class="row collection" id="<?php echo "main_div_" . $val3['ModuleID']; ?>" >
                                                        <div class="container master-container margin_20">

                                                            <input class="filled-in masters" id="<?php echo "m_" . $val3['ModuleID']; ?>" data-id="<?php echo $val3['ModuleID']; ?>" name="<?php echo 'mod['. $val3['ModuleID'].'][is_view]'; ?>" type="checkbox">
                                                            <label class="rolelabel" for="<?php echo "m_" . $val3['ModuleID']; ?>"><?php echo $val3['ModuleName']; ?></label>

                                                            <div class="right">
                                                                <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$val3['ModuleID'] ; ?>" data-id="<?php echo $val3['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val3['ModuleID'];?>" disabled>
                                                                <label for="<?php echo "m_all_" .$val3['ModuleID'] ; ?>">Check All</label>
                                                            </div>  
                                                        </div>
                                                        <div class=" margin_20" id="cm_<?php echo $val3['ModuleID'];?>">
                                                            <div class="row" id="<?php echo "div" . $val3['ModuleID']; ?>">
                                                                <div id="" class="col s10 right">
                                                                    <?php 
                                                                    $action_array = explode(',',$val3['Actions']);
                                                                    if($action_array[0]!='' && is_array($action_array)){
                                                                    foreach ($action_array as $action_val3) {
                                                                        if($action_val3 == "is_view"){
                                                                            ?>
                                                                            <div class="col s2">
                                                                                <input disabled='true' <?php if(@$val3[$action_val3] == 1){echo " checked ";}?> name="<?php echo 'mod['. $val3['ModuleID'].']['.$action_val3.']'; ?>" class="filled-in insert_actions all_actions" id="m_<?php echo $val3['ModuleID'] . $action_val3; ?>" type="checkbox">
                                                                                <label for="m_<?php echo $val3['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val3));?></label>
                                                                            </div>
                                                                        <?php
                                                                        continue;
                                                                        }
                                                                        ?>
                                                                        <div class="col s2">
                                                                            <input <?php if(@$val3[$action_val3] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val3['ModuleID'].']['.$action_val3.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $val3['ModuleID'] . $action_val3; ?>" type="checkbox">
                                                                            <label for="m_<?php echo $val3['ModuleID'] . $action_val3; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val3));?></label>
                                                                        </div>    
                                                                    <?php
                                                                    } }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div style="padding-top:10px"></div>

                                                            <?php if(isset($val3['ChildModule'])){ ?>
                                                            <?php foreach ($val3['ChildModule'] as $val4) { ?>
                                                                <div class="row collection" id="<?php echo "main_div_" . $val4['ModuleID']; ?>" >
                                                                    <div class="container master-container margin_20">

                                                                        <input class="filled-in masters" id="<?php echo "m_" . $val4['ModuleID']; ?>" data-id="<?php echo $val4['ModuleID']; ?>" name="<?php echo 'mod['. $val4['ModuleID'].'][is_view]'; ?>" type="checkbox">
                                                                        <label class="rolelabel" for="<?php echo "m_" . $val4['ModuleID']; ?>"><?php echo $val4['ModuleName']; ?></label>

                                                                        <div class="right">
                                                                            <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$val4['ModuleID'] ; ?>" data-id="<?php echo $val4['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val4['ModuleID'];?>" disabled>
                                                                            <label for="<?php echo "m_all_" .$val4['ModuleID'] ; ?>">Check All</label>
                                                                        </div>  
                                                                    </div>
                                                                    <div class=" margin_20" id="cm_<?php echo $val4['ModuleID'];?>">
                                                                        <div class="row" id="<?php echo "div" . $val4['ModuleID']; ?>">
                                                                            <div id="" class="col s10 right">
                                                                                <?php 
                                                                                $action_array = explode(',',$val4['Actions']);
                                                                                if($action_array[0]!='' && is_array($action_array)){
                                                                                foreach ($action_array as $action_val4) {
                                                                                    if($action_val4 == "is_view"){
                                                                                        ?>
                                                                                        <div class="col s2">
                                                                                            <input disabled='true' <?php if(@$val4[$action_val4] == 1){echo " checked ";}?> name="<?php echo 'mod['. $val4['ModuleID'].']['.$action_val4.']'; ?>" class="filled-in insert_actions all_actions" id="m_<?php echo $val4['ModuleID'] . $action_val4; ?>" type="checkbox">
                                                                                            <label for="m_<?php echo $val4['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val4));?></label>
                                                                                        </div>
                                                                                    <?php
                                                                                    continue;
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col s2">
                                                                                        <input <?php if(@$val4[$action_val4] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val4['ModuleID'].']['.$action_val4.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $val4['ModuleID'] . $action_val4; ?>" type="checkbox">
                                                                                        <label for="m_<?php echo $val4['ModuleID'] . $action_val4; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val4));?></label>
                                                                                    </div>    
                                                                                <?php
                                                                                } }
                                                                                ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="padding-top:10px"></div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div><?php
                                    } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                        if($k_0!='Both' && $k_0!='Web'){ ?>
                            </div>
                        <?php }elseif($k_0=='Both'){ ?>
                            </div>
                        <?php }
                        }*/ ?>
                    
                </div>
                <div class="col s12 m4 l4">
                    <div class="btn add_role_clone">+ New Project Role</div>
                </div>
            </form>
        </div>
    </div>
</div>