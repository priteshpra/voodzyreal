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

                <div class="col s12 m4 l4">
                    <?php 
                    foreach ($modules['Both'][0] as $value) {
                        ?>
                        <div class="row">
                            <div class="container master-container">
                                <input class="filled-in masters" id="<?php echo "master_" . $value->ModuleID; ?>" name="<?php echo "master_" . $value->ModuleID; ?>" value="<?php echo "div" . $value->ModuleID; ?>" type="checkbox">
                                <label class="rolelabel" for="<?php echo "master_" . $value->ModuleID; ?>"><?php echo $value->ModuleName; ?></label>
                                <div class="right">
                                    <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$value->ModuleID ; ?>" value="<?php echo "div" . $value->ModuleID; ?>" type="checkbox" data-master="master_<?php echo $value->ModuleID;?>" disabled>
                                    <label for="<?php echo "m_all_" .$value->ModuleID ; ?>">Check All</label>
                                </div>  
                            </div>
                            <div style="padding-top:10px"></div>
                            <?php 
                            if(isset($modules['Both'][$value->ModuleID])){
                            ?>
                            <ul id="<?php echo "div" . $value->ModuleID; ?>" class="container collection" id="projects-collection" >
                                    <?php
                                    $j = 0;
                                    foreach ($modules['Both'][$value->ModuleID] as $child) {
                                        if ($value->ModuleID == $child->ParentID) {
                                            ?>
                                            <li class="collection-item">
                                                <div class="container submodule-container">
                                                    <input class="filled-in submodule" name="<?php echo "m_" . $child->ModuleID; ?>" id="<?php echo "m_" . $child->ModuleID; ?>" value="<?php echo $value->ModuleID; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                    <label class="rolelabel" for="<?php echo "m_" . $child->ModuleID; ?>"><?php echo $child->ModuleName; ?></label>
                                                    <div class="right">
                                                        <input class="filled-in check_sub_action all_actions" <?php echo @$all_chk; if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> value="<?php echo "m_$child->ModuleID"; ?>" id="<?php echo "m_$child->ModuleID" . "c_all"; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                        <label for="<?php echo "m_$child->ModuleID" . "c_all"; ?>">Check All</label>
                                                    </div>
                                                </div>
                                                <div class="row" id="<?php echo "div" . $child->ModuleID; ?>">
                                                    <div id="" class="col s10 right">
                                                        <?php 
                                                        $action_array = explode(',',$child->Actions);
                                                        foreach ($action_array as $action_value) {
                                                            if($action_value == "is_view"){
                                                                ?>
                                                                <div class="col s2">
                                                                    <input disabled='true' <?php if(@$child->$action_value == 1){echo " checked ";}?> name="<?php echo $action_value . $child->ModuleID; ?>" class="filled-in insert_actions all_actions" id="<?php echo "m_$child->ModuleID" . $action_value; ?>" type="checkbox">
                                                                    <label for="<?php echo "m_$child->ModuleID" . "view"; ?>"><?php echo $action_value;?></label>
                                                                </div>
                                                            <?php
                                                            continue;
                                                            }
                                                            ?>

                                                            <div class="col s2">
                                                                <input <?php if(@$child->$action_value == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo $action_value . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . $action_value; ?>" type="checkbox">
                                                                <label for="<?php echo "m_$child->ModuleID" . $action_value; ?>"><?php echo $action_value;?></label>
                                                            </div>    
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            $j++;
                                        }
                                    }
                                    ?>
                            </ul>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col s12 m4 l4">
                    <?php 
                    foreach ($modules['Web'][0] as $value) {
                        ?>
                        <div class="row">
                            <div class="container master-container">
                                <input class="filled-in masters" id="<?php echo "master_" . $value->ModuleID; ?>" name="<?php echo "master_" . $value->ModuleID; ?>" value="<?php echo "div" . $value->ModuleID; ?>" type="checkbox">
                                <label class="rolelabel" for="<?php echo "master_" . $value->ModuleID; ?>"><?php echo $value->ModuleName; ?></label>
                                <div class="right">
                                    <input  class="filled-in check_all_action" id="<?php echo "m_all_" .$value->ModuleID ; ?>" value="<?php echo "div" . $value->ModuleID; ?>" type="checkbox" data-master="master_<?php echo $value->ModuleID;?>" disabled>
                                    <label for="<?php echo "m_all_" .$value->ModuleID ; ?>">Check All</label>
                                </div>  
                            </div>
                            <div style="padding-top:10px"></div>
                            <?php 
                            if(isset($modules['Web'][$value->ModuleID])){
                            ?>
                            <ul id="<?php echo "div" . $value->ModuleID; ?>" class="container collection" id="projects-collection" >
                                    <?php
                                    $j = 0;
                                    foreach ($modules['Web'][$value->ModuleID] as $child) {

                                        if ($value->ModuleID == $child->ParentID) {
                                            ?>
                                            <li class="collection-item">
                                                <div class="container submodule-container">
                                                    <input class="filled-in submodule <?php if($child->ModuleName == "Customer") echo "masters";?>" name="<?php echo "m_" . $child->ModuleID; ?>" id="<?php echo "m_" . $child->ModuleID; ?>" value="<?php echo "div" . $child->ModuleID; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                    <label class="rolelabel" for="<?php echo "m_" . $child->ModuleID; ?>"><?php echo $child->ModuleName; ?></label>
                                                    <div class="right">
                                                        <input class="filled-in check_sub_action all_actions" <?php echo @$all_chk; if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> value="<?php echo "m_$child->ModuleID"; ?>" id="<?php echo "m_$child->ModuleID" . "c_all"; ?>" type="checkbox" data-div="<?php echo "div" . $child->ModuleID; ?>">
                                                        <label for="<?php echo "m_$child->ModuleID" . "c_all"; ?>">Check All</label>
                                                    </div>
                                                </div>
                                                <div class="row" id="<?php echo "div" . $child->ModuleID; ?>">
                                                    <div id="" class="col s10 right">
                                                        <?php 
                                                        $action_array = explode(',',$child->Actions);
                                                        foreach ($action_array as $action_value) {
                                                            if($action_value == "is_view"){
                                                                ?>
                                                                <div class="col s2">
                                                                    <input disabled='true' <?php if(@$child->$action_value == 1){echo " checked ";}?> name="<?php echo $action_value . $child->ModuleID; ?>" class="filled-in insert_actions all_actions" id="<?php echo "m_$child->ModuleID" . $action_value; ?>" type="checkbox">
                                                                    <label for="<?php echo "m_$child->ModuleID" . "view"; ?>"><?php echo $action_value;?></label>
                                                                </div>
                                                            <?php
                                                            continue;
                                                            }
                                                            ?>

                                                            <div class="col s2">
                                                                <input <?php if(@$child->$action_value == 1){echo " checked ";} if(@$child->is_view){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo $action_value . $child->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$child->ModuleID" . $action_value; ?>" type="checkbox">
                                                                <label for="<?php echo "m_$child->ModuleID" . $action_value; ?>"><?php echo $action_value;?></label>
                                                            </div>    
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php 
                                                if($child->ModuleName == "Customer"){
                                                    $cus_arr = $modules['Web'][$child->ModuleID][0];
                                                ?>
                                                        <ul id="<?php echo "Sdiv" . $child->ModuleID; ?>" class="container collection" id="projects-collection" >
                                                            <li class="collection-item">
                                                                <div class="container submodule-container">
                                                                    <input class="filled-in submodule masters" <?php if(!isset($cus_arr->is_view) || @$cus_arr->is_view==0){ echo " disabled ";}?> name="<?php echo "m_" . $cus_arr->ModuleID; ?>" id="<?php echo "m_" . $cus_arr->ModuleID; ?>" value="<?php echo $cus_arr->ParentID; ?>" type="checkbox" data-div="<?php echo "div" . $cus_arr->ModuleID; ?>">
                                                                    <label class="rolelabel" for="<?php echo "m_" . $cus_arr->ModuleID; ?>"><?php echo $cus_arr->ModuleName; ?></label>
                                                                    <div class="right">
                                                                        <input class="filled-in check_sub_action all_actions" <?php echo @$all_chk; if(@$cus_arr->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> value="<?php echo "m_$cus_arr->ModuleID"; ?>" id="<?php echo "m_$cus_arr->ModuleID" . "c_all"; ?>" type="checkbox" data-div="<?php echo "div" . $cus_arr->ModuleID; ?>">
                                                                        <label for="<?php echo "m_$cus_arr->ModuleID" . "c_all"; ?>">Check All</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="<?php echo "div" . $cus_arr->ModuleID; ?>">
                                                                    <div id="" class="col s10 right">
                                                                    <?php 
                                                                    $action_array = explode(',',$cus_arr->Actions);
                                                                    foreach ($action_array as $action_value) {
                                                                        if($action_value == "is_view"){
                                                                            ?>
                                                                            <div class="col s2">
                                                                                <input disabled='true' <?php if(@$cus_arr->$action_value == 1){echo " checked ";}?> name="<?php echo $action_value . $cus_arr->ModuleID; ?>" class="filled-in insert_actions all_actions" id="<?php echo "m_$cus_arr->ModuleID" . $action_value; ?>" type="checkbox">
                                                                                <label for="<?php echo "m_$cus_arr->ModuleID" . "view"; ?>"><?php echo $action_value;?></label>
                                                                            </div>
                                                                        <?php
                                                                        continue;
                                                                        }
                                                                        ?>

                                                                        <div class="col s2">
                                                                            <input <?php if(@$cus_arr->$action_value == 1){echo " checked ";} if(@$cus_arr->is_view){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo $action_value . $cus_arr->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$cus_arr->ModuleID" . $action_value; ?>" type="checkbox">
                                                                            <label for="<?php echo "m_$cus_arr->ModuleID" . $action_value; ?>"><?php echo $action_value;?></label>
                                                                        </div>    
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                </div>

                                                            <!-- Customer Property Start -->
                                                            <ul id="<?php echo "div" . $cus_arr->ModuleID; ?>" class="container collection" id="projects-collection" >
                                                                <?php
                                                                $j = 0;
                                                                $endarray = $modules['Web'][$cus_arr->ModuleID];
                                                                foreach ($endarray as $end_value) {
                                                                        ?>
                                                                        <li class="collection-item">
                                                                            <div class="container submodule-container">
                                                                                <input class="filled-in submodule" <?php if(isset($cus_arr->is_view) || @$cus_arr->is_view == 0){echo " disabled ";}?> name="<?php echo "m_" . $end_value->ModuleID; ?>" id="<?php echo "m_" . $end_value->ModuleID; ?>" value="<?php echo $cus_arr->ModuleID; ?>" type="checkbox" data-div="<?php echo "div" . $end_value->ModuleID; ?>">
                                                                                <label class="rolelabel" for="<?php echo "m_" . $end_value->ModuleID; ?>"><?php echo $end_value->ModuleName; ?></label>
                                                                                <div class="right">
                                                                                    <input class="filled-in check_sub_action all_actions" <?php echo @$all_chk; if(@$end_value->is_view){echo $disabled;}else{ echo " disabled='true' ";}?> value="<?php echo "m_$end_value->ModuleID"; ?>" id="<?php echo "m_$end_value->ModuleID" . "c_all"; ?>" type="checkbox" data-div="<?php echo "div" . $end_value->ModuleID; ?>">
                                                                                    <label for="<?php echo "m_$end_value->ModuleID" . "c_all"; ?>">Check All</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row" id="<?php echo "div" . $end_value->ModuleID; ?>">
                                                                                <div id="" class="col s10 right">
                                                                                    <?php 
                                                                                    $action_array = explode(',',$end_value->Actions);
                                                                                    foreach ($action_array as $action_value) {
                                                                                        if($action_value == "is_view"){
                                                                                            ?>
                                                                                            <div class="col s2">
                                                                                                <input disabled='true' <?php if(@$end_value->$action_value == 1){echo " checked ";}?> name="<?php echo $action_value . $end_value->ModuleID; ?>" class="filled-in insert_actions all_actions" id="<?php echo "m_$end_value->ModuleID" . $action_value; ?>" type="checkbox">
                                                                                                <label for="<?php echo "m_$end_value->ModuleID" . "view"; ?>"><?php echo $action_value;?></label>
                                                                                            </div>
                                                                                        <?php
                                                                                        continue;
                                                                                        }
                                                                                        ?>

                                                                                        <div class="col s2">
                                                                                            <input <?php if(@$end_value->$action_value == 1){echo " checked ";} if(@$end_value->is_view){echo $disabled;}else{ echo " disabled='true' ";} ?> name="<?php echo $action_value . $end_value->ModuleID; ?>" class="filled-in module_actions all_actions" id="<?php echo "m_$end_value->ModuleID" . $action_value; ?>" type="checkbox">
                                                                                            <label for="<?php echo "m_$end_value->ModuleID" . $action_value; ?>"><?php echo $action_value;?></label>
                                                                                        </div>    
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                            <!-- Customer Property End -->
                                                            </li>
                                                        </ul>
                                                <?php 
                                                }
                                                ?>
                                            </li>
                                            <?php
                                            $j++;
                                        }
                                    }
                                    ?>
                            </ul>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                
            </form>
        </div>
    </div>
</div>