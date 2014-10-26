<?php
//Inkluderar all core filer
/**
* Dessa två if satser är endast för att undvika warningar som skrivs ut när de automatiserade testerna körs
*/
if(!array_key_exists('SRC_DIR', $GLOBALS)){
	define('SRC_DIR', ROOT_DIR . 'src' . DS);
}
if(!array_key_exists('CORE_DIR', $GLOBALS)){
	define('CORE_DIR', ROOT_DIR . 'core' . DS);
}

require_once(ROOT_DIR . 'core' . DS . 'autoload.php');
require_once(ROOT_DIR . 'core' . DS . 'config.php');
require_once(ROOT_DIR . 'core' . DS . 'router.php'); 
require_once(ROOT_DIR . 'core' . DS . 'routes.php'); 
require_once(ROOT_DIR . 'core' . DS . 'controller.php');
require_once(ROOT_DIR . 'core' . DS . 'view.php'); 
require_once(ROOT_DIR . 'core' . DS . 'loader.php'); 
require_once(ROOT_DIR . 'core' . DS . 'db' . DS . 'repository.php');
require_once(ROOT_DIR . 'core' . DS . 'lib' . DS . 'session_handler.php'); 

require_once(ROOT_DIR . 'core' . DS . 'validation' . DS . 'validation.php'); 
require_once(ROOT_DIR . 'core' . DS . 'validation' . DS . 'validatable_object.php'); 

