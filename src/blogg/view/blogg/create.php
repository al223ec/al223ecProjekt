<p>
' . $errors .' 
</p>
<form action="<?php echo \core\Routes::getRoute('blogg', 'save');  ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Posta en post - Skriv in titel och text</legend>
		<fieldset>
			<label for="Titel" >Titel :</label>
			<input type="text" size="80" name="<?php echo $titelPost; ?>" id="Titel" value="'<?php echo $titel ?>" />
		</fieldset>
		<input type="hidden" id="<?php echo $idPost; ?>" name="<?php echo $idPost; ?>" value="<?php echo $id; ?>" />
					
		<fieldset>
		<label for="Text" >Text  :</label>
		<textarea name="<?php echo $textPost; ?>" id="Text"> </textarea>
		</fieldset>
			<input type="submit" name=""  value="Posta post" />
	</fieldset>
</form>
	 	<a href="<?php echo \core\Routes::getRoute('blogg', 'main'); ?>"> Tillbaka</a>



<?php function populateErrorList($errors){
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