<?php

namespace blogg\model\blogg; 

class BloggModel {
	private $bloggRepository; 

	public function __construct(){
		$this->bloggRepository = new \blogg\model\repository\BloggRepository();
	
	}
	
	public function getBloggPosts(){
		return $this->bloggRepository->getBloggPosts(); 
	}
	public function getBloggPostById($id){
		return $this->bloggRepository->getBloggPostById($id); 

	}

	public function saveBloggPost(\blogg\model\blogg\Post $post){
		if(!$post->isValid()){
			return false; 
		}

		return $this->bloggRepository->savePost($post); 
	}


}