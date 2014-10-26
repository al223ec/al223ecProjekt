<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');

require_once ('./core/definer.php');

\core\Loader::load('blogg\model\admin\Settings'); //börja med att läsa in inställningar
$router = \core\Loader::load('\core\Router');  
$router->dispatch(); 
