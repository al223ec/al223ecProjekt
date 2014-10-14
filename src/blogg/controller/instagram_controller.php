<?php

namespace blogg\controller; 

class InstagramController extends \core\Controller{

	private $instagramModel; 
	private $instagramView; 

	public function __construct(){
      	parent::__construct();
		$this->instagramModel = new \blogg\model\instagram\InstagramModel(); 
		$this->instagramView = new \blogg\view\instagram\InstagramView($this->instagramModel); 
	}

	public function main(){
		$this->masterPage->setInstagramView($this->instagramView->getInstagramImagesHTML($this->instagramModel->getInstagramImages()));
	}
}