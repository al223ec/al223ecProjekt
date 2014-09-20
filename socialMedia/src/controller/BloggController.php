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
			default : 
				return $this->getBlogg();
		}
	}

	public function saveBloggPost(){
		$bloggPost = $this->bloggView->saveBloggPost(); 
		$this->bloggModel->saveBloggPost($bloggPost);
		return $this->getBlogg(); 
	}

	public function editBloggPost(){
		return $this->bloggView->getCurrentID(); 
	}

	public function deleteBloggPost(){
		return $this->bloggView->getCurrentID(); 
	}

	public function getBlogg(){
		$ret = $this->bloggView->getAllBloggPosts(); 
		if(\view\Blogg::$AdminIsLoggedIn)
		{
			$ret .= $this->bloggView->getBloggPostForm(); 
		} 
		return $ret;  
	}
}