<?php 
	foreach ($data_araay as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->UserFeedbackID; ?>">
        <td>
            <?php  echo $data->FeedbackType; ?>
        </td>
        <td><?php echo $data->ProjectName; ?></td>
    	<td>
    		<?php 
    			if ($data->OpportunityID==0) {
    				echo $data->VisitorName; 
    			}
    			else{
    				echo $data->OpportunityName; 
    			}
    		?>
    	</td>
        <td>
            <?php 
                if ($data->OpportunityID==0) {
                    echo $data->MobileNo; 
                }
                else{
                    echo $data->mobile; 
                }
            ?>
        </td>
        <td>
            <?php 
                if ($data->OpportunityID==0) {
                    echo $data->EmailID; 
                }
                else{
                    echo $data->email; 
                }
            ?>
        </td>
    	<td><?php echo $data->Feedback; ?></td>
        <td><?php echo @$data->Remarks; ?></td>
        <td><?php echo $data->CallStartDateTime; ?></td>
        <td><?php echo $data->CallEndDateTime; ?></td>
    </tr>
<?php } ?>   