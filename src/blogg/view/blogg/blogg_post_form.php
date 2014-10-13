<?php

namespace blogg\view\blogg;

class BloggPostForm extends BloggView{

	public function getBloggPostAddEditForm($post = null){
		$errors = ""; 
		$id = 0; 
		if($post !== null){
			$errors = $this->populateErrorList($post->getErrors()); 
			$id = $post->getId();
		}
		return '
				<p>
				' . $errors .' 
				</p>
				<form action="'. \core\Routes::getRoute('blogg', 'save'). '" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Posta en post - Skriv in titel och text</legend>
					<fieldset>
						<label for="Titel" >Titel :</label>
						<input type="text" size="20" name="' . self::$titelPost .'" id="Titel" value="" />
					</fieldset>
					<input type="hidden" id="' . self::$idPost . '" name="' . self::$idPost . '" value="' . $id . '" />
					
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

	private function populateErrorList($errors){
		$ret = ''; 

		foreach ($errors as $error) {
			$ret .= '<li>' . $error . '</li>'; 
		}	

		$ret = '<ul>'
		.	$ret .
		'</ul>'; 

		return $ret; 
	}
}