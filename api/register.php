<?php
require "config.php";
require "dbconnect.php";
cors();


$edata=file_get_contents("php://input");
$data=json_decode($edata,true);
$name=$data['name'];
$number=$data['number'];
$password=$data['password'];

if($name!='' && $number !='' && $password !=''){

    $insert_sql="INSERT INTO numbers(phone,name,password)
    VALUES('$number','$name','$password')";
    $insert_query=mysqli_query($conn,$insert_sql);
    
    if($insert_query){
        echo json_encode(array("status"=>200, "msg"=>"User registered successfully"));
    
    }
    else{
        echo json_encode(array("status"=>500, "msg"=>"server error"));
        // echo mysqli_error($conn);
    }
}

else{
    echo json_encode(array("status"=>400, "msg"=>"Missin user inputs"));
}






?>