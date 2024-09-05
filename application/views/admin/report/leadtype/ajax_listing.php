<?php foreach ($visitor as $visitor) { ?>
    <tr class="gradeX" id="row_<?php echo $visitor->VisitorID; ?>">
        <td>
            <?php
                if ($visitor->OpportunityID!=0) {
                    echo "Opportunity (".$visitor->OpportunityType.')';
                }
                elseif ($visitor->IsCustomer == 1) {
                    echo "Customer";
                }
                else{
                    echo "Visitor";
                } 
            ?>    
        </td>
        <td><a class="txt-underline bold" href="<?php echo site_url("admin/user/visitor/details/".$visitor->VisitorID); ?>"><?php echo $visitor->FirstName ." " . $visitor->LastName; ?></a></td>
		<td><?php echo $visitor->EmployeeFirstName . " " . $visitor->EmployeeLastName; ?></td>
        <td><a href="mailto:<?php echo $visitor->EmailID; ?>"><?php echo $visitor->EmailID; ?></a> </td>
        <td><?php echo $visitor->MobileNo; ?></td>
        <td><?php echo $visitor->LeadType; ?></td>
        <td><?php echo $visitor->InquiryDate; ?></td>
        <td><?php echo $visitor->Designation; ?></td>
        <td><?php echo $visitor->SitesCount; ?></td>
        <td><?php echo $visitor->Requirenment; ?></td>                                                                                                                                                   
    </tr>
<?php } ?>   