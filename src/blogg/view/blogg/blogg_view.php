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
		$post = new \blogg\model\blogg\Post(); 
		$post->setText($this->getCleanInput($this->textPost));
		$post->setTitel($this->getCleanInput($this->titelPost)); 

		return $post; 
	}

	public function setPostVar($post){
		$this->setViewVar("post", $post); 
	}

	public function setPostsVar(array $posts){
		$this->setViewVar("posts", $posts);
	}
	public function setSaveSuccessfullVar(){
		$this->setViewVar("saveSuccessfull", false); 
	}
}