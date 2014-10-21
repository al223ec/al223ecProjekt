<?php

namespace blogg\model\admin; 

class AdminModel{

	private $userRepository; 

	private $settingsModel; 

	private $filePath; 

	public function __construct(){
		$this->userRepository = new \auth\model\repository\UserRepository();
	}

	public function saveUser($newUser){
		if(!$this->ceckIfUserNameExists($newUser->getUserName())){
			return $this->userRepository->addUser($newUser); 
		}else{
			return false; 
		}
	}
	/**
	* @return True if exists
	*/
	public function ceckIfUserNameExists($userName){
		return $this->userRepository->getUserWithUserName($userName) !== null;
	}

	public function getUserWithId($id){
		return $this->userRepository->getUserWithId($id); 
	}

	public function getAllUsers(){
		return $this->userRepository->getAllUsers(); 
	}

	public function deleteUser($user){
		return $this->userRepository->deleteUser($user->getUserId()); 
	}
}