<?php
date_default_timezone_set("Asia/Kolkata");

$request_method = $_SERVER['REQUEST_METHOD'];
//$request_method == 'POST';
if (1) {

    $headers = getallheaders();
    $payload = file_get_contents("php://input");

    $file = "api.txt";
    $f = fopen($file, 'aw');

    $host = 'localhost';
    $user = 'root';
    $pass = 'Aug@2020$$';
    $conn = mysqli_connect($host, $user, $pass, 'virtudk6_parekh');
    $payload = json_decode($payload, TRUE);

    $add_opportunity = ("call usp_A_AddOpportunityAPIFB('Facebook','1','1','Admin Web','1.1.1.1','" .
        $payload['lead_fields']['city'] . "','" .
        $payload['created_at'] . "','" .
        $payload['lead_fields']['email'] . "','','','" .
        $payload['account_id'] . "','" .
        $payload['lead_fields']['phone_number'] . "','','" .
        $payload['lead_fields']['full_name'] . "','','" .
        $payload['lead_fields']['form_name'] . "','','','','','')");

    fwrite($f, "Date : " . date('Y-m-d H:i:s') . PHP_EOL);

    if (isset($headers['api-key'])) {
        fwrite($f, "api-key :: " . $headers['api-key'] . PHP_EOL);
        if (mysqli_query($conn, $add_opportunity)) {
            echo "Record inserted successfully";
        } else {
            echo "Could not insert record: " . mysqli_error($conn);
        }
    } else {
        fwrite($f, "api-key not found in headers" . PHP_EOL);
    }

    //fwrite($f, json_decode($payload, TRUE) . PHP_EOL);
    fwrite($f, json_encode($payload, JSON_PRETTY_PRINT) . PHP_EOL);
    fwrite($f, "-----------------------------------------------" . PHP_EOL . PHP_EOL);

    fclose($f);
} else {
    $file = "api.txt";
    
    $f = fopen($file, 'aw');
    $payload = file_get_contents("php://input");
    $payload = json_decode($payload, TRUE);
    fwrite($f, $payload);
    fclose($f);
}
