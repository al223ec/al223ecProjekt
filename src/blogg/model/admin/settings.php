<?php

namespace blogg\model\admin; 

class Settings {	

	public static $NUMBER_OF_BLOGGPOSTS_PER_PAGE = 10; 
	public static $TWITTER_NUMBER_OF_POSTS = 15; 

	private $filePath; 
	private $fileName = 'blogg_settings.xml';

	public function __construct(){
		$this->loadSettings();
		$this->filePath = SRC_DIR . "blogg" . DS . "model " . DS . "admin" . DS . $this->fileName; 
	}

	public function loadSettings(){

	}

	public function saveSettings(){
		 //Creates XML string and XML document using the DOM 
	    $dom = new \DomDocument('1.0', 'UTF-8'); 
	   
	    //add root
	    $settings = $dom->appendChild($dom->createElement('settings'));
		
		$reflection = new \ReflectionClass($this); 
        $staticProperties = $reflection->getStaticProperties(); 
		foreach ($staticProperties as $staticPropertie => $staticPropertieValue) {
			$settings->appendChild($this->createSettingsElement($dom, $staticPropertie, $staticPropertieValue));
		}
	    $dom->formatOutput = true; 
	    $dom->save($this->filePath);
	}

	private function createSettingsElement($dom, $property, $value){
		$node = $dom->createElement($property); 
		$node->appendChild($dom->createTextNode($value)); 

		return $node; 
	}
}