<?php

namespace blogg\model\admin; 

class Settings {	
	private $twitterSettingsKey = 'twitterSettings';
	private $bloggSettingsKey = 'bloggSettings'; 
	private $instagramSettingsKey = 'instagramSettings' ; 

	private $bloggSettings; 
	private $settingObjects = array(); 

	private $filePath; 
	private $fileName = 'settings.xml';

	public function __construct($resetSettings = false){
		$this->filePath = SRC_DIR . "blogg" . DS . "model" . DS . "admin" . DS . $this->fileName; 
		
		$this->bloggSettings = new \blogg\model\admin\BloggSettings();
		$this->settingObjects[$this->bloggSettingsKey] = $this->bloggSettings; 
		$this->settingObjects[$this->twitterSettingsKey] = new \blogg\model\admin\TwitterSettings();
		$this->settingObjects[$this->instagramSettingsKey] = new \blogg\model\admin\InstagramSettings();

		if($resetSettings){
			$this->saveSettings(); 
			$this->loadSettings(); 
		}else{
			$this->loadSettings(); 
		}
	}

	public function getTwitterSettings(){
		return $this->settingObjects[$this->twitterSettingsKey]; 
	}

	public function getInstagramSettings(){
		return $this->settingObjects[$this->instagramSettingsKey]; 
	}
	public function getBloggsettings(){
		return $this->bloggSettings;
	}

	public function loadSettings(){
		$xml = \simplexml_load_file($this->filePath); 
		
		foreach ($this->settingObjects as $object) {

			$elementName = $object->getElementName(); 
			$object->loadSettings($xml->$elementName); 
		}
	}

	public function saveSettings(){
		 //Creates XML string and XML document using the DOM 
	    $dom = new \DomDocument('1.0', 'UTF-8'); 
	   
	    //add root
	    $settings = $dom->appendChild($dom->createElement('settings'));
		
		foreach ($this->settingObjects as $object) {
			$settings->appendChild($object->saveSettings($dom)); 
		}

	    $dom->formatOutput = true; 
	    $dom->save($this->filePath);
	    return true; //Allt har gått väl
	}
}