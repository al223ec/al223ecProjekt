<?php

namespace auth\model; 


class User {

	private $userID; 
	private $userName; 
	private $passwordHash; 
	private $isAdmin; 

	private $valid; 

	public function __construct($userID = 0){
		$this->userID = $userID; 
		$this->valid = false; 
	}
	
	public function validateByPassword($password){
		if(crypt($password, $this->passwordHash) === $this->passwordHash ){
			$this->valid = true; 
		} else{
			$this->valid = false; 
		}
		if($password === $this->passwordHash){
			$this->valid = true; 
		}
		return $this->valid; 
	}

	private function createHash($password){
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		return crypt($password, $salt);
	}

	public function isValidPassword(){
		return $this->valid; 
	}
	public function getUserID(){
		return $this->userID; 
	}
	public function getUserName(){
		return $this->userName; 
	}
	public function getPasswordHash(){
		return $this->passwordHash; 
	}
	public function getIsAdmin(){
		return isset($this->isAdmin) ? $this->isAdmin : false; 
	}
	public function setIsAdmin($isAdmin){
		$this->isAdmin = $isAdmin; 
	}

	public function setUserName($userName){
		$this->userName = $userName;
	}
	
	public function setPasswordHash($passwordHash){
		$this->passwordHash = $passwordHash; 
	}
	public function setPassword($password){
		$this->passwordHash = $this->createHash($password); 
	}

	public function __toString(){
		return $this->userName;
    }

}