<?php

namespace core;

class Routes{

	public static $routes = array(
		'blogg' => array(
			'main' => 'blogg/',
			'save' => 'blogg/save/',
			'edit' => 'blogg/edit/',
			'delete' => 'blogg/delete/',
			'view' => 'blogg/view/'
		),
	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}