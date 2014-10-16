<?php

namespace blogg\view\instagram; 

class InstagramView extends \blogg\view\BaseView{

	public function __construct(){
		$this->setPageTitel("Instagram");
	}
	public function setImages($images){
		$this->setViewVar("images", $images); 
	}
}
