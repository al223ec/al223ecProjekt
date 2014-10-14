<?php

namespace auth\controller; 

class RegisterController extends \core\Controller{
	
	private $registerUserView; 
	private $registerUserModel;

	public function __construct(){
      	parent::__construct();
	      	
		$this->registerUserModel = new \auth\model\RegisterUserModel(); 
		$this->registerUserView = new \auth\view\register\RegisterUserView($this->registerUserModel);
	}
	public function main(){
		$this->masterPage->setAuthView($this->registerUserView->getRegisterForm()); 
	}

	public function saveNewUser(){
		$newUser = $this->getNewUser(); 

		if($newUser !== null && $this->registerUserModel->saveUser($newUser)){
			$this->registerUserView->setSuccessMessage($newUser->getUserName()); 
			\auth\view\ViewBase::redirect();
			return; 
		}
		$this->registerUserView->setFailMessage(); 
		$this->masterPage->setAuthView($this->registerUserView->getRegisterForm()); 
	}
	//Flytta denna till vyn?? 
	private function getNewUser(){
		$userName = $this->registerUserView->getUserName(); 
		$password = $this->registerUserView->getPassword(); 

		if($userName !== "" && $password !== ""){
			$newUser = new \auth\model\User(); 
			$newUser->setUserName($userName); 
			$newUser->setPassword($password);  
			return $newUser; 
		} 
		return null; 
	}
}