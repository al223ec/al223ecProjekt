<?php

namespace blogg\view; 

class BloggView extends \core\ View{

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
				<form action="'. \core\Routes::getRoute('blogg', 'save'). '" method="post" enctype="multipart/form-data">
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

	public function getNewBloggPost(){
		$bloggPost = new \blogg\model\blogg\ Post(); 

		$bloggPost->setTitel($this->getCleanInput(self::$titelPost)); 
		$bloggPost->setText($this->getCleanInput(self::$textPost)); 

		return $bloggPost; 

	}

	//Flytta dessa till en basklass

	public function getAllBloggPosts(){
		$ret = "" ;
		$posts = $this->bloggModel->getBloggPosts(); 

		foreach ($posts as $key => $value) {
			$ret .= "<h1>" . $value->getTitel() . "</h1>"; 
			$ret .= "<p>" . $value->getText() . "</p>";
			$ret .= "<h5>" . $value->getAuthor() . "</h5>"; 
		}
		return $ret; 
	}
}