<?php

namespace blogg\controller; 

class BloggController extends \core\Controller implements Icrud{

	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 
	private $bloggView; 

	public function __construct(){
		$this->twitterModel = new \blogg\model\Twitter(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel(); 
		$this->socialMediaView = new \blogg\view\SocialMediaView($this->twitterModel, $this->instagramModel); 
		$this->bloggView = new \blogg\view\BloggView(); 
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