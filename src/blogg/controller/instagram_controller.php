<?php

namespace blogg\controller; 

class InstagramController extends BaseController{

	private $instagramModel; 

	public function __construct(){
		parent::__construct(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel();  
		$this->setView(new \blogg\view\instagram\InstagramView()); 

	}
	public function main(){
		$this->view->setImages($this->instagramModel->getInstagramImages());  
	}
}