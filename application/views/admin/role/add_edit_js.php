<script>
 $(document).ready(function () {
    setTimeout(function(){ $('#Name').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
});

    window.isClone = 0;
    window.level_project = 1;
    function loadview(RoleID = 0){
        $.ajax({
            type:"post",
            url: '<?php echo base_url();?>admin/role/role_view/'+isClone+'/'+level_project,
            data:{
                RoleID:RoleID,
            },
            success:function(data)
            {
                if(data){
                    isClone = 1;
                    $(".modules").append(data);
                    if(RoleID != 0){
                        Operations();
                    }
                }else{
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
                }
                
            }
        });
    }
    <?php 
    if($RoleID != 0){
        echo "loadview($RoleID);";
    }else{
        echo "loadview();";
    }
    ?>
    

    function LoadPropertyBasedProject(){}


    $('.add_role_clone').on('click', function(){
        // var $clone = $( ".project_level.level_p_1" ).html();
        // var old_level_project = level_project;
        level_project++;
        // $clone = $clone.replace("level_p_"+old_level_project,"level_p_"+level_project);
        // $clone = '<div class="project_level level_p_'+level_project+' collection margin_20" data-project-id="'+level_project+'">'+$clone+'</div>';
        // $( ".modules" ).append($clone);
        loadview();
        // $('.modules .project_level.level_p_'+level_project+' .select2_class .select-dropdown:first').hide();
        // $('.project_level.level_p_'+level_project+' #ProjectID select').material_select();
    });
    /*Function For Buutoon click event */
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        var field_ids = ['ProjectID'];
        var combo_box_error = checkComboBox(field_ids); 
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field');?>");
            return false;
        }else{
            $.ajax({
                type:"post",
                url: base_url + "admin/role/CheckDuplicate",
                data:{table_name:'sssm_roles',field_name:'RoleName',data_value:$('#Name').val(),ufield:'RoleID',ID:$("#RoleID").val()},
                success:function(data)
                {   
                    var obj = JSON.parse(data);
                    if(obj.result == 'Success'){
                        
                        var action_url = $('form').attr('action');
                        window._Project = [];
                        window.ProjectArray = [];
                        var prid,selectval;
                        $('.modules .project_level').each(function(key,val){
                            prid = $(val).find('select').val();
                            selectval = $(val).find('select option:selected').html();
                            if (typeof prid === "undefined") {

                            }else{
                                console.log(selectval);
                                if(jQuery.inArray(prid, ProjectArray) != -1){
                                    alertify.error("Project " + selectval +" used multiple time");
                                    return false;
                                }else{
                                    ProjectArray.push(prid);
                                }
                            }
                            _Project.push($(val).find('select, textarea, input').serialize());
                        });
                        if(ProjectArray.length == 0){
                            alertify.error("Required minimum on projet");
                            return false;
                        }
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $.ajax({
                            type:"post",
                            url: action_url,
                            data:{RoleID:$('#RoleID').val(),Name:$('#Name').val(),Description:$('#Description').val(),Project:_Project},
                            success:function(data)
                            {
                                if(data == 1){
                                    if($('#RoleID').val() == 0){
                                        alertify.success("Role Added Successfully");
                                    }else{
                                        alertify.success("Role Edited Successfully");
                                    }
                                    
                                    setTimeout(function(){ window.location="<?php echo site_url('admin/role');?>" }, 1100);
                                }else{
                                    alertify.error("<?php echo label('please_try_again');?>");
                                }
                                
                            }
                        });

                    }else{
                        alertify.error("<?php echo label('role_already_exists');?>");
                        return false;
                    }           
                }
            });
        }
        return false;
    });
    $(document).on("click", ".modules .masters", function () { 
        var mod = $(this);
        var project_wise = mod.closest('div.project_level').attr('data-project-id');
        // console.log(project_wise);
        var mod_id = mod.attr('data-id');
        var flag = 0;
        if($(this).is(":checked")){
            mod.parents('.modules .level_p_'+project_wise+' .collection').each(function(key,val){
                // console.log(val);
                $(val).find('input.masters:first').prop('checked',true);
                $(val).find('input.check_all_action:first').prop('disabled',false);
            });
            flag = 1;
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.masters').prop('checked',true);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.insert_actions').prop('checked',true);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('disabled',false);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',false);
        }else{
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.masters').prop('checked',false);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.insert_actions').prop('checked',false);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('checked',false);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('disabled',true);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',true);
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',false);
        }
        var totalckb = $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').length;
        var totalselectedckb = $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions:checked').length;
        if(totalselectedckb == 0){
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',false)
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',true)
        }
        if(totalckb == totalselectedckb &&  flag == 1 ){
            $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',true);
        }
        // var div = $(this).val();
        // alert($(this).attr('id'));

        // if($(this).hasClass('submodule')){
        //     if($(this).is(":checked")){
        //         $("#S"+div + " .submodule").prop('checked',true);
        //         $("#S"+div + " .submodule").prop('disabled',false);
        //         $("#S"+div + " .module_actions").prop('disabled',true);
        //         $("#S"+div + " .insert_actions").prop('checked',true);
        //         $("#S"+div + " .module_actions").prop('disabled',false);
        //         $("#S"+div + " .check_sub_action").prop('disabled',false);
        //     }else{
        //         $("#S"+div + " input:checkbox").prop('checked',false);
        //         $("#S"+div + " .module_actions").prop('disabled',true);
        //         $("#S"+div + " .check_sub_action").prop('disabled',true);
        //         $("#S"+div + " .submodule").prop('checked',false);
        //         $("#S"+div + " .submodule").prop('disabled',true);
        //     }
        // }else{
        //     if($(this).is(":checked")){
        //         $("#"+div + " .submodule").prop('checked',true);
        //         $("#"+div + " .insert_actions").prop('checked',true);
        //         $("#"+div + " .module_actions").prop('disabled',false);
        //         $("#"+div + " .check_sub_action").prop('disabled',false);
        //     }else{
        //         $("#"+div + " input:checkbox").prop('checked',false);
        //         $("#"+div + " .module_actions").prop('disabled',true);
        //         $("#"+div + " .check_sub_action").prop('disabled',true);
        //     }
        // }
        // return true;
        // checkchange();
    });
    $(document).on("click", ".modules .check_all_action", function(){
        var check_all_action = $(this);
        var project_wise = check_all_action.parents('.project_level').attr('data-project-id');

        var check_all_action_id = check_all_action.attr('data-id');
        if($(this).is(":checked")){
            $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.all_actions').prop('checked',true);
            $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.check_all_action').prop('checked',true);
            // $('#cm_'+check_all_action_id+' input.all_actions').prop('disabled',false);
            // $('#cm_'+check_all_action_id+' input.insert_actions').prop('disabled',true);
        }else{
            $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.all_actions').prop('checked',false);
            $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.insert_actions').prop('checked',true);
            $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.check_all_action').prop('checked',false);
            // $('#cm_'+check_all_action_id+' input.all_actions').prop('disabled',true);
            // $('#cm_'+check_all_action_id+' input.insert_actions').prop('disabled',false);

        }

        // var div = $(this).val();
        // var master = $(this).attr('data-master');
        // if($(this).is(":checked")){
        //     $("#"+master).prop('checked',true);
        //     $("#"+div + " .submodule").prop('checked',true);
        //     $("#"+div + " .all_actions").prop('checked',true);
        //     $("#"+div + " .all_actions").prop('disabled',false);
        //     $("#"+div + " .insert_actions").prop('disabled',true);
        // }else{
        //     $("#"+master).prop('checked',false);
        //     $("#"+div + " .submodule").prop('checked',false);
        //     $("#"+div + " .all_actions").prop('checked',false);
        //     $("#"+div + " .all_actions").prop('disabled',true);
        // }
        // checkchange();
    });
    function master(){
        $.each($(".masters"), function(){
            var id = $(this).attr("id");
            var project_wise = $(this).closest('div.project_level').attr('data-project-id');
            var total = $("#main_div_"+project_wise+"_"+id).find("input.all_actions").length;
            var totalselected = $("#main_div_"+project_wise+"_" + id).find("input.all_actions:checked").length;
            if(total == totalselected){
                
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+id+' input.check_all_action').prop('checked',true);
            }else{
                    $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+id+' input.check_all_action').prop('checked',false);
            }

        });

    }
    function Operations(){
        $.each($(".modules .masters"), function(){
            var mod = $(this);
            var project_wise = mod.closest('div.project_level').attr('data-project-id');
            // console.log(project_wise);
            var mod_id = mod.attr('data-id');
            var flag = 0;
            if($(this).is(":checked")){
                mod.parents('.modules .level_p_'+project_wise+' .collection').each(function(key,val){
                    // console.log(val);
                    $(val).find('input.masters:first').prop('checked',true);
                    $(val).find('input.check_all_action:first').prop('disabled',false);
                });
                flag = 1;
                // $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.masters').prop('checked',true);
                // $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.insert_actions').prop('checked',true);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('disabled',false);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',false);
            }else{
                // $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.masters').prop('checked',false);
                // $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.insert_actions').prop('checked',false);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('checked',false);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').prop('disabled',true);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',true);
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',false);
            }
            var totalckb = $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions').length;
            var totalselectedckb = $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.all_actions:checked').length;
            if(totalselectedckb == 0){
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',false)
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('disabled',true)
            }
            if(totalckb == totalselectedckb &&  flag == 1 ){
                $('.modules .level_p_'+project_wise+' '+'#main_div_'+project_wise+'_'+mod_id+' input.check_all_action').prop('checked',true);
            }
        });
        $.each($(".modules .check_all_action"), function(){
            var check_all_action = $(this);
            var project_wise = check_all_action.parents('.project_level').attr('data-project-id');

            var check_all_action_id = check_all_action.attr('data-id');
            if($(this).is(":checked")){
                $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.all_actions').prop('checked',true);
                $('.modules .level_p_'+project_wise+' '+'#cm_'+project_wise+'_'+check_all_action_id+' input.check_all_action').prop('checked',true);
                // $('#cm_'+check_all_action_id+' input.all_actions').prop('disabled',false);
                // $('#cm_'+check_all_action_id+' input.insert_actions').prop('disabled',true);
            }
        });

    }
                            // $(".all_actions").on('click',function(){
                            //     if($(this).is(":checked")){
                            //         // $(this).parent('input.check_all_action').prop('checked',true);
                            //         // $(this).parent('input.check_all_action').prop('disabled',false);
                            //     }else{
                            //         $(this).closest('input.check_all_action').prop('checked',false);
                            //         $(this).closest('input.check_all_action').prop('disabled',true);
                            //     }
                            // });
    // $(".submodule").on("click",function(){
    //     var div = $(this).attr('data-div');
    //     if($(this).is(":checked")){
    //         $("#"+div + " .all_actions").prop('disabled',false);
    //         $("#"+div + " .insert_actions").prop('disabled',true);
    //         $("#"+div + " .insert_actions").prop('checked',true);
    //         $(this).parents('.submodule-container').find('.check_sub_action').prop('disabled',false);
    //     }else{
    //         $("#"+div + " .all_actions").prop('disabled',true);
    //         $("#"+div + " input:checkbox").prop('checked',false);
    //         $("#"+div + " .module_actions").prop('checked',false);
    //         $(this).parents('.submodule-container').find('.check_sub_action').prop('disabled',true);
    //         $(this).parents('.submodule-container').find('.check_sub_action').prop('checked',false);
    //     }
    //     checkchange();
    // });
    // $(".check_sub_action").on("click",function(){
    //     var div = $(this).attr('data-div');
    //     if($(this).is(":checked")){
    //         $("#"+div + " .all_actions").prop('checked',true);
    //     }else{
    //         $("#"+div + " .all_actions").prop('checked',false);
    //         $("#"+div + " .insert_actions").prop('checked',true);
    //     }
    //     checkchange();
    // });
    // $(".all_actions").on("click",function(){
    //     checkchange();
    // });
    // function checkchange(){
    //     formSubmitting = true;
    //     $.each($(".submodule"), function(){  
    //         var div = $(this).attr('data-div');
    //         var cnt = $("#"+div+" input:checkbox:checked").length;
    //         var inputcnt = $("#"+div+" input:checkbox").length;
    //         if(cnt == 0){
    //             $(this).prop('checked',false);
    //         }else{
    //             $(this).prop('checked',true);   
    //             if(cnt == inputcnt){
    //                 $(this).parents('.submodule-container').find('.all_actions').prop('checked',true);
    //             }else{
    //                 $(this).parents('.submodule-container').find('.all_actions').prop('checked',false);
    //             }
    //         }
    //     });
    //     $.each($(".masters"), function(){  
    //         var div = $(this).val();
    //         var inputcnt = $("#"+div+" input:checkbox").length;
    //         var cnt = $("#"+div+" input:checkbox:checked").length;
    //         if(cnt == 0){
    //             $(this).prop('checked',false);
    //             $(this).parents('.master-container').find('.check_all_action').prop('checked',false);
    //             $(this).parents('.master-container').find('.check_all_action').prop('disabled',true);
    //         }else{
    //             $(this).parents('.master-container').find('.check_all_action').prop('disabled',false);
    //             $(this).prop('checked',true); 
    //             if(cnt == inputcnt){
    //                 $(this).parents('.master-container').find('.check_all_action').prop('checked',true);
    //             }else{
    //                 $(this).parents('.master-container').find('.check_all_action').prop('checked',false);
    //             }
    //         }
    //     });
    // }
    $(document).on("click",".deleteproject",function(){
        var div = $(this).attr("data-div");
        $("."+div).remove();
    })
    window.formSubmitting = false;
        window.onload = function() {
            <?php 
            if(@$RoleID != 0){
            ?>
            window.addEventListener("beforeunload", function (e) {

                if (formSubmitting) {
                    formSubmitting = false;
                }else{
                    return undefined;
                }

                var confirmationMessage = 'It looks like you have been editing something. '
                                        + 'If you leave before saving, your changes will be lost.';

                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            });
            <?php } ?>
        };
</script>