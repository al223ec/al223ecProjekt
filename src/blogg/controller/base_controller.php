<?php

namespace blogg\controller;


abstract class BaseController extends \core\Controller {
	protected static $userIsloggedIn; 
	protected $authController; 	

	public function __construct(){
      	$this->authController = \core\Loader::load('\\auth\\controller\\AuthController'); 
      	self::$userIsloggedIn = $this->authController->userIsLoggedIn(); //WHY STATIC?? 
	}
	public function initAuthController(){
		if(!isset($this->authController)){
			throw new \Exception("Blogg::BaseController initAuthController, authController är inte definerad, kallar du på BaseControllers construct??");
			
		}
		if(!isset($this->view)){
			throw new \Exception("Blogg::BaseController initAuthController, view finns inte, kontrollera att du instacerar view i konstruktorn");			
		}
		$this->authController->main();
		$authViewRender = $this->authController->getView()->render("auth", "auth", "main", false);
		$this->view->setAuthRenderVar($authViewRender);  
	}
}