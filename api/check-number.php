<?php
    require "config.php";
    require "dbconnect.php";
    cors();

    $edata=file_get_contents('php://input');
    $data=json_decode($edata,true);

    $number=$data['number'];

    // check if number exists

    $check_number_sql="SELECT *  FROM numbers WHERE phone='$number'";
    $check_number_query=mysqli_query($conn,$check_number_sql);

    if(mysqli_num_rows($check_number_query) >0){
        echo json_encode(array('status'=>200, 'msg'=> "number already exists"));
      
    }
    else{
        echo json_encode(array('status'=>200, 'msg'=> "proceed to register"));


    }






?>