<?php 

namespace model; 
require_once(ROOT_DIR . "/blogg/src/model/DAL/BloggPostDAL.php"); 

class Blogg{

	private $bloggPostDAL; 

//User och userID här?? 
	public function __construct(){
		$this->bloggPostDAL = new \DAL\BloggPostDAL();
	}	

	public function getBloggPosts(){
		return $this->bloggPostDAL->getBloggPosts(); 
	}

	public function getBloggPost($bloggPostID){
		if(!is_numeric($bloggPostID)|| $bloggPostID < 1){
			throw new \Exception("BloggModel::getBloggPost Wrong argument sent from view"); 
		}

		return $this->bloggPostDAL->getBloggPost($bloggPostID); 
	}


	public function saveBloggPost(\model\BloggPost $bloggPost){
		//Docontrolls
		$this->bloggPostDAL->saveBloggPost($bloggPost); 
	}

	public function deleteBloggPost($bloggPostID){
		if(!is_numeric($bloggPostID)|| $bloggPostID < 1){
			throw new \Exception("BloggModel::deleteBloggPost Wrong argument sent from view"); 
		}
		return $this->bloggPostDAL->deleteBloggPost($bloggPostID); 
	}
}