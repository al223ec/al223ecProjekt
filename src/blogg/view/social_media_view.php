<?php

namespace blogg\view; 

class SocialMediaView {

	private $twitterModel;  
	private $instagramModel; 

	public function __construct(\blogg\model\Twitter $twitterModel, \blogg\model\instagram\InstagramModel $instagramModel){
		$this->twitterModel = $twitterModel; 
		$this->instagramModel = $instagramModel; 
	}

	public function getInstagramImages(){
		return $this->instagramModel->getInstagramImages(); 
	}

	public function getTweets(){
		$tweets =$this->twitterModel->getTweets(); 
		$ret = ""; 

		if($tweets){
			foreach ($tweets as $key => $value) {
				$ret .= "<h1>" . $value->getName() . "</h1>"; 
				$ret .="<p>". $value->getText() ."</p>"; 
				$ret .= "<h5>" . $value->getScreenName() . "</h5>"; 
			}
		}
		return $ret; 
	}


}