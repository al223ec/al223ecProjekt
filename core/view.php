<?php

namespace core; 

abstract class View {

	protected $viewVars = array();

	protected function getInput($inputName){
		return isset($_POST[$inputName]) ? $_POST[$inputName] : '';
	}
	protected function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : '';
	}
	private function sanitize($input) {
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
	* @param $action vilken funktion som har kallats på i kontrollern, alla funktioner har en tillhörande view fil
 	*/
	public function render($action, $finalRender = true){
		if($this->viewVars !== null){ 
			extract($this->viewVars);
		}
		ob_start();

		//För att hitta rätt fil behöver man läsa vilka namespaces som klassen tillhör, kan skötas mycket snyggare.
		$reflection = new \ReflectionClass($this);
		$namespaceParts = explode('\\', $reflection->getNamespaceName());
		$namespace = $namespaceParts[0]; 
		$controller = $namespaceParts[2]; 

		//pga namngivning, hitta alla stora bokstäver placerar ett _ före och gör alla bokstäver små
		preg_match_all( '/[A-Z]/', $action, $matches, PREG_OFFSET_CAPTURE );

		if(!empty($matches)){
			for($i=0; $i < count($matches[0]); $i++){
				if(!empty($matches[0][$i])){
					$m = $matches[0][$i];
					$action = substr_replace($action, '_' . strToLower($m[0]), $m[1] + $i, 1);
				}
			}
		}
		$actionFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . DS . $action . ".php";

		if (file_exists($actionFile)){
			include_once($actionFile);
		} else {
			throw new \Exception("View '{$action}.php' is not found in $namespace/view/$controller directory.");
		}

		$layoutdata = ob_get_clean();
		if($finalRender){

			$app = SRC_DIR . "templates" . DS . \Config::MAIN_TEMPLATE;
			//Detta är också ganska osnyggt men för att app.php ska veta vilken kontroller som är aktiv just nu. 
			//$active används i app.php
			$active = $controller; 

			if (file_exists($app)){
				include_once($app);
			} else {
				throw new \Exception("Final template file '". \Config::MAIN_TEMPLATE  ."' is not found in $app");
			}
		} else{
			return $layoutdata; 
		}
	}

}


		/*
		if($useTemplate){
			$templateFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . ".php";

			if (file_exists($templateFile)){
				include_once($templateFile);
			} else {
				throw new \Exception("View, default template '{$controller}.php' is not found in $namespace/view/$controller directory.");
			}
		}*/