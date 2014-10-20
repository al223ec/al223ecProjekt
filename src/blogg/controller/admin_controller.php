<?php

namespace blogg\controller; 
	
class AdminController extends BaseController{
	
	private $adminModel; 
	private $isAdminLoggedIn; 
	public function __construct(){
		parent::__construct(); 

		$this->adminModel = new \blogg\model\admin\AdminModel(); 
		$this->view = new \blogg\view\admin\AdminView($this->authController->isAdminLoggedIn(), $this->adminModel); 

		$this->initAuthController();
		$this->isAdminLoggedIn = $this->authController->isAdminLoggedIn(); 
	}

	public function main(){
		
	}
	 
	public function saveUser(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$user = $this->view->getNewUser(); 
		if($user !== null){
			$userId = $this->adminModel->saveUser($user); 
			if($userId != 0){
				$this->redirectTo("admin", "userSaved", $userId); 
			} else {
				var_dump("saveUser admin controller! rad 27"); 
				die(); 
			}
		}
	}

	public function userSaved(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}

		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$user = $this->adminModel->getUserWithId($id);
		if($user !== null){
			 $this->view->setSavedUserVar($user); 
		} else {
			//error!!!
		}
	}
}