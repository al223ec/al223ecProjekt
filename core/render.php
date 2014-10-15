<?php

namespace core;

class Render{
	
	public static function renderAction($namespace, $controller, $action, $vars = null){
		if($vars !== null){
			extract($vars);
		}
		ob_start();

		$actionFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . DS . $action . ".php";

		if (file_exists($actionFile)){
			include_once($actionFile);
		} else {
			throw new \Exception("View '{$action}.php' is not found in $namespace/view/$controller directory.");
		}

		$layoutdata = ob_get_clean();
		$templateFile = SRC_DIR . $namespace . DS . "view" . DS . $controller . DS . $controller . ".php";

		
		if (file_exists($templateFile)){
			include_once($templateFile);
		} else {
			throw new \Exception("Templatefile '{$controller}.php' is not found in $namespace/view/$controller directory.");
		}

	}
}