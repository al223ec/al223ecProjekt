<?php

namespace blogg\view; 

abstract class BaseView extends \core\View{
	//Dessa variablar ska finnas tillgängliaga i all vy filer i blogg/view/

	public function setAuthRenderVar($render){
		$this->setViewVar("authRenderVar", $render); 
	}

	public function setUserLoggedInVar($userIsLoggedIn){
		$this->setViewVar("userIsLoggedIn", $userIsLoggedIn);
	}

	protected function setPageTitel($pageTitel){
		$this->setViewVar("pageTitel", $pageTitel); 
	}

	public function getAuthRender(){
		$vars = $this->getViewVars(); 
		return isset($vars["authRenderVar"]) ?  $vars["authRenderVar"] : "not rendered yet"; 
	}
}