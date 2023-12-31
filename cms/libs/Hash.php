<?php

class Hash {

    /**
     *
     * @param string $algo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
     */
    public static function create($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);

        return hash_final($context);
    }
    public static function createPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public static function verifyPassword($password, $hash) {
        if (password_verify($password, $hash)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function md5($pass){
        return md5(sha1("%aN3") . $pass . sha1("3Gj@"));
    }

}