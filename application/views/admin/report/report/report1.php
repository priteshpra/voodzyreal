<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/report/report/report1"><strong><?php echo label('msg_lbl_title_export_property')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/report/report/export_to_excel_report1">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <?php echo @$Project;?>
                        </div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s12 m6 right">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/report/report/report1" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>