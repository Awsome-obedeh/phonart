<?php
require "config.php";
require "dbconnect.php";
require __DIR__ . '/vendor/autoload.php';
cors();

// get php post inputs
$edata = file_get_contents("php://input");
$data = json_decode($edata, true);
$number = $data['number'];
$remark = $data['remark'];


// jwt
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$config = jwtSecret();
$secret_key = $config['jwt_secret'];


// get headers
$headers = apache_request_headers();

// check if header is present 
if (isset($headers['Authorization'])) {
    // get Authorization value
    $authorizationHeader = $headers['Authorization'];
    // print_r($authorizationHeader);

    // get token from header
    $headerValue = explode(' ', $authorizationHeader);
    // print_r($headerValue);
    $headertoken = $headerValue['1'];
    try {
        // sign jwt
        $decodedJwt = JWT::decode($headertoken, new Key($secret_key, 'HS256'));
        // print_r($decodedJwt);
        $caller_id = $decodedJwt->iss;
        $caller_number = $decodedJwt->number;

        $report_sql="INSERT INTO report(reporter,number,remark) VALUES('$caller_id', '$number', '$remark' )";
        $report_query=mysqli_query($conn,$report_sql);

        if($report_query){
            echo json_encode(array("status"=>200, "msg"=>"report created"));

        }

        else{
            echo json_encode(array("status"=>400, "msg"=>"issue creating report"));
        }
        
    }
    catch (Exception $e) {
        echo "Err:" . $e->getMessage();
    }
}