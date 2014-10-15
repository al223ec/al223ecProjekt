<?php

namespace blogg\controller; 

class BloggController extends \core\Controller {

	private $bloggView; 
	private $formView; 

	public static $userIsloggedIn = true; 
	private $authController; 

	public function __construct(){
      	parent::__construct();
      	$this->authController = \core\Loader::load('\\auth\\controller\\AuthController'); 

      	self::$userIsloggedIn = true;//$this->authController->userIsLoggedIn(); //WHY STATIC??  

		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 
		$this->bloggView = new \blogg\view\blogg\BloggView(); 
		$this->formView = new \blogg\view\blogg\BloggPostForm();
	}
	
	public function main(){
		return array("posts" => $this->bloggModel->getBloggPosts(), "userIsLoggedIn" => self::$userIsloggedIn); 
	}

	public function create(){
		if(!self::$userIsloggedIn){
			return; 
		}

	}
	public function edit(){
		if(!self::$userIsloggedIn){
			return; 
		}

		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$this->masterPage->setBloggView($this->bloggView->viewBloggPost($this->bloggModel->getBloggPostById($id)));
		$this->masterPage->setBloggFormView($this->formView->getBloggPostAddEditForm($this->bloggModel->getBloggPostById($id))); 
	}

	public function view(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		return array("post" => $this->bloggModel->getBloggPostById($id), "userIsLoggedIn" => self::$userIsloggedIn);; 
	}


	public function delete(){
		if(!self::$userIsloggedIn){
			return; 
		}
		
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$post = $this->bloggModel->getBloggPostById($id); 

		$this->masterPage->setBloggFormView($this->bloggView->confirmDelete($post)); 
	}
	public function deleteConfirmed(){
		if(!self::$userIsloggedIn){
			return; 
		}
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$this->bloggModel->delete($id); 

		$this->main(); 
	}


	public function save(){
		if(!self::$userIsloggedIn){
			return; 
		}

		$post = $this->bloggView->getNewBloggPost(); 
		if($post !== null && $post->getId() === 0){
			$post->setUserId($this->authController->getCurrentUserId()); 
		}

		if($post !== null && $this->bloggModel->saveBloggPost($post)){
			$this->masterPage->setBloggView($this->bloggView->viewBloggPost($post, true));
			return;  
		}

		//Något har gått fel
		$this->masterPage->setBloggFormView($this->formView->getBloggPostAddEditForm($post)); 
	}

}