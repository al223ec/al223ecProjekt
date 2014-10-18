<?php

namespace core; 

class View {

	protected $viewVars = array();

	protected function getInput($inputName){
		return isset($_POST[$inputName]) ? $_POST[$inputName] : '';
	}
	protected function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : '';
	}
	protected function sanitize($input) {
        $temp = trim($input);
        return filter_var($temp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }
    protected function setViewVar($key, $var){
		$this->viewVars[$key] = $var; 
	}
	protected function setViewVars(array $vars){
		foreach ($vars as $key => $var) {
			$this->setViewVar($key, $var);
		}
	}
	public function getViewVars(){
		return $this->viewVars; 
	}		

	/**
	* En view bör ju veta detta om sig själv finalRender bool? 
	*
 	*/
	public function render($namespace, $controller, $action, $finalRender = true, $useTemplate = false){
		if($this->viewVars !== null){ 
			extract($this->viewVars);
		}
		ob_start();

		$actionFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . DS . $action . ".php";

		if (file_exists($actionFile)){
			include_once($actionFile);
		} else {
			throw new \Exception("View '{$action}.php' is not found in $namespace/view/$controller directory.");
		}

		/*
		if($useTemplate){
			$templateFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . DS . $controller . ".php";
			$layoutdata = ob_get_clean();

			if (file_exists($templateFile)){
				include_once($templateFile);
			} else {
				throw new \Exception("Templatefile '{$controller}.php' is not found in $namespace/view/$controller directory.");
			}
		}else {
			return ob_get_clean(); 
		}*/

		$layoutdata = ob_get_clean();
		if($finalRender){
			$app = SRC_DIR . "templates" . DS . "app.php";
			$active = $controller; 

			if (file_exists($app)){
				include_once($app);
			} else {
				throw new \Exception("Final template file 'app.php' is not found in $app");
			}
		} else{
			return $layoutdata; 
		}
	}

}