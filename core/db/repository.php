<?php 

namespace core\db; 

abstract class Repository {
	private $dbConnection; 
	protected $table;
	/**
	* @return PDO object, 
	*/
	protected function connection(){
		if($this->dbConnection == null){
			$settings = \core\Loader::load('blogg\model\admin\Settings'); 
			$settings = $settings->getBloggSettings(); 

			$this->dbConnection = new \PDO($settings->connectionString, $settings->dbUserName, $settings->dbPassword);
			if(\Config::DEBUG){
				$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		} 
		return $this->dbConnection; 
	}
	
	protected function findBy($column, $value){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
			WHERE ". $this->table ."." . $column . " = :value
		";
		$params = array(":value" => $value);
		$result = $this->query($sql, $params);
		return ($result !== null) ? $result[0] : null;
	}
	 
	protected function query($sql, $params = null, $insert = false){
		$db = $this->connection();
		$query = $db->prepare($sql); 

		if ($params !== null) {
			if (!is_array($params)) {
				$params = array($params);
			}
			$query->execute($params);
		} else {
			$query->execute(); 
		}

		if($insert){
			return $db->lastInsertId(); 
		}
		
		if($response = $query->fetchAll()){
			return $response; 
		}
		return null;
	}

}