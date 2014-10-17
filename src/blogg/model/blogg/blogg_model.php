<?php

namespace blogg\model\blogg; 

class BloggModel {
	private $bloggRepository; 

	public function __construct(){
		$this->bloggRepository = new \blogg\model\repository\BloggRepository();
	
	}
	public function getNumberOfBloggPostsInDb(){
		return $this->bloggRepository->getNumberOfBloggPostsInDb(); 
	}
	
	public function getBloggPosts($startPost, $numberOfPosts){
		return $this->bloggRepository->getBloggPosts($startPost, $numberOfPosts); 
	}
	public function getBloggPostById($id){
		return $this->bloggRepository->getBloggPostById($id); 
	}

	public function delete($id){
		return $this->bloggRepository->deletePost($id); 
	}
	/**
	*	Returnerar id på posten 
	*/
	public function saveBloggPost(\blogg\model\blogg\Post $post){
		if(!$post->isValid()){
			return; 
		}
		if($post->getId() === 0){
			return intval($this->bloggRepository->savePost($post));
		}
		return intval($this->bloggRepository->updatePost($post));
	}
}