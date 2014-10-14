<?php

namespace blogg\controller; 

class BloggController extends \core\Controller {

	private $twitterModel; 
	private $instagramModel; 
	private $socialMediaView; 
	private $bloggView; 
	private $formView; 

	public static $userIsloggedIn = true; 

	private $currentView; 

	public function __construct(){
      	parent::__construct();

		$this->twitterModel = new \blogg\model\Twitter(); 
		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel(); 

		$this->socialMediaView = new \blogg\view\SocialMediaView($this->twitterModel, $this->instagramModel); 
		$this->bloggView = new \blogg\view\blogg\BloggView(); 
		$this->formView = new \blogg\view\blogg\BloggPostForm(); 
	}
	
	public function main(){
		//$this->params[0], $this->params[1]
	
		$this->masterView->setBloggView($this->bloggView->viewAllPosts($this->bloggModel->getBloggPosts())); 
		$this->masterView->setBloggFormView($this->formView->getBloggPostAddEditForm()); 
		// .  $this->formView->getBloggPostAddEditForm();
		// . $this->socialMediaView->getInstagramImages() . $this->socialMediaView->getTweets(); 
	}

	public function edit(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$this->masterView->setBloggFormView($this->formView->getBloggPostAddEditForm($this->bloggModel->getBloggPostById($id))); 
	}

	public function view(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$this->masterView->setBloggView($this->bloggView->viewBloggPost($this->bloggModel->getBloggPostById($id), true)); 
	}


	public function delete(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$post = $this->bloggModel->getBloggPostById($id); 
		
		$this->masterView->setBloggFormView($this->bloggView->confirmDelete($post)); 
	}
	public function deleteConfirmed(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$this->bloggModel->delete($id); 

		$this->main(); 
	}


	public function save(){
		$post = $this->bloggView->getNewBloggPost(); 
		if($post !== null && $this->bloggModel->saveBloggPost($post)){
			$this->masterView->setBloggView($this->bloggView->viewBloggPost($post, true));
			return;  
		}

		//Något har gått fel
		$this->masterView->setBloggFormView($this->formView->getBloggPostAddEditForm($post)); 
	}

}