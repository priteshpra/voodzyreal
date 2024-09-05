<?php
if ($FilterType == "Daily") {
    $Str = "Today";
} else if ($FilterType == "Weekly") {
    $Str = "Current Week";
} else if ($FilterType == "Monthly") {
    $Str = "Current Month";
} else if ($FilterType == "Yearly") {
    $Str = "Current Year";
} else {
    $Str = "";
}

?>
<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  green white-text">
            <p class="card-stats-title"><i class="mdi-social-group-add"></i> Number Of Visitors</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalVisitor; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  green darken-2">
            <div class="center"><a class="moreinfo" data-type="Visitor" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div>
        </div>
    </div>
</div>
<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content purple white-text">
            <p class="card-stats-title"><i class="mdi-action-alarm-add "></i>Visitors Follow Up</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalVisitorReminder; ?></h4>
            <p class="card-stats-compare"><span class="purple-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action purple darken-2">
            <div class="center"><a class="moreinfo" data-type="Followup" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content pink lighten-2 white-text">
            <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Total Customer</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalCustomer; ?></h4>
            <p class="card-stats-compare"><span class="deep-purple-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  pink darken-2">
            <div class="center"><a class="moreinfo" data-type="Booking" data-Filter="<?php echo $FilterType; ?>" href="javascript:void(0)">More Info</a></div>
        </div>
    </div>
</div>
<?php if ($this->session->userdata['RoleID'] == "-1") { ?>
    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-content   brown lighten-1 white-text">
                <p class="card-stats-title"><i class="mdi-notification-sync"></i>New Lead</p>
                <h4 class="card-stats-number"><?php echo $Dashboard->TotalNew; ?></h4>
                <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
                </p>
            </div>
            <div class="card-action  brown lighten-2 darken-2">
                <div class="center"><a class="moreinfo" data-type="New Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo site_url('admin/report/Opportunityassign/data/new/' . $FilterType); ?>">More Info</a></div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-content   brown lighten-1 white-text">
                <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Lead</p>
                <h4 class="card-stats-number"><?php echo $Dashboard->TotalLead; ?></h4>
                <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
                </p>
            </div>
            <div class="card-action  brown lighten-2 darken-2">
                <div class="center">
                    <div class="moreinfo" data-type="New Lead" data-Filter="<?php echo $FilterType; ?>">No Info</div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  indigo white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Assign Lead</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalAssign; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  indigo darken-1 darken-2">
            <div class="center"><a class="moreinfo" data-type="Assign Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/Assign/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  grey white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>In Progress Lead</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalInProgress; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  grey darken-1 darken-2">
            <div class="center"><a class="moreinfo" data-type="In Progress Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/InProgress/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content  indigo lighten-3 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Over Due Lead</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalOverDue; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action  indigo lighten-1">
            <div class="center"><a class="moreinfo" data-type="Over Due Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/OverDue/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content   teal lighten-2 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Lost Lead</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->TotalLost; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action   teal lighten-1">
            <div class="center"><a class="moreinfo" data-type="Total Lost Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/Opportunityassign/data/Lost/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<div class="col s12 m6 l4">
    <div class="card">
        <div class="card-content light-blue accent-1 white-text">
            <p class="card-stats-title"><i class="mdi-notification-sync"></i>Total Lost Visitor</p>
            <h4 class="card-stats-number"><?php echo $Dashboard->LostVisitor; ?></h4>
            <p class="card-stats-compare"><span class="green-text text-lighten-5"><?php echo $Str; ?></span>
            </p>
        </div>
        <div class="card-action light-blue accent-2">
            <div class="center"><a class="moreinfo" data-type="Total Lost Lead" data-Filter="<?php echo $FilterType; ?>" href="<?php echo base_url('admin/report/visitorlost/data/' . $FilterType); ?>">More Info</a></div>
        </div>
    </div>
</div>

<br><br>
<?php if (!isset($OverDue['0']->Message)) { ?>
    <section id="content complaint-page">
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class="headcls">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title"><a href="javascript:void(0);">Over Due</a></h5>
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
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="width_130"><?php echo label('msg_lbl_employeename') ?></th>
                                        <th class="width_130"><?php echo label('msg_lbl_count') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($OverDue as $key => $value) { ?>
                                        <tr>
                                            <td><a href="<?php echo base_url('admin/report/Opportunityassign/data/OverDue/' . $FilterType . '/' . $value->ID); ?>" class="txt-underline bold"><?php echo $value->Name ?></a></td>
                                            <td><?php echo $value->OpportunityID ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end container-->

    </section>
<?php } ?>