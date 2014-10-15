<?php

namespace master\controller; 

class MasterController extends \core\Controller {
	
	private $bloggController; 	
	private $instagramController; 
	private $twitterController; 
	private $currentView; 

	public function __construct(){
		$this->bloggController = new \blogg\controller\BloggController(); 
		$this->instagramController = new \blogg\controller\InstagramController(); 
		$this->twitterController = new \blogg\controller\TwitterController(); 
		//Skulle kunna använda denna som en slags startsida.
	}
	public function main(){
		$this->bloggController->main(); 
		$this->instagramController->main(); 
		$this->twitterController->main(); 
	}	
}