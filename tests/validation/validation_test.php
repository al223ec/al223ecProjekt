<?php

namespace test\validation; 


use \core\validation;
require_once ('./core/validation/validation.php');

class ValidationTest extends \PHPUnit_Framework_TestCase{

	private $default = "default"; 

	/**
	* Validation method test
	*/
	/**     * @expectedException Exception     */ 
	public function testValidation(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('default', "non Existning method"); 
		$val->validate($this); 
	}

	private $prop = "string"; 
	public function getProp(){
		return $this->prop; 
	}

	public function testPropertyWithGetter(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('prop', \core\validation\validation::$not_empty);
		$this->assertTrue($val->validate($this)); 
	}


	/**
	* Test generiska metoder
	*/
	private $empty = "";
	private $notEmpty = "notEmpty"; 
	public function testNotEmpty(){
		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('empty', \core\validation\validation::$not_empty); 
		$this->assertFalse($val->validate($this));

		$val = new \core\validation\ Validation(); 
		$val->setPropertyToValidate('notEmpty', \core\validation\validation::$not_empty); 
		$this->assertTrue($val->validate($this)); 
	
	}

}