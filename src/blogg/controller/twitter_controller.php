<?php

namespace blogg\controller; 

class TwitterController extends \blogg\controller\BaseController{
	private $twitterModel; 
	private $numberOfTweets; 

	public function __construct(){
		parent::__construct();
		
		$this->twitterModel = new \blogg\model\twitter\Twitter($this->settings->getTwitterSettings());
		$this->setView(new \blogg\view\twitter\TwitterView()); 
		$this->numberOfTweets = $this->settings->getTwitterSettings()->numberOfPosts; 
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets($this->numberOfTweets)); 
	}

}