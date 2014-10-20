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
			$isAdmin = $newUser->getIsAdmin(); 

			$sql = "INSERT INTO " . $this->table . "(user_name, password_hash, is_admin) VALUES( :userName, :passwordHash, :isAdmin)";
			$params = array(":userName" => $userName, ":passwordHash" => $passwordHash, ":isAdmin" ); 
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
			$user->setIsAdmin($userDbo['is_admin']);
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
			$user->setIsAdmin($userDbo['is_admin']);
		}

		return $user; 
	}

	public function getUserNameById($id){
		$userDbo = $this->findBy('id', $id); 
		
		if($userDbo !== null){
			return $userDbo['user_name'];
		}
		return "";  
	}
}