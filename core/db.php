<?php

/**
 * 
 */
class DB {	
	public static function init() {
		$client = new Predis\Client([
    		'password' => REDIS_PASS,
    		'host'   => REDIS_HOST,
    		'port'   => REDIS_PORT,
		]);

		return $client;
	}
}

$client = DB::init();

$res = $client->get('next_user_id');

var_dump($res);