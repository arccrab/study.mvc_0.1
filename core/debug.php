<?php

class Debug {
    public static $debug_file = DIR.'/log/debug.log';

    public static function error($message) {
        $h = fopen(self::$debug_file, 'a+');
        $date = date("Y-m-d H:i:s");

        fwrite($h,'['.$date.'] ERROR: '.$message."\n");

        fclose($h);

        return true;
    }
}