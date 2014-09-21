<?php

namespace view; 

require_once(ROOT_DIR. "/src/model/BloggPost.php");

class Blogg{

	private $errormessage; 

	const Action = "a"; 
	const ActionSave = "Save"; 
	const ActionEdit = "Edit"; 
	const ActionDelete = "Delete"; 
	const ActionDeletionConfirmed = "DeletionConfirmed"; 

	const BloggPostID = "BloggPostID"; 

	const Titel = "postTitel"; 
	const Text = "bloggText"; 

	const TitelErrorKey = "TitelError"; 
	const TextErrorKey = "TextErrorKey"; 

	private $bloggModel; 
	public static $AdminIsLoggedIn = true; 

	public function __construct(\model\Blogg $bloggModel){
		$this->errormessage = array();
		$this->bloggModel = $bloggModel; 
	}	

	public function getCurrentAction(){
		return isset($_GET[self::Action]) ? $_GET[self::Action] : "";
	}

	public function getCurrentID(){
		return isset($_GET[self::BloggPostID]) ? $_GET[self::BloggPostID] : 0;
	}

	public function getBloggPostForm(){
			return "
				<form action='?". self::Action ."=". self::ActionSave ."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Posta en post - Skriv in titel och text</legend>
					<fieldset>
						<label for='Titel' >Titel :</label>
						<input type='text' size='20' name='" . self::Titel ."' id='Titel' value='Enter title here' />
						<span class='errormessage'>" . $this->getErrorMessages(self::TitelErrorKey) ."</span>
					</fieldset>
					<fieldset>
						<label for='Text' >Text  :</label>
						<textarea name='" . self::Text ."' id='Text' value=''>
						</textarea>
						<span class='errormessage'>" . $this->getErrorMessages(self::TextErrorKey) . "</span>
					</fieldset>
					<input type='submit' name=''  value='Posta post' />
				</fieldset>
			</form>"; 
	}

	private function getErrorMessages($key){
		if (isset($this->errorMessages[$key])) {
			return "<span> " . $this->errorMessages[$key] . " </span>"; 
		}
	}

	public function saveBloggPost(){
		$titel = $this->getCleanInput(self::Titel); 
		$text = $this->getCleanInput(self::Text); 
		return new \model\BloggPost(3, "Anton", $titel, $text, time(), 0); 
	}

	public function confirmDelete(){
		$id = $this->getCurrentID(); 
		echo "<script>"; 
		echo "if(confirm('Bekräfta borttagning av post $id'))"; 
		echo "location.href = '?a=" . self::ActionDeletionConfirmed . "&" . self::BloggPostID . "=". $id . "'"; 
		echo "</script>"; 
	}

	public function redirect(){
		header("Location: " . $_SERVER["PHP_SELF"]); 
	}

	private function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : "";
	}
    
    private function sanitize($input) {
        $temp = trim($input);
        return filter_var($temp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }

	public function getAllBloggPosts(){
		$ret = "" ;
		$posts = $this->bloggModel->getBloggPosts(); 
		foreach ($posts as $key => $value) {
			$ret .= "<h1>" . $value->getTitel() . "</h1>"; 
			$ret .= "<p>" . $value->getText() . "</p>";

			if(self::$AdminIsLoggedIn){
				$ret.= "<p>" . $this->getActionTag(self::ActionEdit, "Redigera", $value->getBloggPostID()) . " | " 
				. $this->getActionTag(self::ActionDelete, "Ta bort", $value->getBloggPostID()) ."</p>"; 
			}
			$ret .= "<h5>" . $value->getAuthor() . "</h5>"; 
		}
		return $ret; 
	}

	private function getActionTag($action, $text, $id){
		return "<a href='?". self::Action . "=" . $action . "&" . self::BloggPostID . "=". $id . "'>" . $text ."</a>"; 
	}
}
/*

                 <form action='http://www.cs.tut.fi/cgi-bin/run/~jkorpela/echo.cgi' method='post'>
				  <div>
				    <label for='name'>Name:</label>
				    <input type='text' id='name' name='user_name'>
				  </div>

				  <div>
				    <label for='mail'>E-mail:</label>
				    <input type='email' id='mail' name='user_email'>
				  </div>

				  <div>
				    <label for='msg'>Message:</label>
				    <textarea id='msg' name='user_message'></textarea>
				  </div>
				 
				  <div class='button'>
				    <button type='submit'>Send your message</button>
				  </div>
				</form>

    Just to center the form on the page   
  margin: 0 auto;
  width: 400px;

    To see the limits of the form   
  padding: 1em;
  border: 1px solid #CCC;
  border-radius: 1em;
}

div + div {
  margin-top: 1em;
}

label {
    To make sure that all label have the same size and are properly align   
  display: inline-block;
  width: 90px;
  text-align: right;
}

input, textarea {
    To make sure that all text field have the same font settings
     By default, textarea are set with a monospace font   
  font: 1em sans-serif;

    To give the same size to all text field   
  width: 300px;

  -moz-box-sizing: border-box;
       box-sizing: border-box;

    To harmonize the look & feel of text field border   
  border: 1px solid #999;
}

input:focus, textarea:focus {
    To give a little highligh on active elements   
  border-color: #000;
}

textarea {
    To properly align multiline text field with their label   
  vertical-align: top;

    To give enough room to type some text   
  height: 5em;

    To allow users to resize any textarea vertically
     It works only on Chrome, Firefox and Safari   
  resize: vertical;
}

.button {
    To position the buttons to the same position of the text fields   
  padding-left: 90px;   same size as the label elements   
}

button {
    This extra magin represent the same space as the space between
     the labels and their text fields   
  margin-left: .5em;
}


				*/