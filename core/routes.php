<?php

namespace core;

class Routes{

	public static $routes = array(
		'blogg' => array(
			'main' => 'blogg/main/',
			'save' => 'blogg/save/',
			'edit' => 'blogg/edit/',
			'delete' => 'blogg/delete/',
			'view' => 'blogg/view/',
			'deleteConfirmed' => 'blogg/deleteConfirmed/',
			'create' => 'blogg/create/'
		),
		'auth' => array(
			'main' => 'auth/',
			'login' => 'auth/login/',
			'logout' => 'auth/logout/'
		),
		'instagram' => array(
			'main' => 'instagram/'
		),
		'twitter' => array(
			'main' => 'twitter/'
		),
		'admin' => array(
			'main' => 'admin/',
			'saveNewUser' => 'admin/saveUser'

		),
		'home' => array(
			'main' => 'home/'
			),


	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}