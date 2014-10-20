<?php

namespace blogg\view\admin; 

class AdminView extends \blogg\view\BaseView {

	private $userNamePost = 		"RegisterUserView::UserName";	
	private $passwordPost = 		"RegisterUserView::Password";	
	private $repeatedPasswordPost = "RegisterUserView::RepeatedPassword";	
	private $model; 

	private $errorMessages; 
	const PasswordErrorKey = 	"PasswordError"; 
	const UserNameErrorKey = 	"UserNameError"; 

	public function __construct($adminIsLoggedIn, $adminModel){
		$this->model = $adminModel; 
		$this->errorMessages = array(); 

		$this->setViewVars(array(
			"adminIsLoggedIn" => $adminIsLoggedIn,
			"userNamePost" => $this->userNamePost, 
			"passwordPost" => $this->passwordPost,
			"repeatedPasswordPost" => $this->repeatedPasswordPost
			)
		);

		$this->setPageTitel("Admin page!");
	}	

	private function getUserName(){
		$ret = $this->getCleanInput($this->userNamePost);
		
		if($ret !== $this->getInput($this->userNamePost)){
			$this->errorMessages[self::UserNameErrorKey] = "Användarnamnet innehåller ogiltiga tecken!";
			$ret = ""; 
		}else if($ret === ""){
			$this->errorMessages[self::UserNameErrorKey] = "Användarnamnet saknas";
		}else if($this->model->ceckIfUserNameExists($ret)){
			$this->errorMessages[self::UserNameErrorKey] = "Användarnamnet finns redan";
			$ret = ""; 
		}/*else if(strlen($ret) < \config\Config::UserNameMinLength){
			$this->errorMessages[self::UserNameErrorKey] = "Användarnamnet är för kort";
			$ret = "";
		}*/

		return $ret; 
	}

	private function getPassword(){
		$ret = $this->getInput($this->passwordPost);
		if($ret === ""){
			$this->errorMessages[self::PasswordErrorKey] = "Lösenordet saknas";
		} 
		if ($ret !== $this->getInput($this->repeatedPasswordPost)) {
			$this->errorMessages[self::PasswordErrorKey] = "Lösenorden stämmer inte överens";
			$ret = "";	
		}
		/*else if(strlen($ret) < \config\Config::PasswordMinLength){
			$this->errorMessages[self::PasswordErrorKey] = "Lösenordet är för kort!";
			$ret = "";
		}*/
		return $ret; 
	}

	public function getNewUser(){
 		$userName = $this->getUserName(); 
		$password = $this->getPassword(); 

		if($userName !== "" && $password !== ""){
			$user = new \auth\model\User();
			$user->setUserName($userName); 
			$user->setPassword($password);  

			return $user; 
		} else {
			$this->setErrorVar(); 
		}
		return null; 
	}

	private function setErrorVar(){
		$this->setViewVar("errorMessages", $this->errorMessages); 
	}

	public function setSavedUserVar($user){
		$this->setViewVar("user" ,$user); 
	}

}