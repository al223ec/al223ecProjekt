<?php



//define('CONTROLLER_DIR', ROOT_DIR . 'src' . DS . 'controller' . DS); //Tillfällig fix, måste tänka ut ett sätt att lösa detta
//define('VIEW_DIR', ROOT_DIR . 'src' . DS . 'view' . DS);
//define('MODEL_DIR', ROOT_DIR . 'src' . DS . 'model' . DS);
if(!array_key_exists('SRC_DIR', $GLOBALS)){
	define('SRC_DIR', ROOT_DIR . 'src' . DS);
}
if(!array_key_exists('CORE_DIR', $GLOBALS)){
	define('CORE_DIR', ROOT_DIR . 'core' . DS);
}


require_once(ROOT_DIR . 'common' . DS . 'html_view.php');
require_once(ROOT_DIR . 'core' . DS . 'autoload.php');
require_once(ROOT_DIR . 'core' . DS . 'config.php');
require_once(ROOT_DIR . 'core' . DS . 'base_object.php');
require_once(ROOT_DIR . 'core' . DS . 'router.php'); 
require_once(ROOT_DIR . 'core' . DS . 'routes.php'); 
require_once(ROOT_DIR . 'core' . DS . 'controller.php');
require_once(ROOT_DIR . 'core' . DS . 'view.php'); 
require_once(ROOT_DIR . 'core' . DS . 'loader.php'); 
require_once(ROOT_DIR . 'core' . DS . 'repository.php'); 
require_once(ROOT_DIR . 'core' . DS . 'validation' . DS . 'validation.php'); 

