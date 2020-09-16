<?php

/**
 * 
 */
class UserController {

	public function __construct() {

	}

	public function info($request) {
		
		$param = explode("/", $request);
		$id = $param[1];

		echo "$id";

		return true;
	}

}