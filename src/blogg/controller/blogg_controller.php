<?php

namespace blogg\controller; 

class BloggController extends BaseController {

	private $bloggModel; 
	private $numberOfPostsPerPage; 
	protected static $adminIsLoggedIn;

	//Den här kontrollern kan inte existera utan authcontroller just nu; 
	public function __construct(){
		parent::__construct();
      	$this->setView(new \blogg\view\blogg\BloggView());
		$this->bloggModel = new \blogg\model\blogg\BloggModel(); 

		self::$adminIsLoggedIn = $this->authController->isAdminLoggedIn();
		$this->view->setAdminLoggedInVar(self::$adminIsLoggedIn);
		$this->view->setLoggedInUserId($this->authController->getCurrentUserId()); 

		$this->numberOfPostsPerPage = $this->settings->getBloggSettings()->bloggNumberOfBloggPostsPerPage; 
	}
	
	public function main(){
		$startPost = isset($this->params[0]) ? intval($this->params[0]) : 0;		
		$this->view->setViewFullVar(false); 


		$numberOfPostsInDb = $this->bloggModel->getNumberOfBloggPostsInDb(); 
		$this->view->setPagingVars($startPost, $this->numberOfPostsPerPage, $numberOfPostsInDb); 

		$this->view->setPostsVar($this->bloggModel->getBloggPosts($startPost, $this->numberOfPostsPerPage));
	}


	public function create(){
		if(!self::$userIsloggedIn){
			$this->redirectTo();
		}
		$this->view->setViewFullVar(true); 
	}

	public function edit(){
		if(!self::$userIsloggedIn){
			$this->redirectTo();
		}
		$post = $this->getBloggPostById(); 
		//Bara hen som har gjort inlägget eller admin får redigera
		if(self::$adminIsLoggedIn || $post->getUserId() === $authcontroller->getCurrentUserId()){
			$this->view->setViewFullVar(true);
			$this->view->setPostVar($this->getBloggPostById());
		}else{
			$this->redirectTo();
		}
	}

	public function view(){
		$this->view->setViewFullVar(true);
		$this->view->setPostVar($this->getBloggPostById());
	}


	public function delete(){
		if(!self::$adminIsLoggedIn){
			$this->redirectTo();
		}
		$this->view->setPostVar($this->getBloggPostById());
	}

	public function deleteConfirmed(){
		if(!self::$adminIsLoggedIn){
			$this->redirectTo();
		}
		$this->view->setPostVar($this->getBloggPostById());
	}

	public function save(){
		if(!self::$userIsloggedIn){
			$this->redirectTo(); 
		}

		$post = $this->view->getNewBloggPost(); 
		if($post !== null && $post->getId() === 0){
			$post->setUserId($this->authController->getCurrentUserId()); 
		}
		$this->view->setPostVar($post);
		if($post !== null){
			if($post->isValid()){
				$postId = $this->bloggModel->saveBloggPost($post);
				if($postId !== 0){ 
					$this->redirectTo("blogg", "view", $postId);
				}
			}  
		}

		$this->view->setSaveFailedVar();
	}

	private function getBloggPostById(){
		$id = isset($this->params[0]) ? intval($this->params[0]) : 0; //Detta är ju egentligen lite osnyggt platsberoende

		$post = $this->bloggModel->getBloggPostById($id);
		if($post !== null){
			return $post;
		}
		throw new \Exception("BloggController::getBloggPostById Ett oväntat fel har inträffat användaren har inte kunnat hittats");	
	}
}