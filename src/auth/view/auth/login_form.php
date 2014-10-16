<?php 
if(!isset($message)){
	$message = ""; 
}
if(!isset($errorMessage)){
	$errorMessage = ""; 
}
?>
<h3>Ej inloggad!</h3>
<fieldset>
<?php 
	echo $message; 
	echo $errorMessage; 
?>
<legend>Logga in här!</legend>
<form action="<?php echo \core\routes::getRoute('auth','login'); ?>" method='post' >
	Användarnamn: <input type='text' name="<?php echo $userNamePost; ?>">	
	Lösenord: <input type='password' name="<?php echo $passwordPost; ?>">
	<input type='submit' value='Logga in' name='login'>
</form>
</fieldset>

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
}?>