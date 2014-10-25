<?php

namespace blogg\model\instagram; 

class InstagramModel { 
	
		private $userid; 
		private $accessToken; 

		public function __construct($instagramSettings){
			$this->userid =  $instagramSettings->instagramUserId;
			$this->accessToken = $instagramSettings->accessToken;
		}

		private function fetchData($url){
		     $ch = curl_init();
		     //http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/
		     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		     curl_setopt($ch, CURLOPT_URL, $url);
		     //curl_setopt($ch, CURLOPT_POSTFIELDS, "POST"); 
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 200); 
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		public function getInstagramImages($numberOfposts = 0){
			// Pulls and parses data.
			$result = $this->fetchData("https://api.instagram.com/v1/users/" .$this->userid . "/media/recent/?access_token=" . $this->accessToken);
			$result = json_decode($result);
			
			$ret = array(); 
			if($numberOfposts === 0){
				foreach ($result->data as $post){
					$ret[] = new \blogg\model\instagram\InstagramPost($post);
				} 
			} else {
				$index = 1; 
				if(isset($result)){
					foreach ($result->data as $post){
						$ret[] = new \blogg\model\instagram\InstagramPost($post);
						$index += 1; 
						
						if($index > $numberOfposts){
							break; 
						}
					} 
				}
			}
			return $ret; 

		}
}