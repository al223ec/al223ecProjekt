<?php

namespace home\controller; 

class HomeController extends \blogg\controller\BaseController{

	private $instagramModel; 
	private $bloggModel; 
	private $twitterModel; 
 
	private $numberOfTweets = 3;
	private $numberOfImages = 3; 
	private $numberOfPosts = 3; 

	public function __construct(){
		parent::__construct(); 

		$this->twitterModel = new \blogg\model\twitter\Twitter($this->settings->getTwitterSettings());
		$this->instagramModel = new \blogg\model\instagram\InstagramModel($this->settings->getInstagramSettings());  
		$this->bloggModel = new \blogg\model\blogg\BloggModel();
		$this->setView(new \home\view\home\HomeView());
	}

	public function main(){
		$this->view->setTweets($this->twitterModel->getTweets($this->numberOfTweets)); 
		$this->view->setImages($this->instagramModel->getInstagramImages($this->numberOfImages)); 
		$this->view->setPosts($this->bloggModel->getBloggPosts(0, $this->numberOfPosts)); 
	}
}