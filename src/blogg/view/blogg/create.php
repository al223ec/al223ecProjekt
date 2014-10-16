<?php

	$errors = ""; 
	$id = 0; 
	$titel = "";
	$postText = ""; 

	if($post !== null){
		$errors = populateErrorList($post->getErrors()); 
		$id = $post->getId();
		$titel = $post->getTitel(); 
		$postText = $post->getText(); 
	}
?>
<div class="row">
	<div class="col-md-12">
		<form action="<?php echo \core\Routes::getRoute('blogg', 'save');  ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Posta en post - Skriv in titel och text</legend>
				<?php echo $errors; ?>
				<fieldset>
					<label for="Titel" >Titel :</label>
					<input type="text" size="80" name="<?php echo $titelPost; ?>" id="Titel" value="<?php echo $titel ?>" />
				</fieldset>
				<input type="hidden" id="<?php echo $idPost; ?>" name="<?php echo $idPost; ?>" value="<?php echo $id; ?>" />			
				<fieldset>
				<label for="Text" >Text  :</label>
				<textarea name="<?php echo $textPost; ?>" id="Text"><?php echo $postText; ?> </textarea>
				</fieldset>
					<input type="submit" name=""  value="Posta post" />
			</fieldset>
		</form>
		<a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>"> Tillbaka</a>
	</div>
</div>

<?php 
function populateErrorList($errors){
	$ret = ''; 

	foreach ($errors as $error) {
		$ret .= '<li>' . $error . '</li>'; 
	}	

	$ret = '<ul>'
	.	$ret .
	'</ul>'; 

	return $ret; 
}
?>