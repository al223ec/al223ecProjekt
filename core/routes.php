	<?php

class Routes{
	public static $routes = array(
		'master' => array(
			'main' => 'blogg/'
		),
	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}