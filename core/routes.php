<?php

namespace core;

class Routes{

	public static $routes = array(
		'blogg' => array(
			'main' => 'blogg/',
			'save' => 'blogg/save/',
			'edit' => 'blogg/edit/',
			'delete' => 'blogg/delete/',
			'view' => 'blogg/view/',
			'deleteConfirmed' => 'blogg/deleteConfirmed/'
		),
		'auth' => array(
			'main' => 'auth/',
			'login' => 'auth/login/',
			'logout' => 'auth/logout/'
		),
		'register' => array(
			'main' => 'register/',
			'register' => 'register/',
			'save' => 'register/saveNewUser/' 
		),
		'instagram' => array(
			'main' => 'instagram/'
		)

	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}