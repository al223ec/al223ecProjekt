<?php 

define('ROOT_DIR', realpath(dirname(__FILE__)));
require_once("/common/HTMLView.php");
require_once(ROOT_DIR . "/socialMedia/src/controller/SocialMediaController.php");
require_once(ROOT_DIR . "/master/src/controller/MasterController.php");

session_start();
$view = new HTMLView();
$mc = new \controller\MasterController(); 

$HTMLBody = $mc->getMasterPage();
$HTMLBody .= $mc->getSocialMediaPage(); 

$view->echoHTML($HTMLBody);