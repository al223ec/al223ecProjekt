<?php

namespace core; 

abstract class ObjectBase {
	private $validation; 
	
	protected function setPropertyToValidate($property, $method, $arg = null, $message = "Error on property!"){
		if($this->validation === null){
			$this->validation = new \core\validation\ Validation(); 
		}
		$this->validation->setPropertyToValidate($property, $method, $arg, $messag); 
	}

	protected function getErrorsOnProperty($property){
		if($this->validation === null){
			throw new \Exception("ObjectBase::getErrorsOnProperty You haven't set any properties to validate!");  
		}
		return $this->validation->getErrorsOnProperty($property); 
	}

	public abstract function getErrors(); 
	public abstract function validate(); 
}