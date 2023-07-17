<?php

class Session {

    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        if (isset($_SESSION)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function delete($key) {
        $_SESSION[$key] = '';
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        //unset($_SESSION);
        session_destroy();
    }
}