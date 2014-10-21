<?php

namespace auth\view\auth; 


class AuthView extends \auth\view\ViewBase{
	
	private $userNamePost = "LoginView::Username";		// Användarnamnets kakas namn.
	private $passwordPost = "LoginView::Password";		// Lösenordets kakas namn.
	
	public function __construct(\auth\model\AuthModel $model){
		parent::__construct($model);
		
		$errorMessage = array(); 

		$this->setViewVars(array(
			"userNamePost" => $this->userNamePost,
			"passwordPost" => $this->passwordPost
			)
		); 
	}

	public function populateErrorMessage($user){
		if($user === null){ 
			$this->setErrorMessageVar("Felaktigt användarnamn"); 	
		} else if(!$user->isValidPassword()){
			$this->setErrorMessageVar("Felaktigt lösenord"); 
		}
	}
	
	// Hämtar Användarnamnet vid rätt input.
	public function getUsername(){
		$ret = $this->getCleanInput($this->userNamePost); 
		if($ret === ""){
			$this->setErrorMessageVar("Användarnamn saknas!");
			return ""; 
		}
		return $ret; 
	}

	// Hämtar lösenordet vid rätt input.
	public function getPassword(){
		$ret = $this->getCleanInput($this->passwordPost); 
		if($ret === ""){
			$this->setErrorMessageVar("Lösenord saknas!");	
		}
		return $ret; 
	}

	public function setErrorMessageVar($errorMessage){
		if(array_key_exists("errorMessage", $this->getViewVars())){
			$value = $this->getViewVars()["errorMessage"] . " " . $errorMessage; 
			$this->setViewVar("errorMessage", $value); 
 		}else {
			$this->setViewVar("errorMessage", $errorMessage); 
		}
	}
	public function setLogOutMessage(){
		$this->model->setSessionReadOnceMessage("Du har nu loggat ut!");
	}

	public function setUserIsLoggedInVar($userIsLoggedIn){
		$this->setViewVar("userIsLoggedIn", $userIsLoggedIn); 
	}

	public function setMessageVar(){
		$this->setViewVar("message", $this->getMessage());
	}

	public function successFullLogin(){
		$this->model->setSessionReadOnceMessage("Du har loggat in!"); 
	}

	public function setLoggedInUserNameVar($loggedInUserName){
		$this->setViewVar("loggedInUserName", $loggedInUserName); 
	}

}