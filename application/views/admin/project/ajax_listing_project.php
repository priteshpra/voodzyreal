<?php
if(!empty($project_array)) { 
    foreach ($project_array as $project) { ?>
	<tr id="row_<?php echo $project->ProjectID; ?>">
		<td><a class="txt-underline bold" href="<?php echo site_url("admin/project/project/details/".$project->ProjectID); ?>"><?php echo $project->Title;?></a></td>
		<td><?php echo $project->Location; ?></td>
		<td><?php echo $project->Description; ?></td>
		<td><?php echo $project->GroupName; ?></td>
		<td><?php echo $project->ATSPercentage; ?></td>
		<td><?php echo $project->ProjectType; ?></td>
		<?php
		if ($project->Status == ACTIVE) {
			$inactive_icon_status = "hide";
			$active_icon_status = "";
		} else {
			$inactive_icon_status = "";
			$active_icon_status = "hide";
		}
		if(@$this->cur_module->is_status == 1){
			$status = CHANGE_STATUS;
		}
		?>
		<td class="status action center">
			<i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $project->ProjectID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $project->ProjectID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $project->ProjectID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
		</td>
		<td class="action center">
			<?php 
			if(@$this->cur_module->is_edit == 1){
			?>
			<a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/project/project/edit/<?php echo $project->ProjectID; ?>" style="cursor:pointer;"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
			&nbsp;&nbsp;
			<?php } ?>
			<a class="info bgglobal modal-trigger black btn-floating waves-effect" href="javascript:void(0);" data-id="<?php echo $project->ProjectID; ?>">
				<i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
			</a>
		</td>      
	</tr>
<?php }
  }

?>  