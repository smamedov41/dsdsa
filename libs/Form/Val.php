<?php

class Val {
    public function __construct() {
    }

    public function minlength($data, $arg) {
        if (mb_strlen($data, "UTF8") < $arg) {
            $str =  Lang::get('{Minimum [$arg] simvol olmalıdır}');
            return str_replace('[$arg]', $arg, $str);
        }
    }
    public function maxlength($data, $arg) {
        if (mb_strlen($data, "UTF8") > $arg) {
            $str =  Lang::get('{Maksimum [$arg] simvol olmalıdır}');
            return str_replace('[$arg]', $arg, $str);
        }
    }
    public function digit($data) {
        if (ctype_digit($data) == false) {
            return Lang::get('{Məlumat tam ədəd tipində olmalıdı}');
        }
    }
    public function letter($data) {
        if (!preg_match("/^[a-zəüöğçşıƏÜÖĞÇŞIİ]+$/i", $data)) {
            return Lang::get('{Məlumat yalnız hərflərdən ibarət olmalıdır}');
        }
    }
    public function phone($data) {
        if (!preg_match("/^\(\+994\s[0-9]{2}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/", $data)) {
            return Lang::get('{Nömrə standarta uyğun deyil}');
        }
    }
    public function password($data) {
        if (
            (preg_match_all('/[a-z]/', $data, $arr) >= 3) &&
            (preg_match_all('/[A-Z]/', $data, $arr) >= 3) &&
            (preg_match_all('/[0-9]/', $data, $arr) >= 3) &&
            (preg_match_all('/\W/', $data, $arr) >= 3)
        ) {

        } else {
            return Lang::get('{Şifrə təhlükəsizlik qaydalarına uyğun gəlmir}');
        }
    }
    public function float($data) {
        if (is_float($data) == false) {
            return Lang::get('{Məlumat onluq ədəd tipində olmalıdı}');
        }
    }
    public function email($data) {
        if (Func::filter_email($data) == false) {
            return Lang::get('{E-mail standarta uyğun gəlmir}');
        }
    }
    public function requires($data, $array=false) {
        if($array && is_array($data)){
            $data = array_filter($data);
        }
        if (!isset($data) or empty($data)) {
            return Lang::get('{Bu xana daxil edilməlidir}');
        }
    }
    public function requires_array($data) {
        if (!isset($data) or empty($data)) {
            return Lang::get('{Bu xana daxil edilməlidir}');
        }
    }

    public function __call($name, $arguments) {
        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }

}