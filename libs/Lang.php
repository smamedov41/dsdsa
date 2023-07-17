<?php

/**
 * Date: 6/12/2017
 * Time: 10:17 AM
 */
class Lang {
    public static function get($key, $custom_lang=false) {
        $from = ['{', '}'];
        $key = str_replace($from, '', $key);

        if($custom_lang){
            $lang = $custom_lang;
        } else {
            $lang = MF::$_lang;    
        }        

        if (file_exists('langs/'.$lang.'.php')) {
            require 'langs/'.$lang.'.php';
        } else {
            require 'langs/en.php';
        }

        if (array_key_exists($key, $keys)) {
            return htmlspecialchars_decode($keys[$key]);
        } else {
            return $key;
        }
    }
}