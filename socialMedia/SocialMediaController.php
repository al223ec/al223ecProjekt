<?php 

require_once(ROOT_DIR . "/Twitter.php");
require_once(ROOT_DIR . "/Instagram.php");

class SocialMediaController{
	private $twitter; 
	private $instagram; 

	public function __construct(){
		$this->twitter = new Twitter(); 
		$this->instagram = new Instagram(); 
	}
	public function getMedia(){
		$this->twitter->performRequest(); 
		$this->instagram->getInstagram(); 

		return "getMedia"; 
	}
}