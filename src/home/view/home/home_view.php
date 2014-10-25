<?php

namespace home\view\home; 

class HomeView extends \blogg\view\BaseView{

	public function __construct(){ 
	}

	public function setTweets($tweets){
		$this->setViewVar("tweets", $tweets); 
	}

	public function setImages($images){
		$this->setViewVar("images", $images); 
	}

	public function setPosts($posts){
		$this->setViewVar("posts", $posts); 
	}	
}