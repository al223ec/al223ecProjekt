<?php

namespace view; 

require_once(ROOT_DIR. "/blogg/src/model/BloggPost.php");

class BloggView{

	private $errorMessages; 

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

	private $currentBloggPost = null; 

	public function __construct(\model\Blogg $bloggModel){
		$this->errorMessages = array();
		$this->bloggModel = $bloggModel;
		$this->currentBloggPost = $this->getCurrentBloggPost();  
	}	

	public function getCurrentAction(){
		return isset($_GET[self::Action]) ? $_GET[self::Action] : "";
	}

	public function getCurrentID(){
		return isset($_GET[self::BloggPostID]) ? $_GET[self::BloggPostID] : 0;
	}

	public function getCurrentBloggPost(){
		return $this->currentBloggPost = $this->getCurrentID() !== 0 ? $this->bloggModel->getBloggPost($this->getCurrentID()) : null; 
	}

	public function getBloggPostForm(){
			$titel = $this->currentBloggPost !== null ? $this->currentBloggPost->getTitel() : "Skriv titeln här";  
			$text = $this->currentBloggPost !== null ? $this->currentBloggPost->getText() : "Skriv texten här"; 
			var_dump($this->errorMessages); 
			return "
				<form action='?". self::Action ."=". self::ActionSave ."' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Posta en post - Skriv in titel och text</legend>
					<fieldset>
						<label for='Titel' >Titel :</label>
						<input type='text' size='20' name='" . self::Titel ."' id='Titel' 
						value='Enter title here' />
						<span class='errormessage'>" . $this->getErrorMessages(self::TitelErrorKey) ."</span>
					</fieldset>
					<fieldset>
						<label for='Text' >Text  :</label>
						<textarea name='" . self::Text ."' id='Text' 
						value=''>
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
		
		if($titel === ""){
			$this->errorMessages[self::TitelErrorKey] = "Titel saknas!"; 
		}
		if(($text === "")){
			$this->errorMessages[self::TextErrorKey] = "Text saknas!"; 
		}

		if($this->currentBloggPost !== null){
			var_dump($this->currentBloggPost); 
			die();
		}
		return $titel && $text ? new \model\BloggPost(3, "Anton", $titel, $text, time(), 0) : null;  
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