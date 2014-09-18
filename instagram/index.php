<!DOCTYPE html>
<html>
	<?php
		// Supply a user id and an access token
		$userid = "1501720516";
		$accessToken = "1501720516.ab103e5.0ece8fdbfaef4174a54e42f4c3b2bfb2";

		//var_dump("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		// Gets our data
		function fetchData($url){
		     $ch = curl_init();

		     //http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/
		     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		// Pulls and parses data.
		$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		//var_dump($result); 
		$result = json_decode($result);
		//var_dump($result->data); 

		foreach ($result->data as $post){
			echo "<img src=" . $post->images->thumbnail->url . ">"; 
			echo "<img src=" . $post->images->low_resolution->url . ">";
			echo "<img src=" . $post->images->standard_resolution->url . ">";
		}
	 ?>
</html>

<p>
<!--
object(stdClass)#1 (3) {
 ["pagination"]=> object(stdClass)#2 (0) { } 
 ["meta"]=> object(stdClass)#3 (1) 
 	{ 
 		["code"]=> int(200) 
 	} 
 ["data"]=> array(1) 
 	{ 
 		[0]=> object(stdClass)#4 (15) 
 			{ 	
 				["attribution"]=> NULL 
 				["tags"]=> array(0) { } 
				["type"]=> string(5) "image" 
 				["location"]=> NULL 
 				["comments"]=> object(stdClass)#5 (2) 
 					{ 
 						["count"]=> int(0) 
 						["data"]=> array(0) { } 
 					} 
 				["filter"]=> string(6) "Normal" 
 				["created_time"]=> string(10) "1411042914" 
 				["link"]=> string(34) "http://instagram.com/p/tFjA0oiBTq/" 
 				["likes"]=> object(stdClass)#6 (2) 
 					{
 						["count"]=> int(0) ["data"]=> array(0) { } 
 					} 
 				["images"]=> object(stdClass)#7 (3) 
 					{ 
 						["low_resolution"]=> object(stdClass)#8 (3) 
 							{ 
 								["url"]=> string(101) "http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10665598_758955330846322_1609265676_a.jpg" 
 								["width"]=> int(306) 
 								["height"]=> int(306) 
 							} 
 						["thumbnail"]=> object(stdClass)#9 (3) 
 							{ 
 								["url"]=> string(101) "http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10665598_758955330846322_1609265676_s.jpg" 
 								["width"]=> int(150) 
 								["height"]=> int(150) 
 							} 
 						["standard_resolution"]=> object(stdClass)#10 (3) 
 							{ 
 								["url"]=> string(101) "http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10665598_758955330846322_1609265676_n.jpg" 
 								["width"]=> int(640) 
 								["height"]=> int(640) 
 							} 
 					} 
 				["users_in_photo"]=> array(0) { } 
 				["caption"]=> NULL 
 				["user_has_liked"]=> bool(false) 
 				["id"]=> string(29) "812209295952712938_1501720516" 
 				["user"]=> object(stdClass)#11 (6) 
 					{ 
 						["username"]=> string(7) "al223ec" 
 						["website"]=> string(0) "" 
 						["profile_picture"]=> string(57) "http://images.ak.instagram.com/profiles/anonymousUser.jpg" 
 						["full_name"]=> string(7) "al223ec" 
 						["bio"]=> string(0) "" 
 						["id"]=> string(10) "1501720516" 
 					} 
 				}
 			} 
 		} !-->
</p>

 </html>