<?php
if(!empty($data_array)) { 
    foreach ($data_array as $data) { ?>
    <tr id="row_<?php echo $data->CustomerPropertyID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/user/property/details/'.$data->CustomerPropertyID);?>"><?php echo $data->PropertyNo; ?></a></td>
        <td><?php echo $data->SerialNo; ?></td>
        <td><?php echo $data->CustomerFirstName . " ".$data->CustomerLastName; ?></td>
        <td><?php echo $data->CustomerSFirstName . " ".$data->CustomerSLastName; ?></td>
        <td><?php echo $data->PurchaseDate . "".($data->PurchaseDate !="")?$data->PurchaseDate:''; ?></td>


        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->Amount):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->GSTAmount):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RemainingPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RemainingGSTPayment):"-"; ?></td>
        <td>
            <?php echo SalaryComma($data->TotalNoOfPayment); ?>
        </td>
    </tr>
<?php }
  }

?>  