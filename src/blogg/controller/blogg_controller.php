<?php

namespace blogg\controller; 

class BloggController extends \core\Controller implements Icrud{

	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 
	private $bloggView; 
	private $formView; 

	private $masterView; 

	public static $userIsloggedIn = true; 

	public function __construct($authController = null){

		$this->twitterModel = new \blogg\model\Twitter(); 
		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel(); 

		$this->socialMediaView = new \blogg\view\SocialMediaView($this->twitterModel, $this->instagramModel); 
		$this->bloggView = new \blogg\view\blogg\BloggView(); 
		$this->formView = new \blogg\view\blogg\BloggPostForm(); 
		$this->masterView = new \blogg\view\MasterView($this->socialMediaView, $this->bloggView); 
	}
	
	public function main(){
		//$this->params[0], $this->params[1]
	
		return $this->bloggView->viewAllPosts($this->bloggModel->getBloggPosts()) .  $this->formView->getBloggPostAddEditForm();
		// . $this->socialMediaView->getInstagramImages() . $this->socialMediaView->getTweets(); 
	}

	public function edit(){


	}

	public function view(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		return $this->bloggView->viewBloggPost($this->bloggModel->getBloggPostById($id), true); 
	}


	public function delete(){

	}

	
	public function save(){
		$post = $this->bloggView->getNewBloggPost(); 
		if($post !== null && $this->bloggModel->saveBloggPost($post)){
			return $this->bloggView->viewBloggPost($post, true); 
		}

		//Något har gått fel
		return $this->formView->getBloggPostAddEditForm($post); 
	}

}