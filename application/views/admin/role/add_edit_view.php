<?php 
$level_project_temp = $level_project;
foreach ($modules as $k_0=>$m_0) { ?>
<?php if($k_0!='Both' && $k_0!='Mobile'){ 
    $level_project = ($level_project_temp==1 ? $level_project_temp : $level_project); ?>
    <div class="project_level level_p_<?php echo $level_project;?> collection margin_20" data-project-id="<?php echo $level_project;?>">
    <div class="">
        <a href="javascript:void(0)"    >
            <i class="deleteproject btn-floating waves-effect red darken-4 mdi-navigation-close inactive_status_icon tooltipped" data-position="top" data-delay="50" data-tooltip="Delete Project" data-div="level_p_<?php echo $level_project;?>"></i>
        </a>
    </div>

    <?php echo $Project; ?>
<?php }elseif($k_0=='Both'){ 
    $level_project = 0;?>
    <div class="project_level level_p_0 collection margin_20" data-project-id="0">
        <input type="hidden" name="ProjectID" value="0">
<?php } ?>
    <div class="role_type_label"><label class="rolelabel"><?php echo $k_0; ?></label></div>
    
    <?php
    foreach ($m_0 as $value) { ?>
        <div class="collection" id="<?php echo "main_div_".$level_project."_" . $value['ModuleID']; ?>" >
            <div class="container master-container margin_20">

                <input class="filled-in masters" id="<?php echo "m_".$level_project."_" . $value['ModuleID']; ?>" data-id="<?php echo $value['ModuleID']; ?>" name="<?php echo 'mod['. $value['ModuleID'].'][is_view]'; ?>" type="checkbox" <?php echo (@$editarray[$value['ModuleID']]['is_view'] == 1)?" checked ":"";?> >
                <label class="rolelabel" for="<?php echo "m_".$level_project."_" . $value['ModuleID']; ?>"><?php echo $value['ModuleName']; ?></label>

                <div class="right">
                    <input  class="filled-in check_all_action" id="<?php echo "m_all_".$level_project."_" .$value['ModuleID'] ; ?>" data-id="<?php echo $value['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $value['ModuleID'];?>" disabled >
                    <label for="<?php echo "m_all_".$level_project."_" .$value['ModuleID'] ; ?>">Check All</label>
                </div>  
            </div>
            <div class="margin_20" id="cm_<?php echo $level_project."_" .$value['ModuleID'];?>">
                <div class="row" id="<?php echo "div" . $value['ModuleID']; ?>">
                    <div id="" class="col s10 right">
                        <?php 
                        $action_array = explode(',',$value['Actions']);
                        if($action_array[0]!='' && is_array($action_array)){
                        foreach ($action_array as $action_value) {
                            if($action_value == "is_view"){
                                ?>
                                <div class="col s2">
                                    <input data-mod="<?php echo $value['ModuleID'];?>" disabled='true' <?php if(@$value[$action_value] == 1){echo " checked ";}?>  class="filled-in insert_actions all_actions" id="m_<?php echo $level_project.'_'.$value['ModuleID'] . $action_value; ?>" type="checkbox" <?php echo (@$editarray[$value['ModuleID']][$action_value] == 1)?" checked ":"";?> > 
                                    <!-- name="<?php echo 'mod['. $value['ModuleID'].']['.$action_value.']'; ?>" -->
                                    <label for="m_<?php echo $level_project.'_'.$value['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_value));?></label>
                                </div>
                            <?php
                            continue;
                            }
                            ?>
                            <div class="col s2">
                                <input data-mod="<?php echo $value['ModuleID'];?>" <?php if(@$value[$action_value] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $value['ModuleID'].']['.$action_value.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $level_project.'_'.$value['ModuleID'] . $action_value; ?>" type="checkbox" <?php echo (@$editarray[$value['ModuleID']][$action_value] == 1)?" checked ":"";?>>
                                <label for="m_<?php echo $level_project.'_'.$value['ModuleID'] . $action_value; ?>"><?php echo ucfirst(str_replace('is_', '', $action_value));?></label>
                            </div>    
                        <?php
                        } }
                        ?>
                    </div>
                </div>

                <div style="padding-top:10px"></div>

                <?php if(isset($value['ChildModule'])){ ?>
                <?php foreach ($value['ChildModule'] as $val2) { ?>
                    <div class="row collection" id="<?php echo "main_div_".$level_project."_" . $val2['ModuleID']; ?>" >
                        <div class="container master-container margin_20">

                            <input class="filled-in masters" id="<?php echo "m_".$level_project."_" . $val2['ModuleID']; ?>" data-id="<?php echo $val2['ModuleID']; ?>" name="<?php echo 'mod['. $val2['ModuleID'].'][is_view]'; ?>" type="checkbox" <?php echo (@$editarray[$val2['ModuleID']]['is_view'] == 1)?" checked ":"";?>>
                            <label class="rolelabel" for="<?php echo "m_".$level_project."_" . $val2['ModuleID']; ?>"><?php echo $val2['ModuleName']; ?></label>

                            <div class="right">
                                <input  class="filled-in check_all_action" id="<?php echo "m_all_".$level_project."_" .$val2['ModuleID'] ; ?>" data-id="<?php echo $val2['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val2['ModuleID'];?>" disabled>
                                <label for="<?php echo "m_all_".$level_project."_" .$val2['ModuleID'] ; ?>">Check All</label>
                            </div>  
                        </div>
                        <div class=" margin_20" id="cm_<?php echo $level_project."_" .$val2['ModuleID'];?>">
                            <div class="row" id="<?php echo "div" . $val2['ModuleID']; ?>">
                                <div id="" class="col s10 right">
                                    <?php 
                                    $action_array = explode(',',$val2['Actions']);
                                    if($action_array[0]!='' && is_array($action_array)){
                                    foreach ($action_array as $action_val2) {
                                        if($action_val2 == "is_view"){
                                            ?>
                                            <div class="col s2">
                                                <input data-mod="<?php echo $val2['ModuleID'];?>" disabled='true' <?php if(@$val2[$action_val2] == 1){echo " checked ";}?>  class="filled-in insert_actions all_actions" id="m_<?php echo $level_project.'_'.$val2['ModuleID'] . $action_val2; ?>" type="checkbox" <?php echo (@$editarray[$val2['ModuleID']][$action_val2] == 1)?" checked ":"";?>>
                                                <!-- name="<?php echo 'mod['. $val2['ModuleID'].']['.$action_val2.']'; ?>" -->
                                                <label for="m_<?php echo $level_project.'_'.$val2['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val2));?></label>
                                            </div>
                                        <?php
                                        continue;
                                        }
                                        ?>
                                        <div class="col s2">
                                            <input data-mod="<?php echo $val2['ModuleID'];?>" <?php if(@$val2[$action_val2] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val2['ModuleID'].']['.$action_val2.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $level_project.'_'.$val2['ModuleID'] . $action_val2; ?>" type="checkbox" <?php echo (@$editarray[$val2['ModuleID']][$action_val2] == 1)?" checked ":"";?> >
                                            <label for="m_<?php echo $level_project.'_'.$val2['ModuleID'] . $action_val2; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val2));?></label>
                                        </div>    
                                    <?php
                                    } }
                                    ?>
                                </div>
                            </div>

                            <div style="padding-top:10px"></div>

                            <?php if(isset($val2['ChildModule'])){ ?>
                            <?php foreach ($val2['ChildModule'] as $val3) { ?>
                                <div class="row collection" id="<?php echo "main_div_".$level_project."_" . $val3['ModuleID']; ?>" >
                                    <div class="container master-container margin_20">

                                        <input class="filled-in masters" id="<?php echo "m_".$level_project."_" . $val3['ModuleID']; ?>" data-id="<?php echo $val3['ModuleID']; ?>" name="<?php echo 'mod['. $val3['ModuleID'].'][is_view]'; ?>" type="checkbox" <?php echo (@$editarray[$val3['ModuleID']]['is_view'] == 1)?" checked ":"";?>>
                                        <label class="rolelabel" for="<?php echo "m_".$level_project."_" . $val3['ModuleID']; ?>"><?php echo $val3['ModuleName']; ?></label>

                                        <div class="right">
                                            <input  class="filled-in check_all_action" id="<?php echo "m_all_".$level_project."_" .$val3['ModuleID'] ; ?>" data-id="<?php echo $val3['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val3['ModuleID'];?>" disabled>
                                            <label for="<?php echo "m_all_".$level_project."_" .$val3['ModuleID'] ; ?>">Check All</label>
                                        </div>  
                                    </div>
                                    <div class=" margin_20" id="cm_<?php echo $level_project."_" .$val3['ModuleID'];?>">
                                        <div class="row" id="<?php echo "div" . $val3['ModuleID']; ?>">
                                            <div id="" class="col s10 right">
                                                <?php 
                                                $action_array = explode(',',$val3['Actions']);
                                                if($action_array[0]!='' && is_array($action_array)){
                                                foreach ($action_array as $action_val3) {
                                                    if($action_val3 == "is_view"){
                                                        ?>
                                                        <div class="col s2">
                                                            <input data-mod="<?php echo $val3['ModuleID'];?>" disabled='true' <?php if(@$val3[$action_val3] == 1){echo " checked ";}?> name="<?php echo 'mod['. $val3['ModuleID'].']['.$action_val3.']'; ?>" class="filled-in insert_actions all_actions" id="m_<?php echo $level_project.'_'.$val3['ModuleID'] . $action_val3; ?>" type="checkbox" <?php echo (@$editarray[$val3['ModuleID']][$action_val3] == 1)?" checked ":"";?> >
                                                            <label for="m_<?php echo $level_project.'_'.$val3['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val3));?></label>
                                                        </div>
                                                    <?php
                                                    continue;
                                                    }
                                                    ?>
                                                    <div class="col s2">
                                                        <input data-mod="<?php echo $val3['ModuleID'];?>" <?php if(@$val3[$action_val3] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val3['ModuleID'].']['.$action_val3.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $level_project.'_'.$val3['ModuleID'] . $action_val3; ?>" type="checkbox" <?php echo (@$editarray[$val3['ModuleID']][$action_val3] == 1)?" checked ":"";?> >
                                                        <label for="m_<?php echo $level_project.'_'.$val3['ModuleID'] . $action_val3; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val3));?></label>
                                                    </div>    
                                                <?php
                                                } }
                                                ?>
                                            </div>
                                        </div>

                                        <div style="padding-top:10px"></div>

                                        <?php if(isset($val3['ChildModule'])){ ?>
                                        <?php foreach ($val3['ChildModule'] as $val4) { ?>
                                            <div class="row collection" id="<?php echo "main_div_".$level_project."_" . $val4['ModuleID']; ?>" >
                                                <div class="container master-container margin_20">

                                                    <input class="filled-in masters" id="<?php echo "m_".$level_project."_" . $val4['ModuleID']; ?>" data-id="<?php echo $val4['ModuleID']; ?>" name="<?php echo 'mod['. $val4['ModuleID'].'][is_view]'; ?>" type="checkbox" <?php echo (@$editarray[$val4['ModuleID']]['is_view'] == 1)?" checked ":"";?>>
                                                    <label class="rolelabel" for="<?php echo "m_".$level_project."_" . $val4['ModuleID']; ?>"><?php echo $val4['ModuleName']; ?></label>

                                                    <div class="right">
                                                        <input  class="filled-in check_all_action" id="<?php echo "m_all_".$level_project."_" .$val4['ModuleID'] ; ?>" data-id="<?php echo $val4['ModuleID'] ; ?>" type="checkbox" data-master="master_<?php echo $val4['ModuleID'];?>" disabled>
                                                        <label for="<?php echo "m_all_".$level_project."_" .$val4['ModuleID'] ; ?>">Check All</label>
                                                    </div>  
                                                </div>
                                                <div class=" margin_20" id="cm_<?php echo $level_project."_" .$val4['ModuleID'];?>">
                                                    <div class="row" id="<?php echo "div" . $val4['ModuleID']; ?>">
                                                        <div id="" class="col s10 right">
                                                            <?php 
                                                            $action_array = explode(',',$val4['Actions']);
                                                            if($action_array[0]!='' && is_array($action_array)){
                                                            foreach ($action_array as $action_val4) {
                                                                if($action_val4 == "is_view"){
                                                                    ?>
                                                                    <div class="col s2">
                                                                        <input data-mod="<?php echo $val4['ModuleID'];?>" disabled='true' <?php if(@$val4[$action_val4] == 1){echo " checked ";}?> name="<?php echo 'mod['. $val4['ModuleID'].']['.$action_val4.']'; ?>" class="filled-in insert_actions all_actions" id="m_<?php echo $level_project.'_'.$val4['ModuleID'] . $action_val4; ?>" type="checkbox" <?php echo (@$editarray[$val4['ModuleID']][$action_val4] == 1)?" checked ":"";?> >
                                                                        <label for="m_<?php echo $level_project.'_'.$val4['ModuleID'] . "view"; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val4));?></label>
                                                                    </div>
                                                                <?php
                                                                continue;
                                                                }
                                                                ?>
                                                                <div class="col s2">
                                                                    <input data-mod="<?php echo $val4['ModuleID'];?>" <?php if(@$val4[$action_val4] == 1){echo " checked ";} if(@$action_array['is_view']){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo 'mod['. $val4['ModuleID'].']['.$action_val4.']'; ?>" class="filled-in module_actions all_actions" id="m_<?php echo $level_project.'_'.$val4['ModuleID'] . $action_val4; ?>" type="checkbox" <?php echo (@$editarray[$val4['ModuleID']][$action_val4] == 1)?" checked ":"";?>>
                                                                    <label for="m_<?php echo $level_project.'_'.$val4['ModuleID'] . $action_val4; ?>"><?php echo ucfirst(str_replace('is_', '', $action_val4));?></label>
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
    } ?>
