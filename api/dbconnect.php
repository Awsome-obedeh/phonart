<?php
//    define('HOST','localhost');
//    define('DB_USER','root');
//    define('PASSWORD','');
//    define('DB_NAME','phonenart');

// //    craete database connection
// $conn=new mysqli(HOST,DB_USER,PASSWORD,DB_NAME);
//     if($conn->connect_error){
//         die('Could not Connect ' . mysqli_connect_errno());
//     }
    
?>

<?php
   define('HOST','localhost');
   define('DB_USER','u419285934_phone');
   define('PASSWORD','Myhosting@1010');
   define('DB_NAME','u419285934_phonenart');

//    craete database connection
$conn=new mysqli(HOST,DB_USER,PASSWORD,DB_NAME);
    if($conn->connect_error){
        die('Could not Connect ' . mysqli_connect_errno());
    }
    
?>