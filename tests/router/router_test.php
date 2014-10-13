<?php

namespace test\validation;

class RouterTest  extends \PHPUnit_Framework_TestCase {

	private $validURL;      
	private $param = "123"; 

 	public static function setUpBeforeClass (){
 		//Ganska svårtestad med tanke på alla routes som måste defineras
		//Det funkar att hårdkoda lokalt iaf. 
		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT_DIR', "C:\ProjektPHP\al223ecProjekt\\" . DS);
		define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');
		//define('SRC_DIR', "C:\ProjektPHP\al223ecProjekt\src" . DS);
		require_once ('./core/router.php');
		require_once ('./core/definer.php');
		require_once ('./core/config.php');
 	}


	public function setUp(){
		$this->validURL = \Config::DEFAULT_CONTROLLER . "/" . \Config::DEFAULT_ACTION . "/" . $this->param;

	}
	/**
	* Fallback tester
	*/
	public function testFallbackController(){
		$router = new \core\ Router(null);
		$this->assertEquals($router->getController(), \Config::DEFAULT_CONTROLLER);  
	}

	public function testFallbackAction(){
		$url = \Config::DEFAULT_CONTROLLER . "/"; 
		$router = new \core\ Router($url);
		$this->assertEquals($router->getAction(), \Config::DEFAULT_ACTION);  
	}

	/**
	* 	Ogiltiga url:er, bör utökas
	*/
	public function testFallbackControllerInvalidURL(){
		$invalidURL = "*^??=/"; 
		$router = new \core\ Router($invalidURL);
		$this->assertEquals($router->getController(), \Config::DEFAULT_CONTROLLER);  
	}

	/**
	* Testar att kontrollern defakto blir satt
	*/
	public function testSetController(){
		$url = \Config::DEFAULT_CONTROLLER . "/";
		$router = new \core\ Router($url);
		$this->assertEquals($router->getController(), \Config::DEFAULT_CONTROLLER);  

		$controller = "somecontroller"; 
		$url = $controller . "/";
		$router = new \core\ Router($url);
		$this->assertEquals($router->getController(), $controller);  
	}

	/**
	* Params 
	*/
	public function testParam(){
		$router = new \core\ Router($this->validURL); 
		$this->assertEquals($router->getParams()[0], $this->param);

		$param1 = "abc"; 
		$router = new \core\ Router($this->validURL . "/" . $param1); 

		$this->assertEquals($router->getParams()[0], $this->param);
		$this->assertEquals($router->getParams()[1], $param1);

	}
	/**
	*	Giltiga url
	*/
	public function testValidURL(){
		$router = new \core\ Router($this->validURL); 
		$this->assertEquals($router->getController(), \Config::DEFAULT_CONTROLLER);
	}

	/**
	* Dispatch method tester
	*/
	/**     * @expectedException Exception     */ 
	public function testDispatchControllerFileDoesntExists(){
		$controller = "somecontrollerthatdosentexists"; 
		$url = $controller . "/";
		$router = new \core\ Router($url);
		$router->dispatch(); 
	}
	/**     * @expectedException Exception     */ 
	public function testDispatchActionDoesntExists(){
		$controller = \Config::DEFAULT_CONTROLLER . "/unknownAction"; 
		$url = $controller . "/";
		$router = new \core\ Router($url);
		$router->dispatch(); 
	}


	public function testSuccessfullDispatch(){
		$router = new \core\ Router($this->validURL); 
		//Kommer nog i framtiden att returnera någon form av view objekt 
		$this->assertTrue(is_string ($router->dispatch())); 
	}






	public function testStaticRoutes(){
		//Svårtestad
		//assertEquals( \core\ Routes::getRoute(\Config::DEFAULT_CONTROLLER, \Config::DEFAULT_ACTION)); 
	}
	
}