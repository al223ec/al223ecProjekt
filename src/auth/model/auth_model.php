<?php

namespace auth\model; 

class AuthModel extends \auth\model\ModelBase{

	private $sessionLoginData = "AuthModel::LoggedInUserId";
	private $sessionUserAgent = "AuthModel::UserAgent";

	// Kontrollerar om sessions-varibeln är satt vilket betyder att en användare är inloggad.
	public function userIsLoggedIn($userAgent){
		$user = $this->getLoggedInUser(); 
		return $user !== null && \auth\model\sessionHandler::getSession($this->sessionLoginData) !== "" && \auth\model\sessionHandler::getSession($this->sessionUserAgent) === $userAgent; 
	}

	public function isLoggedInUserAdmin(){
		$user = $this->getLoggedInUser() ; 
		return $user !== null ? $user->getIsAdmin() : false; 
	}

	public function getLoggedInUserName(){
		$user = $this->getLoggedInUser() ; 
		return $user !== null ? $user->getUserName() : ""; 
	}
	// Hämtar vilken användare som är inloggad.
	public function getLoggedInUser(){
		$id = $this->getLoggedInUserId(); 
		if($id === 0){
			return null;
		}
		return $this->userRepository->getUserWithId($id); 
	}

	public function getLoggedInUserId(){
		return \auth\model\sessionHandler::getSession($this->sessionLoginData) !== "" ? \auth\model\sessionHandler::getSession($this->sessionLoginData) : 0;
	}
	// Kontrollerar att inmatat användarnamn och lösenord stämmer vid eventuell inloggning.
	/** 
	* @return User or null 
	*/
	public function checkLogin($clientUsername, $clientPassword, $userAgent){
		//Hämta användare från DB
		$user = $this->userRepository->getUserWithUserName($clientUsername); 
		if($user !== null){
			$user->validateByPassword($clientPassword); 
		}
		if($user !== null && $user->isValidPassword()){
			// Sparar ner den inloggad användaren till sessionen.
			$this->saveUserToSession($user, $userAgent); 
	
		}
		return $user; 	
	}

	private function saveUserToSession($user, $userAgent){
		$elements = array(
			$this->sessionUserAgent => $userAgent,
			$this->sessionLoginData => $user->getUserID());	
		\auth\model\sessionHandler::setSessionArray($elements); 
	}

	// Unsettar sessionsvariabeln 
	/**
	* @return True om det finns en session
	*/
	public function logOut(){
		$ret = \auth\model\sessionHandler::sessionKeyIsSet($this->sessionLoginData); 
		\auth\model\sessionHandler::unsetSessions(); 
		return $ret; 
	}
}