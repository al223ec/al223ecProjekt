<?php

namespace blogg\view\blogg; 

class InstagramView extends \core\View{
	private $instagramModel; 

	public function __construct(\blogg\model\instagram\InstagramModel $instagramModel){
		$this->instagramModel = $instagramModel; 
	}
}
