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

		//pga namngivning, hitta alla stora bokstäver placer ett _ före och gör alla bokstäver små
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