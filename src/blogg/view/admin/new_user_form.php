<section>
<div class="container">
<?php 
	$errors = ""; 

	if(isset($errorMessages)){
		foreach ($errorMessages as $error) {
			$errors .= "<li>" . $error . "</li>"; 
		}
	}
?>

<div class="col-md-12" >
	<h4>Registrera nya användare - </h4>
	<fieldset>
	<legend>Registrera ny användare - skriv in användarnamn och lösenord</legend>
	</fieldset>
	<?php if($errors !== ""){?> 
		<ul>
			<?php echo $errors;?> 
		</ul>
	<?php }?>
	<form action="<?php echo \core\Routes::getRoute('admin', 'saveUser'); ?>" method='post' >
			<fieldset>
				<label for="RegisterUserNameID" >Namn  :</label>
				<input type="text" name="<?php echo $userNamePost; ?>" id='RegisterUserNameID' value="">
			</fieldset>
			<fieldset>
				<label for="isAdminCheckbox" >Administratör  :</label>
				<input type="checkbox" name="<?php echo $isAdminCheckBox; ?>" value="Admin" id="isAdminCheckbox">
			</fieldset>
			<fieldset>
				<label for='PasswordID' >Lösenord  :</label>
				<input type='text' name="<?php echo $passwordPost; ?>" id='PasswordID'>

			</fieldset>
			<fieldset>
				<label for='RepeatedPasswordID' >Repetera lösenord  :</label>
				<input type='text' name="<?php echo $repeatedPasswordPost; ?>" id='RepeatedPasswordID'>

			</fieldset>
		<input class="btn btn-primary" type='submit' value='Registrera'>
	</form>
</div>
</div>
</section>