<?php
    function cors(){
        
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: Authorization, Content-Type");
    }

    function jwtSecret(){
        return [
            'jwt_secret'=> 'Awsome'
        ];
    }

?>