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
			throw new \Exception("Blogg::BaseController setView, authController är inte definerad, kallar du på BaseControllers construct??");
		}
		$this->authController->main();

		//En fix för att undvika att behöva rendera om auth vyn
		if(isset($this->view)){
			$view->setAuthRenderVar($this->view->getAuthRender()); 
		}else{
			$authViewRender = $this->authController->getView()->render("main", false);
			$view->setAuthRenderVar($authViewRender); 
		}

		$this->view = $view; 
		$view->setUserLoggedInVar(self::$userIsloggedIn);		  
	}
}