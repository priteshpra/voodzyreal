<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#MileStone').focus();
        }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
        <?php if (isset($this->session->userdata['postsuccess'])) {
            echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);";
        }
        ?>
    })


    $('#button_submit').on('click', function() {
        var error = checkValidations();
        if (error === 'yes') {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else {
            $.ajax({
                type: "post",
                url: base_url + "admin/sales/nearspaces/CheckDuplicateDouble/",
                data: {
                    table_name: 'ss_propertynearybyplaces',
                    field_name: 'SaleInventoryID',
                    data_value: $('#ProjectID').val(),
                    field_name1: 'Title',
                    data_value1: $('#Title').val(),
                    ufield: 'PropertyNearybyPlacesID',
                    ID: $('#PropertyNearybyPlacesID').val(),
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    if (obj.result == "Success") {
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait'); ?>");
                        $('form').submit();
                    } else {
                        alertify.error('<?php echo label('instalmentno_already_exist'); ?>');
                        return false;
                    }
                },
                error: function(data) {
                    alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
                }
            })

        }
        return false;
    });
    $(document).keypress(function(e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>