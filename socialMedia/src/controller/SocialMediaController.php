<?php 
namespace controller; 

require_once(ROOT_DIR . "/src/model/Twitter.php");
require_once(ROOT_DIR . "/src/model/Instagram.php");
require_once(ROOT_DIR . "/src/view/SocialMedia.php");

class SocialMediaController{
	
	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 

	public function __construct(){
		$this->twitterModel = new \model\Twitter(); 
		$this->instagramModel = new \model\Instagram(); 
		$this->socialMediaView = new \view\SocialMedia($this->twitterModel, $this->instagramModel); 
	}

	public function getMedia(){
		return $this->socialMediaView->getTweet() . $this->socialMediaView->getInstagramImages(); 
	}
}