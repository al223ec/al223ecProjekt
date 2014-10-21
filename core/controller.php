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

	protected function redirectToError($exception){
		if(\Config::DEBUG){
			echo "<pre>"; 
			echo debug_print_backtrace(); 
			echo $exception; 
			echo "</pre>";
			die(); 

		} else{
			ob_start();
			debug_print_backtrace();
			$errorLog = ob_get_clean();
			$errorLog .= $exception; 
			file_put_contents(\Config::ERROR_LOG, $errorLog , FILE_APPEND);
			
			include_once(ROOT_DIR . 'error.php');
			$layoutdata =  ob_get_clean(); 
			include_once(SRC_DIR . "templates" . DS . \Config::MAIN_TEMPLATE); 
		}
	}
}