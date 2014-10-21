<?php

namespace blogg\controller; 
	
class AdminController extends BaseController{
	
	private $adminModel; 
	private $isAdminLoggedIn; 

	public function __construct(){
		parent::__construct(); 
		$this->adminModel = new \blogg\model\admin\AdminModel(); 
		$this->isAdminLoggedIn = $this->authController->isAdminLoggedIn(); 
		$this->setView(new \blogg\view\admin\AdminView($this->authController->isAdminLoggedIn(), $this->adminModel));
		//$this->settings->saveSettings();
	}

	public function main(){	
		$this->view->setUserArray($this->adminModel->getAllUsers()); 
	}
	 
	public function saveUser(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		try{			
			$user = $this->view->getNewUser(); 
			if($user !== null){
				$userId = $this->adminModel->saveUser($user); 
				if($userId != 0){
					$this->redirectTo("admin", "userSaved", $userId); 
				} else {
					throw new \Exception("AdminController::saveUser Ett oväntat fel har inträffat, användaren har inte kunnat sparats");
				}
			}
		}catch(\Exception $e){
			$this->redirectToError($e); 
		}
	}

	public function userSaved(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		try{
			$id = isset($this->params[0]) ? $this->params[0] : 0; 
			$user = $this->adminModel->getUserWithId($id);
			if($user !== null){
				 $this->view->setUserVar($user); 
			} else {
				throw new \Exception("AdminController::userSaved Ett oväntat fel har inträffat, användaren har inte hittats i databasen");
			}
		}catch(\Exception $e){
			$this->redirectToError($e); 
		}
	}

	public function deleteUser(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$user = $this->adminModel->getUserWithId($id);
		$this->view->setUserVar($user); 
	}

	public function deleteConfirmed(){
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		try{
			$user = $this->adminModel->getUserWithId($id);
			$this->view->setUserVar($user); 
			if($this->adminModel->deleteUser($user)){
				return; 
			} 
			//ett fel har inträffat
			throw new \Exception("AdminController::deleteConfirmed Ett oväntat fel har inträffat, användaren har inte kunnat tagits bort");
		}catch(\Exception $e){
			$this->redirectToError($e); 
		}
	}

	public function settings(){
		
	}
}