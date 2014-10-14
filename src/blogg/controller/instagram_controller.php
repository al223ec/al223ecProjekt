<?php

namespace blogg\controller; 

class InstagramController extends \core\Controller{

	private $instagramModel; 

	public function __construct(){
      	parent::__construct();
		$this->instagramModel = new \blogg\model\instagram\InstagramModel(); 
	}

	public function main(){
		$this->masterPage->setInstagramView($this->instagramModel->getInstagramImages());
	}
}