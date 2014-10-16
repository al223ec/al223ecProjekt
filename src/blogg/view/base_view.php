<?php

namespace blogg\view; 

class BaseView extends \core\View{

	public function setAuthRenderVar($render){
		$this->setViewVar("authRenderVar", $render); 
	}

	public function setUserLoggedInVar($userIsLoggedIn){
		$this->setViewVar("userIsLoggedIn", $userIsLoggedIn);
	}

	public function setPageTitel($titel){
		$this->setViewVar("titel", $titel); 

	}
}