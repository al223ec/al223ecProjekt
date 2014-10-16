<?php

namespace blogg\model\repository; 

class BloggRepository extends \core\db\Repository{
	
	public function __construct(){
			$this->table = "bloggposts"; 
	}

	public function getBloggPosts(){
		$sql = "SELECT * FROM " .$this->table ." ORDER BY id DESC;";  
		$ret = array(); 

		if($response = $this->query($sql)){
			foreach ($response as $postdbo) {

				$post = new \blogg\model\blogg\Post($postdbo['id'], $postdbo['user_id']); 
				$post->setTitel($postdbo['titel']); 
				$post->setText($postdbo['text']); 
				$post->setTime($postdbo['time']); 

				$ret[] = $post; 
			}
		} 
		return $ret; 
	}

	public function getBloggPostById($id){
		$postdbo = $this->findBy('id', $id);
		if($postdbo !== null){
			$post = new \blogg\model\blogg\Post($postdbo['id'], $postdbo['user_id']); 
			$post->setTitel($postdbo['titel']); 
			$post->setText($postdbo['text']); 
			$post->setTime($postdbo['time']); 

			return $post; 
		}
		return null;
	}

	public function deletePost($id){
		$sql = "DELETE FROM " . $this->table . " WHERE id = :id"; 
		$params = array(":id" => $id); 
		
		return $this->query($sql, $params, true);
	}

	public function savePost(\blogg\model\blogg\Post $post){
		$titel = $post->getTitel(); 
		$text = $post->getText(); 
		$time = $post->getTime(); 
		$user_id = $post->getUserId(); 

		$sql = "INSERT INTO " . $this->table . "(titel, text, time, user_id) VALUES( :titel, :text, :time, :user_id);"; 
		$params = array(":titel" => $titel, ":text" => $text, ':time' => $time, ':user_id' => $user_id); 
		return $this->query($sql, $params, true);
	}
	

	public function updatePost(\blogg\model\blogg\Post $post){
		$titel = $post->getTitel(); 
		$text = $post->getText(); 
		$time = $post->getTime(); 
		$id = $post->getId(); 

 		$sql = "UPDATE " . $this->table . " SET titel = :titel, text = :text, time = :time WHERE id = :id"; 
		$params = array(":titel" => $titel, ":text" => $text, ':time' => $time, ':id' => $id); 

		return $this->query($sql, $params, true);
	}
}