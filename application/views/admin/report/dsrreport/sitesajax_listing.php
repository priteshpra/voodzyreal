<?php foreach ($visitorsites as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->VisitorSitesID; ?>">
        <td>
            <input name="SitesData" class="SitesData" type="radio" id="SitesID_<?php echo $data->VisitorSitesID; ?>" value="<?php echo $data->VisitorSitesID; ?>" data-id="<?php echo $data->ProjectID; ?>">
            <label for="SitesID_<?php echo $data->VisitorSitesID; ?>" style="color:#000;"></label> 
        </td>
        <td><?php echo $data->ProjectTitle; ?></td>
        <td><?php echo $data->EmployeeName; ?></td>
        <td><?php echo $data->Requirement; ?></td>
        <td><?php echo $data->Budget; ?></td>
        <td><?php echo $data->VisitSource; ?></td>
        <td><?php echo $data->Remarks; ?></td>
        <td><?php echo $data->ChannelPartner; ?></td>
    </tr>
<?php } ?>   