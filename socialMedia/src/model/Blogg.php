<?php 

namespace model; 
require_once(ROOT_DIR . "/src/model/DAL/BloggPostDAL.php"); 

class Blogg{

	private $bloggPostDAL; 

//User och userID här?? 
	public function __construct(){
		$this->bloggPostDAL = new \DAL\BloggPostDAL();
	}	

	public function getBloggPosts(){
		return $this->bloggPostDAL->getBloggPosts(); 
	}

	public function saveBloggPost(\model\BloggPost $bloggPost){
		//Docontrolls
		$this->bloggPostDAL->saveBloggPost($bloggPost); 

	}
}