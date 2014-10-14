<?php

namespace master\view;

class MasterView{
	private $instagramImages; 
	private $tweets; 
	
	private $authView; 
	private $bloggView; 
	private $bloggFormView; 

	private $authController; 
	private $bloggController; 

	public function __construct(){} 

	public function setInstagramImages($instagramImages){
		$this->instagramImages($instagramImages); 
	}	

	public function setAuthView($authView){
		$this->authView = $authView; 
	}

	public function setBloggView($bloggView){
		$this->bloggView = $bloggView; 
	}
	
	public function setBloggFormView($bloggFormView){
		$this->bloggFormView = $bloggFormView; 
	}

	public function getAuthView(){
		if(!isset($this->authView)){
			$controller = \core\Loader::load('\auth\controller\AuthController');
			$controller->main(); 
		}

		return $this->authView; 
	}

	public function getBloggView(){

		if(!isset($this->bloggView)){
			$controller = \core\Loader::load('\blogg\controller\BloggController'); //Detta måste skötas någon annan stans känns det som
			$controller->main(); 
		}

		return $this->bloggView; 
	}
	
	public function getBloggFormView(){
		return $this->bloggFormView; 
	}



}