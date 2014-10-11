<?php

namespace core;

class Routes{
	public static $routes = array(
		'blogg' => array(
			'main' => 'blogg/'
		),
	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}