<?php

namespace auth\model\repository;

class UserRepository Extends \core\db\Repository{
	
	public function __construct(){
		$this->table = "users"; 
	}


	public function addUser(\auth\model\User $newUser){
		try{
			$userName = $newUser->getUserName(); 
			$passwordHash = $newUser->getPasswordHash(); 
			
			$sql = "INSERT INTO " . $this->table . "(user_name, password_hash) VALUES( :userName, :passwordHash)";
			$params = array(":userName" => $userName, ":passwordHash" => $passwordHash); 
			return $this->query($sql, $params, true);
		}
		catch(\Exception $e){
			throw $e; 
		}
	}

	public function getUserWithUserName($userName){
		$user = null; 
		$userDbo = $this->findBy('user_name', $userName); 
		if($userDbo !== null){
			$user = new \auth\model\User($userDbo['id']); 
			$user->setPasswordHash($userDbo['password_hash']); 
			$user->setUserName($userDbo['user_name']); 
			$user->setCookieTime($userDbo['cookie_time']); 
			$user->setCookieTime($userDbo['cookie_value']); 
		}

		return $user; 
	}

	public function getUserWithId($id){
		$user = null; 
		$userDbo = $this->findBy('id', $id); 
		if($userDbo !== null){
			$user = new \auth\model\User($userDbo['id']); 
			$user->setPasswordHash($userDbo['password_hash']); 
			$user->setUserName($userDbo['user_name']); 
			$user->setCookieTime($userDbo['cookie_time']); 
			$user->setCookieTime($userDbo['cookie_value']); 
		}

		return $user; 
	}


	public function saveCookieValue($userId, $cookieValue, $cookieTime){
		$sql = "UPDATE " . $this->table . " SET cookie_value = :cookieValue, cookie_time = :cookieTime WHERE id = :id"; 
		$params = array(":cookieValue" => $cookieValue, ":cookieTime" => $cookieTime, ":id" => $userId); 
		return $this->query($sql, $params, true);
		
	}

	public function resetCookieValues($userId){
		return $this->saveCookieValue($userId, null, 0); 
	}
}