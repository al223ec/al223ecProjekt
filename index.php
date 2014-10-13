<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);
define('ROOT_PATH', '/' . basename(dirname(__FILE__)) . '/');

require_once ('./core/definer.php');

$router = new \core\Router();  
$view = new HTMLView();
$view->echoHTML($router->dispatch());