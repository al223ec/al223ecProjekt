<?php

namespace blogg\view\instagram; 

class InstagramView extends \blogg\view\BaseView{

	public function setImages($images){
		$this->setViewVar("images", $images); 
	}
}
