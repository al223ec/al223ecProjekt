<?php

namespace core\validation; 

class Validation{
	/**
	*	Generic validation methods
	*/
	public static $not_empty = "_not_empty"; 
	public static $regex = "_regex";	
	/**
	*	String validation methods
	*/
	public static $is_string = "_is_string"; 
	public static $min_length = "_min_length"; 
	public static $max_length = "_max_length"; 
	public static $alpha_num = "_alpha_num"; 
	/**
	*	Numeric validation methods
	*/
	public static $is_numeric = "_is_numeric"; 
	public static $is_int = "_is_int"; 
	public static $max_value = "_max_value"; 
	public static $min_value = "_min_value"; 

	private $errorMessages; 
	private $properties; 

	public function __construct(){
		$this->errorMessages = array();
		$this->properties = array();   
	}

	public function setPropertyToValidate($property, $method, $arg = null, $message = "Error on property!"){
		//kontrollera om rulen redan är sattt
		$this->properties[$property][] = new ValidationMethod($method, $arg, $message); 
	}

	public function validate($that){

		foreach ($this->properties as $property => $validationMethods) {
			if(!method_exists($that,'get' . $property)){ //Fältet är privat 
				$reflection = new \ReflectionClass($that);

				$reflectedProperty = $reflection->getProperty($property);
				$reflectedProperty->setAccessible(true); //Ordna så den privata variabeln går att komma åt
	
				//$objStr = "\\" . $reflection->getName(); tror inte denna är nödvändig
				$obj = new $that(); 
				$valueToValidate = $reflectedProperty->getValue($obj); //Läs den privata variabeln

			} else {
				$valueToValidate = call_user_func_array(array($that, 'get' . $property), array());
			}		
			
			foreach ($validationMethods as $validationMethod) {
				$method = $validationMethod->getMethod(); 

				if(!method_exists($this, $method)){ 
					throw new \Exception("Validation::validate Validation Saknar $method funktionen");
				}

				$result = $this->$method($valueToValidate, $validationMethod->getArg());
				$validationMethod->setValid($result);

				if(!$result){ 
					$this->errorMessages[$property][] = $validationMethod->getMessage(); 
				}
			}
		}
		
		return $this->isValid(); 
	}
	
	private function isValid(){
		foreach ($this->properties as $validationMethods) {
			foreach ($validationMethods as $validationMethod) {
				if(!$validationMethod->isValid()){
					return false; 
				}
			}
		}
		return true; 
	}
	/* Jävligt oklart om jag ska ha denna funktionen 
	public function getErrors(){
		return $this->errorMessages; 
	}
	*/
	public function getErrorsOnProperty($property){
		//throw errors
		return isset($this->errorMessages[$property]) ? $this->errorMessages[$property] : array(); //konsekvent alltid en array
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

class ValidationMethod { //Bättre namn på gång? 
	
	private $method; 
	private $arg;
	private $message;
	private $valid; 

	public function __construct($method, $arg, $message){
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