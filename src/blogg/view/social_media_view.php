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




}