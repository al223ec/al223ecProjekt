<?php

namespace blogg\controller;


abstract class BaseController extends \core\Controller {
	
	public static $userIsloggedIn; 
	protected $authController; 	

	public function __construct(){
      	$this->authController = \core\Loader::load('\\auth\\controller\\AuthController'); 
      	self::$userIsloggedIn = $this->authController->userIsLoggedIn(); //WHY STATIC??  
      	
	}
}