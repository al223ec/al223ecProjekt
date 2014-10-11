<?php

namespace test\validation; 


use \core\validation;
require_once ('./core/validation/validation.php');

class ValidationErrorMessagesTest extends \PHPUnit_Framework_TestCase{
	
	private $int = 2223; 
	private $notNumeric = ""; 

	/**
	* Felmeddelande tester
	*/
	public function testDisplayErrorMessage(){
		$errorMessage = "Ett felmmeddelande som kan läsas ut om det är något fel";

		$validation = new \core\validation\ Validation(); 
		$validation->setPropertyToValidate('notNumeric', \core\validation\validation::$is_numeric, null, $errorMessage); 
		$validation->validate($this); 
		$this->assertEquals($validation->getErrorsOnProperty('notNumeric')[0], $errorMessage); 
		$this->assertCount(0, $validation->getErrorsOnProperty('nonExistingProperty')); 
	}

	public function testDontDisplayErrorMessages(){
		$errorMessage = "Ett felmmeddelande som kan läsas ut om det är något fel";
		$validation = new \core\validation\ Validation(); 
		$validation->setPropertyToValidate('int', \core\validation\validation::$is_numeric, null, $errorMessage);

		$validation->validate($this); 
		$this->assertCount(0, $validation->getErrorsOnProperty('int')); 
	}

	public function testSeveralErrorMessagesOnProperty(){
		$errorMessage = "Ett felmmeddelande som kan läsas ut om det är något fel";
		$errorMessage2 = "Ett till meddelande"; 
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notNumeric', \core\validation\validation::$is_numeric, null, $errorMessage); 
		$val->setPropertyToValidate('notNumeric', \core\validation\validation::$max_value, 1000, $errorMessage2); 
		$val->validate($this); 
		
		$this->assertEquals($val->getErrorsOnProperty('notNumeric')[0], $errorMessage); 
		$this->assertEquals($val->getErrorsOnProperty('notNumeric')[1], $errorMessage2); 	
	}

	public function testSeveralErrorMessagesOnSeveralProperties(){
		//TODO::Detta
	}

}