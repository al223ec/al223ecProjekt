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
		$instagramFlow = $this->instagramModel->getInstagramImages($numberOfPosts); 
		$flow = array_merge($flow, $instagramFlow); 
		$ret = array(); 
		foreach ($flow as $value) {
			$ret[$value->getTime()] = $value; 
		}

		 arsort($ret); 
		 return $ret; 
		//Sorteringsfunktionen fungerar inte alls och jag vet inte varför 
		
		usort($flow, function($a, $b) {
			$aTime = $a->getTime(); 
			$bTime = $b->getTime(); 
			
			if($aTime == $aTime){
				return 0; 
			}
			return ($aTime < $bTime) ? 1 : -1;
		});


		return $flow;
	}
}