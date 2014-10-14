<?php

namespace blogg\view\blogg; 

class BloggView extends \core\View{
	//TODO: Dela upp denna vyn
	protected static $bloggPostId = "BloggPostID"; 

	protected static $titelPost = "BloggView::titelPost"; 
	protected static $textPost = "BloggView::textPost"; 	
	protected static $idPost = "BloggView::idPost"; 	

	protected $bloggModel; 

	public function __construct(\model\Blogg $bloggModel = null){
		$this->bloggModel = $bloggModel;
		$this->setPageHeader("Bloggen"); 
	}	

	public function confirmDelete($post){
		$ret = $this->getBloggPostHTML($post, false);

		$ret .= '<p> Detta kommer att ta bort inlägget</p>
		<a href="' . \core\Routes::getRoute('blogg', 'deleteConfirmed')  . $post->getId() .'"> Bekräfta borttagning </a>'; 
		
		return $ret; 
	}

	public function viewBloggPost($post, $displayfull = false){
		$ret = $this->getBloggPostHTML($post, $displayfull);

		$ret .= $displayfull ? $this->getPostFooter() : ""; 
		$ret .= \blogg\controller\BloggController::$userIsloggedIn ? $this->getViewEditDeleteLinks($post->getId())  : '';

		return $ret; 
	}

	private function getBloggPostHTML($post, $displayfull){
		$text =  $displayfull ? $post->getText() : substr($post->getText(), 0, 120); 

		return '<h1> <a href="' . \core\Routes::getRoute('blogg', 'view')  . $post->getId() .'">'. $post->getTitel() .' </a></h1>
				<p>' . $text  . '</p>
				<h5>Skrivet: '. gmdate("Y-m-d H:i:s", $post->getTime()) . '</h5>
			'; 
	}


	private function getViewEditDeleteLinks($id){
		 return "<a href='" . \core\Routes::getRoute('blogg', 'edit')  . $id ."'> Redigera</a>  | 
                <a href='" . \core\Routes::getRoute('blogg', 'delete')  . $id ."'> Ta bort</a>";
	}

	private function getPostFooter(){
		 return "<a href='" . \core\Routes::getRoute('blogg', 'main') ."'> Tillbaka</a>"; 
	}

	public function getNewBloggPost(){
		$bloggPost = new \blogg\model\blogg\ Post($this->getCleanInput(self::$idPost)); 
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