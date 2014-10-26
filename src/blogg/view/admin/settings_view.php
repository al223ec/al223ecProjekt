<?php

namespace blogg\view\admin; 

class SettingsView extends \blogg\view\BaseView {

	private $settingObjects = array();  
	/*
		private $displayNames = array(
			"numberOfImages" => "Antalet bilder",
			"instagramUserId" => "User Id",
			"accessToken" => "Access token",

			'numberOfPosts' => "Antalet tweets",
			'oauthAccessToken' => "Oauth access token",
			'oauthAccessTokenSecret' => "Oauth access secret",
			'consumerKey' => "Consumer key",
			'consumerSecret' => "Consumer secret",

			"bloggNumberOfBloggPostsPerPage" => "Poster per sida",
			"dbPassword" => "Databas lösen",
			"dbUserName" => "Databas användarnamn",
			"dbName" => "Databas namn",
			"dbIpAddress" => "Databas ip-adress",
			"connectionString" => ""
			); 
	  <?php 
	    foreach ($bloggSettings->getPropertyNames() as $name) {?>
	    <div class="form-group">
	        <label for="db_password" class="col-sm-2 control-label"><?php echo $displayNames[$name]; ?></label>
	        <div class="col-sm-6">
	         <?php if($bloggSettings->getDisplayInput($name)) { } ?>
	          <input type="text" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>"  
	          placeholder="<?php echo $displayNames[$name]; ?>" value="<?php echo $bloggSettings->$name; ?>" >
	        </div>
	    </div>
	<?php } ?>
	*/
	public function __construct($settings){
		$this->settingObjects[] = $settings->getTwitterSettings(); 
		$this->settingObjects[] = $settings->getBloggSettings(); 
		$this->settingObjects[] = $settings->getInstagramSettings(); 

		$arr = array(); 
	    foreach ($this->settingObjects as $settingObject) {
	    	$properties = $settingObject->getPropertyNames(); 
	    	foreach ($properties as $property) {
	    		$arr[$property] = $property;  
	    	}
		}

   		$this->setViewVars($arr);
   		$this->setViewVars(array(
   				"twitterSettings" => $settings->getTwitterSettings(),
   				"bloggSettings" => $settings->getBloggSettings(),
   				"instagramSettings" => $settings->getInstagramSettings()
   				)); 
	}

	public function saveSettings(){	
	    foreach ($this->settingObjects as $settingObject) {
	    	$properties = $settingObject->getPropertyNames(); 
	    	foreach ($properties as $property) {
	    		$cleanInput = $this->getCleanInput($property); 
	    		$settingObject->$property = $cleanInput !== "" ? $cleanInput : $settingObject->$property;  
	    	}
		}
		return $this->settingObjects; 
	}

	public function setSaveMessage($bool){
		$saveMessage = $bool ? "Inställningarna har sparats! " : "Något har gått fel, som dessutom inte kastat undantag"; 
		$this->setViewVar("saveMessage" , $saveMessage); 
	}

}