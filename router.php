<?php

// get uri path and route to controller method

require_once __DIR__.'/config/routes.php';

$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$route_check = false;

foreach ($routes as $r_val) {
	$r_val['route'];

	$to_preg = '~^'.$r_val['route'].'$~';

	if (preg_match($to_preg, $request_uri)) {
		$action = explode("/", $r_val['action']);

		require_once __DIR__."/controller/".$action[0].".php";

		$controller = $action[0]."Controller";
		$worker = new $controller();
		$action = $action[1];

		if (!$worker->$action($request_uri)) {
			exit('WRONG ROUTE');
		}

		$route_check = true;
	}
}

if (!$route_check) {
	header("HTTP/1.0 404 Not Found");
}