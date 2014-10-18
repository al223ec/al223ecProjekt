<?php

namespace blogg\controller; 

class AdminController extends BaseController{


	public function __construct(){
		parent::__construct(); 
		$this->view = new \blogg\view\admin\AdminView(); 

		$this->initAuthController(); 
	}

	public function main(){
		
	}
	 
}