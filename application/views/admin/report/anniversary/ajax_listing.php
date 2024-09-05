<?php 
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
    <tr id="row_<?php echo $data->VisitorID; ?>">
        <td><?php echo $data->FirstName.' '.$data->LastName; ?></td>
        <td><?php echo $data->EmailID; ?></td>
        <td><?php echo $data->MobileNo; ?></td>
    </tr>
<?php }
  }

?>  