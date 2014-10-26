<?php

namespace blogg\model\admin; 

class Settings {	
	private $twitterSettingsKey = 'twitterSettings';
	private $bloggSettingsKey = 'bloggSettings'; 
	private $instagramSettingsKey = 'instagramSettings' ; 

	private $settingObjects = array(); 

	private $filePath; 
	private $fileName = 'settings.xml';

	public function __construct(){
		$this->filePath = ROOT_DIR . $this->fileName; 
		
		$this->settingObjects[$this->bloggSettingsKey] =  new \blogg\model\admin\BloggSettings();
		$this->settingObjects[$this->twitterSettingsKey] = new \blogg\model\admin\TwitterSettings();
		$this->settingObjects[$this->instagramSettingsKey] = new \blogg\model\admin\InstagramSettings();

		$this->loadSettings(); 
	}

	public function getTwitterSettings(){
		return $this->settingObjects[$this->twitterSettingsKey]; 
	}

	public function getInstagramSettings(){
		return $this->settingObjects[$this->instagramSettingsKey]; 
	}
	public function getBloggsettings(){
		return $this->settingObjects[$this->bloggSettingsKey];
	}

	public function loadSettings(){
		$xml = \simplexml_load_file($this->filePath); 

		foreach ($this->settingObjects as $object) {
			$elementName = $object->getElementName(); 
			$object->loadSettings($xml->$elementName); 
		}
	}

	public function saveSettings($settingObjects = null){
		 //Creates XML string and XML document using the DOM 
	    $dom = new \DomDocument('1.0', 'UTF-8'); 
	   
	    //add root
	    $settings = $dom->appendChild($dom->createElement('settings'));
		if($settingObjects == null){
			$settingObjects = $this->settingObjects; 
		}
		foreach ($settingObjects as $object) {
			$settings->appendChild($object->saveSettings($dom)); 
		}

	    $dom->formatOutput = true; 
	    $dom->save($this->filePath);
	    return true; //Allt har gått väl
	}

	public function resetSettings(){
		$this->settingObjects[$this->bloggSettingsKey] =  new \blogg\model\admin\BloggSettings();
		$this->settingObjects[$this->twitterSettingsKey] = new \blogg\model\admin\TwitterSettings();
		$this->settingObjects[$this->instagramSettingsKey] = new \blogg\model\admin\InstagramSettings();
		$this->saveSettings(); 
		$this->loadSettings(); 
	}
}