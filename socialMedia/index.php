<?php 

define('ROOT_DIR', realpath(dirname(__FILE__)));

require_once("../common/HTMLView.php");
require_once(ROOT_DIR . "/SocialMediaController.php");

session_start();
$view = new HTMLView();
$smc = new SocialMediaController(); 

$HTMLBody = $smc->getMedia();
$view->echoHTML($HTMLBody);