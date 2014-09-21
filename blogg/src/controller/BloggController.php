<?php

namespace controller; 

require_once(ROOT_DIR . "/blogg/src/view/BloggView.php");
require_once(ROOT_DIR . "/blogg/src/model/Blogg.php");

class BloggController{
	
	private $bloggView; 
	private $bloggModel; 

	public function __construct(){
		$this->bloggModel = new \model\Blogg(); 
		$this->bloggView = new \view\BloggView($this->bloggModel); 
	}

	public function performAction(){
		$strAction = $this->bloggView->getCurrentAction();

		switch($strAction){
			case \view\BloggView::ActionSave:
				return $this->saveBloggPost(); 
			case \view\BloggView::ActionEdit:
				return $this->editBloggPost();
			case \view\BloggView::ActionDelete :
				return $this->deleteBloggPost();
			case \view\BloggView::ActionDeletionConfirmed :
				return $this->deleteBloggPostConfirmed();
			default : 
				return $this->getBlogg();
		}
	}

	private function saveBloggPost(){
		if(($bloggPost = $this->bloggView->saveBloggPost()) !== null){
			$this->bloggModel->saveBloggPost($bloggPost);
			$this->bloggView->redirect(); 
		}else{
			return $this->getBlogg(); 
		}

	}

	private function editBloggPost(){
		return $this->bloggView->getBloggPostForm();
	}

	private function deleteBloggPost(){
		$this->bloggView->confirmDelete(); 
		return $this->getBlogg(); 
	}

	//Tar faktiskt bort bloggPosten
	private function deleteBloggPostConfirmed(){
		if($this->bloggModel->deleteBloggPost($this->bloggView->getCurrentID())){
			$this->bloggView->redirect(); 
			//Visa successmeddelande
		}
		return $this->getBlogg(); 
	}

	private function getBlogg(){
		$ret = $this->bloggView->getAllBloggPosts(); 
		if(\view\BloggView::$AdminIsLoggedIn)
		{
			$ret .= $this->bloggView->getBloggPostForm(); 
		} 
		return $ret;  
	}
}