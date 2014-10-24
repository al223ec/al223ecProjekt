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

	public function setPostVar($post){
		$this->setViewVar("post", $post); 
	}

	public function setPostsVar(array $posts){
		$this->setViewVar("posts", $posts);
	}
	public function setSaveSuccessfull(){
		 \core\lib\SessionHandler::setSession($this->sessionKey, "Blogginlägget har sparats! "); 
	}
	public function setSaveFailedVar(){
		$this->setViewVar("saveSuccessfull", false); 
	}

	public function setViewFullVar($viewFullBloggPost){
		$this->setViewVar("viewFullBloggPost", $viewFullBloggPost); 
	}

	public function setAdminLoggedInVar($adminIsLoggedIn){
		$this->setViewVar("adminIsLoggedIn", $adminIsLoggedIn); 
	}

	public function setLoggedInUserId($loggedInUserId){
		$this->setViewVar("loggedInUserId", $loggedInUserId); 
	}

}