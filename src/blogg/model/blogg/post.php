<?php

namespace blogg\model\blogg; 

class Post extends \core\validation\ValidatableObject {

	private $id; 
	private $user_id; 

	private $titel; 
	private $text; 
	private $time; 

	public function __construct($id = 0, $user_id = 1){
		$id = intval($id); 
		$user_id = intval($user_id); 
		if($user_id <= 0){
			throw new \Exception("Blogg::Model::Blogg::Post Argument exception __construct");
		}

		$this->id = $id; 
		$this->user_id = $user_id; 

		$this->setPropertyToValidate('titel', \core\validation\Validation::$is_string, null, "Titeln innehåller ogiltiga tecken"); 
		$this->setPropertyToValidate('titel', \core\validation\Validation::$not_empty, null, "Titeln får inte vara tomt"); 

		$this->setPropertyToValidate('text', \core\validation\Validation::$is_string, null, "Texten innehåller ogiltiga tecken"); 
		$this->setPropertyToValidate('text', \core\validation\Validation::$not_empty, null, "Du måste skriva något i ditt inlägg"); 
	}

	public function getUserId(){
		return $this->user_id; 
	}

	public function getId(){
		return $this->id; 
	}

	public function setTitel($titel){
		$this->titel = $titel; 
	}

	public function setText($text){
		$this->text = $text;
	}

	public function setTime($time){
		$this->time = intval($time);
		if($this->time === 0){
			throw new \Exception("Post::setTime Seems like you have sent an invalid value for time");			
		} 
	}

	public function setUserId($userId){
		if($this->id !== 0){
			throw new \Exception("Post::setUserId Can only be used on new objects");
			
		}
		$this->user_id = $userId; 
	}

	public function getTitel(){
		return $this->titel; 
	}

	public function getText(){
		return $this->text; 
	}
	
	public function getTime(){
		if(!$this->time){
			$this->time = time(); 
		}
		return $this->time; 
	}

	public function getErrors(){
		$ret = []; 
		foreach ($this->getErrorsOnProperty('titel') as $error) {
			$ret[] = $error;  
		}

		foreach ($this->getErrorsOnProperty('text') as $error) {
			$ret[] = $error;  
		}
		
		return $ret;
	}

	public function isValid(){
		return $this->validate($this);
	}
}