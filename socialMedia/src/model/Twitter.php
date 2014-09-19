<?php 

namespace model; 

require_once(ROOT_DIR . "/src/model/TwitterAPIExchange.php");
require_once(ROOT_DIR . "/src/model/Tweet.php");

class Twitter{
		private $twitterSettings = array(
		    'oauth_access_token' => "2817132410-MZ6wqr0FQiTrES1tDWWTPI3u1mlcBDvsj77MKcV",
		    'oauth_access_token_secret' => "t4J1iWhOt3kPUOETGptyjs0gqYjGajMRdwdaqRLMkGyRd",
		    'consumer_key' => "cSU4oJkdSpjNeyO8XsLcpKbb4",
		    'consumer_secret' => "TZwHg9mTVqTghtuMxhxEceUNkjgefep9p371pvtBfhdidnciPS"
		);
		/**
		* TWITTER 
		* http://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1
		* https://github.com/J7mbo/twitter-api-php
		*/

		//$json = fetchData("https://api.twitter.com/1.1/statuses/user_timeline.json?user_id=2817132410&screen_name=al223ec"); //getting the file content
		public function performRequest(){
			/** Perform a GET request and echo the response **/
			/** Note: Set the GET field BEFORE calling buildOauth(); **/
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = '?screen_name=al223ec';
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($this->twitterSettings);
			$decode = json_decode($twitter->setGetfield($getfield)
			             ->buildOauth($url, $requestMethod)
			             ->performRequest(), true);


			$author = $decode[0]['user']['name']; 
			$text = $decode[0]['text']; 
			$tweet = new Tweet($author, $text); 

			var_dump($tweet); 
		}

/*
		array(1) { 
			[0]=> array(22) 
			{ 
				["created_at"]=> string(30) "Thu Sep 18 14:35:14 +0000 2014" ["id"]=> float(5.1261080356939E+17) ["id_str"]=> string(18) "512610803569393664" ["text"]=> string(10) "Testtewwte" ["source"]=> string(66) "Twitter Web Client" ["truncated"]=> bool(false) ["in_reply_to_status_id"]=> NULL ["in_reply_to_status_id_str"]=> NULL ["in_reply_to_user_id"]=> NULL ["in_reply_to_user_id_str"]=> NULL ["in_reply_to_screen_name"]=> NULL ["user"]=> array(39) { ["id"]=> float(2817132410) ["id_str"]=> string(10) "2817132410" ["name"]=> string(15) "Anton LedstrÃ¶m" ["screen_name"]=> string(7) "al223ec" ["location"]=> string(0) "" ["description"]=> string(0) "" ["url"]=> NULL ["entities"]=> array(1) { ["description"]=> array(1) { ["urls"]=> array(0) { } } } ["protected"]=> bool(false) ["followers_count"]=> int(0) ["friends_count"]=> int(0) ["listed_count"]=> int(0) ["created_at"]=> string(30) "Thu Sep 18 14:31:15 +0000 2014" ["favourites_count"]=> int(0) ["utc_offset"]=> NULL ["time_zone"]=> NULL ["geo_enabled"]=> bool(false) ["verified"]=> bool(false) ["statuses_count"]=> int(1) ["lang"]=> string(2) "sv" ["contributors_enabled"]=> bool(false) ["is_translator"]=> bool(false) ["is_translation_enabled"]=> bool(false) ["profile_background_color"]=> string(6) "C0DEED" ["profile_background_image_url"]=> string(48) "http://abs.twimg.com/images/themes/theme1/bg.png" ["profile_background_image_url_https"]=> string(49) "https://abs.twimg.com/images/themes/theme1/bg.png" ["profile_background_tile"]=> bool(false) ["profile_image_url"]=> string(79) "http://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png" ["profile_image_url_https"]=> string(80) "https://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png" ["profile_link_color"]=> string(6) "0084B4" ["profile_sidebar_border_color"]=> string(6) "C0DEED" ["profile_sidebar_fill_color"]=> string(6) "DDEEF6" ["profile_text_color"]=> string(6) "333333" ["profile_use_background_image"]=> bool(true) ["default_profile"]=> bool(true) ["default_profile_image"]=> bool(true) ["following"]=> bool(false) ["follow_request_sent"]=> bool(false) ["notifications"]=> bool(false) } ["geo"]=> NULL ["coordinates"]=> NULL ["place"]=> NULL ["contributors"]=> NULL ["retweet_count"]=> int(0) ["favorite_count"]=> int(0) ["entities"]=> array(4) { ["hashtags"]=> array(0) { } ["symbols"]=> array(0) { } ["urls"]=> array(0) { } ["user_mentions"]=> array(0) { } } ["favorited"]=> bool(false) ["retweeted"]=> bool(false) ["lang"]=> string(2) "pt" } }
*/
}