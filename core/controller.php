<?php

namespace core; 

abstract class Controller {

	protected $params; 

	protected $masterView; 

	public function __construct(){
		$this->masterView = \core\Loader::load('\\master\\view\\MasterView'); 
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