<?php

namespace blogg\model\instagram; 

class InstagramPost {
	private $image; //??

	private $thumbnailUrl; 
	private $lowResolutionUrl;
	private $standardResolutionUrl;

	private $response; 

	public function __construct($response){
		$this->response = $response; 
		$this->readResponse($response); 
	}

	private function readResponse($response){
		$this->thumbnailUrl = $response->images->thumbnail->url; 
		$this->lowResolutionUrl = $response->images->low_resolution->url;
		$this->standardResolutionUrl = $response->images->standard_resolution->url;
	}

	public function getLowResolutionUrl(){
		return $this->lowResolutionUrl; 
	}
} 
