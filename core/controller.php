<?php

namespace core; 

abstract class Controller {

	protected $params; 

	protected $masterPage; 
	
	public function __construct(){
		$this->masterPage = \core\Loader::load('\\master\\MasterPage'); 
	}

	public abstract function main(); 

	public function setParams($params){
		$this->params = $params; 
	}
	
	protected function redirectTo($controller = '', $action = ''){ //Bör lägga till möjligheter att skicka med args??
		header('Location: ' . ROOT_PATH . $controller . '/' . $action);
		exit;
	}
}