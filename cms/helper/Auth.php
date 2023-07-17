<?php

class Auth {

    public static function handleLogin() {
        if(!isset($_SESSION)){
            session_start();
        }

        $logged = isset($_SESSION['adminLoggedIn']) ? $_SESSION['adminLoggedIn'] : NULL;
        if ($logged == false) {
            session_destroy();
            header('Location: ' . URL.'login');
            exit;
        }
    }
}