<?php

namespace blogg\controller; 

class TwitterController extends \core\Controller{
	private $twitterModel; 
	private $twitterView; 

	
	public function __construct(){
      	parent::__construct();
		$this->twitterModel = new \blogg\model\Twitter();
		$this->twitterView = new \blogg\view\twitter\TwitterView(); 
	}

	public function main(){
		$this->masterPage->setTwitterView($this->twitterView->getTweetsHTML($this->twitterModel->getTweets())); 
	}
}