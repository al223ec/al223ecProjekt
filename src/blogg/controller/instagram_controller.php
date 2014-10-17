<?php

namespace blogg\controller; 

class InstagramController extends BaseController{

	private $instagramModel; 
	public function __construct(){
		parent::__construct(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel();  
		$this->view = new \blogg\view\instagram\InstagramView(); 
		$this->view->setUserLoggedInVar(self::$userIsloggedIn);		

		//Måste flytta detta till något vettigare ställe och göra detta på ett bättre sätt
		$this->initAuthController(); 
	}

	public function main(){
		$this->view->setImages($this->instagramModel->getInstagramImages());  
	}
}