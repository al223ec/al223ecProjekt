<?php

namespace view; 

class SocialMediaView {
	private $twitterModel;  
	private $instagramModel; 


	public function __construct(\model\Twitter $twitterModel, \model\Instagram $instagramModel){
		$this->twitterModel = $twitterModel; 
		$this->instagramModel = $instagramModel; 
		
	}
	public function getInstagramImages(){
		return $this->instagramModel->getInstagramImages(); 
	}

	public function getTweet(){
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