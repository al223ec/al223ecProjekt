<?php

namespace blogg\view\instagram; 

class InstagramView extends \core\View{

	public function __construct(){
		$this->setPageHeader("Instagram");
	}

	public function getInstagramImagesHTML($images){
		$ret = ""; 
		foreach ($images as $image) {
			$ret .= '<img src="' . $image->getLowResolutionUrl() . '" alt="instagram image ">'; 
		}
		return $ret; 
	}
}
