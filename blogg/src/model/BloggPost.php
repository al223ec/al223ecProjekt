<?php 

namespace model; 

class BloggPost{
	private $bloggPostID; 
	private $userID; //Nfk 
	private $author; 
	private $titel; 
	private $time; 
	private $text; 

	public function __construct($userID, $author, $titel, $text, $time, $bloggPostID = 0){
		$this->userID = $userID; 
		$this->author = $author; 
		$this->titel = $titel; 
		$this->text = $text; 
		$this->time = $time; 
		$this->bloggPostID = $bloggPostID; //Om noll ny post

	}

	public function getAuthor(){
		return $this->author; 
	}

	public function getText(){
		return $this->text; 
	}

	public function getTitel(){
		return $this->titel; 
	}

	public function getBloggPostID(){
		return $this->bloggPostID; 
	}

	public function getTime(){
		return $this->time; 
	}

	public function getUserID(){
		return $this->userID; 
	}
}