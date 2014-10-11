<?php

namespace blogg\model\blogg; 

class BloggModel {
	private $bloggRepository; 

	public function __construct(){
		$this->bloggRepository = new \model\BloggRepository();
	
	}
	
	public function getBloggPosts(){

	}


}