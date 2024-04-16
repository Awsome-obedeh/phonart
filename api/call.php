<?php
require "config.php";
require "dbconnect.php";
require __DIR__ . '/vendor/autoload.php';
cors();

// get php post inputs
$edata = file_get_contents("php://input");
$data = json_decode($edata, true);
$number = $data['number'];

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
     

        $check_number_sql = "SELECT * FROM  allowednumbers WHERE phone_number=$number";
        $check_number_query = mysqli_query($conn, $check_number_sql);

        if (mysqli_num_rows($check_number_query) > 0) {

            // check if calling number is flagged as scam in the database
            $check_scam_sql="SELECT * FROM numbers WHERE phone='$caller_number'";
            $check_scam_query=mysqli_query($conn,$check_scam_sql);
            $calling_user=mysqli_fetch_assoc($check_scam_query);
           $scam_true=$calling_user['scam'];
           if($scam_true){

               echo json_encode(array("status" => 200, "scam" => true ));
           }
           else{
               echo json_encode(array("status" => 200, "scam" => false));

           }
        } else {
            $allowed_numbers = [
                'num1' =>  '08094422802',
                "num2" => '08062119957',
                "mum3" => "0902342952"
            ];
            echo json_encode(array("staus" => 400, "msg" => "Invalid number ", "allowed numbers" => $allowed_numbers));
        }
    } catch (Exception $e) {
        echo "Err:" . $e->getMessage();
    }
}
else{
    echo json_encode(array("status"=>200, "msg"=>"No authorization"));
}
