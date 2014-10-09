<?php

namespace core\validation; 

class Validation{

	public static $max_length = "_max_length"; 
	
	private $errorMessages; 
	private $fields; 

	public function __construct(){
		$this->errorMessages = array();
		$this->fields = array();   
	}

	public function setFieldToValidate($field, $method, $arg, $message){
		//kontrollera om rulen redan är sattt
		$this->fields[$field][] = new ValidationMethod($method, $arg, $message); 
	}

	public function validate($that){
		foreach ($this->fields as $field => $validationMethods) {
			if(!method_exists($that,'get' . $field)){ 
				throw new \Exception("Validation::validate funktion get" . $field . " saknas");
			}

			$valueToValidate = call_user_func_array(array($that, 'get' . $field), array());
			
			foreach ($validationMethods as $validationMethod) {
				$method = $validationMethod->getMethod(); 

				if(!method_exists($this, $method)){ 
					throw new \Exception("Validation::validate Validation Saknar $method funktionene");
				}

				$result = $this->$method($valueToValidate, $validationMethod->getArg());
				$validationMethod->setValid($result);

				if(!$result){ 
					$this->errorMessages[$field][] = $validationMethod->getMessage(); 
				}
			}
		}
		
		return $this->isValid(); 
	}
	
	private function isValid(){
		foreach ($this->fields as $validationMethods) {
			foreach ($validationMethods as $validationMethod) {
				if(!$validationMethod->isValid()){
					return false; 
				}
			}
		}
		return true; 
	}

	public function getErrors(){
		return $this->errorMessages; 
	}

	/**
	*	Generic validation methods
	*/
	private function _not_empty($var){
		return !empty($var);
	}
	private function _regex($var, $regex){
		return !preg_match($regex, $var);
	}
	
	/**
	*	String validation methods
	*/
	private function _is_string($var){
		return is_string($var);
	}
	private function _min_length($var, $min){
		return (is_string($var) && strlen($var) >= $min);
	}
	private function _max_length($var, $max){
		return (is_string($var) && strlen($var) <= $max);
	}
	private function _alpha_num($var){
		return !preg_match('/[^a-z0-9]/i', $var);
	}
	
	/**
	*	Numeric validation methods
	*/
	private function _is_numeric($var){
		return is_numeric($var);
	}
	private function _is_int($var){
		return is_int($var);
	}
	private function _max_value($var, $max){
		return (is_numeric($var) && $var <= $max);
	}
	private function _min_value($var, $min){
		return (is_numeric($var) && $var >= $min);
	}
}

class ValidationMethod {
	
	private $method; 
	private $arg;
	private $message;
	private $valid; 

	public function __construct($method, $arg = null, $message = "Ett error message"){
		$this->method = $method; 
		$this->arg = $arg; 
		$this->message = $message;  
	}

	public function getMethod(){
		return $this->method; 
	}

	public function getArg(){
		return $this->arg; 
	}

	public function getMessage(){
		return $this->message;
	}

	public function setValid($valid){
		$this->valid = $valid; 
	}
	public function isValid(){
		return $this->valid; 
	}
}


/** Användningsexempel
*
*/
/*
	$val = new \model\Validation();
	$val->setFieldToValidate('ssn', '_max_length', self::$ssnMaxLength, "Error message max length");
	$val->setFieldToValidate('ssn', '_min_length', self::$ssnMinLength, "Error message min length");

	var_dump($val->validate($this));
	foreach ($val->getErrors() as $field => $errors) {
		foreach ($errors as $error) {
			echo "Fel på fältet $field " . $error;
		}
	}
	die();
*/ 