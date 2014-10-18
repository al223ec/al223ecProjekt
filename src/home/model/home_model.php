<?php

namespace home\model; 

class HomeModel {
	
	private $twitterModel; 
	private $bloggModel; 

	public function __construct(){
		$this->instagramModel = new \blogg\model\instagram\InstagramModel();  
		$this->bloggModel = new \blogg\model\blogg\BloggModel();
	}

	public function getBloggAndInstagramFlow($numberOfPosts){
		$flow = $this->bloggModel->getBloggPosts(0, $numberOfPosts); 
		$flow = array_merge($flow, $this->instagramModel->getInstagramImages($numberOfPosts));
		//Sorteringsfunktionen
		usort($flow, function($a, $b) {
			$aTime = $a->getTime(); 
			$bTime = $b->getTime(); 
			
			if($aTime == $aTime){
				return 0; 
			}
			return ($aTime < $bTime) ? 1 : -1;
		});

		//$flow = array_slice($flow, 0, $numberOfPosts, true);
		return $flow; 
	}
}