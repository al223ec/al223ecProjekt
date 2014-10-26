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
	}

	public function main(){	
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$this->view->setUserArray($this->adminModel->getAllUsers()); 
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
				throw new \Exception("AdminController::saveUser Ett oväntat fel har inträffat, användaren har inte kunnat sparats");
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
			 $this->view->setUserVar($user); 
		} else {
			throw new \Exception("AdminController::userSaved Ett oväntat fel har inträffat, användaren har inte hittats i databasen");
		}
	}

	public function deleteUser(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$id = isset($this->params[0]) ? $this->params[0] : 0; 
		$user = $this->adminModel->getUserWithId($id);
		if($user !== null){
			$this->view->setUserVar($user); 
		}else {
			throw new \Exception("AdminController::deleteUser Ett oväntat fel har inträffat, användaren har inte hittats i databasen");
		}
	}

	public function deleteConfirmed(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$id = isset($this->params[0]) ? $this->params[0] : 0; 

		$user = $this->adminModel->getUserWithId($id);
		$this->view->setUserVar($user); 
		if($this->adminModel->deleteUser($user)){
			return; 
		} else{
			//ett fel har inträffat
			throw new \Exception("AdminController::deleteConfirmed Ett oväntat fel har inträffat, användaren har inte kunnat tagits bort");
		}
	}

	public function settings(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$this->setView(new \blogg\view\admin\SettingsView($this->settings));
	}

	public function saveSettings(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}
		$this->setView(new \blogg\view\admin\SettingsView($this->settings));
		$this->view->setSaveMessage($this->settings->saveSettings($this->view->saveSettings())); 
	}

	public function resetSettings(){
		if(!$this->isAdminLoggedIn){
			$this->redirectTo(); 
		}	
		$this->setView(new \blogg\view\admin\SettingsView($this->settings));
		$this->settings->resetSettings(); 
	}
}