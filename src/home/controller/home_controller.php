<?php

namespace home\controller; 

class HomeController extends \blogg\controller\BaseController{

	private $instagramModel; 
	private $homeModel; 

	private $lengthOfFlow = 12; 


	public function __construct(){
		parent::__construct(); 

		$this->twitterModel = new \blogg\model\twitter\Twitter();
		$this->homeModel = new \home\model\HomeModel(); 

		$this->view = new \home\view\home\HomeView(); 
		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		
      	$this->initAuthController(); 
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets(3)); 
		$this->view->setBloggAndInstagramFlow($this->homeModel->getBloggAndInstagramFlow($this->lengthOfFlow)); 

	}
}