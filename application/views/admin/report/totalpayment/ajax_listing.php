<?php
    foreach ($data_array as $data) { ?>
    <tr id="row_<?php echo $data->CustomerPropertyID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/user/property/details/'.$data->CustomerPropertyID);?>"><?php echo $data->PropertyNo; ?></a></td>
        <td><?php echo $data->CustomerFirstName . " ".$data->CustomerLastName; ?></td>
        <td><?php echo SalaryComma($data->Amount); ?></td>
        <td><?php echo SalaryComma($data->TotalPayByCustomer); ?></td>
        <td><?php echo SalaryComma($data->RemainingAmountPayment); ?></td>
        <td><?php echo SalaryComma($data->GSTAmount); ?></td>
        <td><?php echo SalaryComma($data->TotalGstpsyByCustomer); ?></td>
        <td><?php echo SalaryComma($data->RemainingGSTPayment); ?></td>
    </tr>
<?php }
?>  	