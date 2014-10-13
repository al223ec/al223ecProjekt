<?php

namespace blogg\view\blogg; 

class BloggView extends \core\ View{

	protected static $bloggPostId = "BloggPostID"; 

	protected static $titelPost = "BloggView::titelPost"; 
	protected static $textPost = "BloggView::textPost"; 	
	protected static $idPost = "BloggView::idPost"; 	

	protected $bloggModel; 

	public function __construct(\model\Blogg $bloggModel = null){
		$this->bloggModel = $bloggModel;
	}	

	public function confirmDelete(){

	}

	public function viewBloggPost($post, $displayfull = false){
		$text =  $displayfull ? $post->getText() : substr($post->getText(), 0, 100); 

		$ret = '<h1>'. $post->getTitel() .' </h1>
			<p>' . $text  . '</p>
			<h5>Skrivet: '. gmdate("Y-m-d H:i:s", $post->getTime()) . '</h5>

		'; 
		
		$ret .= \blogg\controller\BloggController::$userIsloggedIn ? $this->getViewEditDeleteLinks($post->getId())  : '';

		return $ret; 
	}
	private function getViewEditDeleteLinks($id){
		 return "<a href='" . \core\Routes::getRoute('blogg', 'view')  . $id ."'> Visa</a> | 
                <a href='" . \core\Routes::getRoute('blogg', 'edit')  . $id ."'> Redigera</a>  | 
                <a href='" . \core\Routes::getRoute('blogg', 'delete')  . $id ."'> Ta bort</a>";
	}

	public function getNewBloggPost(){
		$bloggPost = new \blogg\model\blogg\ Post($this->getCleanInput(self::$idPost, self::$userIdPost)); 

		$bloggPost->setTitel($this->getCleanInput(self::$titelPost)); 
		$bloggPost->setText($this->getCleanInput(self::$textPost)); 

		return $bloggPost; 
	}

	public function viewAllPosts($posts){
		$ret = "";
		foreach ($posts as $post) {
			$ret .= $this->viewBloggPost($post); 
		 }
		 return $ret; 
	}
	

}