<?php

namespace blogg\model\twitter; 

class Twitter{

	private $twitterSettings = array(
		    'oauth_access_token' => "2817132410-MZ6wqr0FQiTrES1tDWWTPI3u1mlcBDvsj77MKcV",
		    'oauth_access_token_secret' => "t4J1iWhOt3kPUOETGptyjs0gqYjGajMRdwdaqRLMkGyRd",
		    'consumer_key' => "cSU4oJkdSpjNeyO8XsLcpKbb4",
		    'consumer_secret' => "TZwHg9mTVqTghtuMxhxEceUNkjgefep9p371pvtBfhdidnciPS"
		);
	public function __construct(){
		echo $this->postTweet("Postat med PHP");
		die();
	}

	/**
	* TWITTER 
	* http://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1
	* https://github.com/J7mbo/twitter-api-php
	*///$json = fetchData("https://api.twitter.com/1.1/statuses/user_timeline.json?user_id=2817132410&screen_name=al223ec"); //getting the file content
	public function getTweets($numberOfTweets){
		$ret = array();
		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name=al223ec';
		$requestMethod = 'GET';
		$twitter = new TwitterApiExchange($this->twitterSettings);
		$decode = json_decode($twitter->setGetfield($getfield)
		             ->buildOauth($url, $requestMethod)
		             ->performRequest(), true);

		if($decode){
			$index = 1; 
			foreach ($decode as $key => $value) {
				if($value['user'] && $value['text']){
					$ret[] = new Tweet($value['user']['name'], $value['text'], $value['user']['screen_name']); 
				}
				$index += 1; 
				if($index > $numberOfTweets){
					break; 
				}

			}
		}
		return $ret; 
	}	

	public function postTweet($tweet){
		if(strlen($tweet) > 140){ //Fail
			return; 
		}
		$postfields = array(
		    'status' => $tweet,
		);
		$url = 'https://api.twitter.com/1.1/statuses/update.json';
		$requestMethod = 'POST';

		$twitter = new TwitterApiExchange($this->twitterSettings);
		return $twitter->buildOauth($url, $requestMethod)
		             ->setPostfields($postfields)
		             ->performRequest();
	}
}