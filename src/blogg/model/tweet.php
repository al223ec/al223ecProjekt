<?php

namespace blogg\model; 

class Tweet {
	private $name;
	private $screenName;  
	private $text; 

	public function __construct($name, $text, $screenName){
		$this->name = $name; 
		$this->text = $text; 
		$this->screenName = $screenName; 
	}

	public function getText(){
		return $this->text; 
	}
	public function getName(){
		return $this->name; 
	}

	public function getScreenName(){
		return $this->screenName; 
	}
}