<?php
namespace test\validation; 

use \core\validation;
require_once ('./core/validation/validation.php');

class ValidationStringsTest extends \PHPUnit_Framework_TestCase{

	/**
	* String test validation
	*/
	private $isString = "string"; 
	private $notString = 123; 

	public function testValidString(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('isString', \core\validation\validation::$is_string); 
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notString', \core\validation\validation::$is_string); 
		$this->assertFalse($val->validate($this));
	}

	private $lengthString = "length";
	public function testMinLength(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('lengthString', \core\validation\validation::$min_length, 3); 
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('lengthString', \core\validation\validation::$min_length, 30); 
		$this->assertFalse($val->validate($this));
	}

	public function testMaxLength(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('lengthString', \core\validation\validation::$max_length, 3); 
		$this->assertFalse($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('lengthString', \core\validation\validation::$max_length, 30); 
		$this->assertTrue($val->validate($this));
	}

	private $alphaNum = "abcdefghijklmnopqwrstuvxyz0123456789"; 
	private $notAlphaNum = "ÅÖÄ*^¨¨åöä"; 

	public function testAlphaNum(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('alphaNum', \core\validation\validation::$alpha_num);
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notAlphaNum', \core\validation\validation::$alpha_num);
		$this->assertFalse($val->validate($this));
	}

	private $onlyNumberString = "123456789"; 
	private $notOnlyNumbersStrin = "123asd"; 

	public function testRegex(){
		$regex = "/\D/";
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('onlyNumberString', \core\validation\validation::$regex, $regex);
		$this->assertTrue($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notOnlyNumbersStrin', \core\validation\validation::$regex, $regex);
		$this->assertFalse($val->validate($this));
	}
}