<?php

namespace auth\controller; 

class AuthController extends \core\Controller{
	//TODO:se över authmodel också, har endast gjort om vy delen och den här kontrollern
	private $authModel;

	public function userIsLoggedIn(){
		return $this->authModel->userIsLoggedIn($this->getUserAgent()); 
	} 
	public function isAdminLoggedIn(){
		//TODO: få till detta på ett vettigt sätt
		return $this->authModel->isLoggedInUserAdmin(); 
	}
	public function getCurrentUserId(){
		return $this->authModel->getLoggedInUserId();
	}

	public function __construct(){
		$this->authModel = new \auth\model\AuthModel();
		$this->view = new \auth\view\auth\AuthView($this->authModel);
	}

	public function main(){
		$userAgent = $this->getUserAgent();
		$this->view->setUserIsLoggedInVar($this->authModel->userIsLoggedIn($userAgent));
		$this->view->setLoggedInUserNameVar($this->authModel->getLoggedInUserName()); 
		$this->view->setMessageVar();
	}
	
	//Denna funktion behöver flyttas
	private function getUserAgent(){
		return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
	}

	public function login(){
		$userAgent = $this->getUserAgent();	
		// Hämtar användarnamn och lösenord.
		$clientUsername = $this->view->getUsername();
		$clientPassword = $this->view->getPassword();		
		$user = null; 

		// Kontrollerar om användarnamn och lösenord överensstämmer med sparad data.
		if($clientUsername !== ""){
			$user = $this->authModel->checkLogin($clientUsername, $clientPassword, $userAgent);
		}		

		if($user !== null && $user->isValidPassword()){
			$this->view->successfullLogIn();
			$this->redirectTo();

		} else if($clientUsername !== ""){
			$this->view->populateErrorMessage($user);
		}
	}

	public function logout(){
		$this->view->setLogOutMessage(); 
		$this->authModel->logOut();
		
		$this->redirectTo();
	}
}