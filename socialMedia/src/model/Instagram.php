<?php 

namespace model; 

class Instagram{
		private $userid = "1501720516";
		private $accessToken = "1501720516.ab103e5.0ece8fdbfaef4174a54e42f4c3b2bfb2";

		//var_dump("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		// Gets our data
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


		     /*
	        $options = array( 
	            CURLOPT_HTTPHEADER => $header,
	            CURLOPT_HEADER => false,
	            CURLOPT_URL => $this->url,
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_TIMEOUT => 10,
	        );
	        $feed = curl_init();
	        curl_setopt($feed, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt_array($feed, $options);
	        $json = curl_exec($feed);
		*/
		}

		//
		private function getHeader(){ 
			throw new \Exception("Instagram::getHeader() Fungerar inte", 1);
			
			$ips = $_SERVER["HTTP_USER_AGENT"];
			$secret = '0075c814a4ef4be9ad4cb9bab67b480f';

			$signature = (hash_hmac('sha256', $ips, $secret, false));
			$value = join('|', array($ips, $signature));
			return array(
				'HTTP Header: ' => "X-Insta-Forwarded-For",
				'Value: ' => $value);
			/*
			HTTP Header: X-Insta-Forwarded-For
			Value: [IP information]|[Signature]
			*/
		//	echo $header;
		}

		private function testHeader(){
			/*
			curl \
			  -X POST \
			  -F 'access_token=<your_access_token>' \
			  -H 'X-Insta-Forwarded-For: <your_ip_information>|<your_signature>' \
			  https://api.instagram.com/v1/media/657988443280050001_25025320/likes
			  *
			  */
		}

		public function getInstagramImages(){
			// Pulls and parses data.
			$result = $this->fetchData("https://api.instagram.com/v1/users/" .$this->userid . "/media/recent/?access_token=" . $this->accessToken);
			$result = json_decode($result);
			$ret = ""; 
			foreach ($result->data as $post){

				$ret .= "<img src=" . $post->images->thumbnail->url . ">"; 
				$ret .= "<img src=" . $post->images->low_resolution->url . ">";
				$ret .= "<img src=" . $post->images->standard_resolution->url . ">";
			}
			return $ret; 

		}
}