<?php

namespace controller; 

class BloggController extends \core\controller implements Icrud{

	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 
	private $bloggView; 

	public function __construct(){
		$this->twitterModel = new \model\Twitter(); 
		$this->instagramModel = new \model\instagram\InstagramModel(); 
		$this->socialMediaView = new \view\SocialMediaView($this->twitterModel, $this->instagramModel); 
		$this->bloggView = new \view\BloggView(); 

	}
	
	public function main(){
		return $this->bloggView->getBloggPostForm() . $this->socialMediaView->getInstagramImages() . $this->socialMediaView->getTweets(); 
	}

	public function edit(){

	}
	public function delete(){

	}
	public function save(){
		
	}

}