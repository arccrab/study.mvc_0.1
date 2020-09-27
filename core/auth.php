<?php

class Auth {
    public static function create_hash($password) {

        $passkey = password_hash($password, PASSWORD_DEFAULT);

        return $passkey;
    }

    public static function check_hash($key, $hash) {

        return password_verify($key, $hash);
    }

    public static function filter_str($string) {
        $string = preg_replace('~^[^a-z0-9]$~', '', $string);

        return $string;
    }

    public static function check() {
        if (isset($_SESSION['user_id'])) {
            return true;
        }

        return false;
    }
}