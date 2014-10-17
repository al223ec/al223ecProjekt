<?php

namespace home\controller; 

class HomeController extends \blogg\controller\BaseController{

	private $bloggController; 
	private $twitterController; 
	private $instagramController; 

	public function __construct(){
		parent::__construct(); 

      	$this->bloggController = \core\Loader::load('\\blogg\\controller\\BloggController'); 
      	$this->instagramController = \core\Loader::load('\\blogg\\controller\\InstagramController');
      	$this->twitterController = \core\Loader::load('\\blogg\\controller\\TwitterController');

      	$this->initAuthController(); 
	}
	public function main(){

	}
}