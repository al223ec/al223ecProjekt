<?php

namespace blogg\view\twitter; 

class TwitterView extends \core\View{

	public function __construct(){
		$this->setPageHeader("Twitter"); 
	}
	public function getTweetsHTML($tweets){
		$ret = ""; 
		if($tweets){
			foreach ($tweets as $tweet) {
		        $ret .='<div class="col-lg-4">
			 			<img src="'. DS . 'img' . DS .'tweet.png" alt="tiwtter image">
					        <h2>'. $tweet->getName() .'</h2>
					        <p>' . $tweet->getText() .'</p>
					        <h5> ' . $tweet->getScreenName() . '</h5> 
						</div>'; 
			}
		}
		return $ret; 
	}

}
