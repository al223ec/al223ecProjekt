<?php

namespace blogg\controller; 

class BloggController extends BaseController {

	private $bloggModel; 
	private $numberOfPostsPerPage  = 15; 

	//Den här kontrollern kan inte existera utan authcontroller just nu; 
	public function __construct(){
		parent::__construct();
      	$this->view = new \blogg\view\blogg\BloggView();
		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 

		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		
		$this->initAuthController(); 
	}
	
	public function main(){
		$startPost = 0; 
		if(isset($this->params[0])){// && isset($this->params[1])){
			$startPost = intval($this->params[0]); 
		}
		$this->view->setViewFullVar(false); 
		$numberOfPostsInDb = $this->bloggModel->getNumberOfBloggPostsInDb(); 

		$this->view->setPaging($startPost, $this->numberOfPostsPerPage, $numberOfPostsInDb); 
		$this->view->setPostsVar($this->bloggModel->getBloggPosts($startPost, $this->numberOfPostsPerPage));
	}

	public function create(){
		if(!self::$userIsloggedIn){
			return; 
		}
      	//$instagramController = \core\Loader::load('\\blogg\\controller\\BloggController'); 
		$this->view->setViewFullVar(true); 
	}

	public function edit(){
		if(!self::$userIsloggedIn){
			return; 
		}
		$this->view->setViewFullVar(true);
		$this->view->setPostVar($this->getBloggPostById());
	}

	public function view(){
		$this->view->setViewFullVar(true);
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
		$postId = $this->bloggModel->saveBloggPost($post); 
		
		if($post !== null && $postId !== 0){
			//$this->view->setSaveSuccessfullVar();  
			$this->redirectTo("blogg", "view", $postId);
			return;  
		}
		var_dump("Fail BloggController::Save() rad 75"); 
		die(); 
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