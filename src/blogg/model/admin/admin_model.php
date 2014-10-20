<?php

namespace blogg\model\admin; 

class AdminModel{

	private $userRepository; 

	public function __construct(){
		$this->userRepository = new \auth\model\repository\UserRepository();
	}

	public function loadSettings(){
		
	}

	public function saveSettings(){
		 //Creates XML string and XML document using the DOM 
		
	    $dom = new DomDocument('1.0', 'UTF-8'); 

	    //add root
	    $root = $dom->appendChild($dom->createElement('Root'));

	    //add NodeA element to Root
	    $nodeA = $dom->createElement('NodeA');
	    $root->appendChild($nodeA);

	    // Appending attr1 and attr2 to the NodeA element
	    $attr = $dom->createAttribute('attr1');
	    $attr->appendChild($dom->createTextNode('some text'));
	    $nodeA->appendChild($attr);
		/*
		** insert more nodes
		*/

	    $dom->formatOutput = true; // set the formatOutput attribute of domDocument to true

	    // save XML as string or file 
	    $test1 = $dom->saveXML(); // put string in test1
	    $dom->save('test1.xml'); // save as file
	}

	public function saveUser($newUser){
		if(!$this->ceckIfUserNameExists($newUser->getUserName())){
			return $this->userRepository->addUser($newUser); 
		}else{
			return false; 
		}
	}
	/**
	* @return True if exists
	*/
	public function ceckIfUserNameExists($userName){
		return $this->userRepository->getUserWithUserName($userName) !== null;
	}

	public function getUserWithId($id){
		return $this->userRepository->getUserWithId($id); 
	}
}