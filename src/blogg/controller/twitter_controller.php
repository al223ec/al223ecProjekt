<?php

namespace blogg\controller; 

class TwitterController extends \blogg\controller\BaseController{
	private $twitterModel; 
	private $numberOfTweets; 

	public function __construct(){
		parent::__construct();
		$this->twitterModel = new \blogg\model\twitter\Twitter();
		$this->setView(new \blogg\view\twitter\TwitterView()); 
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets()); 
	}

}