<?php

namespace blogg\view; 

class BloggView {

	private static $bloggPostId = "BloggPostID"; 

	private static $titelPost = "BloggView::titelPost"; 
	private static $textPost = "BloggView::textPost"; 

	private $bloggModel; 

	public static $AdminIsLoggedIn = true; 
	private $currentBloggPost = null; 

	public function __construct(\model\Blogg $bloggModel = null){
		$this->bloggModel = $bloggModel;
		//$this->currentBloggPost = $this->getCurrentBloggPost();  //Kanske inte?? 
	}	


	public function getBloggPostForm(){
		return '
				<form action="" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Posta en post - Skriv in titel och text</legend>
					<fieldset>
						<label for="Titel" >Titel :</label>
						<input type="text" size="20" name="' . self::$titelPost .'" id="Titel" 
						value="Skriv titeln här" />
					</fieldset>
					<fieldset>
						<label for="Text" >Text  :</label>
						<textarea name="' . self::$textPost . '" id="Text" 
						value="">
						</textarea>
					</fieldset>
					<input type="submit" name=""  value="Posta post" />
				</fieldset>
			</form>'; 
	}

	public function confirmDelete(){
		$id = $this->getCurrentID(); 
		echo "<script>"; 
		echo "if(confirm('Bekräfta borttagning av post $id'))"; 
		echo "</script>"; 
	}


	//Flytta dessa till en basklass
	private function getCleanInput($inputName) {
		return isset($_POST[$inputName]) ? $this->sanitize($_POST[$inputName]) : "";
	}
    private function getInput($inputName) {
		return isset($_POST[$inputName]) ? $_POST[$inputName] : "";
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
}