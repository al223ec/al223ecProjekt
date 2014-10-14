<?php

namespace auth\model; 

class AuthModel extends \auth\model\ModelBase{

	private $sessionLoginData = "AuthModel::LoggedInUserId";
	private $sessionUserAgent = "AuthModel::UserAgent";

	// Kontrollerar om sessions-varibeln är satt vilket betyder att en användare är inloggad.
	public function userIsLoggedIn($userAgent){
		return \auth\model\sessionHandler::getSession($this->sessionLoginData) !== "" && \auth\model\sessionHandler::getSession($this->sessionUserAgent) === $userAgent; 
	}

	// Hämtar vilken användare som är inloggad.
	public function getLoggedInUser(){
		$id = $this->getLoggedInUserId(); 
		if($id === null){
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
			$user->validate($clientPassword); 
		}
		if($user !== null && $user->isValid()){
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

	// Kontrollerar att inmatat användarnamn och lösenord stämmer vid eventuell inloggning + (med kakor och förfallodatumskontroll).
	public function checkLoginWithCookies($clientUsername, $cookieValue, $userAgent){
		$user = $this->userRepository->getUserWithUserName($clientUsername); 
		if($user === null){
			return null; 
		}
		$user->validateByCookieValue($cookieValue); 
		
		if($user->getCookieTime() < time()){
			return null; 
		}
		if($user->isValid()){
			$this->saveUserToSession($user, $userAgent); 
			return $user; 
		}
		return null; 
	}

	//Sparar aktuellt cookievaule och tid till dB
	public function saveCookieValue($value, $cookieTime){
		$userID = $this->getLoggedInUser() !== null ? $this->getLoggedInUser()->getUserID() : 0; 
		$this->userRepository->saveCookieValue($userID, $value, $cookieTime); 
	}

	// Unsettar sessionsvariabeln 
	/**
	* @return True om det finns en session
	*/
	public function logOut(){
		$ret = \auth\model\sessionHandler::sessionKeyIsSet($this->sessionLoginData); 
		if($ret){
			$this->userRepository->resetCookieValues($this->getLoggedInUserId()); 
		}
		\auth\model\sessionHandler::unsetSessions(); 
		return $ret; 
	}
}