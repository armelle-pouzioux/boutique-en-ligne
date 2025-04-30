<?php

class Session
{
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function checkUserLogin() 
    {
        if (!isset($_SESSION["id"])) {
            header("Location: ../views/user/login.php");
            exit();
        }
    }

    public function logOut()
    {
        session_unset(); 
        session_destroy(); 
        header("Location: /boutique-en-ligne/index.php");
        exit();
    }
}