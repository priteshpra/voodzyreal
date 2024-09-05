<?php
    foreach ($data_array as $data) { ?>
    <tr id="row_<?php echo $data->CustomerPropertyID; ?>">
        <td>
            <?php echo $data->Title;?>
        </td>
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/user/property/details/'.$data->CustomerPropertyID);?>"><?php echo $data->PropertyNo; ?></a></td>
        <td><?php echo $data->SerialNo; ?></td>
        <td><?php echo $data->CustomerFirstName . " ".$data->CustomerLastName; ?></td>
        <td><?php echo $data->CustomerSFirstName . " ".$data->CustomerSLastName; ?></td>
        <td><?php echo $data->PurchaseDate . "".($data->PurchaseDate !="")?GetDateInFormat($data->PurchaseDate,'m-d-Y'):''; ?></td>


        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->Amount):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->GSTAmount):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RemainingPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RemainingGSTPayment):"-"; ?></td>
        <td>
            <?php echo SalaryComma($data->TotalNoOfPayment); ?>
        </td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->TotalPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->TotalGSTPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RefundPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->RefundGSTPayment):"-"; ?></td>
        <td><?php echo ($data->is_price == 1 )?SalaryComma($data->CancelFeeAmount):"-"; ?></td>
    </tr>
<?php }
?>  