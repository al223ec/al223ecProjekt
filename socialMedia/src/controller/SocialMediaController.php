<?php 

require_once(ROOT_DIR . "/src/model/Twitter.php");
require_once(ROOT_DIR . "/src/model/Instagram.php");

class SocialMediaController{
	private $twitterModel; 
	private $instagramModel; 


	public function __construct(){
		$this->twitter = new \model\Twitter(); 
		$this->instagram = new \model\Instagram(); 
	}

	public function getMedia(){
		$this->twitter->performRequest(); 
		//$this->instagram->getInstagram(); 

		return "getMedia"; 
	}
}