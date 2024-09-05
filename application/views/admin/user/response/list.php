<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo site_url($Url); ?>">Reminder</a></h5>
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
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/user/response/visitor/<?php echo $ParentID . "/".$ReminderID;?>"><?php echo label('msg_lbl_response');?></a></h5>
                    </div>
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
                                <th class="width_200"><?php echo label('msg_lbl_employeename');?></th>
                                <th class="width_200"><?php echo label('msg_lbl_response');?></th>
                                <th class="width_200"><?php echo label('msg_lbl_responsedate');?></th>
                            </tr>
                        </thead>

                        <tbody id="table_body">

                        </tbody> 
                    </table>
                    <div id="table_paging_div"></div>
                </div>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT-->