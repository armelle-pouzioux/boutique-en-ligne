<?php

class Session
{
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function checkUserLogin() {
        if (!isset($_SESSION["id"])) {
            // redirection absolue vers la page de login
            header("Location: /boutique-en-ligne/views/user/login.php");
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