<?php

namespace test\model; 


require_once ('./core/base_object.php');
require_once ('./src/blogg/model/blogg/post.php');

class TestBloggPost extends \PHPUnit_Framework_TestCase {
	
	private $post;
	private $id = 1; 
	private $user_id = 1;  

	public static function setUpBeforeClass (){
 	}

	public function setUp(){
		$this->post = new \blogg\model\blogg\Post($this->id, $this->user_id);
	}

	/**     * @expectedException Exception     */ 
	public function testConstruct(){
		$post = new \blogg\model\blogg\Post(1, 0);
	}


	public function testSetters(){
		$titel = "Ett blogg inläggs titel";
		$text = "Bacon ipsum dolor sit amet tail porchetta cow biltong short ribs. Filet mignon ball tip pancetta sausage leberkas, tail chicken fatback pork chop short loin pork loin tenderloin. T-bone pork loin pork chop pastrami, short ribs ball tip beef spare ribs flank pork belly. Cow salami turkey ham, venison jowl porchetta sirloin t-bone short loin pork belly pork. Pig meatball porchetta shank brisket spare ribs short ribs strip steak pork chop pastrami chuck ham doner biltong sausage"; 
		$time = Time();

		$this->post->setTitel($titel); 
		$this->post->setText($text);
		$this->post->setTime($time); 

		$this->assertEquals($this->readPrivatePorperty($this->post, 'titel'), $titel); //Läs den privata variabeln
		$this->assertEquals($this->readPrivatePorperty($this->post, 'text'), $text);
		$this->assertEquals($this->readPrivatePorperty($this->post, 'time'), $time);
	}

	private function readPrivatePorperty($obj, $property){
		$reflection = new \ReflectionClass($obj);
		$reflectedProperty = $reflection->getProperty($property); 
		$reflectedProperty->setAccessible(true); //Ordna så den privata variabeln går att komma åt

		return $reflectedProperty->getValue($obj); 
	}
}

