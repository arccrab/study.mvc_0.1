<?php
session_start();

define('DIR', __DIR__);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/config/config.php';
require_once __DIR__.'/vendor/predis/Autoloader.php';
Predis\Autoloader::register();

require_once __DIR__.'/core/db.php';
require_once __DIR__.'/core/mvc.php';
require_once __DIR__.'/core/service.php';
require_once __DIR__.'/core/auth.php';
require_once __DIR__.'/core/debug.php';

require_once __DIR__.'/router.php';
