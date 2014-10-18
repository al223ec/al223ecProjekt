<?php

namespace blogg\model\admin; 

class AdminModel{

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
}