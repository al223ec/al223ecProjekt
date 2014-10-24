<?php

namespace home\model; 

class HomeModel {
	private $bloggModel; 

	public function __construct($instagramSettings){
		$this->instagramModel = new \blogg\model\instagram\InstagramModel($instagramSettings);  
		$this->bloggModel = new \blogg\model\blogg\BloggModel();
	}

	public function getBloggAndInstagramFlow($numberOfPosts){

		$bloggFlow = $this->bloggModel->getBloggPosts(0, $numberOfPosts); 
		$instagramFlow = $this->instagramModel->getInstagramImages($numberOfPosts); 
	
		$flow = array(); 
		for ($i=0; $i < $numberOfPosts/2; $i+=2) { 
			if(isset($bloggFlow[$i]) && isset($bloggFlow[$i+1])){
				$flow[] = $bloggFlow[$i]; 
				$flow[] = $bloggFlow[$i+1];
			}
			if(isset($instagramFlow[$i]) && isset($instagramFlow[$i+1])){
				$flow[] = $instagramFlow[$i]; 
				$flow[] = $instagramFlow[$i+1];
			}  
		}

		return $flow; 
/*
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


		return $flow;*/
	}
}