<?php 

namespace core; 

class Router{
	/**
	* Routens uppgift är att dela upp url:en och disturbera dessa delar
	*/

	private $controller;
	private $action;
	private $params;

	public function __construct($routeForTesting = ""){
		//För att göra det möjligt att testa denna klass utifrån 
		$route = isset($_GET['url']) ? $_GET['url'] : '';
		$route = $routeForTesting !== "" ? $routeForTesting : $route; 
		//Se till att inte otillåtna tecken skickas med i urlen
		if(preg_match(\Config::ALLOWED_URL_CHARS, $route)){
			$route = ""; 
		}

		$routeParts = explode('/', $route);

		$this->controller = $routeParts[0];
		$this->action = isset($routeParts[1]) ? $routeParts[1] : \Config::DEFAULT_ACTION;

		//Remove the first element from an array
		array_shift($routeParts);
		array_shift($routeParts);
		
		$this->params = $routeParts;
	}

	public function getAction(){
		if (empty($this->action)){ 
			$this->action = \Config::DEFAULT_ACTION;
		}    
		return $this->action;
	}  
	public function getController(){
		//Ser till att controller alltid stavas med små bokstäver
		$this->controller = strtolower($this->controller);

		if (empty($this->controller)){ 
			$this->controller = \Config::DEFAULT_CONTROLLER;
		}  
	    return $this->controller;
	} 
	
	public function getParams(){
	    return $this->params;  
	}

	public function dispatch(){
		$controllerName = $this->getController();

		$action = $this->getAction();
		$params = $this->getParams();

		if(!file_exists(SRC_DIR)){
			throw new \Exception("Something wrong with the configuration of this project check global SRC_DIR in definer.php");
		}

		//Tar fram alla mappar i src mappen
		$files = scandir(SRC_DIR, 1);
		$controllerfile = "";
		$namespace = ""; 
		//Loopa dessa filer 
		foreach ($files as $file) {
			$controllerDir = SRC_DIR . $file . DS . 'controller';
			if (file_exists($controllerDir)){ //Om man hittar controller mappen 
				$filesInControllerDir = scandir($controllerDir, 1);//Hämta alla filnamn i den mappen 

				foreach ($filesInControllerDir as $fileInControllerDir) { 
					if (0 === strpos($fileInControllerDir, $controllerName)) {
						$controllerfile = SRC_DIR . $file . DS . 'controller' . DS . $fileInControllerDir; 
						$namespace = $file; 
						break; 
					}
				}	
			}
		}

		$controller = '\\' . $namespace . '\\controller\\' . ucfirst($controllerName) . 'Controller'; //Alltid stor första bokstav på objekt
		if (file_exists($controllerfile)){
			require_once($controllerfile);

			$app = \core\Loader::load($controller); 
			$app->setParams($params);

			if(!method_exists($app, $action)){
				throw new \Exception('Controller ' . $controller . ' does not have ' . $action . ' function');  
			}
			$vars = $app->$action();
			\core\Render::renderAction($namespace, $controllerName , $action, $vars);
			
		} else {
			throw new \Exception('Controller ' . $controller . ' not found');  
		}
	} 
}