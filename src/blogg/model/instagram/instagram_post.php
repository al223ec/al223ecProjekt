<?php

namespace blogg\model\instagram; 

class InstagramPost {
	private $image; //??

	private $thumbnailUrl; 
	private $lowResolutionUrl;
	private $standardResolutionUrl;
	private $unique; 

	private $response; 

	public function __construct($response){
		$this->response = $response; 
		$this->readResponse($response); 
	}

	private function readResponse($response){
		$this->thumbnailUrl = $response->images->thumbnail->url; 
		$this->lowResolutionUrl = $response->images->low_resolution->url;
		$this->standardResolutionUrl = $response->images->standard_resolution->url;
		$this->unique = $response->created_time; //Tror att den är ganska uniq iaf
	}
	public function getThumbnailUrl(){
		return $this->thumbnailUrl; 
	}

	public function getLowResolutionUrl(){
		return $this->lowResolutionUrl; 
	}

	public function getStandardResolutionUrl(){
		return $this->standardResolutionUrl; 
	}
	public function getUnique(){
		return $this->unique; 
	}
} 
