<?php

namespace blogg\controller; 

class InstagramController extends BaseController{

	private $instagramModel; 
	private $numberOfImages; 

	public function __construct(){
		parent::__construct(); 
		$this->instagramModel = new \blogg\model\instagram\InstagramModel($this->settings->getInstagramSettings());  
		$this->setView(new \blogg\view\instagram\InstagramView()); 
		
		$this->numberOfImages = $this->settings->getInstagramSettings()->numberOfImages; 
	}

	public function main(){
		$this->view->setImages($this->instagramModel->getInstagramImages($this->numberOfImages));  
	}
}