<?php

class Service {

    public static function get_uri_param(String $data, $n) {
        $data = explode("/", $data);

        return $data[$n];
    }

    public static function get_session_param(String $param) {

        return $_SESSION[$param];
    }

    public static function set_session_param(String $param, $data) {
        $_SESSION[$param] = $data;

        return true;
    }

    public static function get_post_param(String $param) {
        if (isset($_POST[$param])) {

            return Auth::filter_str($_POST[$param]);
        } else {

            return false;
        }
    }

    public static function print (String $message) {

        echo '<pre>'."\n".$message.'</pre>';

        exit();
    }

    public static function show_data ($data) {

        $message = "--- " . __METHOD__ . " ---\n\n";

        ob_start();
        var_dump($data);
        $message .= ob_get_clean();

        self::print($message);

        return true;
    }

}