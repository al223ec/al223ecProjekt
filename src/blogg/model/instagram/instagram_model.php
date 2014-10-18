<?php

namespace blogg\model\instagram; 

class InstagramModel { 
	
		private $userid = "1501720516";
		private $accessToken = "1501720516.ab103e5.0ece8fdbfaef4174a54e42f4c3b2bfb2";

		private function fetchData($url){
		     $ch = curl_init();
		     //http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/
		     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		     curl_setopt($ch, CURLOPT_URL, $url);
		     //curl_setopt($ch, CURLOPT_POSTFIELDS, "POST"); 
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		public function getInstagramImages($numberOfposts = 0){
			// Pulls and parses data.
			$result = $this->fetchData("https://api.instagram.com/v1/users/" .$this->userid . "/media/recent/?access_token=" . $this->accessToken);
			$result = json_decode($result);
			
			$ret = []; 
			if($numberOfposts === 0){
				foreach ($result->data as $post){
					$ret[] = new \blogg\model\instagram\InstagramPost($post);
				} 
			} else {
				$index = 0; 
				foreach ($result->data as $post){
					$ret[] = new \blogg\model\instagram\InstagramPost($post);
					$index += 1; 
					
					if($index > $numberOfposts){
						break; 
					}
				} 
			}
			return $ret; 

		}
}