<?php

namespace auth\model; 

class RegisterUserModel extends \auth\model\ModelBase{

	public function saveUser(\auth\model\User $newUser){
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
}