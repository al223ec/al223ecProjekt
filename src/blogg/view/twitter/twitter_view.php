<?php

namespace blogg\view\twitter; 

class TwitterView extends \blogg\view\BaseView {

	public function __construct(){
		$this->setPageTitel("Twitter");
	}

	public function setTweets($tweets){
		$this->setViewVar("tweets", $tweets); 
	}
}
