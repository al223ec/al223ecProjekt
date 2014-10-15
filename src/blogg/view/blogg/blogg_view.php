<?php

namespace blogg\view\blogg; 

class BloggView extends \core\View{
	//TODO: Dela upp denna vyn
	protected static $bloggPostId = "BloggPostID"; 

	protected static $titelPost = "BloggView::titelPost"; 
	protected static $textPost = "BloggView::textPost"; 	
	protected static $idPost = "BloggView::idPost"; 	

	public function __construct(){
		$this->setPageHeader("Bloggen"); 
	}	

	public function confirmDelete($post){
		$ret = $this->getBloggPostHTML($post, false);

		$ret .= '<p> Detta kommer att ta bort inlägget</p>
		<a href="' . \core\Routes::getRoute('blogg', 'deleteConfirmed')  . $post->getId() .'"> Bekräfta borttagning </a>'; 
		
		return $ret; 
	}

	public function viewBloggPost($post, $displayfull = false){
		$html = $displayfull ? $this->getPostFooter() : ""; 
		$html .= \blogg\controller\BloggController::$userIsloggedIn ? $this->getViewEditDeleteLinks($post->getId())  : '';
		
		return $this->getBloggPostHTML($post, $displayfull, $html);
	}

	private function getBloggPostHTML($post, $displayfull, $html = ""){
		$text =  $displayfull ? $post->getText() : substr($post->getText(), 0, 120); 

		return '
				<div class="row bloggpost">
					<div class="col-md-7">
						<h1> <a href="' . \core\Routes::getRoute('blogg', 'view')  . $post->getId() .'">'. $post->getTitel() .' </a></h1>
						<p>' . $text  . '</p>
						<h5>Skrivet: '. gmdate("Y-m-d H:i:s", $post->getTime()) . '</h5>
						' . $html .'
					</div>
					<div class="col-md-5">
						placeholder för bild, kanske kan välja en instagram bild? 
					</div>
					<div class="col-md-12">
						<hr>
					</div>
				</div>
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