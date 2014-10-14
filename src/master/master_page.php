<?php

namespace master;

class MasterPage {
	
	private $instagramView; 
	private $twitterView; 
	
	private $authView; 
	private $bloggView; 
	private $bloggFormView; 

	private $authController; 
	private $bloggController; 

	public function __construct(){} 

	public function setInstagramView($instagramView){
		$this->instagramView = $instagramView; 
	}	

	public function setAuthView($authView){
		$this->authView = $authView; 
	}

	public function setTwitterView($twitterView){
		$this->twitterView = $twitterView;
	}

	public function setBloggView($bloggView){
		$this->bloggView = $bloggView; 
	}
	
	public function setBloggFormView($bloggFormView){
		$this->bloggFormView = $bloggFormView; 
	}

	public function getInstagramView(){
		return $this->instagramView; 
	}

	public function getTwitterView(){
		return $this->twitterView; 
	}

	public function getAuthView(){
		if(!isset($this->authView)){
			$controller = \core\Loader::load('\auth\controller\AuthController');
			$controller->main(); 
		}
		return $this->authView; 
	}

	public function getBloggView(){
		return $this->bloggView; 
	}
	
	public function getBloggFormView(){
		return $this->bloggFormView; 
	}

	private $pageHeader; 
	public function setPageHeader($pageHeader){
		$this->pageHeader = $pageHeader; 
	}
	public function getPageHeader(){
		return $this->pageHeader; 
	}
}