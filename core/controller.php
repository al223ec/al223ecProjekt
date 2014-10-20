<?php

namespace core; 

abstract class Controller {

	protected $params; 
	protected $view;

	public abstract function main(); 

	public function setParams($params){
		$this->params = $params; 
	}
	
	public function getView(){
		return $this->view;
	}	
	protected function redirectTo($controller = '', $action = '', $args = ''){ //Bör lägga till möjligheter att skicka med args??
		//TODO: kontrollera args ska skunna vara en array också
		//Bör ha en redirect to error också 
		header('Location: ' . rtrim(ROOT_PATH . $controller . '/' . $action . '/' . $args, '/') .  '/');
		exit;
	}
}