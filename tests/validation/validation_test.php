<?php

namespace test\validation; 


use \core\validation;
require_once ('./core/validation/validation.php');

class ValidationTest extends \PHPUnit_Framework_TestCase{

	private $default = "default"; 
	private $int = 2223; 
	private $notInt = 1.23455; 
	private $notNumeric = ""; 
	private $max_int = 2223; 
	private $float = 1.23455; 
	/**
	* Validation method test
	*/
	/**     * @expectedException Exception     */ 
	public function testValidation(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('default', "non Existning method"); 
		$val->validate($this); 
	}
	//Namngivning
	private $prop = "string"; 
	public function getProp(){
		return $this->prop; 
	}

	public function testPropertyWithGetter(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('prop', \core\validation\validation::$not_empty);
		$this->assertTrue($val->validate($this)); 
	}


	/**
	* Test generiska metoder
	*/
	private $empty = "";
	private $notEmpty = "notEmpty"; 
	public function testNotEmpty(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('empty', \core\validation\validation::$not_empty); 
		$this->assertFalse($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notEmpty', \core\validation\validation::$not_empty); 
		$this->assertTrue($val->validate($this)); 
	
	}
	/**
	* String test validation
	*/
	private $isString = "string"; 
	private $notString = 123; 

	public function testValidString(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('isString', \core\validation\validation::$is_string); 
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notString', \core\validation\validation::$is_string); 
		$this->assertFalse($val->validate($this));
	}

	private $lengthString = "length";
	public function testMinLength(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('lengthString', \core\validation\validation::$min_length, 3); 
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('lengthString', \core\validation\validation::$min_length, 30); 
		$this->assertFalse($val->validate($this));
	}

	public function testMaxLength(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('lengthString', \core\validation\validation::$max_length, 3); 
		$this->assertFalse($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('lengthString', \core\validation\validation::$max_length, 30); 
		$this->assertTrue($val->validate($this));
	}

	private $alphaNum = "abcdefghijklmnopqwrstuvxyz0123456789"; 
	private $notAlphaNum = "ÅÖÄ*^¨¨åöä"; 

	public function testAlphaNum(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('alphaNum', \core\validation\validation::$alpha_num);
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notAlphaNum', \core\validation\validation::$alpha_num);
		$this->assertFalse($val->validate($this));
	}

	private $onlyNumberString = "123456789"; 
	private $notOnlyNumbersStrin = "123asd"; 
	public function testRegex(){
		$regex = "/\D/";
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('onlyNumberString', \core\validation\validation::$regex, $regex);
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notOnlyNumbersStrin', \core\validation\validation::$regex, $regex);
		$this->assertFalse($val->validate($this));
	}

	/**
	* Felmeddelande tester
	*/
	public function testErrorMessage(){
		$errorMessage = "Ett felmmeddelande som kan läsas ut om det är något fel";

		$vDisplayMessage = new \core\validation\ Validation(); 
		$vDisplayMessage->setFieldToValidate('notNumeric', \core\validation\validation::$is_numeric, null, $errorMessage); 
		$vDisplayMessage->validate($this); 
		$this->assertEquals($vDisplayMessage->getErrorsOnProperty('notNumeric')[0], $errorMessage); 
		$this->assertEquals($vDisplayMessage->getErrorsOnProperty('nonExistingProperty')[0], ""); 

		$vDontDisplayMessage = new \core\validation\ Validation(); 
		$vDontDisplayMessage->setFieldToValidate('int', \core\validation\validation::$is_numeric, null, $errorMessage);

		$vDontDisplayMessage->validate($this); 
		$this->assertEquals($vDontDisplayMessage->getErrorsOnProperty('int')[0], ""); 
	}

	public function testSeveralErrorMessagesOnProperty(){
		$errorMessage = "Ett felmmeddelande som kan läsas ut om det är något fel";
		$errorMessage2 = "Ett till meddelande"; 
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notNumeric', \core\validation\validation::$is_numeric, null, $errorMessage); 
		$val->setFieldToValidate('notNumeric', \core\validation\validation::$max_value, 1000, $errorMessage2); 
		$val->validate($this); 
		
		$this->assertEquals($val->getErrorsOnProperty('notNumeric')[0], $errorMessage); 
		$this->assertEquals($val->getErrorsOnProperty('notNumeric')[1], $errorMessage2); 	
	}

	public function testSeveralErrorMessagesOnSeveralProperties(){
		//TODO::Detta
	}


	/**
	*	Numeriska test metoder
	*/
	public function testIsNumeric(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('int', \core\validation\validation::$is_numeric); 
		$this->assertTrue($val->validate($this)); 
	}

	public function testIsNotNumeric(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notNumeric', \core\validation\validation::$is_numeric); 
		$this->assertFalse($val->validate($this)); 
	}

	public function testIsInt(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('int', \core\validation\validation::$is_int); 

		$this->assertTrue($val->validate($this)); 
	}
	
	public function testIsNotInt(){
		$val = new \core\validation\ Validation(); 
		$val->setFieldToValidate('notInt', \core\validation\validation::$is_int); 
		$this->assertFalse($val->validate($this)); 
	}
	public function testMaxValue(){
		$validateWithHigherValue = new \core\validation\ Validation(); 
		$validateWithHigherValue->setFieldToValidate('int', \core\validation\validation::$max_value, 50000); 

		$validateWithLowerValue = new \core\validation\ Validation(); 
		$validateWithLowerValue->setFieldToValidate('int', \core\validation\validation::$max_value, 50); 

		$this->assertTrue($validateWithHigherValue->validate($this)); 
		$this->assertFalse($validateWithLowerValue->validate($this));
	}

	public function testMinValue(){
		$validateWithHigherValue = new \core\validation\ Validation(); 
		$validateWithHigherValue->setFieldToValidate('int', \core\validation\validation::$min_value, 50000); 

		$validateWithLowerValue = new \core\validation\ Validation(); 
		$validateWithLowerValue->setFieldToValidate('int', \core\validation\validation::$min_value, 50); 

		$this->assertFalse($validateWithHigherValue->validate($this)); 
		$this->assertTrue($validateWithLowerValue->validate($this));
	}

}