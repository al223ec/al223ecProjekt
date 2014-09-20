<?php

namespace controller; 

require_once(ROOT_DIR . "/src/controller/SocialMediaController.php");
require_once(ROOT_DIR . "/src/controller/BloggController.php");

class MasterController{
	
	private $socialMediaController; 
	private $bloggController; 


	public function __construct(){
		$this->socialMediaController = new SocialMediaController(); 
		$this->bloggController = new BloggController(); 
	}

	public function getMasterPage(){
		return $this->bloggController->performAction(); 
	}

	public function getSocialMediaPage(){
		return $this->socialMediaController->getMedia(); 
	}

}