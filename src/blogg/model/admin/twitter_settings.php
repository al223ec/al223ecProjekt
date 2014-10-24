<?php

namespace blogg\model\admin; 

class TwitterSettings extends SettingsObject{

	protected $data = array(
		'twitterNumberOfPosts' => 15,
		'oauthAccessToken' => "2817132410-euMdEPUEClDiJsDDxejHzOlCzJUZ6RyDUkl0VC7",
		'oauthAccessTokenSecret' => "U9GmdIhEFnzk3oVLaNeoQTXQMEldoRa77PjamD61VtKzF",
		'consumerKey' => "cSU4oJkdSpjNeyO8XsLcpKbb4",
		'consumerSecret' => "TZwHg9mTVqTghtuMxhxEceUNkjgefep9p371pvtBfhdidnciPS"
	); 

    protected $elementName = "twitterSettings"; 
}	