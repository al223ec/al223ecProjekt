<?php

namespace blogg\view\blogg; 

class BloggView extends \blogg\view\BaseView{

	private $titelPost = "BloggView::titelPost"; 
	private $textPost = "BloggView::textPost"; 
	private $idPost = "BloggView::idPost"; 

	public function __construct(){
		$this->setPageTitel("Blogg");
		$this->setViewVars(array(
			"titelPost" => $this->titelPost,
			"textPost" => $this->textPost, 
			"idPost" => $this->idPost
			)); 
	}

	public function getNewBloggPost(){
		$post = new \blogg\model\blogg\Post(intval($this->getCleanInput($this->idPost))); 
		$post->setText($this->getInputWithBrTags($this->textPost));
		$post->setTitel($this->getCleanInput($this->titelPost)); 

		return $post; 
	}

	private function getInputWithBrTags($inputName){
		$ret = $this->getInput($inputName); 
		$ret = str_replace(array("\r", "\n"), "temporaryPlaceholderForBrTag", $ret);
//		$ret = filter_var($ret, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); //Ta bort ev script taggar etc funkar inte att göra på detta sätt vid redigering
		$ret = str_replace("temporaryPlaceholderForBrTag", "<br>", $ret);
		return $ret; 
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
	public function setSaveFailedVar(){
		$this->setViewVar("saveSuccessfull", false); 
	}

	public function setViewFullVar($bool){
		$this->setViewVar("viewFullBloggPost", $bool); 
	}

}