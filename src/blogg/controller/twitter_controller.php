<?php

namespace blogg\controller; 

class TwitterController extends \blogg\controller\BaseController{
	private $twitterModel; 

	public function __construct(){
		parent::__construct();
		$this->twitterModel = new \blogg\model\twitter\Twitter();
		$this->view = new \blogg\view\twitter\TwitterView(); 

		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		
		$this->initAuthController(); 
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets(3)); 
	}

}