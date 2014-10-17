<?php

namespace auth\view;

abstract class ViewBase extends \core\View{
	
	protected $model; 
	
	private $sessionKey = "ViewBase::SessionKey"; 

	public function __construct($model){
		$this->model = $model;	
	}
	protected function getMessage(){
		return $this->model->getSessionReadOnceMessage(); 
	}

    protected function setSession($message){
    	$this->model->setSessionMessage($this->sessionKey, $message); 
    }
}