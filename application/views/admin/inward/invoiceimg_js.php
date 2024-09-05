<script>
    window.itemclone = 1;
    $(document).ready(function () {
        setTimeout(function(){ $('#ChallanNo').focus(); }, 1100);
        <?php if (isset($this->session->userdata['posterror'])) {
         echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
        ?>     
        <?php if (isset($this->session->userdata['postsuccess'])) {
         echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
        ?>     
    })
    
    window.submitflag = 1;    
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
         else
        {   
            if(submitflag == 0){
              return false;
            }
            submitflag == 0;
            $.ajax({
                success:function(data)
                {
                    $('#button_submit').addClass('hide');
                    $('#button_submit_loading').removeClass('hide');
                    alertify.success("<?php echo label('please_wait');?>");
                    $('form').submit();
                }
            });
        }
        return false;
    });
    
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });

    $(document).on("click","#itemcloneclick",function(){
        itemclone++
        $.ajax({
            type: "post",
            datatype:"html",
            url: base_url + "admin/inward/ajax_itemclone/"+itemclone,
            data: {
            },success: function (data){
                $("#item_main").append(data);
            },error: function (data){
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }); 

    $(document).on("click",".remove_item",function(){
        $(this).parents(".item_panel_box").remove();
    });

    function ChangeVendor(){
        if($("#VendorDiv").length != 0){
            var CategoryID = $('#CategoryID').val();
            if(CategoryID == "")
                    CategoryID = 0;
            $.ajax({
                type: "POST",
                url: base_url + "admin/inward/vendorCombobox",
                data: {
                    CategoryID:CategoryID
                },
                success: function (result){
                    $('#VendorDiv').html(result);
                    $('#VendorDiv').show();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }

    function ChangeGoods(){
        if($("#GoodsDiv").length != 0){
            var CategoryID = $('#CategoryID').val();
            if(CategoryID == "")
                    CategoryID = 0;
            $.ajax({
                type: "POST",
                url: base_url + "admin/inward/goodsCombobox",
                data: {
                    CategoryID:CategoryID
                },
                success: function (result){
                    $('#GoodsDiv').html(result);
                    $('#GoodsDiv').show();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }

    function LoadPropertyBasedProject(){
    }
   
</script>