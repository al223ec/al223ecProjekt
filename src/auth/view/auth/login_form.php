<?php 
if(!isset($message)){
	//throw new \Exception("Login_form:: message är inte definerat!");
}
?>

<h2>Ej inloggad!</h2>
<fieldset>
<?php echo $message; ?>

<legend>Logga in här!</legend>
<form action="<?php echo \core\routes::getRoute('auth','login'); ?>" method='post' >
	Användarnamn: <input type='text' name="<?php echo $userNamePost; ?>">	
	Lösenord: <input type='password' name="<?php echo $passwordPost; ?>">

	<input type='submit' value='Logga in' name='login'>
</form>
</fieldset>