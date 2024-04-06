<?php
    require "config.php";
    require "dbconnect.php";
    cors();


    $password=$number='';
    $edata=file_get_contents("php://input");
    $data=json_decode($edata,true);
    try{

    

            $password=$data['password'];
            $number=$data['number'];
    
            $login_sql="SELECT * FROM numbers WHERE phone='$number' && password='$password'";
            $login_query=mysqli_query($conn,$login_sql);
    
            if($login_query && mysqli_num_rows($login_query)>0){
                $users=mysqli_fetch_assoc($login_query);
                $token=$users['id'];
                echo json_encode(array("status"=>"200","msg"=>"user logged in successfully", "token"=>$token));
            }
    
    
            else{
                echo json_encode((array("status"=>400, "msg"=>"Invalid Credentials")));
                // echo mysqli_error($conn);
            };
     

    }

    catch(Exception $err){
        echo json_encode(array("status"=>500, "msg"=>"Server Error"));
        // echo $err;
    }
   
