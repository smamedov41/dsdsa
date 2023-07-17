<?php

class Auth {

    public static function handleLogin() {
        @session_start();
        $logged = isset($_SESSION['webLogIn']) ? $_SESSION['webLogIn'] : NULL;
        if ($logged == false) {
            @session_destroy();
            header('Location: ' . URL);
            exit;
        }
    }
}