<?php

namespace blogg\controller; 

class TwitterController extends \blogg\controller\BaseController{
	private $twitterModel; 

	public function __construct(){
		parent::__construct();
		$this->twitterModel = new \blogg\model\Twitter();
		$this->view = new \blogg\view\twitter\TwitterView(); 

		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		

		//Måste flytta detta till något vettigare ställe
		$this->authController->main();
		$authViewRender = $this->authController->getView()->render("auth", "auth", "main", false);
		$this->view->setAuthRenderVar($authViewRender);  
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets(3)); 
	}

}