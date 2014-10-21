<?php

namespace blogg\controller;


abstract class BaseController extends \core\Controller {
	protected static $userIsloggedIn; 
	protected $authController; 	
	protected $settings;

	public function __construct(){
      	$this->authController = \core\Loader::load('\\auth\\controller\\AuthController'); 
      	self::$userIsloggedIn = $this->authController->userIsLoggedIn(); //WHY STATIC?? 
      	$this->settings = \core\Loader::load('\\blogg\\model\\admin\\Settings'); 
	}

	protected function setView($view){
		if(!isset($this->authController)){
			throw new \Exception("Blogg::BaseController initAuthController, authController är inte definerad, kallar du på BaseControllers construct??");
		}
		
		$this->authController->main();
		$authViewRender = $this->authController->getView()->render("auth", "auth", "main", false);

		$this->view = $view; 
		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		  
		$this->view->setAuthRenderVar($authViewRender); 
	}
}