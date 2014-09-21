<?php

namespace controller; 

require_once(ROOT_DIR . "/src/view/Blogg.php");
require_once(ROOT_DIR . "/src/model/Blogg.php");

class BloggController{
	
	private $bloggView; 
	private $bloggModel; 

	public function __construct(){
		$this->bloggModel = new \model\Blogg(); 
		$this->bloggView = new \view\Blogg($this->bloggModel); 

	}

	public function performAction(){
		$strAction = $this->bloggView->getCurrentAction();

		var_dump($strAction); 
		switch($strAction){
			case \view\Blogg::ActionSave:
				return $this->saveBloggPost(); 
			case \view\Blogg::ActionEdit:
				return $this->editBloggPost();
			case \view\Blogg::ActionDelete :
				return $this->deleteBloggPost();
			case \view\Blogg::ActionDeletionConfirmed :
				return $this->deleteBloggPostConfirmed();
			default : 
				return $this->getBlogg();
		}
	}

	private function saveBloggPost(){
		$bloggPost = $this->bloggView->saveBloggPost(); 
		$this->bloggModel->saveBloggPost($bloggPost);
		return $this->getBlogg(); 
	}

	private function editBloggPost(){
		return $this->bloggView->getCurrentID(); 
	}

	private function deleteBloggPost(){
		$this->bloggView->confirmDelete(); 
		return $this->getBlogg(); 
	}

	private function deleteBloggPostConfirmed(){
		if($this->bloggModel->deleteBloggPost($this->bloggView->getCurrentID())){
			$this->bloggView->redirect(); 
			//Visa successmeddelande
		}
		return $this->getBlogg(); 
	}

	private function getBlogg(){
		$ret = $this->bloggView->getAllBloggPosts(); 
		if(\view\Blogg::$AdminIsLoggedIn)
		{
			$ret .= $this->bloggView->getBloggPostForm(); 
		} 
		return $ret;  
	}
}