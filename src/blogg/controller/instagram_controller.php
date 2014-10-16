<?php

namespace blogg\controller; 

class InstagramController extends BaseController{

	private $instagramModel; 
	public function __construct(){
		parent::__construct(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel();  
		$this->view = new \blogg\view\instagram\InstagramView(); 


		//Måste flytta detta till något vettigare ställe och göra detta på ett bättre sätt
		$this->authController->main();
		$authViewRender = $this->authController->getView()->render("auth", "auth", "main", false);
		$this->view->setAuthRenderVar($authViewRender);  
	}

	public function main(){
		$this->view->setImages($this->instagramModel->getInstagramImages());  
	}
}