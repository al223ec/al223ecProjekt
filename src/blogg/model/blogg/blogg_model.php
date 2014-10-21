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
		$userRepository = new \auth\model\repository\UserRepository();

		$posts = $this->bloggRepository->getBloggPosts($startPost, $numberOfPosts); 
		foreach ($posts as $post) {
			$post->setAuthor($userRepository->getUserNameById($post->getUserID())); 
		}
		return $posts; 
	}

	public function getBloggPostById($id){
		$userRepository = new \auth\model\repository\UserRepository();

		$post = $this->bloggRepository->getBloggPostById($id); 
		$post->setAuthor($userRepository->getUserNameById($post->getUserID())); 
		
		return $post; 
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