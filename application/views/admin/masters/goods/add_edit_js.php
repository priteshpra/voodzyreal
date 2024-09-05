<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#GoodsName').focus(); }, 1100);
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
        var combo_box_error = checkComboBox(['CategoryID']);
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else
        {   
            var id = $('#GoodsID').val();
            var GoodsName = $('#GoodsName').val();
            var CategoryID = $('#CategoryID').val();

            if(submitflag == 0){
              return false;
            }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/goods/CheckDuplicateDouble",
                data:{
                    table_name:'ss_goods',
                    field_name:'GoodsName',
                    data_value:GoodsName,
                    field_name1:'CategoryID',
                    data_value1:CategoryID,
                    ufield:'GoodsID',
                    ID:id,
                },
                success:function(data)
                {
                    submitflag = 1;
                    var obj = JSON.parse(data);

                    if(obj.result == 'Success'){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                        
                    }else{
                        alertify.error("<?php echo label('msg_lbl_goods_exist');?>");
                        return false;
                    }           
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

    function ChangeVendor(){
    }
    function ChangeGoods(){
    }
</script>