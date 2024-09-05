<script>
    window.current_page_size = 10;
    window.total_page = 1;
    $(document).ready(function() {
        ajax_property(current_page_size, total_page);
        ajax_milestone(current_page_size, total_page);
        ajax_gallery(current_page_size, total_page);
        ajax_nearbyspaces(current_page_size, total_page);
        ajax_highlight(current_page_size, total_page);
        ajax_features(current_page_size, total_page);
        ajax_details(current_page_size, total_page);
    })
    $('#button_submit').on('click', function() {
        var error = checkValidations();
        var field_ids = ['GroupID'];
        var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error == 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            alertify.success("<?php echo label('please_wait'); ?>");
            $.ajax({
                type: "post",
                url: base_url + "admin/sales/property/editproject/" + '<?php echo $SaleInventoryID; ?>',
                data: $("form").serialize(),
                success: function(data) {
                    if (data == 1) {
                        alertify.success('<?php echo label('data_updated_successfully'); ?>');
                    } else {
                        alertify.error('<?php echo label('please_try_again'); ?>');
                    }
                },
                error: function(data) {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                }
            })
        }
    });
    $('#button_submit_rule').on('click', function() {
        var page_content = tinyMCE.get('Rule').getContent();
        if (page_content == '' || page_content == null) {
            alertify.error("<?php echo label('msg_lbl_please_enter_content_description'); ?>");
            return false;
        }
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/property/editrules/" + '<?php echo $SaleInventoryID; ?>',
            data: {
                Rule: tinyMCE.get('Rule').getContent(),
            },
            success: function(data) {
                if (data == 1) {
                    alertify.success('<?php echo label('data_updated_successfully'); ?>');
                } else {
                    alertify.error('<?php echo label('please_try_again'); ?>');
                }
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    });

    function ajax_milestone(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/specification/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#milestone #table_body').html(obj.a);
                $('#milestone #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_property(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/propertys/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#property #table_body').html(obj.a);
                $('#property #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_gallery(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/gallery/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#gallery #table_body').html(obj.a);
                $('#gallery #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_nearbyspaces(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/nearspaces/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#nearbyspaces #table_body').html(obj.a);
                $('#nearbyspaces #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_highlight(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/Keyhighlights/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#highlight #table_body').html(obj.a);
                $('#highlight #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_features(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/propertyfeature/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#features #table_body').html(obj.a);
                $('#features #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function ajax_details(current_page_size, total_page) {
        DesignationID = '';
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/details/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ProjectID: '<?php echo $SaleInventoryID; ?>',
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#projectdetail #table_body').html(obj.a);
                $('#projectdetail #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    $('.tabs .tabclick').on('click', function() {
        var myid = $(this).attr("href");
        if (myid == "#gallery") {
            current_page_size = $("#gallery #PageSize").val();
            total_page = 1;
            ajax_gallery(current_page_size, total_page);
        } else if (myid == "#milestone") {
            current_page_size = $("#milestone #PageSize").val();
            total_page = 1;
            ajax_milestone(current_page_size, total_page);
        } else if (myid == "#property") {
            current_page_size = $('#property #PageSize').val();
            total_page = 1;
            ajax_property(current_page_size, total_page);
        } else if (myid == "#features") {
            current_page_size = $('#features #PageSize').val();
            total_page = 1;
            ajax_features(current_page_size, total_page);
        } else if (myid == "#highlight") {
            current_page_size = $('#highlight #PageSize').val();
            total_page = 1;
            ajax_highlight(current_page_size, total_page);
        } else if (myid == "#nearbyspaces") {
            current_page_size = $('#nearbyspaces #PageSize').val();
            total_page = 1;
            ajax_nearbyspaces(current_page_size, total_page);
        } else if (myid == "#projectdetail") {
            current_page_size = $('#projectdetail #PageSize').val();
            total_page = 1;
            ajax_details(current_page_size, total_page);
        }
    });
    $(document).on("click", ".cross1", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/gallery/delete/" + id,
            data: {},
            success: function(data) {
                if (data == 1) {
                    current_page_size = $("#gallery #PageSize").val();
                    total_page = 1;
                    ajax_gallery(current_page_size, total_page);
                }

            },
            error: function(data) {

                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    })
    $('#milestone').on('click', '.pagination_buttons', function() {
        var total_page = $('#milestone #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_milestone(total_page, page);
    });
    $('#gallery').on('click', '.pagination_buttons', function() {
        var total_page = $('#gallery #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_gallery(total_page, page);
    });
    $('#property').on('click', '.pagination_buttons', function() {
        var total_page = $('#property #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_property(total_page, page);
    });
    $('#nearbyspaces').on('click', '.pagination_buttons', function() {
        var total_page = $('#nearbyspaces #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_nearbyspaces(total_page, page);
    });
    $('#highlight').on('click', '.pagination_buttons', function() {
        var total_page = $('#highlight #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_highlight(total_page, page);
    });
    $('#features').on('click', '.pagination_buttons', function() {
        var total_page = $('#features #PageSize').val();
        var page = $(this).attr('data-page-number');
        ajax_features(total_page, page);
    });

    $('#property').on('change', '.PageSize', function() {
        var total_page = $(this).val();
        var div = $(this).attr('data-div');
        if (div == "Property") {
            ajax_property(total_page, 1);
        }
    })


    $("#property #table_body ").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#property #row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#property #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#property #row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/property/changeStatus",
            data: {
                id: id,
                status: status,
                table_name: "sssm_property",
                field_name: "PropertyID"
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#property #row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#property #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#property #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#property #row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#property #row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#property #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);
            }
        })
    })
    $("#milestone #table_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        $('#milestone #row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#milestone #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#milestone #row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/specification/changeStatus",
            data: {
                id: id,
                status: status,
                table_name: "ss_propertyspecification",
                field_name: "PropertyspecificationID"
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#milestone #row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#milestone #row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#milestone #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#milestone #row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#milestone #row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#milestone #row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);
            }
        })
    })
    $("#property #table_body").on('click', '.info', function() {
        $("#model_title").html("Property");
        var id = $(this).attr('data-id');
        var table_name = "sssm_property";
        var field_name = "PropertyID";
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/property/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
    $("#milestone #table_body").on('click', '.info', function() {
        $("#model_title").html("MileStone");
        var id = $(this).attr('data-id');
        var table_name = "ss_propertyspecification";
        var field_name = "PropertyspecificationID";
        $.ajax({
            type: "post",
            url: base_url + "admin/sales/specification/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
</script>
<!-- Ck Editor JS -->
<script type="text/javascript" src="<?php echo $this->config->item('base_url') . 'tiny_mce/tiny_mce.js'; ?>"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode: "exact",
        elements: "Rule",
        theme: "advanced",
        plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
        visualblocks_default_state: true,
        end_container_on_empty_block: true,
        // Theme options
        theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
        // Example content CSS (should be your site CSS)
        //content_css: "css/content.css",
        // Drop lists for link/image/media/template dialogs
        template_external_list_url: "lists/template_list.js",
        external_link_list_url: "lists/link_list.js",
        external_image_list_url: "lists/image_list.js",
        media_external_list_url: "lists/media_list.js",
        // Style formats
        style_formats: [{
                title: 'Bold text',
                inline: 'b'
            },
            {
                title: 'Red text',
                inline: 'span',
                styles: {
                    color: '#ff0000'
                }
            },
            {
                title: 'Red header',
                block: 'h1',
                styles: {
                    color: '#ff0000'
                }
            },
            {
                title: 'Example 1',
                inline: 'span',
                classes: 'example1'
            },
            {
                title: 'Example 2',
                inline: 'span',
                classes: 'example2'
            },
            {
                title: 'Table styles'
            },
            {
                title: 'Table row 1',
                selector: 'tr',
                classes: 'tablerow1'
            }
        ],
        // Replace values for the template plugin
        template_replace_values: {
            username: "Some User",
            staffid: "991234"
        }
    });
</script>

<!-- /TinyMCE -->