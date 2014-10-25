<?php

abstract class Config{	
	const DEFAULT_CONTROLLER = "home";
	const DEFAULT_ACTION = "main"; 
	const ALLOWED_URL_CHARS = "/[^A-z0-9\/\^]/"; 
	const DEBUG = false;
	const ERROR_LOG = "myerrors.log"; 
	 
	const MAIN_TEMPLATE = "app.php"; 
}//TheBl4ckD4lia