<?php

$routes = [
	['route' => 'user\/[0-9]+', 'action' => 'user/info'],
    ['route' => 'user\/edit', 'action' => 'user/edit'],
    ['route' => 'follow\/[0-9]+', 'action' => 'user/follow'],
    ['route' => 'unfollow\/[0-9]+', 'action' => 'user/unfollow'],
    ['route' => 'post\/create', 'action' => 'post/create'],
    ['route' => 'login', 'action' => 'user/login'],
    ['route' => 'exit', 'action' => 'user/logout'],
    ['route' => 'register', 'action' => 'user/create'],
//    ['route' => 'delete', 'action' => 'user/delete'],
    ['route' => '', 'action' => 'index/index'],
];

