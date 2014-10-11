<?php


namespace test\validation; 
use \core\validation;
require_once ('./core/validation/validation.php');

class ValidationNumericTest extends \PHPUnit_Framework_TestCase{

	private $int = 2223; 
	private $notInt = 1.23455; 
	private $notNumeric = ""; 
	private $max_int = 2223; 
	private $float = 1.23455; 

	/**
	*	Numeriska test metoder
	*/
	public function testIsNumeric(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('int', \core\validation\validation::$is_numeric); 
		$this->assertTrue($val->validate($this)); 
	}

	public function testIsNotNumeric(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notNumeric', \core\validation\validation::$is_numeric); 
		$this->assertFalse($val->validate($this)); 
	}

	public function testIsInt(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('int', \core\validation\validation::$is_int); 

		$this->assertTrue($val->validate($this)); 
	}
	
	public function testIsNotInt(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notInt', \core\validation\validation::$is_int); 
		$this->assertFalse($val->validate($this)); 
	}
	public function testMaxValue(){
		$validateWithHigherValue = new \core\validation\ Validation(); 
		$validateWithHigherValue->setPropertyToValidate('int', \core\validation\validation::$max_value, 50000); 

		$validateWithLowerValue = new \core\validation\ Validation(); 
		$validateWithLowerValue->setPropertyToValidate('int', \core\validation\validation::$max_value, 50); 

		$this->assertTrue($validateWithHigherValue->validate($this)); 
		$this->assertFalse($validateWithLowerValue->validate($this));
	}

	public function testMinValue(){
		$validateWithHigherValue = new \core\validation\ Validation(); 
		$validateWithHigherValue->setPropertyToValidate('int', \core\validation\validation::$min_value, 50000); 

		$validateWithLowerValue = new \core\validation\ Validation(); 
		$validateWithLowerValue->setPropertyToValidate('int', \core\validation\validation::$min_value, 50); 

		$this->assertFalse($validateWithHigherValue->validate($this)); 
		$this->assertTrue($validateWithLowerValue->validate($this));
	}
}