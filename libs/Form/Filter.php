<?php

class Filter {
    public function __construct() {}

    public function filter_int($str) {
        return Func::filter_int($str);
    }
    public function filter_string($str) {
        return Func::filter_string($str);
    }
    public function filter_text($str) {
        return Func::filter_text($str);
    }
    public function filter_html($str) {
        return Func::filter_html($str);
    }
    public function filter_email($str) {
        return Func::filter_email($str);
    }
    public function filter_ip($str) {
        return Func::filter_ip($str);
    }
    public static function filter_array($array=[]) {
        if(is_array($array)){
            return Func::filter_array(array_filter(array_unique($array)));
        } else {
            return [];
        }
    }

    public function __call($name, $arguments) {
        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }

}