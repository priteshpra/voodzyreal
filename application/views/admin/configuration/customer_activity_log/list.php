<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey hide-on-large-only">
            <i class="mdi-action-search active"></i>
            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/Activitylog"> Admin Activity Log</a></h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->


    <!--start container-->
    <div class="container">
        <div class="section">
            <div class="complaint-page-right">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                                <div class="input-field col s2">
                                    <select id="select-dropdown">
                                        <option value="10"  selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col s8 center m-t-20">
                                    <span><label>Data Display :</label></span> &nbsp;&nbsp;
                                    <input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
                                    <label for="All">All</label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
                                    <label for="Filter">Filter</label>  &nbsp;&nbsp;

                                </div>  
                                <div class="col s2 right-align">
                                    <a class="btn-floating waves-effect waves-light grey right">
                                        <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down"></i></a>
                                    <div class="right">
                                        <a href="<?php echo site_url(); ?>admin/configuration/activitylog/export_to_excel" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="search_action card-panel" style="display:none;">                                
                                <h4 class="header"><strong> Search Value </strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s6">
                                        <input type="text" name="ActivitylogName" id="ActivitylogName" value="" class="form-control">
                                        <label name="ActivitylogName" class="">Activitylog</label>
                                    </div>   

                                    <div class="input-field col s6">
                                        <input type="text" name="ActivityDate" id="ActivityDate" value="" class="datepicker">
                                        <label name="ActivityDate" class="">Activity Date</label>
                                    </div>                                  
                                    <!--  <div class="input-field search_label_radio col s6">
                                       <div name="status" class="form-control search_div m-t-10 left">Status</div>
                                       <input name="Status_search" type="radio" id="All_Status_search" value="-1" checked="checked">
                                       <label for="All_Status_search">All</label>
                                       <input name="Status_search" type="radio" id="Active" value="1">
                                       <label for="Active">Active</label> 
                                       <input name="Status_search" type="radio" id="InActive" value="0">
                                       <label for="InActive">InActive</label>
                                     </div> -->
                                </div>

                                <button class="btn waves-effect waves-light right" type="button" id="button_customer_activitylog_submit" name="button_customer_activitylog_submit">Submit
                                </button>
                                &nbsp;&nbsp;&nbsp;

                                <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();">Clear</a> 

                            </div>
                        </div>
                    </div>
                    <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Activitylog Name</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody id="customer_activitylog_table_body">

                        </tbody> 
                    </table>
                    <div id="table_paging_div"></div>
                    <!-- <ul class="pagination right">
                     <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                     <li class="active"><a href="#!">1</a></li>
                     <li class="waves-effect"><a href="#!">2</a></li>
                     <li class="waves-effect"><a href="#!">3</a></li>
                     <li class="waves-effect"><a href="#!">4</a></li>
                     <li class="waves-effect"><a href="#!">5</a></li>
                     <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                   </ul> -->
                </div>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT