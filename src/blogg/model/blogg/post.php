<?php

namespace blogg\model\blogg; 

class Post extends \core\BaseObject {

	private $id; 
	private $user_id; 
	private $titel; 
	private $text; 

	public function __construct($id = 0, $user_id = 1){
		if(!is_int($id) || !is_int($user_id)){
			throw new \Exception("Blogg::Model::Blogg::Post Argument exception __construct");
		}
		$this->validation = new \core\validation\ Validation(); 

		$this->id = $id; 
		$this->user_id = $user_id; 

		$this->setPropertyToValidate('titel', \core\validation\Validation::$is_string, null, "Titeln innehåller ogiltiga tecken"); 
		$this->setPropertyToValidate('titel', \core\validation\Validation::$not_empty, null, "Titeln får inte vara tomt"); 

		$this->setPropertyToValidate('text', \core\validation\Validation::$is_string, null, "Texten innehåller ogiltiga tecken"); 
		$this->setPropertyToValidate('text', \core\validation\Validation::$not_empty, null, "Du måste skriva något i ditt inlägg"); 
	}

	public function setTitel($titel){
		$this->titel = $titel; 
	}

	public function setText($text){
		$this->text = $text;
	}


	
	public function getErrors(){
		$ret = ""; 
		foreach ($this->getErrorsOnProperty('titel') as $error) {
			$ret .= $error . " - ";  
		}

		foreach ($this->getErrorsOnProperty('text') as $error) {
			$ret .= $error . " - ";  
		}
		return $ret;
	}

	public function isValid(){
		return $this->validate($this);
	}



}