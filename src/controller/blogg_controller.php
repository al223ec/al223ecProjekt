<?php

namespace controller; 

class BloggController extends \core\controller implements Icrud{

	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 

	public function __construct(){
		$this->twitterModel = new \model\Twitter(); 
		$this->instagramModel = new \model\Instagram(); 
		$this->socialMediaView = new \view\SocialMediaView($this->twitterModel, $this->instagramModel); 
	}
	
	public function main(){
		return $this->socialMediaView->getInstagramImages() . $this->socialMediaView->getTweet(); 
	}

	public function edit(){

	}
	public function delete(){

	}
	public function save(){
		
	}

}