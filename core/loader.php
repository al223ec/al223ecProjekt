<?php

namespace core; 

class Loader{
	//laddar ett objekt utifrån singelton mönstret
	//http://coderoncode.com/2014/01/27/design-patterns-php-singletons.html Argument mot singelton

	/*
	* Singletons are considered by many to be an anti-pattern, 
	* Anti-patterns are design solutions that are usually ineffective
	* and present a high risk of being counter productive.
	*/

	private static $loaded = array();  
	public static function load($object){
	    if (empty(self::$loaded[$object])){      
	    	self::$loaded[$object]= new $object();    
	    }    
	    return self::$loaded[$object];  
	}
}