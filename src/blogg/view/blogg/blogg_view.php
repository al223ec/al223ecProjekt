<?php

namespace blogg\view\blogg; 

class BloggView extends \blogg\view\BaseView{

	private $titelPost = "BloggView::titelPost"; 
	private $textPost = "BloggView::textPost"; 
	private $idPost = "BloggView::idPost"; 

	private $sessionKey = "BloggView::SessionKey"; 

	public function __construct(){
		$this->setPageTitel("Blogg");

		$this->setViewVars(array(
			"titelPost" => $this->titelPost,
			"textPost" => $this->textPost, 
			"idPost" => $this->idPost,
			"sessionMessage" => \core\lib\SessionHandler::readAndRemoveSession($this->sessionKey)
			)); 
	}
	/**
	* @return post
	*/
	public function getNewBloggPost(){
		$post = new \blogg\model\blogg\Post(intval($this->getCleanInput($this->idPost))); 
		$post->setText($this->getCleanInput($this->textPost));
		$post->setTitel($this->getCleanInput($this->titelPost)); 

		return $post; 
	}
	//Denna är unik för startsidan kanske flytta denna till en egen klass??
	public function setPagingVars($startPost, $numberOfPostsPerPage, $numberOfPostsInDb){
		$this->setViewVar("numberOfPostsInDb", $numberOfPostsInDb);

		$this->setViewVar("numberOfPostsPerPage", $numberOfPostsPerPage); 
		$this->setViewVar("pagingNext", $startPost + $numberOfPostsPerPage);

		if($startPost - $numberOfPostsPerPage < 0){
			$this->setViewVar("pagingPrev", 0); 
		}else{
			$this->setViewVar("pagingPrev", $startPost - $numberOfPostsPerPage); 
		}
	}
	/**
	* @param post
	*/
	public function setPostVar($post){
		$this->setViewVar("post", $post); 
	}
	/**
	* @param array Posts
	*/
	public function setPostsVar(array $posts){
		$this->setViewVar("posts", $posts);
	}
	public function setSaveSuccessfull(){
		 \core\lib\SessionHandler::setSession($this->sessionKey, "Blogginlägget har sparats! "); 
	}
	public function setSaveFailedVar(){
		$this->setViewVar("saveSuccessfull", false); 
	}

	/**
	* @param Bool
	*/
	public function setViewFullVar($viewFullBloggPost){
		$this->setViewVar("viewFullBloggPost", $viewFullBloggPost); 
	}

	/**
	* @param Bool
	*/
	public function setAdminLoggedInVar($adminIsLoggedIn){
		$this->setViewVar("adminIsLoggedIn", $adminIsLoggedIn); 
	}
	/**
	* @param Int
	*/
	public function setLoggedInUserId($loggedInUserId){
		$this->setViewVar("loggedInUserId", $loggedInUserId); 
	}

	public function setDeleteFailed(){
		$this->setViewVar("deleteFailed", "Ett oväntat fel har inträffat posten har inte kunnat tagits bort eftersom den inte hittats i databasen"); 
	}
}