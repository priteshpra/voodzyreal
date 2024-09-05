<?php
if(!empty($project_array)) { 
    foreach ($project_array as $project) { ?>
	<tr id="row_<?php echo $project->MisscallID; ?>">
		<td><?php echo $project->MsgId;?></td>
		<td><?php echo $project->LongCode; ?></td>
		<td><?php echo $project->RcvFrom; ?></td>
		<td><?php echo $project->RcvTime; ?></td>
		<td><?php echo $project->MsgText; ?></td>
	</tr>
<?php }
  }

?>  