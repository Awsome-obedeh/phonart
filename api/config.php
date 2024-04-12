<?php
    function cors(){
        
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: Content-Type");
    }

    function jwtSecret(){
        return [
            'jwt_secret'=> 'Awsome'
        ];
    }

?>