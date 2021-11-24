<?php

class AuthHelper{

    function __construct()
    {  
    }

    function checkLoggedIn() {
        session_start();

        if(isset($_SESSION['email']) && $_SESSION['admin'] == 0){
            $admin = 0;
        }else if(isset($_SESSION['email']) && isset($_SESSION['admin'])){
            $admin = 1;
        }else{
            header("Location: ".BASE_URL."login");
        }
        return $admin;
    }

    function checkAdmin() {
        session_start();
        if(!isset($_SESSION['email']) && !isset($_SESSION['admin'])){
            header("Location: ".BASE_URL."login");
        }
        
    }
}