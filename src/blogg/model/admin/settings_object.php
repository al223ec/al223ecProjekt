<?php

namespace blogg\model\admin; 

class SettingsObject {

	protected $data = array(); 
	protected $elementName; 

	public function loadSettings($xmlNode){
        foreach ($this->data as $key => $value) {
            $this->data[$key] = (string)$xmlNode->$key; 
        }
	}

	public function saveSettings($dom){
		if(!isset($this->elementName)){
			throw new \Exception("SettingsObject::saveSettings You haven't set elementName");
		}
		$node =  $dom->createElement($this->elementName); 

		foreach ($this->data as $key => $value) {
			$setting = $dom->createElement($key); 
			$setting->appendChild($dom->createTextNode($value));
			$node->appendChild($setting); 
		}
		return $node; 
	}

	public function getElementName(){
		return $this->elementName; 
	}

    public function getPropertyNames(){
    	$ret = array(); 
    	foreach ($this->data as $key => $value) {
 			$ret[] = $key; 
    	}
    	return $ret; 
    }

    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            // non-existant property
            // => up to you to decide what to do
        }
    }

    public function __set($name, $value) {
    	//kolla issset 
    	$this->data[$name] = $value; 
        if ($name === 'numberOfPosts') {
        //    throw new Exception("not allowed : $name");
        } else {
            // => up to you to decide what to do
        }
    }

    public function getDisplayInput($property){

    } 

    public function getDisplayName($property){
    	return "!" . $property; 

    }
}
