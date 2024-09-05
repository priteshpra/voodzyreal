<?php //pr($details);exit;
?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/sales/propertys"); ?>">Sales Inventory</a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right candidate-details-box" id="company-details-box">
        <div class="card-panel">
          <div class="col s12 m12 l12">
            <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/sales/propertys/details/" . $Project->SaleInventoryID); ?>"><?php echo $Project->DisplayName; ?></a></h5>
          </div>
          <div class="row">
            <div class="row">
              <div class="col s12">
                <h5><?php echo @$details->OwenerFirstName . ' ' . @$details->OwenerLastName; ?></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box z-depth-1">
                    <li class="tab"><a class="tabclick active" href="#basicprofile" title="Basic Details">Basic Details</a></li>
                    <li class="tab"><a class="tabclick active" href="#projectdetail" title="Project Details">Project Details</a></li>
                    <?php
                    if (@$this->property_module->is_view == 1) {
                    ?>
                      <li class="tab"><a class="tabclick" href="#property" title="Property">Pro. Configure</a></li>
                    <?php
                    }
                    if (@$this->milestone_module->is_view == 1) {
                    ?>
                      <li class="tab"><a class="tabclick" href="#milestone" title="MileStone">Pro. Specification</a></li>
                    <?php
                    }
                    if (@$this->gallery_module->is_view == 1) {
                    ?>
                      <li class="tab"><a class="tabclick" href="#gallery" title="Gallery">Pro. Gallery</a></li>
                      <li class="tab"><a class="tabclick" href="#nearbyspaces" title="nearbyspaces">Pro. Near Byspaces</a></li>
                      <li class="tab"><a class="tabclick" href="#highlight" title="highlight">Pro. Key highLights</a></li>
                      <li class="tab"><a class="tabclick" href="#features" title="features">Pro. Features</a></li>
                    <?php
                    }

                    ?>
                  </ul>
                </div>
              </div>

              <!-- Edit Profile Start -->
              <div id="basicprofile" class="col s12">
                <div class="col s12">
                  <div class="card-panel clearfix">
                    <form class="col s12 m-t-30" method="post">
                      <br>
                      <div class="row">
                        <div class="input-field col s12 m6">
                          <input id="Title" name="Title" value="<?php echo @$Project->DisplayName; ?>" type="text" readonly />
                          <label for="Title"><?php echo label('msg_lbl_project_title'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                          <input id="Location" name="Location" value="<?php echo @$Project->StreetAddress; ?>" type="text" readonly />
                          <label for="Location"><?php echo label('msg_lbl_Location'); ?></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="GroupName" name="GroupName" value="<?php echo @$Project->CompanyName; ?>" type="text" readonly />
                          <label for="GroupName"><?php echo label('msg_lbl_groupname'); ?></label>
                        </div>
                        <div class="input-field col s12 ">
                          <textarea name="Description" id="Description" class=" materialize-textarea" readonly><?php echo @$Project->AboutProperty; ?></textarea>
                          <label for="Description"><?php echo label('msg_lbl_Description'); ?></label>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Edit Profile End -->
              <!-- projectdetail Start -->
              <div id="projectdetail" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">

                          <div class="input-field col m2 s12">
                            <select id="PageSize" class="PageSize select_materialize" data-div="Property">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <?php
                          // if (@$this->propertys_module->is_insert == 1) {
                          ?>
                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/sales/details/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>
                          <?php //} 
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Total Units</th>
                            <th>Builder Name</th>
                            <th>Total Floors</th>
                            <th class="center"><?php echo label('msg_lbl_status') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- projectdetail End -->
              <?php
              if (@$this->property_module->is_view == 1) {
              ?>
                <!-- Property Start -->
                <div id="property" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">

                            <div class="input-field col m2 s12">
                              <select id="PageSize" class="PageSize select_materialize" data-div="Property">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <?php
                            if (@$this->propertys_module->is_insert == 1) {
                            ?>
                              <div class="col s12 m10 right-align list-page-right-top-icon">
                                <a href="<?php echo site_url("admin/sales/property/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                                  <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                                </a>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th><?php echo label('msg_lbl_propertyno') ?></th>
                              <th><?php echo label('msg_lbl_saleablearea') ?></th>
                              <th><?php echo label('msg_lbl_tarrecesaleablearea') ?></th>
                              <th class="center"><?php echo label('msg_lbl_status') ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- Property End -->
              <?php
              }
              if (@$this->milestone_module->is_view == 1) {
              ?>
                <!-- MileStone Start -->
                <div id="milestone" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">

                            <div class="input-field col m2 s12">
                              <select id="PageSize">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>

                            <div class="col s12 m10 right-align list-page-right-top-icon">
                              <a href="<?php echo site_url("admin/sales/specification/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                                <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                              </a>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_150">Floor Number</th>
                              <th class="width_200">Facing</th>
                              <th class="width_180">Rent Agreement Duration</th>
                              <th class="width_100 center"><?php echo label('msg_lbl_status') ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- MileStone End -->
              <?php
              }
              if (@$this->gallery_module->is_view == 1) {
              ?>
                <!-- Gallery Start -->
                <div id="gallery" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">

                            <div class="input-field col m2 s12">
                              <select id="PageSize">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>

                            <div class="col s12 m10 right-align list-page-right-top-icon">
                              <a href="<?php echo site_url("admin/sales/gallery/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                                <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                              </a>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div id="table_body">
                        </div>
                      </div>
                      <div id="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- Gallery End -->
              <?php
              }
              ?>
              <!-- nearbyspaces Start -->
              <div id="nearbyspaces" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">

                          <div class="input-field col m2 s12">
                            <select id="PageSize">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>

                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/sales/nearspaces/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_150">Title</th>
                            <th class="width_100 center"><?php echo label('msg_lbl_status') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- nearbyspaces End -->

              <!-- highlight Start -->
              <div id="highlight" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">

                          <div class="input-field col m2 s12">
                            <select id="PageSize">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>

                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/sales/keyhighlights/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_150">Title</th>
                            <th class="width_100 center"><?php echo label('msg_lbl_status') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- highlight End -->

              <!-- features Start -->
              <div id="features" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">

                          <div class="input-field col m2 s12">
                            <select id="PageSize">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>

                          <div class="col s12 m10 right-align list-page-right-top-icon">
                            <a href="<?php echo site_url("admin/sales/propertyfeature/add/" . $SaleInventoryID); ?>" class="btn-floating right waves-effect waves-light green accent-6">
                              <i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i>
                            </a>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_150">Fetaure</th>
                            <th class="width_100 center"><?php echo label('msg_lbl_status') ?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                      </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- features End -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $view_modal_popup; ?>