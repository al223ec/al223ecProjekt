<?php 
	$errors = ""; 

	if(isset($errorMessages)){
		foreach ($errorMessages as $error) {
			$errors .= "<li>" . $error . "</li>"; 
		}
	}
?>


<h4>Registrera nya användare - </h4>
<fieldset>
<legend>Registrera ny användare - skriv in användarnamn och lösenord</legend>
<?php if($errors !== ""){?> 
	<ul>
		<?php echo $errors;?> 
	</ul>
<?php }?>
<form action="<?php echo \core\Routes::getRoute('admin', 'saveNewUser'); ?>" method='post' >
		<fieldset>
			<label for='RegisterUserNameID' >Namn  :</label>
			<input type='text' name="<?php echo $userNamePost; ?>" id='RegisterUserNameID' value="">
		</fieldset>
		<fieldset>
			<label for='PasswordID' >Lösenord  :</label>
			<input type='text' name="<?php echo $passwordPost; ?>" id='PasswordID'>

		</fieldset>
		<fieldset>
			<label for='RepeatedPasswordID' >Repetera lösenord  :</label>
			<input type='text' name="<?php echo $repeatedPasswordPost; ?>" id='RepeatedPasswordID'>

		</fieldset>
	<input type='submit' value='Registrera'>
</form>