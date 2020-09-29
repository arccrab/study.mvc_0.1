<?php

/**
 * 
 */
class DB {	
	public static function init() {

	    $db_type = self::type();

	    if ($db_type === 'redis') {

            $client = new Predis\Client([
                'password' => REDIS_PASS,
                'host'   => REDIS_HOST,
                'port'   => REDIS_PORT,
            ]);
        } else {

	        return false;
        }

		return $client;
	}

	public static function type() {

        return DB_TYPE;
    }
//
//    private

    public static function get_state_message($key) {
        $db = self::init();

        if (self::type() === 'redis') {

            $result = $db->hget('state_messages', $key);

            if (!$result) {
                return false;
            }
        } else {
            return false;
        }

        return $result;
    }
}
