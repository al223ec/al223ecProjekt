<?php

namespace model; 

class Tweet{
	private $author; 
	private $text; 

	public function __construct($author, $text){

		$this->author = $author; 
		$this->text = $text; 

	}

	public function getText(){
		return $this->text; 
	}
	public function getAuthor(){
		return $this->author; 
	}
	
}