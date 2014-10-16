<?php

namespace blogg\view; 

class BaseView extends \core\View{

	public function setAuthRenderVar($render){
		$this->setViewVar("authRenderVar", $render); 
	}
	
}