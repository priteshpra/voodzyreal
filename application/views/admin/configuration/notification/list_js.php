<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/notification"><?php echo label('msg_lbl_notification');?></a></h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->


    <!--start container-->
    <div class="container">
        <div class="section">
            <div class="listing-page">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
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
                        </div>
                    </div>
                    <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo label('msg_lbl_city');?></th>
								<th><?php echo label('msg_lbl_state');?></th>
								<th class="actions center"><?php echo label('msg_lbl_status');?></th>
								<th class="actions center"><?php echo label('msg_lbl_action');?></th>
                            </tr>
                        </thead>

                        <tbody id="city_table_body">

                        </tbody> 
                    </table>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT-->