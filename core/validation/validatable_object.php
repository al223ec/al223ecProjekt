<?php

namespace core\validation; 

abstract class ValidatableObject {

	private $validation; 
	
	protected function setPropertyToValidate($property, $method, $arg = null, $message = "Error on property!"){
		if($this->validation === null){
			$this->validation = new \core\validation\Validation(); 
		}
		$this->validation->setPropertyToValidate($property, $method, $arg, $message); 
	}

	protected function getErrorsOnProperty($property){
		if($this->validation === null){
			throw new \Exception("ObjectBase::getErrorsOnProperty You haven't set any properties to validate!");  
		}
		return $this->validation->getErrorsOnProperty($property); 
	}

	protected function validate($that){
		return $this->validation->validate($that); 
	}

	public abstract function getErrors();
	public abstract function isValid(); 
}