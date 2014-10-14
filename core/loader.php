<?php

namespace core; 

class Loader{
	//laddar ett objekt utifrån singelton mönstret
	private static $loaded = array();  

	public static function load($object){
	    if (empty(self::$loaded[$object])){      
	    	self::$loaded[$object]= new $object();    
	    }    
	    return self::$loaded[$object];  
	}
}