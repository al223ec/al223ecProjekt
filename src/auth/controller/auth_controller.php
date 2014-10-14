<?php

namespace auth\controller; 

class AuthController extends \core\Controller{

	private $helpers;
	private $authView;
	private $userView;
	private $authModel;

	public function userIsLoggedIn(){
		return $this->authModel->userIsLoggedIn($this->getUserAgent()); 
	} 
	public function getCurrentUserId(){
		return $this->authModel->getLoggedInUserId();
	}

	public function __construct(){
      	parent::__construct();

		$this->authModel = new \auth\model\AuthModel();
		$this->authView = new \auth\view\auth\AuthView($this->authModel);
		$this->userView = new \auth\view\auth\UserView($this->authModel);
	}


	/**
	* Kontroller om användaren är inloggad
	*/
	public function main(){
		$userAgent = $this->getUserAgent();

		if($this->authView->userIsRemembered() && !$this->authModel->userIsLoggedIn($userAgent)){
			$loggedInUser = $this->authModel->checkLoginWithCookies($this->authView->getUsernameCookie(), $this->authView->getPasswordCookie(), $userAgent); 
			
			if($loggedInUser !== null && $loggedInUser->isValid()){
				$this->userView->successfullLogInWithCookiesLoad();						
			} else{
				$this->authView->setFaultyCookiesMessage(); 
				$this->authView->forgetRememberedUser();
			}
		}

		if($this->authModel->userIsLoggedIn($userAgent)){
			$this->masterPage->setAuthView($this->userView->showUser());
			return;
		}
		$this->masterPage->setAuthView($this->authView->showLogin());
	}
	
	//Denna funktion behöver flyttas
	private function getUserAgent(){
		return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
	}

	public function login(){
		$userAgent = $this->getUserAgent();	
		// Hämtar användarnamn och lösenord.
		$clientUsername = $this->authView->getUsername();
		$clientPassword = $this->authView->getPassword();		
		$user = null; 

		// Kontrollerar om användarnamn och lösenord överensstämmer med sparad data.
		if($clientUsername !== ""){
			$user = $this->authModel->checkLogin($clientUsername, $clientPassword, $userAgent);
		}		

		if($user !== null && $user->isValid()){
			// Om "Håll mig inloggad" är ikryssad, spara i cookies.
			if ($this->authView->RememberMeIsFilled()) {
				$this->authView->saveToCookies($clientUsername, $clientPassword);
				$this->userView->successfullLogInWithCookiesSaved();
			} else {
				$this->userView->successfullLogIn();
			}
			//Lyckad inloggning
			\auth\view\ViewBase::redirect();
			exit();
		} else if($clientUsername !== ""){
			$this->authView->populateErrorMessage($user);
		}
		$this->masterPage->setAuthView($this->authView->showLogin());
	}

	public function logout(){
		$this->authView->forgetRememberedUser();
		$this->authView->setLogOutMessage(); 
		$this->authModel->logOut();	

		\auth\view\ViewBase::redirect();	
		exit();
	}
}