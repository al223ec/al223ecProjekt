<?php

namespace blogg\controller; 

class BloggController extends BaseController {

	private $bloggModel; 

	//Den här kontrollern kan inte existera utan authcontroller just nu; 
	public function __construct(){
		parent::__construct();

      	$this->view = new \blogg\view\blogg\BloggView();
		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		
		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 

		//Måste flytta detta till något vettigare ställe
		$this->authController->main();
		$authViewRender = $this->authController->getView()->render("auth", "auth", "main", false);
		$this->view->setAuthRenderVar($authViewRender);  
	}
	
	public function main(){
		$this->view->setPostsVar($this->bloggModel->getBloggPosts());
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
		$this->view->setPostVar($this->getBloggPostById());
	}

	public function view(){
		$this->view->setPostVar($this->getBloggPostById());
	}


	public function delete(){
		if(!self::$userIsloggedIn){
			return; 
		}
		$this->view->setPostVar($this->getBloggPostById());

	}

	public function deleteConfirmed(){
		if(!self::$userIsloggedIn){
			return; //redirecta istället?  
		}
		$this->view->setPostVar($this->getBloggPostById());
	}


	public function save(){
		if(!self::$userIsloggedIn){
			return; 
		}

		$post = $this->view->getNewBloggPost(); 
		if($post !== null && $post->getId() === 0){
			$post->setUserId($this->authController->getCurrentUserId()); 
		}
		$this->view->setPostVar($post);
		if($post !== null && $this->bloggModel->saveBloggPost($post)){
			//Allt har lyckats 
			$this->redirectTo();
			return;  
		}
		$this->view->setSaveSuccessfullVar();  

		var_dump("Fail BloggController::Save() rad 75"); 
	}

	private function getBloggPostById(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$post = $this->bloggModel->getBloggPostById($id);
		if($post !== null){
			return $post;
		}
		var_dump("Fail BloggController::getBloggPostById() ");
		die(); 
		//Något har gått fel
		$this->redirectTo(); //error 404? 
	}

}